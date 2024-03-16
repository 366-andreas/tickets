<?php

namespace AndreasNik\Ticket\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface TicketActions
{
    public function createAsUser(int $userID, Model $entity, array $data, Collection $attachments);

    public function createAsEntity(Model $entity, array $data, Collection $attachments);


}