<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static auth($client)
 * @method static get()
 * @method static id()
 */
class Client extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'client';
    }
}
