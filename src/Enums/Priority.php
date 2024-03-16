<?php
namespace AndreasNik\Ticket\Enums;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;


/**
 * @method static static Low()
 * @method static static Normal()
 * @method static static High()
 * @method static static Critical()
 */
class Priority
{
    const Low = 'low';
    const Normal = 'normal';
    const High = 'high';
    const Critical = 'critical';

    private static array $priorities = [
        'Low' => self::Low,
        'Normal' => self::Normal,
        'High' => self::High,
        'Critical' => self::Critical,
    ];

    public string $value;
    public string $key;

    /**
     * @throws Throwable
     */
    final public function __construct(string $name)
    {
        $name = ucfirst(Str::camel($name));
        throw_unless(self::has($name), new InvalidArgumentException("invalid priority: {$name}"));
        $priority = self::$priorities[$name];
        $this->value = $priority;
        $this->key = $name;
    }

    private static function has(string $name): bool
    {
        return isset(self::$priorities[ucfirst(Str::camel($name))]);
    }
}