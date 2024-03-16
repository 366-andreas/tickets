<?php
namespace AndreasNik\Ticket\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    public $table = 'core_affiliates';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';
}