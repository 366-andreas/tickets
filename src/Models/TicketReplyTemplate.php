<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketReplyTemplate extends Model
{
    protected $table = 'ticket_reply_templates';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';

    public function content(): HasMany
    {
        return $this->hasMany(TicketReplyTemplateContent::class, 'template_id');
    }
}