<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketReplyTemplateContent extends Model
{
    protected $table = 'ticket_reply_templates_content';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function template(): BelongsTo
    {
        return $this->belongsTo(TicketReplyTemplate::class);
    }
}