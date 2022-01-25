<?php

/**
 * Dispatcher
 * permet de charger le controller en fonction de la req$ete utilisateur
 */
class Dispatcher
{

    private $request; //objet request 

    /**
     * function principal du dispatcher
     * charge le controller en fonction du routing
     */
    function __construct()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        //get_class_methods($controller) current controller methods like (studentController ....)
        //get_class_methods('Controller') the MainController methods=> core/Controller.php
        //edit the conditions to eliminate parent class methods also
        if (!in_array($this->request->action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {
            $this->error('This controller ' . $this->request->controller . ' dosn\'t have any  method like ' . $this->request->action);
        }
        call_user_func_array(array($controller, $this->request->action), $this->request->params);
        $controller->render($this->request->action);
    }
    /**
     * permet de charger le controller en fonction de la requête utilisateur
     */
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
    /**
     * permet de générer une page d'erreur en cas de problem au niveau du routing (page inexistante)
     */
    public function error($message)
    {
        $controller = new Controller($this->request);
        $controller->e404($message);
    }
}
