<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketAttachment extends Model
{
    protected $table = 'ticket_attachments';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}