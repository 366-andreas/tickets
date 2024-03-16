<?php

use AndreasNik\Ticket\Models\TicketSettings;
use Illuminate\Database\Seeder;

class TicketSettingsSeeder extends Seeder
{
    public function run()
    {
        TicketSettings::query()->insert([
            [
                'entity_type' => 'client',
                'ai_status' => true,
                'inactive_days_passed_to_resolve_ticket' => 10
            ],
            [
                'entity_type' => 'affiliate',
                'ai_status' => true,
                'inactive_days_passed_to_resolve_ticket' => 10
            ],
        ]);
    }
}