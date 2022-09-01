<?php

namespace LdTalent\Pwa;

use Illuminate\Support\Facades\Facade;

class PwaFacade extends Facade
{
    
    /**
     * Get the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pwa-laravel';
    }

}