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
class Question extends Controller {

    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('question_model');
        $this->load->library('grid');
    }

    function index() {
        if (!common::view_permit()) {
            common::redirect();
        }
        $gridObj = new grid();
        $gridColumn = array("Question", "Type", "Status");
        $gridColumnModel = array(
            array("name" => "texts",
                "index" => "texts",
                "width" => 200,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "type",
                "index" => "type",
                "width" => 100,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 100,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            //$this->session->set_userdata('type', $_POST['searchField']);
            $gridObj->setGridOptions("Manage Questions", 880, 200, "id", "asc", $gridColumn, $gridColumnModel, site_url("?c=question&m=load_question&searchField={$_POST['searchField']}"), true);
        } else {
            $gridObj->setGridOptions("Manage Questions", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('question/load_question'), true);
        }

        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'shorturl';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Questions';
        $this->load->view('main', $data);
    }

    function load_question() {
        $this->question_model->get_question_grid();
    }

    function new_question() {
        if (!common::add_permit()) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('new_question')) {
                if ($this->question_model->add_question()) {
                    $this->session->set_flashdata('msg', 'Question Added Successfully!!!');
                    redirect('question');
                }
            }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['action'] = 'question/new_question';
        $data['dir'] = 'shorturl';
        $data['page'] = 'add_url';
        $data['page_title'] = 'Add Questions';
        $this->load->view('main', $data);
    }

    function edit_question($id = '') {

        if ($_POST['save']) {
            if ($this->form_validation->run('new_question')) {
                if ($this->question_model->update_question()) {
                    //$this->session->unset_userdata('edit_qid');
                    $this->session->set_flashdata('msg', 'Question Updated Successfully!!!');
                    redirect('question');
                }
            }
        }
        $this->session->set_userdata('edit_qid', $id);
        $data = sql::row('scic_question', 'id=' . $id);
        $multi_answer = sql::row('scic_multi_ans', 'qid=' . $id);
        $answer = sql::row('scic_answer', 'ans_number=' . $id, 'answer');

        $data['answer'] = $answer;
        $data['multi_answer'] = $multi_answer;
        $data['msg'] = $this->session->flashdata('msg');
        $data['action'] = 'question/edit_question';
        $data['dir'] = 'shorturl';
        $data['page'] = 'add_url';
        $data['page_title'] = 'Edit Questions';
        $this->load->view('main', $data);
    }

    function delete_question($id = '') {

        if ($id == '') {
            redirect('question');
        }
        $this->question_model->delete_question($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('question');
    }

    function question_status() {
        $id = $this->uri->segment(4);
        if ($id == '') {
            redirect('question');
        }
        $status = $this->uri->segment(3);
        common::change_status('scic_question', 'id=' . $id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('question');
    }

}

?>
