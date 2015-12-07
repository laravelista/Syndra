<?php namespace Laravelista\Syndra\Facades;

use Illuminate\Support\Facades\Facade;

class Syndra extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'syndra';
    }
}
