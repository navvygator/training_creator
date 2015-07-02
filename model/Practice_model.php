<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 19:48
 */

class Practice_model {

    private $db = null;

    function __construct()
    {
        $this->db = Database::getInstance();
    }

    function get_all_practice()
    {
        $this->db->reset_query();
        $this->db->select('* ');
        $this->db->from('practice');
        $this->db->order('time', 'ASC');
        $result = $this->db->get_vals();
        return $result;
    }

    function get_practice_info($practice_id)
    {
        $this->db->reset_query();
        $this->db->select();
        $this->db->from('practice');
        $this->db->where('id', '=', $practice_id);
        $result = $this->db->get_vals(true);
        return $result;
    }

    function add_practice($practice)
    {
        $this->db->reset_query();
        $this->db->insert('practice', $practice);
    }

    function delete_practice($id)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $id);
        $this->db->delete_vals('practice');
    }

    function edit_practice($practice)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $practice['id']);
        $this->db->set($practice);
        $this->db->update_vals('practice');
    }

} 