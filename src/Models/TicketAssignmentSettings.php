<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\Models\Language;
use Tests\Models\User;

class TicketAssignmentSettings extends Model
{
    protected $table = 'ticket_assignment_settings';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

}