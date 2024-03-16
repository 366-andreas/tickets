<?php

namespace AndreasNik\Ticket\Tests\Requests;

use AndreasNik\Ticket\Enums\Priority;

trait CategoryRequest
{
    public function createCategory(): array
    {
        return [
            'system_name' => 'Test Category',
            'priority' => Priority::Low,
            'enabled' => 1,
            'color' => null,
        ];
    }

    public function updateCategory(): array
    {
        return [
            'priority' => Priority::Critical,
            'enabled' => 0,
            'color' => null,
        ];
    }

    public function createCategoryContent(): array
    {
        return [
            [
                'language_id' => 1,
                'name' => 'Name 1',
            ],
            [
                'language_id' => 2,
                'name' => 'Name 2',
            ],
            [
                'language_id' => 3,
                'name' => 'Name 3',
            ]
        ];
    }

    public function updateCategoryContent(): array
    {
        return [
            [
                'language_id' => 3,
                'name' => 'Name 3',
            ]
        ];
    }

}