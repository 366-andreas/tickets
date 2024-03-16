<?php

namespace AndreasNik\Ticket\Services\Concerns;

use AndreasNik\Ticket\Enums\Priority;
use AndreasNik\Ticket\Enums\Status;
use AndreasNik\Ticket\Enums\WaitingFrom;
use AndreasNik\Ticket\Services\TicketService;

trait TicketOperations
{
    public function waitingOnSupport(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::WaitingOnSupport(), $userID);
    }

    public function inProgress(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::InProgress(), $userID);
    }

    public function waitingOnOtherDepartment(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::WaitingOnOtherDepartment(), $userID);
    }

    public function reopened(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::Reopened(), $userID);
    }

    public function waitingOnEntity(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::WaitingOnEntity(), $userID);
    }

    public function resolved(int $userID = null): TicketService
    {
        return $this->updateStatus(Status::Resolved(), $userID);
    }

    public function priorityLow(int $userID = null): TicketService
    {
        return $this->updatePriority(Priority::Low(), $userID);
    }

    public function priorityNormal(int $userID = null): TicketService
    {
        return $this->updatePriority(Priority::Normal(), $userID);
    }

    public function priorityHigh(int $userID = null): TicketService
    {
        return $this->updatePriority(Priority::High(), $userID);
    }

    public function priorityCritical(int $userID = null): TicketService
    {
        return $this->updatePriority(Priority::Critical(), $userID);
    }

    public function waitingFromEntity(int $userID = null): TicketService
    {
        return $this->updateWaitingFrom(WaitingFrom::Entity(), $userID);
    }

    public function waitingFromUser(): TicketService
    {
        return $this->updateWaitingFrom(WaitingFrom::User());
    }

    public function setCategory(int $userID, int $categoryId = null): TicketService
    {
        $this->ticket->update([
            'category_id' => $categoryId,
            'modified_by' => $userID
        ]);

        return $this->refreshTicket();
    }

    public function removeCategory($user): TicketService
    {
        return $this->setCategory($user);
    }


    public function assignToUser(int $userID, int $assignee = null): TicketService
    {
        $this->ticket->update([
            'assignee' => $assignee,
            'modified_by' => $userID
        ]);

        return $this->refreshTicket();
    }


    private function updateWaitingFrom(WaitingFrom $responseFrom, int $userID = null): TicketService
    {
        $this->ticket->update([
            'waiting_from' => $responseFrom->value,
            'modified_by' => $userID,
        ]);

        return $this->refreshTicket();
    }

    private function updateStatus(Status $status, int $userID = null): TicketService
    {
        $this->ticket->update([
            'status' => $status->value,
            'modified_by' => $userID,
        ]);

        return $this->refreshTicket();
    }

    private function updatePriority(Priority $priority, int $userID = null): TicketService
    {
        $this->ticket->update([
            'priority' => $priority->value,
            'modified_by' => $userID,
        ]);

        return $this->refreshTicket();
    }

}