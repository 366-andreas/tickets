<?php

namespace AndreasNik\Ticket\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AndreasNik\Ticket\Models\TicketCategory;

class CategoryFactory extends Factory
{
    protected $model = TicketCategory::class;

    public function definition(): array
    {
        return [
            'system_name' => $this->faker->sentence(1),
            'entity_type' => config('ticket.entities')[0],
            'priority' => config('ticket.priorities')[0],
            'enabled' => 1,
        ];
    }
}
