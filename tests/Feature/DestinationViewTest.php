<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\DestinationView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinationViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_record_destination_view(): void
    {
        $destination = Destination::factory()->create(['status' => 'post']);

        $response = $this->postJson(route('api.destinations.view', $destination));

        $response->assertStatus(401);
        $this->assertDatabaseEmpty('destination_views');
    }

    public function test_authenticated_user_records_view_in_database(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create(['status' => 'post']);

        $response = $this->actingAs($user)->postJson(route('api.destinations.view', $destination));

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('destination_views', [
            'user_id' => $user->id,
            'destination_id' => $destination->id,
        ]);
    }

    public function test_viewing_same_destination_updates_recency_without_duplicate(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create(['status' => 'post']);

        $this->actingAs($user)->postJson(route('api.destinations.view', $destination));
        $this->actingAs($user)->postJson(route('api.destinations.view', $destination));

        $this->assertEquals(1, DestinationView::where('user_id', $user->id)->count());
    }

    public function test_dashboard_persists_and_returns_recently_viewed_destinations(): void
    {
        $user = User::factory()->create();
        $destinations = Destination::factory()->count(5)->create(['status' => 'post']);

        // View 3 destinations
        foreach ($destinations->take(3) as $dest) {
            $this->actingAs($user)->postJson(route('api.destinations.view', $dest));
        }

        // Load dashboard (simulating page refresh)
        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('recentlyViewed', function ($recentlyViewed) {
            return $recentlyViewed->count() === 3;
        });
    }

    public function test_authenticated_user_can_clear_history(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create(['status' => 'post']);

        $this->actingAs($user)->postJson(route('api.destinations.view', $destination));
        $this->assertEquals(1, DestinationView::where('user_id', $user->id)->count());

        $response = $this->actingAs($user)->postJson(route('api.history.clear'));

        $response->assertStatus(200);
        $this->assertEquals(0, DestinationView::where('user_id', $user->id)->count());
    }
}
