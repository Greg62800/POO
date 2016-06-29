<?php

namespace POO\Model;


use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use PDO;
use POO\Dispatcher;

class Model extends Manager {


    public $table;

    public function __construct()
    {
        $this->config = require ROOT . DS . 'config' . DS . 'App.php';

        $this->db = new PDO("{$this->config['mysql']['driver']}:host={$this->config['mysql']['host']};dbname={$this->config['mysql']['database']}", $this->config['mysql']['username'], $this->config['mysql']['password']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->table = str_replace('app\\model\\', '', strtolower(get_class($this))) . 's';
    }

    public function getAll()
    {
        $req = $this->db->prepare("SELECT * FROM $this->table");
        $req->execute();
        return $req->fetchAll();
    }
}