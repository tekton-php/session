<?php namespace Tekton\Session;

use Tekton\Session\SegmentFactory;
use Tekton\Session\Session;
use Aura\Session\Phpfunc;
use Aura\Session\Randval;
use Aura\Session\CsrfTokenFactory;
use Aura\Session\SessionFactory as BaseSessionFactory;

class SessionFactory extends BaseSessionFactory
{
    /**
     *
     * Creates a new Session manager.
     *
     * @param array $cookies An array of cookie values, typically $_COOKIE.
     *
     * @param callable|null $delete_cookie Optional: An alternative callable
     * to invoke when deleting the session cookie. Defaults to `null`.
     *
     * @return Session New Session manager instance
     */
    public function newInstance(array $cookies, $delete_cookie = null)
    {
        $phpfunc = new Phpfunc;
        return new Session(
            new SegmentFactory,
            new CsrfTokenFactory(new Randval($phpfunc)),
            $phpfunc,
            $cookies,
            $delete_cookie
        );
    }
}
