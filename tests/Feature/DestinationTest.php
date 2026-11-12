<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DestinationTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_displays_real_destinations_and_counts(): void
    {
        Destination::factory()->create([
            'name' => 'Air Terjun Sekumpul',
            'category' => 'Waterfall',
            'price' => 20000,
            'status' => 'post',
        ]);

        Destination::factory()->create([
            'name' => 'Pantai Kuta',
            'category' => 'Sunset Beach',
            'price' => 0,
            'status' => 'post',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Air Terjun Sekumpul');
        $response->assertSee('Pantai Kuta');
        $response->assertSee('1+ Destinasi');
    }

    public function test_pending_destinations_are_hidden_from_public_and_user_dashboard(): void
    {
        Destination::factory()->create([
            'name' => 'Spot Publik Aktif',
            'category' => 'Waterfall',
            'status' => 'post',
        ]);

        Destination::factory()->create([
            'name' => 'Spot Rahasia Pending',
            'category' => 'Mountain',
            'status' => 'pending',
        ]);

        // 1. Welcome page: only post is visible
        $welcomeResponse = $this->get('/');
        $welcomeResponse->assertStatus(200);
        $welcomeResponse->assertSee('Spot Publik Aktif');
        $welcomeResponse->assertDontSee('Spot Rahasia Pending');

        // 2. User Dashboard: only post is visible
        $user = User::factory()->create(['role' => 'user']);
        $dashResponse = $this->actingAs($user)->get('/dashboard');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Spot Publik Aktif');
        $dashResponse->assertDontSee('Spot Rahasia Pending');

        // 3. API Destinations: only post is returned
        $apiResponse = $this->getJson('/api/destinations');
        $apiResponse->assertStatus(200);
        $apiResponse->assertJsonCount(1);
        $apiResponse->assertSee('Spot Publik Aktif');
        $apiResponse->assertDontSee('Spot Rahasia Pending');
    }

    public function test_admin_dashboard_displays_both_post_and_pending_destinations(): void
    {
        Destination::factory()->create([
            'name' => 'Spot Sudah Terbit',
            'category' => 'Waterfall',
            'status' => 'post',
        ]);

        Destination::factory()->create([
            'name' => 'Spot Belum Terbit Pending',
            'category' => 'Mountain',
            'status' => 'pending',
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Spot Sudah Terbit');
        $response->assertSee('Spot Belum Terbit Pending');
    }

    public function test_dashboard_displays_real_destinations_from_database(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Air Terjun Gitgit',
            'category' => 'Waterfall',
            'price' => 15000,
            'status' => 'post',
        ]);

        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Air Terjun Gitgit');
        $response->assertSee('Rp 15.000 / orang');
    }

    public function test_admin_dashboard_displays_real_destinations(): void
    {
        Destination::factory()->create([
            'name' => 'Gunung Batur',
            'category' => 'Mountain',
            'price' => 100000,
            'status' => 'post',
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Gunung Batur');
        $response->assertSee('Rp 100.000 / orang');
    }

    public function test_admin_can_store_a_destination_with_pending_status(): void
    {
        $file = UploadedFile::fake()->image('test_spot.jpg');

        $response = $this->postJson('/admin/destinations', [
            'name' => 'Pantai Pandawa Pending',
            'category' => 'Sunset Beach',
            'description' => 'Pantai indah dengan tebing kapur dan patung panca pandawa.',
            'price' => 'Rp 15.000 / orang',
            'image' => $file,
            'status' => 'pending',
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('destination.name', 'Pantai Pandawa Pending');
        $response->assertJsonPath('destination.status', 'pending');

        $this->assertDatabaseHas('destinations', [
            'name' => 'Pantai Pandawa Pending',
            'category' => 'Sunset Beach',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_update_a_destination_status_to_post(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Spot Pending Sebelumnya',
            'category' => 'Waterfall',
            'price' => 10000,
            'status' => 'pending',
        ]);

        $response = $this->postJson("/admin/destinations/{$destination->id}", [
            'name' => 'Spot Pending Sebelumnya',
            'category' => 'Waterfall',
            'description' => 'Deskripsi spot terbaru yang menakjubkan.',
            'price' => '25000',
            'status' => 'post',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'status' => 'post',
            'price' => 25000,
        ]);
    }

    public function test_admin_can_delete_a_destination_from_database(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Destinasi yang Mau Dihapus',
        ]);

        $response = $this->deleteJson("/admin/destinations/{$destination->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        $this->assertDatabaseMissing('destinations', [
            'id' => $destination->id,
        ]);
    }

    public function test_api_returns_all_destinations_as_json(): void
    {
        Destination::factory()->count(3)->create(['status' => 'post']);

        $response = $this->getJson('/api/destinations');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
