<?php
namespace AndreasNik\Ticket\Enums;


use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;


/**
 * @method static static Entity()
 * @method static static User()

 */
class WaitingFrom
{
    const Entity = 'Entity';
    const User = 'User';

    private static array $waitingFrom = [
        'Entity' => self::Entity,
        'User' => self::User
    ];

    public string $value;
    public string $key;

    /**
     * @throws Throwable
     */
    final public function __construct(string $name)
    {
        $name = ucfirst(Str::camel($name));
        throw_unless(self::has($name), new InvalidArgumentException("invalid waiting from: {$name}"));
        $priority = self::$waitingFrom[$name];
        $this->value = $priority;
        $this->key = $name;
    }

    private static function has(string $name): bool
    {
        return isset(self::$waitingFrom[ucfirst(Str::camel($name))]);
    }
}