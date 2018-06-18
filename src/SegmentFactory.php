<?php namespace Tekton\Session;

use Tekton\Session\Segment;
use Aura\Session\Session;
use Aura\Session\SegmentFactory as BaseSegmentFactory;

class SegmentFactory extends BaseSegmentFactory
{
    /**
     *
     * Creates a session segment object.
     *
     * @param Session $session
     * @param string  $name
     *
     * @return Segment
     */
    public function newInstance(Session $session, $name)
    {
        return new Segment($session, $name);
    }
}
