<?php

namespace AndreasNik\Ticket\Tests;

use AndreasNik\Ticket\TicketServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase,
        WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('config:clear');
    }


    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        Artisan::call('migrate:refresh', [
            '--database' => 'testing',
            '--path' => '../../../../database/migrations',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            TicketServiceProvider::class
        ];
    }
}
