<?php

namespace AndreasNik\Ticket\Services;

use AndreasNik\Ticket\Enums\Status;
use AndreasNik\Ticket\Interfaces\EntityActions;
use AndreasNik\Ticket\Interfaces\TicketActions;
use AndreasNik\Ticket\Models\Ticket;
use AndreasNik\Ticket\Services\Concerns\Response;
use AndreasNik\Ticket\Services\Concerns\TicketOperations;
use Illuminate\Database\Eloquent\Model;

class TicketService implements TicketActions, EntityActions
{
    private ?Ticket $ticket = null;
    private string $entity;

    use TicketOperations,
        Response;

    /**
     * @param string $entity
     * @return $this
     */
    public function setEntity(string $entity): TicketService
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * @param $ticket
     * @return $this
     */
    public function setTicket($ticket = null): TicketService
    {
        if (!is_null($ticket)) {
            $ticket = $ticket instanceof Ticket ? $ticket : Ticket::query()->findOrFail($ticket);
        }
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * @return TicketService
     */
    private function refreshTicket(): TicketService
    {
        if (!is_null($this->ticket)) {
            $this->setTicket($this->ticket->refresh());
        }

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    /**
     * @param int $userID
     * @param Model $entity
     * @param array $data
     * @return $this
     */
    public function createAsUser(int $userID, Model $entity, array $data): TicketService
    {
        $data = array_merge($data, [
            'entity_type' => $this->entity,
            'entity_id' => $entity->getKey(),
            'language_id' => $entity->getAttribute('language_id'),
            'waiting_response_from' => 'entity',
            'status' => Status::WaitingOnEntity,
            'opened_by' => 'user',
            'created_by' => $userID
        ]);

        return $this->create($data);
    }

    /**
     * @param Model $entity
     * @param array $data
     * @return $this
     */
    public function createAsEntity(Model $entity, array $data): TicketService
    {
        $data = array_merge($data, [
            'entity_type' => $this->entity,
            'entity_id' => $entity->getKey(),
            'language_id' => $entity->getAttribute('language_id'),
            'waiting_response_from' => 'user',
            'status' => Status::WaitingOnSupport,
            'opened_by' => 'entity',
            'created_by' => $entity->getKey()
        ]);

        return $this->create($data);
    }

    /**
     * @param array $data
     * @return $this
     */
    private function create(array $data): TicketService
    {
        $ticket = Ticket::query()->create($data);
        return $this->setTicket($ticket);
    }
}