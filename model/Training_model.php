<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 14:33
 */

class Training_model {

    private $db = null;

    function __construct()
    {
        $this->db = Database::getInstance();
    }

    function get_all_trainings($user_id)
    {
        $this->db->reset_query();
        $this->db->select('* ');
        $this->db->from('training');
        $this->db->where('user_id', '=', $user_id);
        $result = $this->db->get_vals();
        return $result;
    }

    function get_training($id)
    {
        $this->db->reset_query();
        $this->db->select('* ');
        $this->db->from('training');
        $this->db->where('id', '=', $id);
        $result = $this->db->get_vals(true);
        return $result;
    }

    function get_training_days($id)
    {
        $this->db->reset_query();
        $this->db->select('* ');
        $this->db->from('day');
        $this->db->where('id_training', '=', $id);
        $result = $this->db->get_vals();
        return $result;
    }


    function add_traning($training)
    {
        $this->db->insert('training', $training);
        $training_id = $this->db->last_id();
        $this->db->insert('day', array('id_training'=>$training_id, 'day'=>'1'));
    }

    function delete_training($id)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $id);
        $this->db->delete_vals('training');
    }

    function edit_training($training)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $training['id']);
        $this->db->set($training);
        $this->db->update_vals('training');
    }

    function get_day_blocks($day_id)
    {
        $this->db->reset_query();
        $this->db->select('* ');
        $this->db->from('block');
        $this->db->where('day_id', '=', $day_id);
        $this->db->order('block_num', 'ASC');
        $result = $this->db->get_vals();
        return $result;
    }

    function days_of_training($training_id)
    {
        $this->db->reset_query();
        $this->db->select("MAX(day) as 'day' ");
        $this->db->from('day');
        $this->db->where('id_training', '=', $training_id);
        $result = $this->db->get_vals(true);
        return $result;
    }

    function add_day_training($training_id, $day)
    {
        $next_day = (int)$day+1;
        $this->db->reset_query();
        $this->db->insert('day', array('id_training'=>$training_id, 'day'=>$next_day));
    }

    function delete_day_training($day_id)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $day_id);
        $this->db->delete_vals('day');
    }

    function add_block($block)
    {
        $this->db->reset_query();
        $this->db->insert('block', $block);
    }

    function delete_block($block_id)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $block_id);
        $this->db->delete_vals('block');
    }

    function get_block_info($block_id)
    {
        $this->db->reset_query();
        $this->db->select();
        $this->db->from('block');
        $this->db->where('id', '=', $block_id);
        $result=$this->db->get_vals(true);
        return $result;
    }

    function edit_block($block_id, $vals)
    {
        $this->db->reset_query();
        $this->db->set($vals);
        $this->db->where('id', '=', $block_id);
        $this->db->update_vals('block');
    }


    function get_all_block_practice($block_id)
    {
        $this->db->reset_query();
        $this->db->select();
        $this->db->from('block_practice');
        $this->db->join_table('practice', 'block_practice.practice_id = practice.id', 'INNER');
        $this->db->where('block_practice.block_id', '=', $block_id);
        $result = $this->db->get_vals();
        return $result;
    }

    function get_all_block_practice_short($block_id)
    {
        $this->db->reset_query();
        $this->db->select('block_practice.id, practice.name, practice.time ');
        $this->db->from('block_practice');
        $this->db->join_table('practice', 'block_practice.practice_id = practice.id', 'INNER');
        $this->db->where('block_practice.block_id', '=', $block_id);
        $result = $this->db->get_vals();
        return $result;
    }

    function get_block_practice_max($block_id)
    {
        $this->db->reset_query();
        $this->db->select("MAX(practice_num) as 'practice_num' ");
        $this->db->from('block_practice');
        $this->db->where('block_id', '=', $block_id);
        $result = $this->db->get_vals(true);
        return $result;
    }

    function get_block_practice_info($id)
    {
        $this->db->reset_query();
        $this->db->select();
        $this->db->from('block_practice');
        $this->db->join_table('practice', 'block_practice.practice_id = practice.id', 'INNER');
        $this->db->where('block_practice.id', '=', $id);
        $result = $this->db->get_vals(true);
        return $result;
    }

    function add_block_practice($block_practice)
    {
        $this->db->reset_query();
        $this->db->insert('block_practice', $block_practice);
    }

    function delete_block_practice($block_practice_id)
    {
        $this->db->reset_query();
        $this->db->where('id', '=', $block_practice_id);
        $this->db->delete_vals('block_practice');
    }

    function delete_all_block_practice($block_id)
    {
        $this->db->reset_query();
        $this->db->where('block_id', '=', $block_id);
        $this->db->delete_vals('block_practice');
    }

} 