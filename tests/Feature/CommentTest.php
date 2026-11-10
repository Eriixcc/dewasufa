<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_can_fetch_comments(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Air Terjun Gitgit',
            'category' => 'Waterfall',
        ]);

        Comment::factory()->create([
            'destination_id' => $destination->id,
            'destination_slug' => 'gitgit',
            'destination_name' => 'Air Terjun Gitgit',
            'author_name' => 'Wayan Tester',
            'comment' => 'Air terjun yang sangat indah dan mempesona.',
        ]);

        $response = $this->getJson('/api/comments');

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertSee('Wayan Tester');
        $response->assertSee('Air terjun yang sangat indah');
    }

    public function test_user_can_submit_a_comment_with_rating(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Pantai Melasti',
            'category' => 'Sunset Beach',
        ]);

        $response = $this->postJson('/api/comments', [
            'destination_id' => $destination->id,
            'destination_slug' => 'sunset',
            'destination_name' => 'Pantai Melasti',
            'author_name' => 'Made Anindya',
            'rating' => 5,
            'comment' => 'Sunset terbaik di tebing kapur Bali Selatan!',
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('comment.author_name', 'Made Anindya');

        $this->assertDatabaseHas('comments', [
            'author_name' => 'Made Anindya',
            'destination_id' => $destination->id,
            'comment' => 'Sunset terbaik di tebing kapur Bali Selatan!',
        ]);
    }

    public function test_user_can_submit_comment_with_uploaded_photos(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Gunung Batur',
            'category' => 'Mountain',
        ]);

        $file = UploadedFile::fake()->image('batur_sunrise.jpg');

        $response = $this->post('/api/comments', [
            'destination_id' => $destination->id,
            'destination_slug' => 'mountain',
            'destination_name' => 'Gunung Batur',
            'author_name' => 'Ketut Pendaki',
            'rating' => 5,
            'comment' => 'Pemandangan lautan awan dari puncak batur sangat magis!',
            'photos' => [$file],
        ], ['Accept' => 'application/json']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', [
            'author_name' => 'Ketut Pendaki',
            'rating' => 5.0,
        ]);

        $comment = Comment::where('author_name', 'Ketut Pendaki')->first();
        $this->assertNotNull($comment);
        $this->assertNotEmpty($comment->photos);
    }

    public function test_admin_dashboard_displays_real_comments_from_database(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Air Terjun Sekumpul',
            'category' => 'Waterfall',
        ]);

        Comment::factory()->create([
            'destination_id' => $destination->id,
            'author_name' => 'Nyoman Wisatawan',
            'comment' => 'Trekking seru dan pemandangan luar biasa sejuk.',
        ]);

        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Nyoman Wisatawan');
        $response->assertSee('Trekking seru dan pemandangan luar biasa sejuk.');
    }

    public function test_admin_can_delete_a_comment_from_database(): void
    {
        $comment = Comment::factory()->create([
            'author_name' => 'Spam User',
            'comment' => 'Ini komentar yang melanggar ketentuan.',
        ]);

        $response = $this->deleteJson("/admin/comments/{$comment->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}

