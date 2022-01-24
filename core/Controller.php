<?php
class Controller
{
    private $request;
    private $vars = [];
    private $layout = 'default';
    private $rendered = false;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function render($view)
    {
        if ($this->rendered) {
            return false;
        }
        extract($this->vars);
        if (strpos($view, '/') === 0) {
            $file = ROOT . DS . 'view' . $view . '.php';
        } else {
            $file = ROOT . DS . 'view' . DS . $this->request->controller . DS . $view . '.php';
        }

        ob_start();
        require($file);
        $contents = ob_get_clean();
        require ROOT . DS . 'view' . DS . 'layout' . DS . $this->layout . '.php';
        $this->rendered = true;
    }

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }
}
