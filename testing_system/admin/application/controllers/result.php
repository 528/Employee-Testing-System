<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author Mohaimen
 */

class result extends Controller {

    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_result');
        $this->load->library('grid');
    }

    function index() {

        $data['nav_array'] = array(
            array('title' => 'Manage Results', 'url' => '')
        );
        //$this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("Email", "Name", "Test Status", "Notification");
        $gridColumnModel = array(
            array("name" => "username",
                "index" => "username",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "password",
                "index" => "password",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "notification",
                "index" => "notification",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Results", 880, 200, "id", "asc", $gridColumn, $gridColumnModel, site_url("?c=result&m=load_users&searchField={$_POST['searchField']}&searchValue={$_POST['searchValue']}"), true);
        } else {
            $gridObj->setGridOptions("Manage Results", 880, 200, "id", "asc", $gridColumn, $gridColumnModel, site_url('result/load_users'), true);
        }


        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'result';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Results';
        $this->load->view('main', $data);
    }

    function load_users() {
        $this->mod_result->get_user_grid();
    }

    function evaluate_general($user_id = '') {
        if (!common::update_permit()) {
            common::redirect();
        }
        $id = $user_id;
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_general')) {
                $this->mod_result->update_gen_marks($id); //Don't Change
                $this->session->set_flashdata('msg', 'General Part Evaluated Successfully!');
                $check = sql::row("scic_result", "user_id=$id");
                if ($check['general'] != -1 && $check['third_part'] != -1 && $check['notification']==0) {
                    $this->mod_result->sendEmail($id);					
                }
                redirect('result');
            }
        }

        if ($id == '') {
            redirect('result');
        }
        $data = sql::row("scic_result", "user_id=$id");
        //$this->session->set_userdata('edit_user_id', $data['id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Results', 'url' => site_url('result')),
            array('title' => 'Evaluate General', 'url' => '')
        );
        $data['question'] = $this->mod_result->get_general();
        $data['answer'] = $this->mod_result->get_general_answer($id);
        $data['dir'] = 'result';
        $data['action'] = 'result/evaluate_general/' . $user_id;
        $data['page'] = 'gen_form'; //Don't Change
        $data['page_title'] = 'Evaluation';
        $this->load->view('main', $data);
    }

    function evaluate_third($user_id = '') {
        if (!common::update_permit()) {
            common::redirect();
        }
        $id = $user_id;
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_third')) {
                $this->mod_result->update_third_marks($id); //Don't Change
                $this->session->set_flashdata('msg', 'Third Part Evaluated Successfully!');
                $check = sql::row("scic_result", "user_id=$id");
                if ($check['general'] != -1 && $check['third_part'] != -1 && $check['notification']==0) {
                    $this->mod_result->sendEmail($id);
                }
                redirect('result');
            }
        }

        if ($id == '') {
            redirect('result');
        }
        $data = sql::row("scic_result", "user_id=$id");
        //$this->session->set_userdata('edit_user_id', $data['id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Results', 'url' => site_url('result')),
            array('title' => 'Evaluate Third Part', 'url' => '')
        );
        $data['question'] = $this->mod_result->get_third();
        $data['answer'] = $this->mod_result->get_third_answer($id);
        $data['dir'] = 'result';
        $data['action'] = 'result/evaluate_third/' . $user_id;
        $data['page'] = 'third_form'; //Don't Change
        $data['page_title'] = 'Evaluation';
        $this->load->view('main', $data);
    }

    function delete_result($id = '') {

        if ($id == '') {
            redirect('result');
        }
        $this->mod_result->delete_result($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('result');
    }

}

?>