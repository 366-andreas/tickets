<?php

namespace AndreasNik\Ticket;

use AndreasNik\Ticket\Services\CategoryService;
use AndreasNik\Ticket\Services\ReplyTemplateService;
use AndreasNik\Ticket\Services\SettingsService;
use AndreasNik\Ticket\Services\TicketService;

class Helpdesk
{
    private TicketService $ticket;
    private CategoryService $category;
    private SettingsService $settings;
    private string $entity;
    private ReplyTemplateService $template;

    public function __construct(TicketService        $ticket,
                                CategoryService      $category,
                                SettingsService      $settings,
                                ReplyTemplateService $template)
    {
        $this->ticket = $ticket;
        $this->category = $category;
        $this->settings = $settings;
        $this->template = $template;
    }

    public function setEntity(string $entity): Helpdesk
    {
        $this->entity = $entity;
        return $this;
    }

    public function settings(): SettingsService
    {
        return $this->settings->setEntity($this->entity);
    }

    public function category($category = null): CategoryService
    {
        return $this->category->setEntity($this->entity)->setCategory($category);
    }

    public function template($template = null): ReplyTemplateService
    {
        return $this->template->setEntity($this->entity)->setTemplate($template);
    }


    public function ticket($ticket = null): TicketService
    {
        return $this->ticket->setEntity($this->entity)->setTicket($ticket);
    }



}