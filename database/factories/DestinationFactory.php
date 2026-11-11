<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Destination>
 */
class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement(['Waterfall', 'Sunset Beach', 'Sunrise Beach', 'Mountain']),
            'description' => fake()->paragraph(),
            'image' => 'images/waterfall.jpg',
            'price' => fake()->randomElement([0, 15000, 20000, 50000]),
            'status' => 'post',
        ];
    }

    /**
     * Indicate that the destination is pending (admin only).
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
