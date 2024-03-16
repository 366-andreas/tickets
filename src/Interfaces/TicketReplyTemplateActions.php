<?php

namespace AndreasNik\Ticket\Interfaces;

use AndreasNik\Ticket\Services\ReplyTemplateService;

interface TicketReplyTemplateActions
{
    public function setTemplate($template): ReplyTemplateService;
    public function new(int $userID, array $templateData, array $contentData): ReplyTemplateService;
    public function edit(int $userID, array $templateData, array $contentData = null): ReplyTemplateService;
    public function updateContent(array $data = null): ReplyTemplateService;
    public function toggleStatus(int $userID): ReplyTemplateService;
}