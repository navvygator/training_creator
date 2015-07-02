<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 10:00
 */

class Route {

    function __construct()
    {
        session_start();
        $settings = Settings::getInstance();
        $router=$settings->router();
        $url = $router['default'];
        if(!empty($_GET['url']))
        {
            $url = $_GET['url'];
        }
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $url[0] =  ucfirst($url[0]);
        if(file_exists('controller/'.$url[0].'.php'))
        {
            require('controller/'.$url[0].'.php');
            $controller = new $url[0];
            if(isset($url[2]))
            {
                if(method_exists($controller, $url[1]))
                {
                $controller->$url[1]($url[2]);
                }
                else
                {
                    printf("Метод %s в классе %s не найден", $url[1], $url[0]);
                }
            }
            else
            {
                if(isset($url[1]))
                {
                    if(method_exists($controller, $url[1]))
                    {
                    $controller->$url[1]();
                    }
                    else
                    {
                        printf("Метод %s в классе %s не найден", $url[1], $url[0]);
                    }
                }
                else
                {
                    if(method_exists($controller, 'index'))
                    {
                        $controller->index();
                    }
                }
            }
        }
        else
        {
            printf("Не найден контроллер %s\n", $url[0]);
        }

    }
} 