<?php

namespace AndreasNik\Ticket\Tests\Unit;

use AndreasNik\Ticket\Models\TicketReplyTemplate;
use AndreasNik\Ticket\Models\TicketReplyTemplateContent;
use AndreasNik\Ticket\Models\TicketSettings;
use AndreasNik\Ticket\Tests\Requests\TemplateRequest;
use AndreasNik\Ticket\Tests\TestCase;
use Illuminate\Contracts\Container\BindingResolutionException;

class TicketReplyTemplateTest extends TestCase
{
    use TemplateRequest;

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
    public function test_ticket_category(string $entity)
    {
        $userID = 112;
        $templateData = $this->createTemplate($entity);
        $contentData = $this->createTemplateContent();

        $template = helpdesk($entity)->template()->new($userID, $templateData, $contentData);
        $templateObject = $template->getTemplate();

        $this->assertions($userID, $entity, $templateData, $contentData, $templateObject);

        $templateData = $this->updateTemplate();
        $contentData = $this->updateTemplateContent();

        $template = helpdesk($entity)->template($templateObject)->edit($userID, $templateData, $contentData);
        $templateObject = $template->getTemplate();

        $this->assertions($userID, $entity, $templateData, $contentData, $templateObject);

        $category = helpdesk($entity)->template($templateObject)->toggleStatus($userID);
        $categoryObject = $category->getTemplate();

        $this->assertDatabaseHas(TicketReplyTemplate::class, [
                'id' => $categoryObject->getKey(),
                'enabled' => !$templateData['enabled'],
                'modified_by' => $userID
            ]
        );
    }

    private function assertions(int $userID, string $entity, array $templateData,
                                array $contentData, TicketReplyTemplate $templateObject)
    {
        $this->assertDatabaseHas(TicketReplyTemplate::class,
            array_merge($templateData,
                [
                    'entity_type' => $entity,
                    'created_by' => $userID
                ])
        );

        collect($contentData)->each(function (array $item) use ($templateObject) {
            $this->assertDatabaseHas(TicketReplyTemplateContent::class,
                array_merge(['template_id' => $templateObject->getKey()], $item)
            );
        });
    }
}