<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination_id' => Destination::factory(),
            'destination_slug' => 'waterfall',
            'destination_name' => fake()->words(3, true),
            'author_name' => fake()->name(),
            'author_role' => 'Wisatawan Terverifikasi',
            'rating' => 5.0,
            'comment' => fake()->paragraph(),
            'photos' => null,
            'status' => 'published',
        ];
    }
}

