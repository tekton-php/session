<?php namespace Tekton\Session\Providers;

use Illuminate\Support\ServiceProvider;
use Tekton\Session\SessionManager;

class SessionProvider extends ServiceProvider
{
    public function provides()
    {
        return ['session'];
    }

    function register()
    {
        $this->app->singleton('session', function() {
            $config = app('config')->get('session');
            return new SessionManager($config);
        });
    }
}
