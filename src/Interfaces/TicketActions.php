<?php

namespace AndreasNik\Ticket\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface TicketActions
{
    public function createAsUser(int $userID, Model $entity, array $data);

    public function createAsEntity(Model $entity, array $data);


}