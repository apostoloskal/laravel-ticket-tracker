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
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(asText: true),
            'category' => fake()->randomElement(TicketCategory::cases()),
            'status' => fake()->randomElement(TicketStatus::cases()),
            'email' => fake()->email()
        ];
    }
}
