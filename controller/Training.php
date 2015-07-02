<?php
/**
 * Created by PhpStorm.
 * User: navvygator
 * Date: 29.06.15
 * Time: 14:18
 */

class Training extends MA_Controller {

    function __construct()
    {
        if(!empty($_SESSION['user_login']) && !empty($_SESSION['user_id']) && $_SESSION['logged']=='logged')
        {
            parent::__construct();
            $this->training_model = new Training_model();
            $this->user_model = new User_model();
            $this->view = new MA_View();
        }
        else
        {
            header('Location: /login');
        }
    }

    function index()
    {
        $data['user'] = $this->user_model->get_user(array('id'=>$_SESSION['user_id']));
        $this->view->render('template/header');
        $this->view->render('content', $data);
        $this->view->render('template/footer');
    }

    function generate_trainings($user_id)
    {
        $data['trainings'] = $this->training_model->get_all_trainings($user_id);
        $this->view->render('generator/select_trainings', $data);

    }

    function generate_days($training_id)
    {
        $data['training_days'] = $this->training_model->get_training_days($training_id);
        $this->view->render('generator/select_days', $data);
    }

    function generate_blocks($day_id)
    {
        $data['day_blocks'] = $this->training_model->get_day_blocks($day_id);
        $this->view->render('generator/select_blocks', $data);
    }

    function generate_block_practice($block_id)
    {
        $data['block_practice'] = $this->training_model->get_all_block_practice_short($block_id);
        $block = $this->training_model->get_block_info($block_id);
        $data['free_time'] = $block['free_time'];
        $this->view->render('generator/select_block_practice', $data);
    }

    function add_training()
    {
        if(empty($_POST['name']))
        {
            $this->view->render('training/add');
        }
        else
        {
            $training['name'] = addslashes(trim($_POST['name']));
            $training['user_id'] = addslashes(trim($_POST['user_id']));
            $this->training_model->add_traning($training);
            echo "success";

        }
    }

    function delete_training($id)
    {
        $data['training'] = $this->training_model->get_training($id);
        $this->view->render('training/delete', $data);
    }

    function delete_training_confirm()
    {
        if(!empty($_POST['id']))
        {
            $training_id = $_POST['id'];
            $this->training_model->delete_training($training_id);
            echo "success";
        }
        else
        {
            echo "Ошибка удаления";
        }
    }

    function edit_training($id)
    {
        if(empty($_POST['id']) || empty($_POST['name']))
        {
            $data['training'] = $this->training_model->get_training($id);
            $this->view->render('training/edit', $data);
        }
        else
        {
            $training['id'] = (int)$_POST['id'];
            $training['name'] = addslashes(trim($_POST['name']));
            $this->training_model->edit_training($training);
            echo "success";

        }
    }

    function add_day()
    {
        $training_id = (int)$_POST['training_id'];
        $result = $this->training_model->days_of_training((int)$training_id);
        $max_day = (int)$result['day'];
        $this->training_model->add_day_training($training_id, $max_day);
        echo "success";
    }

    function delete_day()
    {
        $day_id = (int)$_POST['day_id'];
        $this->training_model->delete_day_training($day_id);
        echo "success";
    }

    function add_block()
    {
        if(empty($_POST['block_name']) || empty($_POST['block_num']) || empty($_POST['block_time']))
        {
            $this->view->render('block/add');
        }
        else
        {
            $block['day_id'] = (int)$_POST['day_id'];
            $block['block_name'] = addslashes(trim($_POST['block_name']));
            $block['block_num'] = addslashes(trim($_POST['block_num']));
            $block['time'] = addslashes(trim($_POST['block_time']));
            $block['free_time'] = addslashes(trim($_POST['block_time']));
            $this->training_model->add_block($block);
            echo "success";

        }
    }

    function delete_block($id)
    {
        $data['block'] = $this->training_model->get_block_info($id);
        $this->view->render('block/delete', $data);
    }

    function delete_block_confirm()
    {
        if(!empty($_POST['id']))
        {
            $block_id = $_POST['id'];
            $this->training_model->delete_block($block_id);
            $this->training_model->delete_all_block_practice($block_id);
            echo "success";
        }
        else
        {
            echo "Ошибка удаления";
        }
    }

    function edit_block($id)
    {
        if(empty($_POST['id']) || empty($_POST['block_name']))
        {
            $data['block'] = $this->training_model->get_block_info($id);
            $this->view->render('block/edit', $data);
        }
        else
        {
            $block['block_name'] = addslashes(trim($_POST['block_name']));
            $this->training_model->edit_block((int)$_POST['id'], $block);
            echo "success";

        }
    }

    function add_block_practice()
    {
        $settings = Settings::getInstance();
        $practice_model = new Practice_model();
        $practice_id = $_POST['practice_id'];
        $practice = $practice_model->get_practice_info($practice_id);
        $block_id = $_POST['block_id'];
        $block = $this->training_model->get_block_info($block_id);
        $free_time = strtotime($block['free_time']) - strtotime('00:00:00');
        $practice_time = strtotime($practice['time']) - strtotime('00:00:00');
        if($free_time>=$practice_time)
        {
            $block['free_time'] = date('H:i:s', $free_time - $practice_time - strtotime($settings->get_serv_time()));
            $this->training_model->edit_block($block['id'], $block);
            $block_practice_max = $this->training_model->get_block_practice_max($block['id']);
            $block_practice['block_id'] = $block['id'];
            $block_practice['practice_num'] = (int)$block_practice_max + 1;
            $block_practice['practice_id'] = $practice_id;
            $this->training_model->add_block_practice($block_practice);
            echo "success";
        }
        else
        {
            echo "В блоке не хватает свободного времени для выбранного упражнения";
        }


    }

    function delete_block_practice()
    {
        $block_id = $_POST['block_id'];
        $block_practice_id = $_POST['block_practice_id'];
        $block_practice = $this->training_model->get_block_practice_info($block_practice_id);
        $block = $this->training_model->get_block_info($block_id);
        $free_time = strtotime($block['free_time']);
        $practice_time = strtotime($block_practice['time']);
        $block['free_time'] = date('H:i:s', $free_time + $practice_time - strtotime('24:00:00'));
        $this->training_model->edit_block($block['id'], $block);
        $this->training_model->delete_block_practice($block_practice_id);
        echo "success";
    }

    function build_training($training_id)
    {
        $settings = Settings::getInstance();
        $data['training'] = $this->training_model->get_training($training_id);
        $data['training']['total_time'] = 0;
        $data['training']['total_free_time'] = 0;
        $data['training']['days'] = $this->training_model->get_training_days($training_id);
        foreach($data['training']['days'] as &$day)
        {
            $day['blocks'] = $this->training_model->get_day_blocks($day['id']);
            foreach($day['blocks'] as &$block)
            {
                $block['block_practice'] = $this->training_model->get_all_block_practice($block['id']);

                if(!empty($block['time']))
                {
                    $data['training']['total_time'] += strtotime($block['time']) - strtotime("00:00:00");
                    $data['training']['total_free_time'] += strtotime($block['free_time']) - strtotime("00:00:00");
                }
            }
        }
        $data['training']['total_time'] = date('H:i:s', $data['training']['total_time']  - strtotime($settings->get_serv_time()));
        $data['training']['total_free_time'] = date('H:i:s', $data['training']['total_free_time'] - strtotime($settings->get_serv_time()));
        $this->view->render('training/build', $data);
    }

} 