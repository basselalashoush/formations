<?php

class Dispatcher
{

    private $request;
    function __construct()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        if (!in_array($this->request->action, get_class_methods($controller))) {
            $this->error('This controller ' . $this->request->controller . ' dosn\'t have any  method like ' . $this->request->action);
        }
        call_user_func_array(array($controller, $this->request->action), $this->request->params);
        $controller->render($this->request->action);
    }

    function loadController()
    {
        $controllerName = ucfirst($this->request->controller) . 'Controller';
        $file = ROOT . DS . 'controller' . DS . $controllerName . '.php';
        if (!file_exists($file)) {
            $this->error('This controller ' . $this->request->controller . ' dosen\'t existe');
        }
        require $file;
        return new $controllerName($this->request);
    }

    public function error($message)
    {
        header("HTTP/1.0 404 Not Found");
        $controller = new Controller($this->request);
        $controller->set('message', $message);
        $controller->render('/errors/404');
        die();
    }
}
