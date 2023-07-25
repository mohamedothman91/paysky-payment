<?php

namespace PaySky\Payment\Facades;

use Illuminate\Support\Facades\Facade;

class PaySky extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'paysky';
    }
}
