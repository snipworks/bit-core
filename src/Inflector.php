<?php

namespace Snipworks\BitCore;

/**
 * Class Inflector
 * @package Snipworks\BitCore
 */
class Inflector
{
    /**
     * Convert string to camel case
     * @param $string
     * @param bool $lower_first
     * @return mixed|string
     */
    public static function camelcase($string, $lower_first = false)
    {
        $string = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        return ($lower_first) ? lcfirst($string) : $string;
    }

    /**
     * Convert string to snake case (underscore)
     * @param $string
     * @return string
     */
    public static function underscore($string)
    {
        return strtolower(preg_replace('/([a-z]+(?=[A-Z])|[A-Z]+(?=[A-Z][a-z]))/', '\\1_', $string));
    }

    /**
     * Check if haystack ends with needle
     * @param $needle
     * @param $haystack
     * @return bool
     */
    public static function ends($needle, $haystack)
    {
        $needle = strrev($needle);
        $haystack = strrev($haystack);

        return (strpos($haystack, $needle) === 0);
    }
}
