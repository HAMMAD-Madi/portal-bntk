<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PDF extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pdf'; // This is the key under which the service is registered in the container
    }
}