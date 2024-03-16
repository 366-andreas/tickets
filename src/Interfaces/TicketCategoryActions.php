<?php

namespace AndreasNik\Ticket\Interfaces;

use AndreasNik\Ticket\Services\CategoryService;

interface TicketCategoryActions
{
    public function setCategory($category): CategoryService;
    public function new(int $userID, array $categoryData, array $contentData): CategoryService;
    public function edit(int $userID, array $categoryData, array $contentData = null): CategoryService;
    public function updateContent(array $data = null): CategoryService;
    public function toggleStatus(int $userID): CategoryService;
}