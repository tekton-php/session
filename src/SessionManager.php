<?php namespace Tekton\Session;

use Aura\Session\SessionFactory;

class SessionManager {

    use \Tekton\Support\Traits\LibraryWrapper;

    protected $session;
    protected $segment;

    function __construct() {
        $this->config = app('config');
        $this->factory = new SessionFactory;
        $this->session = $this->factory->newInstance($_COOKIE);

        // Configure session
        $this->session->setCookieParams([
            'lifetime' => $this->config->get('session.lifetime', 120),
        ]);

        // Create main segment
        $this->segment = $this->session->getSegment(self::class);
        $this->library = $this->segment;
    }

    function factory() {
        return $this->factory;
    }

    function session() {
        return $this->session;
    }

    function segment($segment) {
        return $this->session->getSegment($segment);
    }
}
