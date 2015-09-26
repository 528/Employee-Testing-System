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
class user extends Controller {

    function __construct() {
        parent::Controller();
        //common::is_admin_logged();
        $this->load->model('mod_user');
    }

    function index() {

        $data['nav_array'] = array(
            array('title' => 'Manage Users', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('User Name', "Password", "Status");
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
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Users", 880, 200, "id", "asc", $gridColumn, $gridColumnModel, site_url("?c=user&m=load_users&searchField={$_POST['searchField']}&searchValue={$_POST['searchValue']}"), true);
        } else {
            $gridObj->setGridOptions("Manage Users", 880, 200, "id", "asc", $gridColumn, $gridColumnModel, site_url('user/load_users'), true);
        }

        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'user';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Users';
        $this->load->view('main', $data);
    }

    function load_users() {
        $this->mod_user->get_user_grid();
    }

    function new_user() {
        if (!common::add_permit()) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_user')) {
                $data = sql::row("scic_user", "username='" . $_POST['user_name'] . "'");

                if (!$data) {
                    $this->mod_user->save_user(); //Don't Change
                    $this->session->set_flashdata('msg', 'User Added Successfully!');
                } else
                    $this->session->set_flashdata('msg', 'User already exist');
                redirect('user');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Users', 'url' => site_url('user')),
            array('title' => 'Add New User', 'url' => '')
        );
        $data['dir'] = 'user';
        $data['action'] = 'user/new_user';
        $data['page'] = 'user_form'; //Don't Change
        $data['page_title'] = 'Add New User';
        $this->load->view('main', $data);
    }

    function edit_user($user_id = '') {
        if (!common::update_permit()) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_user')) {
                $this->mod_user->update_user(); //Don't Change
                $this->session->set_flashdata('msg', 'Content Updated Successfully!');
                redirect('user');
            }
        }
        $id = $user_id;
        if ($id == '') {
            redirect('user');
        }
        $data = sql::row("scic_user", "id=$id");
        $this->session->set_userdata('edit_user_id', $data['id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Users', 'url' => site_url('user')),
            array('title' => 'Add New User', 'url' => '')
        );
        $data['dir'] = 'user';
        $data['action'] = 'user/edit_user/' . $user_id;
        $data['page'] = 'user_form'; //Don't Change
        $data['page_title'] = 'Edit User';
        $this->load->view('main', $data);
    }

    function delete_user() {
        $id = $this->uri->segment(3);
        if ($id == '') {
            redirect('user');
        }

        $this->mod_user->delete_user($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('user');
    }

    function user_status() {
        $id = $this->uri->segment(4);
        if ($id == '') {
            redirect('user');
        }
        $status = $this->uri->segment(3);
        common::change_status('scic_user', 'id=' . $id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('user');
    }
	function delete_all_user(){
	$this->mod_user->empty_user();	
	}

}

?>