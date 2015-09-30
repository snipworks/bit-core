<?php

namespace Snipworks\BitCore;

/**
 * @class View
 */
class View
{
    /** @var Controller $controller */
    protected $controller;
    protected $variables = array();
    protected $filename = null;
    protected $render = null;

    /**
     * @throws BitException
     */
    protected function configure()
    {
        $file = sprintf('app/views/%s/%s.php', $this->controller, $this->render);
        if (!file_exists(__ROOT__ . $file)) {
            throw new BitException(sprintf('View file %s not found', __ROOT__ . $file));
        }

        $this->filename = $file;
    }

    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param $key
     * @param string $value
     */
    public function set($key, $value = null)
    {
        $this->variables[$key] = $value;
    }

    /**
     * @return string
     * @throws BitException
     */
    public function build()
    {
        $this->configure();
        extract($this->variables, EXTR_SKIP);
        ob_start();
        ob_implicit_flush(0);

        /** @noinspection PhpIncludeInspection */
        include_once(__ROOT__ . $this->filename);

        return ob_get_clean();
    }

    /**
     * @param $render
     */
    public function render($render)
    {
        $this->render = $render;
    }
}
