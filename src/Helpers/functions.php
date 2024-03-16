<?php

use AndreasNik\Ticket\Helpdesk;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('helpdesk')) {
    /**
     * @throws BindingResolutionException
     */
    function helpdesk(string $entity): Helpdesk
    {
        /**
         * @var Helpdesk $helpdesk
         */
        $helpdesk = app()->make(Helpdesk::class);
        return $helpdesk->setEntity($entity);
    }
}

if (! function_exists('userID')) {
    function userID($user):int
    {
        return $user instanceof Model ? $user->getKey() : $user;
    }
}


