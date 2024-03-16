<?php

namespace AndreasNik\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use TicketSettingsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TicketSettingsSeeder::class);
    }
}


