<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 10:31
 */

class User_model {

    private $db = null;

    function __construct()
    {
        $db = Database::getInstance();
        $this->db = $db;
    }

    function get_user($user)
    {
        $this->db->reset_query();
        $this->db->select();
        $this->db->from('users');
        foreach($user as $key=>$value)
        {
            $this->db->where($key,'=',$value);
        }
        return $this->db->get_vals(true);
    }



} 