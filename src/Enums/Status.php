<?php
namespace AndreasNik\Ticket\Enums;


use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;

/**
 * @method static static WaitingOnSupport()
 * @method static static InProgress()
 * @method static static WaitingOnOtherDepartment()
 * @method static static Reopened()
 * @method static static WaitingOnEntity()
 * @method static static Resolved()
 */
class Status
{
    const WaitingOnSupport = 'waiting_on_support';
    const InProgress = 'in_progress';
    const WaitingOnOtherDepartment = 'waiting_on_other_department';
    const Reopened = 'reopened';
    const WaitingOnEntity = 'waiting_on_entity';
    const Resolved = 'resolved';

    private static array $statuses = [
        'WaitingOnSupport' => 'waiting_on_support',
        'InProgress' => 'in_progress',
        'WaitingOnOtherDepartment' => 'waiting_on_other_department',
        'Reopened' => 'Reopened',
        'WaitingOnEntity' => 'waiting_on_entity',
        'Resolved' => 'resolved',

    ];


    public string $value;
    public string $key;

    /**
     * @throws Throwable
     */
    final public function __construct(string $name)
    {
        $name = ucfirst(Str::camel($name));
        throw_unless(self::has($name), new InvalidArgumentException("invalid status: {$name}"));
        $priority = self::$statuses[$name];
        $this->value = $priority;
        $this->key = $name;
    }

    private static function has(string $name): bool
    {
        return isset(self::$statuses[ucfirst(Str::camel($name))]);
    }
}