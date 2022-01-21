<?php

class Request
{
    public $url; // url appeler par l'utilisateur 
    public function __construct()
    {
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    }
}
