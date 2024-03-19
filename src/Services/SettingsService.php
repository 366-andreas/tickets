<?php

namespace AndreasNik\Ticket\Services;

use AndreasNik\Ticket\Interfaces\EntityActions;
use AndreasNik\Ticket\Interfaces\TicketSettingsActions;
use AndreasNik\Ticket\Models\TicketAssignmentSettings;
use AndreasNik\Ticket\Models\TicketSettings;
use Illuminate\Support\Collection;

class SettingsService implements TicketSettingsActions, EntityActions
{
    private string $entity;

    /**
     * @param string $entity
     * @return $this
     */
    public function setEntity(string $entity): SettingsService
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * @return TicketSettings
     */
    public function getSettings(): TicketSettings
    {
        return TicketSettings::query()->where('entity_type', $this->entity)->first();
    }

    /**
     * @return Collection
     */
    public function getAssignments(): Collection
    {
        return TicketAssignmentSettings::query()->where('entity_type', $this->entity)->get();
    }

    /**
     * @param int $userID
     * @param array $data
     * @return $this
     */
    public function updateSettings(int $userID, array $data): SettingsService
    {
        TicketSettings::query()->where('entity_type', $this->entity)
            ->update(array_merge($data, ['modified_by' => $userID]));

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function updateAssignments(array $data): SettingsService
    {
        TicketAssignmentSettings::query()->where('entity_type', $this->entity)->forceDelete();
        TicketAssignmentSettings::query()->insert($data);

        return $this;
    }
}