<?php

if (! function_exists('session'))
{
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function session($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('session');
        }

        if (is_array($key)) {
            return app('session')->global()->put($key);
        }

        return app('session')->global()->get($key, $default);
    }
}

if (! function_exists('session_segment'))
{
    /**
     * Create a session segment
     * @param  string $segment Unique name of the segment
     * @return \Tekton\Session\Segment
     */
    function session_segment(string $segment)
    {
        return app('session')->segment($segment);
    }
}
