<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of general
 *
 * @author Mohaimen
 */
class General extends Controller {

    function General() {
        parent::Controller();
        $this->load->model('get_question');
    }

    function index() {

        $data['msg'] = '';
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'general') {
            $res = $this->get_question->get_general();
            for ($i = 0; $i < count($res); $i++) {
                $text[$i] = $res[$i]['texts'];
                $qid[$i] = $res[$i]['id'];
            }
            $data['text'] = $text;
            $data['qid'] = $qid;
        } else {
            redirect('login');
        }

        $data['title'] = 'General Info';
        $data['dir'] = 'general';
        $data['page'] = 'index';
        $this->load->view('main', $data);
    }

    function answer_submit() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'general') {
            if (isset($_POST['submit_general'])) {
                if ($this->get_question->submit_general()) {
                    $data['msg'] = "You have successfully completed the General question section. Please <a href='" . site_url('skill_test/get_first_part') . "'>click here</a> to continue.";
                } else {
                    $data['msg'] = "Something Wrong.";
                }
            }
        } else {
            $data['msg'] = "Do not adopt unfair means. <a href='" . site_url('skill_test/get_first_part') . "'>click here</a> to continue.";
        }
        $data['title'] = 'Successfull';
        $data['dir'] = 'general';
        $data['page'] = 'success_general';
        $this->load->view('main', $data);
    }

}
