<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of answer_submission
 *
 * @author Mohaimen
 */
Class answer_submission extends Model {

    function answer_submission() {
        parent::Model();
    }

    function submit_userinfo() {
        $today = date("Y-m-d");
        //$cur_time = date("Y-m-d H:i:s");
        $sql = "insert into scic_skillset set
                user_id={$this->session->userdata('logged_in')},
                fullname={$this->db->escape($_POST['fullname'])},
                date={$this->db->escape($today)},
                arrival_time=now()";
        $this->db->query($sql);
        $this->session->set_userdata('type', 'general');
        $em = "'" . $this->session->userdata('email') . "'";
        $sql = "insert into scic_result set
                user_id={$this->session->userdata('logged_in')},
                email=$em";
        $this->db->query($sql);
        return TRUE;
    }

    function get_multiple() {
        $type = 1;
        $user = $this->session->userdata('logged_in');
        $sql = "SELECT * FROM scic_question,scic_multi_ans WHERE type  = ? AND status='active' AND qid=id";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        // print_r($result);
        // echo "</br>".$result[0][texts];
        //exit();
        if ($query->num_rows() != 0) {
            $sql = "SELECT arrival_time + INTERVAL 50 MINUTE AS time_limit FROM scic_skillset WHERE user_id  = ?";
            $query = $this->db->query($sql, array($user));
            $dt = $query->result_array();


            $this->session->set_userdata('start', $dt[0]['time_limit']);
            //$this->session->set_userdata('logged_in', $username);

            return $result;
        } else {
            return false;
        }
    }

    function submit_multiple() {
        $ques_id = $_POST['qid'];
        for ($i = 0; $i < count($ques_id); $i++) {
			
            $sql = "insert into scic_part_i set
                user_id={$this->session->userdata('logged_in')},
                ans_number={$this->db->escape($ques_id[$i])},
                answer={$this->db->escape($_POST[$ques_id[$i]])},
                type='1'";
           $this->db->query($sql);		  		   
        }
        $this->session->set_userdata('type', 'part_ii');
        $sql = "select count(*) as total from scic_answer,scic_part_i where user_id=" . $this->session->userdata('logged_in') . " and scic_answer.ans_number=scic_part_i.ans_number and scic_answer.answer=scic_part_i.answer and scic_answer.type=scic_part_i.type";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $sql = "update scic_result set
                first_part={$result[0]['total']}
                where user_id={$this->session->userdata('logged_in')}";
        $this->db->query($sql);
        return TRUE;
    }

    function get_math() {
        $type = 2;

        $sql = "SELECT * FROM scic_question WHERE type  = ? AND status='active'";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        //print_r($result);
        // echo "</br>".$result[0][texts];
        // exit();
        if ($query->num_rows() != 0) {

            //$this->session->set_userdata('logged_in', $username);

            return $result;
        } else {
            return false;
        }
    }

    function submit_math() {
        $ques_id = $_POST['qid'];
        $ans = $_POST['answer'];
        for ($i = 0; $i < count($ques_id); $i++) {
            $sql = "insert into scic_part_ii set
                user_id={$this->session->userdata('logged_in')},
                ans_number={$this->db->escape($ques_id[$i])},
                answer={$this->db->escape($ans[$i])},
                type='2'";
            $this->db->query($sql);
        }
        $this->session->set_userdata('type', 'part_iii');

        $sql = "select count(*) as total from scic_answer,scic_part_ii where user_id=" . $this->session->userdata('logged_in') . " and scic_answer.ans_number=scic_part_ii.ans_number and scic_part_ii.answer LIKE scic_answer.answer and scic_answer.type=scic_part_ii.type";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $sql = "update scic_result set
                second_part={$result[0]['total']}
                where user_id={$this->session->userdata('logged_in')}";
        $this->db->query($sql);
        return TRUE;
    }

    function get_third() {
        $type = 3;

        $sql = "SELECT * FROM scic_question WHERE type  = ? AND status='active'";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        //print_r($result);
        // echo "</br>".$result[0][texts];
        // exit();
        if ($query->num_rows() != 0) {

            //$this->session->set_userdata('logged_in', $username);

            return $result;
        } else {
            return false;
        }
    }

    function submit_third() {
        $ques_id = $_POST['qid'];
        $ans = $_POST['answer'];
        for ($i = 0; $i < count($ques_id); $i++) {
            $sql = "insert into scic_part_iii set
                user_id={$this->session->userdata('logged_in')},
                ans_number={$this->db->escape($ques_id[$i])},
                answer={$this->db->escape($ans[$i])},
                type='3'";
            $this->db->query($sql);
        }
        //$today = date("Y-m-d H:i:s"); 
        $sql = "update scic_skillset set left_time=now() where user_id=" . $this->session->userdata('logged_in');
        $this->db->query($sql);
        $sql = "update scic_result set test_status=1 where user_id=" . $this->session->userdata('logged_in');
        $this->db->query($sql);
        $this->session->set_userdata('type', 'done');
        return TRUE;
    }
    
        function sendEmail($id) {
        // parameters of your mail server and how to send your email
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'test@aslingga.com',
            'smtp_pass' => 'testpasswdxxx',
            'mailtype' => 'html'
        );

        $data = sql::row("scic_result", "user_id=$id");
        $count = sql::count("scic_question","type='1' and status='active'");
        $mul_marks = ($data['first_part']/$count)*100;
        //$count = sql::count("scic_question","type='1' and status='active'");
        $count_mth = sql::count("scic_question","type='2' and status='active'");
        $math_marks = ($data['second_part']/$count_mth)*100;
        $name = sql::row("scic_skillset", "user_id=$id");
        $t_tme = common::time_diff($name['left_time'],$name['arrival_time']);
        $sql = "SELECT * FROM scic_general,scic_question WHERE user_id=$id and id=ans_number and scic_general.type='0' and scic_question.type='0'";
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();        
        // recipient, sender, subject, and you message
        $to = "mike@space-coast-ic.com";
        $from = "Mohaimen@space-coast-ic.com";
        $subject = "Test Result::".$name['fullname'];
        $message = "Candidate Name: ".$name['fullname']."</br> Candidate Email: ".$data['email']."</br>Test Date: ".$name['arrival_time']."</br>Marks in General: 0</br> Marks in first part:".$mul_marks.
                " Percent(".$data['first_part']." right answer among ".$count." problems) </br> Marks in Second Part:".$math_marks.
                " Percent(".$data['second_part']." right answer among ".$count_mth." problems) </br> Marks in Third Part: 0</br> Total Time Taken: ".$t_tme." Seconds </br> </br>";
        
        $message.= "****<strong><u>Test Details::General Section</u></strong>**** </br>";
        foreach ($result as $row)
        {
            $message.= "<strong>".$row['texts']."</strong></br><strong><u>Ans: </u></strong>".$row['answer']."</br>";
        }
        
        $sql = "SELECT texts,scic_part_i.answer as given_answer,scic_answer.answer as org_answer,first,second,third,fourth FROM scic_part_i,scic_question,scic_multi_ans,scic_answer WHERE scic_part_i.user_id=$id and scic_question.id=scic_part_i.ans_number and scic_answer.ans_number=scic_part_i.ans_number and scic_answer.type='1' and  scic_part_i.type=scic_question.type and scic_multi_ans.qid=scic_part_i.ans_number";
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        $message.= "</br>****<strong><u>Test Details::Multiple Choice Section</u></strong>**** </br>";
        foreach ($result as $row)
        {
            if($row['given_answer']=="a"){
                $mul = $row['first'];
                if($row['given_answer'] != $row['org_answer'])
                  $mul = $mul."(<font color='red'>Wrong Answer</font>)";  
            }
            else if($row['given_answer']=="b"){
                $mul = $row['second'];
                if($row['given_answer'] != $row['org_answer'])
                  $mul = $mul."(<font color='red'>Wrong Answer</font>)";
            }
            else if($row['given_answer']=="c"){
                $mul = $row['third'];
                if($row['given_answer'] != $row['org_answer'])
                  $mul = $mul."(<font color='red'>Wrong Answer</font>)";
            }
            else if($row['given_answer']=="d"){
                $mul = $row['fourth'];
                if($row['given_answer'] != $row['org_answer'])
                  $mul = $mul."(<font color='red'>Wrong Answer</font>)";
            }
            else 
                $mul = "None(<font color='red'>Wrong Answer</font>)";                
            
            $message.= "<strong>".$row['texts']."</strong></br><strong><u>Ans: </u></strong>".$mul."</br>";
        }
        
        $sql = "SELECT texts,scic_part_ii.answer as given_answer,scic_answer.answer as org_answer FROM scic_part_ii,scic_question,scic_answer WHERE scic_part_ii.user_id=$id and scic_question.id=scic_part_ii.ans_number and scic_part_ii.type=scic_question.type and scic_answer.type='2' and scic_answer.ans_number=scic_part_ii.ans_number";
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        $message.= "</br>****<strong><u>Test Details::Math Section</u></strong>**** </br>";
        foreach ($result as $row)
        {
            if(strtolower($row['given_answer']) != strtolower($row['org_answer'])){
                  $mul = $row['given_answer']."(<font color='red'>Wrong Answer</font>)";  
            }
            else
                  $mul = $row['given_answer'];//"None(<font color='red'>Wrong Answer</font>)";   
            
            $message.= "<strong>".$row['texts']."</strong></br><strong><u>Ans: </u></strong>".$mul."</br>";
        }
        
        $sql = "SELECT * FROM scic_part_iii,scic_question WHERE user_id=$id and id=ans_number and scic_part_iii.type=scic_question.type";
        $query = $this->db->query($sql, array($type));
        $result = $query->result_array();
        $message.= "</br>****<strong><u>Test Details::Scenerio Section</u></strong>**** </br>";
        foreach ($result as $row)
        {
            $message.= "<strong>".$row['texts']."</strong></br><strong><u>Ans: </u></strong>".$row['answer']."</br>";
        }
        // load the email library that provided by CI
        //$this->load->library('email', $config);
        $this->load->library('email');
        // this will bind your attributes to email library
        //$this->email->set_newline("\r\n");
        $this->email->from($from, 'Space Coast IC');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");

        // send your email. if it produce an error it will print 'Fail to send your message!' for you
        if ($this->email->send()) {
             $sql = "update scic_result set
                notification=1
                where user_id=$id";

        return $this->db->query($sql);
			
        } else {
            echo "Fail to send your message!";
        }
    }

}
