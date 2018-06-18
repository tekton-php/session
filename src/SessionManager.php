<?php namespace Tekton\Session;

use Tekton\Session\SessionFactory;
use Tekton\Support\Repository;

class SessionManager
{
    protected $factory;
    protected $session;
    protected $config;
    protected $global;

    function __construct($config = [])
    {
        $this->config = new Repository($config);
        $this->factory = new SessionFactory;
        $this->session = $this->factory->newInstance($_COOKIE);

        // Configure session
        $this->session->setCookieParams([
            'lifetime' => $this->config->get('lifetime', 120),
        ]);

        // Create global segment
        $this->global = $this->session->getSegment(self::class);
    }

    function global()
    {
        return $this->global;
    }

    function factory()
    {
        return $this->factory;
    }

    function session()
    {
        return $this->session;
    }

    function segment(string $segment)
    {
        return $this->session->getSegment($segment);
    }
}
