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

    public function test_api_returns_empty_when_destination_has_no_comments(): void
    {
        $destination = Destination::factory()->create([
            'name' => 'Destinasi Baru',
            'category' => 'Waterfall',
        ]);

        $response = $this->getJson("/api/comments?destination_id={$destination->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('count', 0);
        $response->assertJsonPath('comments', []);
    }

    public function test_api_filters_comments_by_destination_id(): void
    {
        $dest1 = Destination::factory()->create(['name' => 'Pantai A']);
        $dest2 = Destination::factory()->create(['name' => 'Pantai B']);

        Comment::factory()->create([
            'destination_id' => $dest1->id,
            'author_name' => 'User Dest 1',
            'comment' => 'Komentar Pantai A',
        ]);

        Comment::factory()->create([
            'destination_id' => $dest2->id,
            'author_name' => 'User Dest 2',
            'comment' => 'Komentar Pantai B',
        ]);

        $response = $this->getJson("/api/comments?destination_id={$dest1->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('count', 1);
        $response->assertSee('User Dest 1');
        $response->assertDontSee('User Dest 2');
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

    public function test_destination_rating_and_reviews_count_are_calculated_correctly_on_comment_store(): void
    {
        $dest = Destination::factory()->create([
            'rating' => 0.0,
            'reviews_count' => 0,
        ]);

        // Submit first comment with rating 5
        $this->postJson('/api/comments', [
            'destination_id' => $dest->id,
            'author_name' => 'Reviewer 1',
            'rating' => 5,
            'comment' => 'Bagus sekali!',
        ])->assertStatus(201);

        $dest->refresh();
        $this->assertEquals(5.0, (float) $dest->rating);
        $this->assertEquals(1, $dest->reviews_count);

        // Submit second comment with rating 3
        $this->postJson('/api/comments', [
            'destination_id' => $dest->id,
            'author_name' => 'Reviewer 2',
            'rating' => 3,
            'comment' => 'Cukup bagus.',
        ])->assertStatus(201);

        $dest->refresh();
        // (5 + 3) / 2 = 4.0
        $this->assertEquals(4.0, (float) $dest->rating);
        $this->assertEquals(2, $dest->reviews_count);
    }

    public function test_api_comments_returns_avg_rating_breakdown_and_supports_star_filtering(): void
    {
        $dest = Destination::factory()->create();

        Comment::factory()->create([
            'destination_id' => $dest->id,
            'rating' => 5,
            'comment' => 'Bintang 5 A',
        ]);
        Comment::factory()->create([
            'destination_id' => $dest->id,
            'rating' => 5,
            'comment' => 'Bintang 5 B',
        ]);
        Comment::factory()->create([
            'destination_id' => $dest->id,
            'rating' => 1,
            'comment' => 'Bintang 1 Kurang Memuaskan',
        ]);

        // 1. Get all comments for destination
        $resAll = $this->getJson("/api/comments?destination_id={$dest->id}");
        $resAll->assertStatus(200);
        $resAll->assertJsonPath('count', 3);
        $resAll->assertJsonPath('avg_rating', 3.7);
        $resAll->assertJsonPath('rating_breakdown.5', 2);
        $resAll->assertJsonPath('rating_breakdown.1', 1);

        // 2. Filter only 1 star
        $resStar1 = $this->getJson("/api/comments?destination_id={$dest->id}&rating=1");
        $resStar1->assertStatus(200);
        $resStar1->assertJsonPath('filtered_count', 1);
        $resStar1->assertSee('Bintang 1 Kurang Memuaskan');
        $resStar1->assertDontSee('Bintang 5 A');

        // 3. Filter only 5 stars
        $resStar5 = $this->getJson("/api/comments?destination_id={$dest->id}&rating=5");
        $resStar5->assertStatus(200);
        $resStar5->assertJsonPath('filtered_count', 2);
        $resStar5->assertSee('Bintang 5 A');
        $resStar5->assertSee('Bintang 5 B');
        $resStar5->assertDontSee('Bintang 1 Kurang Memuaskan');
    }
}
