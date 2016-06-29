<?php

namespace POO\Controller;


use POO\Components\FetchComponent;
use POO\Components\UrlComponent;

class Controller {

    public $request;
    private $vars = [];
    public $layout = 'default';
    public $_ext = '.ctp';
    private $rendered = false;

    public function __construct($request = null)
    {
        $this->request = $request;
        $this->fetch = new FetchComponent();
        $this->url = new UrlComponent();
        if(isset($this->helpers)) {
            foreach($this->helpers as $v) {
                $helpers = "POO\\Helper\\{$v}Helper";
                $this->$v = new $helpers;
            }
        }
    }

    public function render($view)
    {
        if($this->rendered) {
            return false;
        }
        extract($this->vars);
        if(!strpos($view, '/')) {
            $view = ROOT . DS . 'src' . DS . 'Template' . DS . ucfirst($this->request->controller) . DS . $this->request->action . $this->_ext;
        }else {
            $view = ROOT . DS . 'src' . DS . 'Template' . DS . $view;
        }
        ob_start();
        require $view;
        $this->fetch->content = ob_get_clean();
        require ROOT . DS . 'src' . DS . 'Template' . DS . 'Layouts' . DS . $this->layout . $this->_ext;
        $this->rendered = true;
    }

    public function set($one, $two = null) {
        if (is_array($one)) {
            if (is_array($two)) {
                $data = array_combine($one, $two);
            } else {
                $data = $one;
            }
        } else {
            $data = array($one => $two);
        }
        $this->vars = $data + $this->vars;
    }

    public function loadModel($name) {
        $modelName = "App\\Model\\$name";
        $this->$name = new $modelName();
    }

    public function errors($message)
    {
        header("HTTP/1.0 404 Not Found");
        $this->set($message);
        $this->render('/errors/404');
        die();
    }

    public function element($filename)
    {
        extract($this->vars);
        $file = ROOT . DS . 'src' . DS . 'Template' . DS . 'Elements' . DS . $filename . $this->_ext;
        if(file_exists($file)) {
            require $file;
        }
        $this->errors("Errors :'(");
    }
}