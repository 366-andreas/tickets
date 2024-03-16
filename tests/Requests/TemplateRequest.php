<?php

namespace AndreasNik\Ticket\Tests\Requests;


use AndreasNik\Ticket\Database\Factories\CategoryFactory;
use AndreasNik\Ticket\Models\TicketCategory;
use Illuminate\Contracts\Container\BindingResolutionException;

trait TemplateRequest
{
    /**
     * @throws BindingResolutionException
     */
    public function createTemplate(string $entity): array
    {
        return [
            'name' => 'Test Template',
            'category_id' => app()->make(CategoryFactory::class)->create(['entity_type' => $entity]),
            'enabled' => 1,
        ];
    }

    public function updateTemplate(): array
    {
        return [
            'enabled' => 0,
        ];
    }

    public function createTemplateContent(): array
    {
        return [
            [
                'language_id' => 1,
                'content' => 'Name 1',
            ],
            [
                'language_id' => 2,
                'content' => 'Name 2',
            ],
            [
                'language_id' => 3,
                'content' => 'Name 3',
            ]
        ];
    }

    public function updateTemplateContent(): array
    {
        return [
            [
                'language_id' => 3,
                'content' => 'Name 3',
            ]
        ];
    }

}