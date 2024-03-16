<?php

namespace AndreasNik\Ticket\Services;

use AndreasNik\Ticket\Interfaces\EntityActions;
use AndreasNik\Ticket\Interfaces\TicketReplyTemplateActions;
use AndreasNik\Ticket\Models\TicketReplyTemplate;

class ReplyTemplateService implements TicketReplyTemplateActions, EntityActions
{
    private ?TicketReplyTemplate $template = null;
    private string $entity;

    /**
     * @param string $entity
     * @return $this
     */
    public function setEntity(string $entity): ReplyTemplateService
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template): ReplyTemplateService
    {
        if (!is_null($template)) {
            $template = $template instanceof TicketReplyTemplate ? $template : TicketReplyTemplate::query()->findOrFail($template);
        }
        $this->template = $template;

        return $this;
    }


    /**
     * @return TicketReplyTemplate|null
     */
    public function getTemplate(): ?TicketReplyTemplate
    {
        return $this->template;
    }


    /**
     * @return $this
     */
    private function refreshTemplate(): ReplyTemplateService
    {
        if (!is_null($this->template)) {
            $this->setTemplate($this->template->refresh());
        }

        return $this;
    }


    /**
     * @param int $userID
     * @param array $templateData
     * @param array $contentData
     * @return $this
     */
    public function new(int $userID, array $templateData, array $contentData): ReplyTemplateService
    {
        /**
         * @var TicketReplyTemplate $template
         */
        $templateData = array_merge($templateData,
            [
                'created_by' => $userID,
                'entity_type' => $this->entity
            ]);
        $template = TicketReplyTemplate::query()->create($templateData);

        $this->setTemplate($template);

        !empty($contentData) && $this->updateContent($contentData);

        return $this;
    }


    /**
     * @param int $userID
     * @param array $templateData
     * @param array|null $contentData
     * @return ReplyTemplateService
     */
    public function edit(int $userID, array $templateData, array $contentData = null): ReplyTemplateService
    {
        if (!is_null($this->template)) {
            $this->template->update(array_merge($templateData, ['modified_by' => $userID]));
            $this->refreshTemplate();
        }

        return $this->updateContent($contentData);
    }


    /**
     * @param array|null $data
     * @return ReplyTemplateService
     */
    public function updateContent(array $data = null): ReplyTemplateService
    {
        if (!is_null($this->template) && !is_null($data)) {
            $this->template->content()->forceDelete();
            $this->template->content()->createMany($data);
        }

        return $this->refreshTemplate();
    }

    /**
     * @param int $userID
     * @return ReplyTemplateService
     */
    public function toggleStatus(int $userID): ReplyTemplateService
    {
        $this->template->update([
            'enabled' => !$this->template->getAttribute('enabled'),
            'modified_by' => $userID
        ]);

        return $this->refreshTemplate();
    }
}