<?php namespace Tekton\Session\Facades;

use Dynamis\Facade;

class Session extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'session';
    }
}
