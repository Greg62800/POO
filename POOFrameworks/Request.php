<?php

namespace POO;


class Request
{

    public $url;

    public function __construct()
    {
        $this->url = $_SERVER['REDIRECT_URL'];
    }
}