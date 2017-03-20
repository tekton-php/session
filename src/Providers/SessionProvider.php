<?php namespace Tekton\Session\Providers;

use Tekton\Support\ServiceProvider;
use Tekton\Session\SessionManager;

class SessionProvider extends ServiceProvider {

    function register() {
        $this->app->singleton('session', function() {
            return new SessionManager();
        });
    }

    function boot() {

    }
}
