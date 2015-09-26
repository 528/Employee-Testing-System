<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Mohaimen
 */
class Login extends Controller {

    function Login() {
        parent::Controller();
        $this->load->model('valid_user');
    }

    function index() {
        $data['msg'] = '';
        $logged_in = $this->session->userdata('logged_in');
        if (!$logged_in)
            if ($this->form_validation->run('valid_login')) {

                if (isset($_POST['submit_login'])) {
                    if ($this->valid_user->user_validation()) {
                        redirect('skill_test');
                    } else {
                        $data['msg'] = 'User email and/or password invalid';
                    }
                }
            }
        $data['title'] = 'Login';
        $data['dir'] = 'login';
        $data['page'] = 'login_view';
        $this->load->view('main', $data);
    }
	
	function register() {
        $data['msg'] = "";
        if (isset($_POST['submit_register'])) {
            if ($this->form_validation->run('register_user')) {
                if($this->valid_user->register_user()){
                     if ($this->valid_user->user_validation()) {
                        redirect('skill_test');
                     }
                $data['msg'] = "Successfully Registered !<a href='" . site_url('login') . "'>Login now</a> to continue.";
				$data['dir'] = 'general';
                $data['page'] = 'success';
                $this->load->view('main', $data);
				return;
				}
				else
				$data['msg'] = "<div class='error'>This email already exist. Please try with different email address.</div>";
            } else {
                $data['msg'] = "<div class='error'>Please fill in all the required fields and try to submit the form</div>";
            }
        }
        
        $data['dir'] = 'login';
        $data['page'] = 'register';
        $this->load->view('main', $data);
    }

    /*
      function forget_password()
      {
      if($this->form_validation->run('valid_forget_password'))
      {
      //redirect();
      }
      $this->load->view('forget_password');
      }
     */
}
?>

