<?php

namespace RiseTechApps\ToUpper;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RiseTechApps\ToUpper\ToUpper
 */
class ToUpperFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'to-upper';
    }
}
