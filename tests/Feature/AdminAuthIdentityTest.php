<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthIdentityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_displays_logged_in_admin_identity(): void
    {
        $admin = User::factory()->create([
            'name' => 'God',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('God');
        $response->assertSee('admin@gmail.com');
        $response->assertDontSee('Erick');
    }

    public function test_different_admin_displays_their_own_name_and_not_hardcoded_erick(): void
    {
        $adminPrabs = User::factory()->create([
            'name' => 'Prabu Admin',
            'email' => 'prabu@dewasufa.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($adminPrabs)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Prabu Admin');
        $response->assertSee('prabu@dewasufa.com');
        $response->assertDontSee('Erick');
    }
}

