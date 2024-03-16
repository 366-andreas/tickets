<?php

namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketCategory extends Model
{
    protected $table = 'ticket_categories';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';

    use HasFactory;


    public function content(): HasMany
    {
        return $this->hasMany(TicketCategoryContent::class, 'category_id');
    }
}