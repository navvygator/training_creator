<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 28.06.15
 * Time: 14:11
 */

class Settings {

    private static $_instance=null;

    private $database = array(
        'host'=>'localhost',
        'name'=>'trening-new',
        'user'=>'root',
        'pass'=>'smal888'
    );

    private $route = array(
        'default' => 'Login'
    );

    private $serv_time = "07:00:00";

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if(self::$_instance===null)
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function db_host()
    {
        return $this->database['host'];
    }

    public function db_name()
    {
        return $this->database['name'];
    }

    public function db_user()
    {
        return $this->database['user'];
    }

    public function db_pass()
    {
        return $this->database['pass'];
    }
    public function router()
    {
        return $this->route;
    }

    public function get_serv_time()
    {
        return $this->serv_time;
    }
} 