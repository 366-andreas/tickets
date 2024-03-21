<?php
namespace AndreasNik\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $category_id
 * @property string $entity_type
 * @property int $entity_id
 * @property int|null $assignee
 * @property int $language_id
 * @property string $subject
 * @property string $priority
 * @property string $opened_by
 * @property string $waiting_response_from
 * @property TicketCategory $category
 * @property Collection<TicketResponse> $responses
 */
class Ticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = ['id'];
    public const CREATED_AT = 'created_on';
    public const UPDATED_AT = 'modified_on';



    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(TicketResponse::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(TicketFeedback::class);
    }
}