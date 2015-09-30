<?php

namespace Snipworks\BitCore;

/**
 * Core class for model objects
 * Class Model
 * @package Snipworks\BitCore
 */
class Model
{
    /** @var int $id */
    public $id;

    /** Validate function */
    public function validate()
    {
    }

    /**
     * Class constructor
     * @param array $data
     */
    public function __construct($data = array())
    {
        if (is_array($data) && $data) {
            $this->set($data);
        }
    }

    /**
     * Set array key and values as model object properties
     * @param array $data
     */
    public function set(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
