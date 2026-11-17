<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\SavedDestination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavedDestinationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_save_destination(): void
    {
        $destination = Destination::factory()->create(['status' => 'post']);

        $response = $this->postJson(route('api.destinations.save', $destination));

        $response->assertStatus(401);
        $this->assertDatabaseEmpty('saved_destinations');
    }

    public function test_authenticated_user_can_save_destination_to_database(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create([
            'name' => 'Pantai Pandawa',
            'status' => 'post',
        ]);

        $response = $this->actingAs($user)->postJson(route('api.destinations.save', $destination));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_saved' => true,
        ]);

        $this->assertDatabaseHas('saved_destinations', [
            'user_id' => $user->id,
            'destination_id' => $destination->id,
        ]);
    }

    public function test_saving_again_toggles_and_removes_from_saved_destinations(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create(['status' => 'post']);

        // First save
        $this->actingAs($user)->postJson(route('api.destinations.save', $destination));
        $this->assertEquals(1, SavedDestination::where('user_id', $user->id)->count());

        // Toggle (remove)
        $response = $this->actingAs($user)->postJson(route('api.destinations.save', $destination));
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_saved' => false,
        ]);

        $this->assertEquals(0, SavedDestination::where('user_id', $user->id)->count());
    }

    public function test_saved_destinations_are_isolated_per_user(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $dest1 = Destination::factory()->create(['name' => 'Destinasi 1', 'status' => 'post']);
        $dest2 = Destination::factory()->create(['name' => 'Destinasi 2', 'status' => 'post']);

        // User 1 saves Destinasi 1
        $this->actingAs($user1)->postJson(route('api.destinations.save', $dest1));

        // User 2 saves Destinasi 2
        $this->actingAs($user2)->postJson(route('api.destinations.save', $dest2));

        // Check user 1 saved destinations
        $savedUser1 = SavedDestination::where('user_id', $user1->id)->pluck('destination_id')->all();
        $this->assertEquals([$dest1->id], $savedUser1);

        // Check user 2 saved destinations
        $savedUser2 = SavedDestination::where('user_id', $user2->id)->pluck('destination_id')->all();
        $this->assertEquals([$dest2->id], $savedUser2);
    }

    public function test_api_saved_plans_returns_only_authenticated_user_saved_destinations(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create([
            'name' => 'Air Terjun Gitgit',
            'status' => 'post',
        ]);

        SavedDestination::create([
            'user_id' => $user->id,
            'destination_id' => $destination->id,
        ]);

        $response = $this->actingAs($user)->getJson(route('api.saved-plans'));

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'id' => $destination->id,
            'title' => 'Air Terjun Gitgit',
        ]);
    }

    public function test_dashboard_injects_user_saved_destinations(): void
    {
        $user = User::factory()->create();
        $destination = Destination::factory()->create([
            'name' => 'Gunung Agung',
            'status' => 'post',
        ]);

        SavedDestination::create([
            'user_id' => $user->id,
            'destination_id' => $destination->id,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('savedDestinations', function ($saved) use ($destination) {
            return $saved->count() === 1 && $saved->first()->id === $destination->id;
        });
        $response->assertSee('Gunung Agung');
    }
}

