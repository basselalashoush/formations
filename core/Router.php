<?php

class Router
{
    /**
     * Permet de parser une url
     * @param $url Url à parser
     * @return tableau contenant les paramètres
     **/
    public static function parse($url)
    {
        $url = trim($url, '/');
        $params = explode('/', $url);
    }
}
