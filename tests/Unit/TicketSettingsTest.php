<?php

namespace AndreasNik\Ticket\Tests\Unit;

use AndreasNik\Ticket\Models\TicketAssignmentSettings;
use AndreasNik\Ticket\Models\TicketSettings;
use AndreasNik\Ticket\Tests\TestCase;
use Illuminate\Contracts\Container\BindingResolutionException;

class TicketSettingsTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

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

    public function providesEntity(): array
    {
        return [
            ['client'],
            ['affiliate']
        ];
    }

    /**
     * @dataProvider providesEntity
     * @throws BindingResolutionException
     */
    public function test_ticket_settings(string $entity)
    {
        $userId = 112;

        $settings = [
            'ai_status' => false,
            'inactive_days_passed_to_resolve_ticket' => 10
        ];

        helpdesk($entity)->settings()->updateSettings($userId, $settings);

        $this->assertDatabaseHas(TicketSettings::class,
            array_merge($settings,
                [
                    'entity_type' => $entity,
                    'modified_by' => $userId
                ])
        );
    }


    /**
     * @dataProvider providesEntity
     * @throws BindingResolutionException
     */
    public function test_ticket_assignment_settings(string $entity)
    {
        $assignments = [
            [
                'user_id' => 1,
                'language_id' => 1,
                'entity_type' => $entity
            ],
            [
                'user_id' => 2,
                'language_id' => 1,
                'entity_type' => $entity
            ],
            [
                'user_id' => 1,
                'language_id' => 2,
                'entity_type' => $entity
            ],
            [
                'user_id' => 2,
                'language_id' => 2,
                'entity_type' => $entity
            ],
        ];

        helpdesk($entity)->settings()->updateAssignments($assignments);

        collect($assignments)->each(function (array $data) {
            $this->assertDatabaseHas(TicketAssignmentSettings::class, $data);
        });
    }

}