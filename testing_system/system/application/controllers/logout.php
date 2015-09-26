<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Logout extends Controller {

    function Logout() {
        parent::Controller();
        $this->load->model('valid_user');
    }

    function index() {
        $this->valid_user->disable_user();
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('type');
        session_destroy();
        redirect('welcome/thanks', 'refresh');
    }

    function logout1() {
        
    }

}

?>
