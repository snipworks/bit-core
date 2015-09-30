<?php

namespace Snipworks\BitCore;

if (!defined('__ROOT__')) {
    throw new BitException("Required constant '__ROOT__' not defined");
}

/**
 * Class Application
 * @package Snipworks\BitCore
 */
class Application
{
    /**
     * @throws BitException
     */
    public static function dispatch()
    {
        list($name, $action) = self::parseURI();
        $controller = self::createController($name);
        $controller->initialize();
        $controller->execute($action);
        $controller->finalize();
        echo $controller->view->build();
    }


    /**
     * @param $name
     * @return Controller
     * @throws BitException
     */
    protected static function createController($name)
    {
        $controller = Inflector::camelcase($name) . 'Controller';
        if (!class_exists($controller)) {
            throw new BitException("Controller class $controller not found.");
        }

        return new $controller();
    }

    /**
     * @return array
     * @throws BitException
     */
    protected static function parseURI()
    {
        if (!isset($_SERVER['PATH_INFO'])) {
            $_SERVER['PATH_INFO'] = 'home';
        }

        $uri = explode('/', trim($_SERVER['PATH_INFO'], '/'));
        $action = (count($uri) < 2) ? null : array_pop($uri);
        $controller = implode('_', $uri);

        return array($controller, $action);
    }
}
