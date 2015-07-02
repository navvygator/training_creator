<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 10:38
 */

class MA_View {

    function __construct()
    {

    }

    function render($view, $data=null)
    {
        if (is_array($data))
        {
            extract($data);
        }
        require('view/'.$view.'.php');
    }

    function generate($view, $data)
    {
        if(is_array($data))
        {
            ob_start();
            extract($data);
            require('view/'.$view.'.php');
            $buffer = ob_get_contents();
            @ob_end_clean();
            return $buffer;
        }
    }

} 