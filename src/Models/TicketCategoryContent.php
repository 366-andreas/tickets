<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketCategoryContent extends Model
{
    protected $table = 'ticket_categories_content';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }
}