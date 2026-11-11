<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can successfully sign up and data is stored in the database.
     */
    public function test_user_can_sign_up_and_data_is_stored_in_database(): void
    {
        $response = $this->postJson('/signup', [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'phone' => '+62 812-9876-5432',
            'password' => 'secret12345',
            'password_confirmation' => 'secret12345',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'user' => [
                    'name' => 'Budi Santoso',
                    'email' => 'budi.santoso@example.com',
                    'phone' => '+62 812-9876-5432',
                    'role' => 'user',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'phone' => '+62 812-9876-5432',
            'role' => 'user',
        ]);

        $user = User::where('email', 'budi.santoso@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('secret12345', $user->password));
        $this->assertFalse($user->isAdmin());
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }

    /**
     * Test user can sign up with a profile photo avatar.
     */
    public function test_user_can_sign_up_with_profile_photo(): void
    {
        $file = UploadedFile::fake()->image('my-profile.jpg', 200, 200);

        $response = $this->postJson('/signup', [
            'name' => 'Dewi Lestari',
            'email' => 'dewi.lestari@example.com',
            'phone' => '+62 813-1122-3344',
            'password' => 'dewipassword123',
            'password_confirmation' => 'dewipassword123',
            'avatar' => $file,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        $user = User::where('email', 'dewi.lestari@example.com')->first();
        $this->assertNotNull($user);
        $this->assertNotNull($user->avatar);
        $this->assertStringStartsWith('images/avatars/', $user->avatar);
        $this->assertFileExists(public_path($user->avatar));

        // Clean up test file
        if (File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }
    }

    /**
     * Test database role column properly distinguishes between user and admin roles.
     */
    public function test_role_column_distinguishes_user_and_admin(): void
    {
        $regularUser = User::factory()->create([
            'email' => 'regular@dewasufa.com',
            'role' => 'user',
        ]);

        $adminUser = User::factory()->admin()->create([
            'email' => 'admin.test@dewasufa.com',
        ]);

        $this->assertEquals('user', $regularUser->role);
        $this->assertFalse($regularUser->isAdmin());

        $this->assertEquals('admin', $adminUser->role);
        $this->assertTrue($adminUser->isAdmin());

        $this->assertDatabaseHas('users', [
            'id' => $regularUser->id,
            'role' => 'user',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $adminUser->id,
            'role' => 'admin',
        ]);
    }

    /**
     * Test validation rules on signup.
     */
    public function test_signup_validation_errors(): void
    {
        // Missing required fields
        $response = $this->postJson('/signup', []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password', 'password_confirmation']);

        // Password mismatch
        $responseMismatch = $this->postJson('/signup', [
            'name' => 'Testing',
            'email' => 'testing@dewasufa.com',
            'password' => 'secret123',
            'password_confirmation' => 'mismatch123',
        ]);
        $responseMismatch->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);

        // Duplicate email
        User::factory()->create(['email' => 'existing@dewasufa.com']);
        $responseDuplicate = $this->postJson('/signup', [
            'name' => 'Testing Dupe',
            'email' => 'existing@dewasufa.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);
        $responseDuplicate->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Test user can log in with database credentials.
     */
    public function test_user_can_login_with_database_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'member@dewasufa.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/login', [
            'login' => 'member@dewasufa.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'user' => [
                    'email' => 'member@dewasufa.com',
                ],
            ]);

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }

    /**
     * Test public welcome page contains the signup modal with avatar input.
     */
    public function test_welcome_page_has_signup_modal_with_avatar_feature(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="signup-modal"', false);
        $response->assertSee('id="signup-avatar"', false);
        $response->assertSee('id="signup-avatar-preview"', false);
        $response->assertSee('id="signup-email"', false);
        $response->assertSee('id="signup-username"', false);
        $response->assertSee('id="signup-phone"', false);
    }
}

