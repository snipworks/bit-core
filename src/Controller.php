<?php

namespace Snipworks\BitCore;

/**
 * Class Controller
 * @package Snipworks\BitCore
 */
class Controller
{
    /** @var View $view */
    public $view;

    /**
     * Initialize controller class
     * -- create new view
     */
    public function __construct()
    {
        $this->view = new View($this);
    }

    /**  */
    public function initialize()
    {
    }

    /**  */
    public function finalize()
    {
    }

    /**
     * Execute and dispatch action
     * @param $name
     * @throws BitException
     */
    public function execute($name)
    {
        try {
            $name = (!$name) ? 'index' : $name;
            $action = Inflector::camelcase($name . '_action', true);
            $method = new \ReflectionMethod($this, $action);
            if (!$method->isPublic()) {
                throw new BitException(
                    sprintf('Access to method %s::%s is not allowed', get_class($this), $method->getName())
                );
            }

            $this->view->render($name);
            $method->invoke($this);
        } catch (\Exception $e) {
            throw new BitException($e->getMessage());
        }
    }

    /**
     * Return controller name
     * @return string
     */
    public function __toString()
    {
        return Inflector::underscore(substr(get_class($this), 0, -10));
    }
}
