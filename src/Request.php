<?php

namespace Snipworks\BitCore;

/**
 * Core class for handling server requests
 * @class Request
 */
class Request
{
    const POST = 'POST';
    const GET = 'GET';

    /**
     * Set request value of key
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function set($key, $value = null)
    {
        return $_REQUEST[$key] = $value;
    }

    /**
     * Get request parameter by specified key
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    /**
     * Get all request parameters
     * @return array
     */
    public static function params()
    {
        return isset($_REQUEST) ? $_REQUEST : array();
    }

    /**
     * Check request method
     * @param $method
     * @return bool
     */
    public static function method($method)
    {
        return ($_SERVER['REQUEST_METHOD'] == trim(strtoupper($method)));
    }
}
