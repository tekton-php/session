<?php namespace Tekton\Session;

use Aura\Session\Session;
use Aura\Session\Segment as BaseSegment;

class Segment extends BaseSegment
{
    /**
     * Age the flash data for the session.
     *
     * @return void
     */
    public function ageFlashData()
    {
        $_SESSION[Session::FLASH_NOW][$this->name] = (isset($_SESSION[Session::FLASH_NEXT][$this->name]))
            ? $_SESSION[Session::FLASH_NEXT][$this->name]
            : [];

        $_SESSION[Session::FLASH_NEXT][$this->name] = [];
    }

    /**
     * Get the value of a given key and then forget it.
     *
     * @param  string  $key
     * @param  string  $default
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        if (! $this->exists($key)) {
            return $default;
        }

        return $this->remove($key);
    }

    /**
     * Replace the given session attributes entirely.
     *
     * @param  array  $attributes
     * @return void
     */
    public function replace(array $attributes)
    {
        $this->put($attributes);
    }

    /**
     * Increment the value of an item in the session.
     *
     * @param  string  $key
     * @param  int  $amount
     * @return mixed
     */
    public function increment($key, $amount = 1)
    {
        $this->put($key, $value = $this->get($key, 0) + $amount);

        return $value;
    }

    /**
     * Decrement the value of an item in the session.
     *
     * @param  string  $key
     * @param  int  $amount
     * @return int
     */
    public function decrement($key, $amount = 1)
    {
        return $this->increment($key, $amount * -1);
    }

    /**
     * Flash a key / value pair to the session.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function flash($key, $value)
    {
        $this->setFlash($key, $value);
        $this->removeFromOldFlashData([$key]);
    }

    /**
     * Flash a key / value pair to the session for immediate use.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function now($key, $value)
    {
        $this->setFlashNow($key, $value);
    }

    /**
     * Get all of the session data.
     *
     * @return array
     */
    public function all()
    {
        $this->resumeOrStartSession();
        return isset($_SESSION[$this->name])
             ? $_SESSION[$this->name]
             : [];
    }

    /**
     * Checks if a key exists.
     *
     * @param  string|array  $key
     * @return bool
     */
    public function exists($key)
    {
        $this->resumeOrStartSession();
        return isset($_SESSION[$this->name][$key]);
    }

    /**
     * Checks if an a key is present and not null.
     *
     * @param  string|array  $key
     * @return bool
     */
    public function has($key)
    {
        return ! is_null($this->get($key));
    }

    /**
     * Put a key / value pair or array of key / value pairs in the session.
     *
     * @param  string|array  $key
     * @param  mixed       $value
     * @return void
     */
    public function put($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }
        }
        else {
            $this->set($key, $value);
        }
    }



    /**
     * Remove an item from the session, returning its value.
     *
     * @param  string  $key
     * @return mixed
     */
    public function remove($key)
    {
        if (isset($_SESSION[$this->name][$key])) {
            $value = $_SESSION[$this->name][$key];
            unset($_SESSION[$this->name][$key]);
            return $value;
        }

        return null;
    }

    /**
     * Remove one or many items from the session.
     *
     * @param  string|array  $keys
     * @return void
     */
    public function forget($keys)
    {
        $keys = (! is_array($keys)) ?: [$keys];

        foreach ($keys as $key) {
            $this->remove($key);
        }
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
}
