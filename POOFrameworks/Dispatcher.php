<?php

namespace POO;
use POO\Controller\Controller;


/**
 * @property Request request
 */
class Dispatcher
{

    private $request;


    public function __construct()
    {
        $this->request = new Request();
        Router::parser($this->request->url, $this->request);
    }

    public function error($message)
    {
        $controller = new Controller($this->request);
        $controller->errors($message);
    }

    public function loadController()
    {
        $name = ucfirst($this->request->controller);
        $controllerName = "App\\Controller\\{$name}Controller";
        $controller = new $controllerName($this->request);
        return $controller;
    }

    public function run()
    {
        $controller = $this->loadController();
        if(method_exists($controller, $this->request->action)) {
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }else {
            $this->error('Impposible de trouvée l\'action ' . $this->request->action);
        }
        $controller->render($this->request->action);
    }
}