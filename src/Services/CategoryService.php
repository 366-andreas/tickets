<?php

namespace AndreasNik\Ticket\Services;

use AndreasNik\Ticket\Interfaces\EntityActions;
use AndreasNik\Ticket\Interfaces\TicketCategoryActions;
use AndreasNik\Ticket\Models\TicketCategory;

class CategoryService implements TicketCategoryActions, EntityActions
{
    private ?TicketCategory $category = null;
    private string $entity;

    /**
     * @param string $entity
     * @return $this
     */
    public function setEntity(string $entity): CategoryService
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category): CategoryService
    {
        if (!is_null($category)) {
            $category = $category instanceof TicketCategory ? $category : TicketCategory::query()->findOrFail($category);
        }
        $this->category = $category;

        return $this;
    }


    /**
     * @return TicketCategory|null
     */
    public function getCategory(): ?TicketCategory
    {
        return $this->category;
    }


    /**
     * @return CategoryService
     */
    private function refreshCategory(): CategoryService
    {
        if (!is_null($this->category)) {
            $this->setCategory($this->category->refresh());
        }

        return $this;
    }


    /**
     * Create Ticket Category with its content
     *
     * @param int $userID
     * @param array $categoryData
     * @param array $contentData
     * @return CategoryService
     */
    public function new(int $userID, array $categoryData, array $contentData): CategoryService
    {
        /**
         * @var TicketCategory $category
         */
        $categoryData = array_merge($categoryData,
            [
                'created_by' => $userID,
                'entity_type' => $this->entity
            ]);
        $category = TicketCategory::query()->create($categoryData);

        $this->setCategory($category);

        !empty($contentData) && $this->updateContent($contentData);

        return $this;
    }


    /**
     * Edit Ticket Category with its content
     * @param int $userID
     * @param array $categoryData
     * @param array|null $contentData
     * @return CategoryService
     */
    public function edit(int $userID, array $categoryData, array $contentData = null): CategoryService
    {
        if (!is_null($this->category)) {
            $this->category->update(array_merge($categoryData, ['modified_by' => $userID]));
            $this->refreshCategory();
        }

        return $this->updateContent($contentData);
    }


    /**
     * @param array|null $data
     * @return CategoryService
     */
    public function updateContent(array $data = null): CategoryService
    {
        if (!is_null($this->category) && !is_null($data)) {
            $this->category->content()->forceDelete();
            $this->category->content()->createMany($data);
        }

        return $this->refreshCategory();
    }


    /**
     * @param int $userID
     * @return CategoryService
     */
    public function toggleStatus(int $userID): CategoryService
    {
        $this->category->update([
            'enabled' => !$this->category->getAttribute('enabled'),
            'modified_by' => $userID
        ]);

        return $this->refreshCategory();
    }
}