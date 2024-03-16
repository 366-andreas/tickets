<?php

namespace AndreasNik\Ticket\Interfaces;

interface TicketSettingsActions
{
    public function updateSettings(int $userID, array $data);
    public function updateAssignments(array $data);
    public function getAssignments();
    public function getSettings();
}