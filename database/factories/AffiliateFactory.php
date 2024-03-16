<?php

namespace AndreasNik\Ticket\Database\Factories;

use AndreasNik\Ticket\Tests\Models\Affiliate;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliateFactory extends Factory
{
    protected $model = Affiliate::class;

    public function definition(): array
    {
        return [
            'name' => 'andreas',
            'contact_id' => 123,
            'language_id' => 2
        ];
    }
}