<?php

namespace Database\Factories;

use App\Enums\TicketCategory;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tracking_code' => 'TKT-' . fake()->numberBetween(10000000000, 1999999999),
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(asText: true),
            'category' => fake()->randomElement(TicketCategory::cases()),
            'status' => fake()->randomElement(TicketStatus::cases()),
            'email' => fake()->email()
        ];
    }
}
