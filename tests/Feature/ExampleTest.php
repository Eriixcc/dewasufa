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
        $response->assertSee('Daftar sebagai Author');
        $response->assertSee('Pengaturan (Settings)');
        $response->assertSee('Logout');
        $response->assertDontSee('Log Out (Keluar)');
    }

    public function test_author_registration_modal_contains_expected_fields(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('author-username');
        $response->assertSee('author-email');
        $response->assertSee('author-password');
        $response->assertSee('btn-submit-author-reg');
        $response->assertSee('Daftar');
        $response->assertSee('sedang diverifikasi oleh admin');
        $response->assertDontSee('new-dest-name');
        $response->assertDontSee('new-dest-category');
    }

    public function test_settings_modal_contains_reset_password_and_roles_and_no_dark_mode(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('settings-reset-password');
        $response->assertSee('settings-confirm-password');
        $response->assertSee('settings-role');
        $response->assertSee('readonly');
        $response->assertSee('settings-avatar-input');
        $response->assertSee('dash-notif-popover');
        $response->assertSee('dash-btn-lihat');
        $response->assertSee('User');
        $response->assertDontSee('•••');
        $response->assertDontSee('Mode Tampilan Gelap (Nature Glass)');
        $response->assertSee('Logout');
    }

    public function test_comment_author_username_is_locked_and_cannot_be_changed(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('comment-author-name');
        $response->assertSee('dash-comment-name-locked');
        $response->assertSee('Mengulas sebagai:');
        $response->assertSee('Akun Aktif');
        $response->assertDontSee('Nama Anda (Opsional)');
    }
}
