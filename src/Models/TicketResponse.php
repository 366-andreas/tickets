<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $ticket_id
 * @property int|null $entity_id
 * @property int|null $user_id
 * @property int|null $response_number
 * @property string|null $message
 * @property int $is_visible
 * @property Ticket $ticket
 */
class TicketResponse extends Model
{
    protected $table = 'ticket_responses';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class, 'response_id', 'id');
    }
}