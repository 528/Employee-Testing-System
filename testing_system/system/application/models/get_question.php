<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of get_general_question
 *
 * @author Mohaimen
 */
Class get_question extends Model {

    function get_question() {
        parent::Model();
    }

    function get_general() {
        $type = 0;

        $sql = "SELECT * FROM scic_question WHERE type  = ? AND status='active'";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        //print_r($result);
        // echo "</br>".$result[0][texts];
        // exit();
        if ($query->num_rows() != 0) {

            return $result;
        } else {
            return false;
        }
    }

    function submit_general() {
        $ques_id = $_POST['qid'];
        $ans = $_POST['answer'];
        for ($i = 0; $i < count($ques_id); $i++) {
            $sql = "insert into scic_general set
                user_id={$this->session->userdata('logged_in')},
                ans_number={$this->db->escape($ques_id[$i])},
                answer={$this->db->escape($ans[$i])},
                type='0'";
            $this->db->query($sql);
        }
        $this->session->set_userdata('type', 'part_i');
        return TRUE;
    }

}

?>