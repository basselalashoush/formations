<?php
class Controller
{
    private $request; // Objet Request 
    private $vars = []; // Variables à passer à la vue
    private $layout = 'default'; // Layout à utiliser pour rendre la vue
    private $rendered = false; // Si le rendu a été fait ou pas ?

    /**
     * Constructeur
     * @param $request Objet request de notre application
     **/
    public function __construct($request)
    {
        // On stock la request dans l'instance	
        $this->request = $request;
    }

    /**
     * Permet de rendre une vue
     * @param $view Fichier à rendre (chemin depuis view ou nom de la vue) 
     **/
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

    /**
     * Permet de passer une ou plusieurs variable à la vue
     * @param $key nom de la variable OU tableau de variables
     * @param $value Valeur de la variable
     **/
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }
    /**
     * Permet de charger un model
     **/
    public function laodModel($modelName)
    {
        $file = ROOT . DS . 'model' . DS . $modelName . '.php';
        require_once($file);
        if (!isset($this->$modelName)) {
            $this->$modelName = new $modelName();
        }
    }
    /**
     * allows to handle with errors 404
     */
    public function e404($message)
    {
        header("HTTP/1.0 404 Not Found");
        $this->set('message', $message);
        $this->render('/errors/404');
        die();
    }
}
