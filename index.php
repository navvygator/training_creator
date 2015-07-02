<?php

function __autoload($class)
{
    if(file_exists('core/'.$class.'.php'))
    {
        require_once('core/'.$class.'.php');
    }
    if(file_exists('model/'.$class.'.php'))
    {
        require_once('model/'.$class.'.php');
    }
}

$app = new Route();

