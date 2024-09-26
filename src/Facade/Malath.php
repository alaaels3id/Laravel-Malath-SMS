<?php

namespace Alaaelsaid\LaravelMalathSms\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static send(string|array $number, string $message)
 *
 * @see SmsProcess
 */

class Malath extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Malath';
    }
}
