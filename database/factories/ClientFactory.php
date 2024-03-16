<?php

namespace AndreasNik\Ticket\Database\Factories;

use AndreasNik\Ticket\Tests\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => 'andreas',
            'referred_affiliate_id' => 1,
            'contact_id' => 123,
            'language_id' => 2
        ];
    }
}