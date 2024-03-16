<?php
namespace AndreasNik\Ticket\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'core_clients';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';
}