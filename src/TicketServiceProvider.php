<?php

namespace AndreasNik\Ticket;

use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();
        $this->mergeConfigFrom(__DIR__.'/../config/ticket.php', 'ticket');
        $this->loadMigrationsFrom('database/migrations');
    }
}