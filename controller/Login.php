<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 10:32
 */

class Login extends MA_Controller {

    function __construct()
    {
        parent::__construct();
        $this->user_model = new User_model();
        $this->view = new MA_View();
    }

    function index()
    {
        if(!empty($_SESSION['user_login']) && !empty($_SESSION['user_id']) && !empty($_SESSION['logged']))
        {
            $user['id'] = $_SESSION['user_id'];
            $user['login'] = $_SESSION['user_login'];
            $data['user_logged'] =$this->user_model->get_user($user);
            $this->view->render('template/header');
            $this->view->render('login/login_true', $data);
            $this->view->render('template/footer');
        }
        else
        {
            if (empty($_POST['login']) || empty($_POST['pass']))
            {
                $this->view->render('template/header');
                $this->view->render('login/login');
                $this->view->render('template/footer');
            }
            else
            {
                $user['login'] = $_POST['login'];
                $user['pass'] = $_POST['pass'];
                $result = $this->user_model->get_user($user);
                if(count($result)>0)
                {
                    $user_logged = $result;
                    $_SESSION['logged']="logged";
                    $_SESSION['user_login'] = $user_logged['login'];
                    $_SESSION['user_id'] = $user_logged['id'];
                    header('Location: /training');
                }
                else
                {
                    header('Location: /login');
                }
            }
        }
    }

    function logout()
    {
        unset($_SESSION['logged']);
        unset($_SESSION['user_login']);
        unset($_SESSION['user_id']);
        header('Location: /login');
    }
} 