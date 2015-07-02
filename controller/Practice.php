<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 19:49
 */

class Practice extends MA_Controller {

    function __construct()
    {
        if(!empty($_SESSION['user_login']) && !empty($_SESSION['user_id']) && $_SESSION['logged']=='logged')
        {
            parent::__construct();
            $this->practice_model = new Practice_model();
            $this->user_model = new User_model();
            $this->view = new MA_View();
        }
        else
        {
            header('Location: /login');
        }
    }

    function generate_all_practice()
    {
        $data['practice'] = $this->practice_model->get_all_practice();
        $this->view->render('generator/select_all_practice', $data);
    }

    function add_practice()
    {
        if(empty($_POST['name']) && empty($_POST['time']) && empty($_POST['content']))
        {
            $this->view->render('practice/add');
        }
        else
        {
            $practice['name'] = addslashes(trim($_POST['name']));
            $practice['time'] = addslashes(trim($_POST['time']));
            $practice['theme'] = addslashes(trim($_POST['theme']));
            $practice['purpose'] = addslashes(trim($_POST['purpose']));
            $practice['content'] = addslashes(trim($_POST['content']));
            $practice['inference'] = addslashes(trim($_POST['inference']));
            $practice['material'] = addslashes(trim($_POST['material']));
            $this->practice_model->add_practice($practice);
            echo "success";

        }
    }

    function view_practice($id)
    {
        $data['practice'] = $this->practice_model->get_practice_info($id);
        $this->view->render('practice/view', $data);
    }

    function delete_practice($id)
    {
        $data['practice'] = $this->practice_model->get_practice_info($id);
        $this->view->render('practice/delete', $data);
    }

    function delete_practice_confirm()
    {
        if(!empty($_POST['id']))
        {
            $practice_id = $_POST['id'];
            $this->practice_model->delete_practice($practice_id);
            echo "success";
        }
        else
        {
            echo "Ошибка удаления";
        }
    }

    function edit_practice($id)
    {
        if(empty($_POST['name']) && empty($_POST['time']) && empty($_POST['content']) && empty($_POST['practice_id']))
        {
            $data['practice'] = $this->practice_model->get_practice_info($id);
            $this->view->render('practice/edit', $data);
        }
        else
        {
            $practice['id'] = (int)$_POST['id'];
            $practice['name'] = addslashes(trim($_POST['name']));
            $practice['time'] = addslashes(trim($_POST['time']));
            $practice['theme'] = addslashes(trim($_POST['theme']));
            $practice['purpose'] = addslashes(trim($_POST['purpose']));
            $practice['content'] = addslashes(trim($_POST['content']));
            $practice['inference'] = addslashes(trim($_POST['inference']));
            $practice['material'] = addslashes(trim($_POST['material']));
            $this->practice_model->edit_practice($practice);
            echo "success";

        }
    }

}