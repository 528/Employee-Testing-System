<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of skill_test
 *
 * @author Mohaimen
 */
class Skill_test extends Controller {

    function Skill_test() {
        parent::Controller();
        $this->load->model('answer_submission');
    }

    function index() {

        $data['msg'] = '';
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'skill_ass') {
            if (isset($_POST['skill_info'])) {
                if ($this->form_validation->run('full_name')) {
                    if ($this->answer_submission->submit_userinfo()) {
                        redirect('general');
                    }
                }
            }
        } else {
            redirect('login');
        }

        $data['title'] = 'Skill Test';
        $data['dir'] = 'skill';
        $data['page'] = 'skill_view';
        $this->load->view('main', $data);
    }

    function get_first_part() {
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_i') {
            $res = $this->answer_submission->get_multiple();
            for ($i = 0; $i < count($res); $i++) {
                $text[$i] = $res[$i]['texts'];
                $qid[$i] = $res[$i]['id'];
                $first_choice[$i] = $res[$i]['first'];
                $second_choice[$i] = $res[$i]['second'];
                $third_choice[$i] = $res[$i]['third'];
                $fourth_choice[$i] = $res[$i]['fourth'];
            }
            $data['text'] = $text;
            $data['qid'] = $qid;
            $data['first'] = $first_choice;
            $data['second'] = $second_choice;
            $data['third'] = $third_choice;
            $data['fourth'] = $fourth_choice;
        } else {
            redirect('login');
        }
        $data['title'] = 'Skill Test';
        $data['dir'] = 'skill';
        $data['page'] = 'first_part';
        $this->load->view('main', $data);
    }

    function submit_first_part() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_i') {
            if (isset($_POST['submit_first'])) {
                if ($this->answer_submission->submit_multiple()) {
                    $data['msg'] = "You have successfully completed the First part question section. Please <a href='" . site_url('skill_test/get_second_part') . "'>click here</a> to continue.";
                } else {
                    $data['msg'] = "Something Wrong.";
                }
            }
        } else {
            $data['msg'] = "Do not adopt unfair means.<a href='" . site_url('skill_test/get_second_part') . "'>click here</a> to continue.";
        }
        $data['title'] = 'Successfull';
        $data['dir'] = 'general';
        $data['page'] = 'success';
        $this->load->view('main', $data);
    }

    function get_second_part() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_ii') {
            $res = $this->answer_submission->get_math();
            for ($i = 0; $i < count($res); $i++) {
                $text[$i] = $res[$i]['texts'];
                $qid[$i] = $res[$i]['id'];
            }
            $data['text'] = $text;
            $data['qid'] = $qid;
        }
        $data['title'] = 'Math Problem';
        $data['dir'] = 'skill';
        $data['page'] = 'second_part';
        $this->load->view('main', $data);
    }

    function submit_second_part() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_ii') {
            if (isset($_POST['submit_math'])) {
                if ($this->answer_submission->submit_math()) {
                    $data['msg'] = "You have successfully completed the Second part question section. Please <a href='" . site_url('skill_test/get_third_part') . "'>click here</a> to continue.";
                } else {
                    $data['msg'] = "Something Wrong.";
                }
            }
        } else {
            $data['msg'] = "Do not adopt unfair means. <a href='" . site_url('skill_test/get_third_part') . "'>click here</a> to continue.";
        }
        $data['title'] = 'Successfull';
        $data['dir'] = 'general';
        $data['page'] = 'success';
        $this->load->view('main', $data);
    }

    function get_third_part() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_iii') {
            $res = $this->answer_submission->get_third();
            for ($i = 0; $i < count($res); $i++) {
                $text[$i] = $res[$i]['texts'];
                $qid[$i] = $res[$i]['id'];
            }
            $data['text'] = $text;
            $data['qid'] = $qid;
        }

        $data['title'] = 'Customer Problem Handling';
        $data['dir'] = 'skill';
        $data['page'] = 'third_part';
        $this->load->view('main', $data);
    }

    function submit_third_part() {
        $data['msg'] = "";
        $logged_in = $this->session->userdata('logged_in');
        $type = $this->session->userdata('type');
        if ($logged_in && $type == 'part_iii') {
            if (isset($_POST['submit_math'])) {
                if ($this->answer_submission->submit_third()) {
                    $check = sql::row("scic_result", "user_id=$logged_in");
                if ($check['first_part'] != -1 && $check['second_part'] != -1 && $check['notification']==0) {
                    $this->answer_submission->sendEmail($logged_in);					
                }
                    $data['msg'] = "You have successfully completed the Third part question section. Please <a href='" . site_url('logout') . "'>click here</a> to continue.";
                } else {
                    $data['msg'] = "Something Wrong.";
                }
            }
        } else {
            $data['msg'] = "Do not adopt unfair means. <a href='" . site_url('logout') . "'>click here</a> to continue.";
        }
        $data['title'] = 'Test Done!!';
        $data['dir'] = 'general';
        $data['page'] = 'success';
        $this->load->view('main', $data);
    }

}
