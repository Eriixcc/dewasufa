<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_dashboard_returns_a_successful_response(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Pengguna');
        $response->assertSee('Destinasi Baru Rilis');
        $response->assertSee('Riwayat Terakhir Dilihat');
        $response->assertSee('Buat Destinasi Baru');
    }
}
