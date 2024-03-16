<?php

namespace AndreasNik\Ticket\Tests\Unit;

use AndreasNik\Ticket\Models\TicketCategory;
use AndreasNik\Ticket\Models\TicketCategoryContent;
use AndreasNik\Ticket\Models\TicketSettings;
use AndreasNik\Ticket\Tests\Requests\CategoryRequest;
use AndreasNik\Ticket\Tests\TestCase;
use Illuminate\Contracts\Container\BindingResolutionException;

class TicketCategoryTest extends TestCase
{
    use CategoryRequest;

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
        $categoryData = $this->createCategory();
        $contentData = $this->createCategoryContent();

        $category = helpdesk($entity)->category()->new($userID, $categoryData, $contentData);
        $categoryObject = $category->getCategory();

        $this->assertions($userID, $entity, $categoryData, $contentData, $categoryObject);

        $categoryData = $this->updateCategory();
        $contentData = $this->updateCategoryContent();

        $category = helpdesk($entity)->category($categoryObject)->edit($userID, $categoryData, $contentData);
        $categoryObject = $category->getCategory();

        $this->assertions($userID, $entity, $categoryData, $contentData, $categoryObject);

        $category = helpdesk($entity)->category($categoryObject)->toggleStatus($userID);
        $categoryObject = $category->getCategory();

        $this->assertDatabaseHas(TicketCategory::class, [
                'id' => $categoryObject->getKey(),
                'enabled' => !$categoryData['enabled'],
                'modified_by' => $userID
            ]
        );
    }

    private function assertions(int $userID, string $entity, array $categoryData,
                                array $contentData, TicketCategory $categoryObject)
    {
        $this->assertDatabaseHas(TicketCategory::class,
            array_merge($categoryData,
                [
                    'entity_type' => $entity,
                    'created_by' => $userID
                ])
        );

        collect($contentData)->each(function (array $item) use ($categoryObject) {
            $this->assertDatabaseHas(TicketCategoryContent::class,
                array_merge(['category_id' => $categoryObject->getKey()], $item)
            );
        });
    }
}