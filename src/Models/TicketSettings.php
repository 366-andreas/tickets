<?php
namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;

class TicketSettings extends Model
{
    protected $table = 'ticket_settings';
    protected $guarded = ['id'];

    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';
}