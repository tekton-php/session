<?php namespace Tekton\Session;

use Aura\Session\Session as BaseSession;

class Session extends BaseSession
{
    /**
     * Generate a new session ID for the session.
     *
     * @param  bool  $destroy
     * @return bool
     */
    public function migrate($destroy = false)
    {
        return ($destroy)
            ? $this->destroy()
            : $this->regenerateId();
    }

    /**
     * Remove all of the items from the session.
     *
     * @return void
     */
    public function flush()
    {
        $this->clear();
    }

    /**
     * Get the CSRF token value.
     *
     * @return string
     */
    public function token()
    {
        return $this->getCsrfToken()->getValue();
    }

    /**
     * Save the session data to storage.
     *
     * @return bool
     */
    public function save()
    {
        return (bool) $this->commit();
    }
}
