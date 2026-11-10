<?php

namespace Tests\Feature;

use App\Models\Destination;
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
        ]);

        Destination::factory()->create([
            'name' => 'Pantai Kuta',
            'category' => 'Sunset Beach',
            'price' => 0,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Air Terjun Sekumpul');
        $response->assertSee('Pantai Kuta');
        $response->assertSee('1+ Destinasi');
    }

    public function test_dashboard_displays_real_destinations_from_database(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Air Terjun Gitgit',
            'category' => 'Waterfall',
            'price' => 15000,
        ]);

        $response = $this->get('/dashboard');

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
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Gunung Batur');
        $response->assertSee('Rp 100.000 / orang');
    }

    public function test_admin_can_store_a_destination_in_database(): void
    {
        $file = UploadedFile::fake()->image('test_spot.jpg');

        $response = $this->postJson('/admin/destinations', [
            'name' => 'Pantai Pandawa',
            'category' => 'Sunset Beach',
            'description' => 'Pantai indah dengan tebing kapur dan patung panca pandawa.',
            'price' => 'Rp 15.000 / orang',
            'image' => $file,
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('destination.name', 'Pantai Pandawa');

        $this->assertDatabaseHas('destinations', [
            'name' => 'Pantai Pandawa',
            'category' => 'Sunset Beach',
            'price' => 15000,
        ]);
    }

    public function test_admin_can_update_a_destination_in_database(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Spot Lama',
            'category' => 'Waterfall',
            'price' => 10000,
        ]);

        $response = $this->postJson("/admin/destinations/{$destination->id}", [
            'name' => 'Spot Baru Diupdate',
            'category' => 'Mountain',
            'description' => 'Deskripsi spot terbaru yang menakjubkan.',
            'price' => '25000',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'name' => 'Spot Baru Diupdate',
            'category' => 'Mountain',
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
        Destination::factory()->count(3)->create();

        $response = $this->getJson('/api/destinations');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
