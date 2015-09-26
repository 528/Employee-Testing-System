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
class mod_result extends Model {

    function __construct() {
        parent::Model();
    }

    function get_user_grid() {
        $sortname = common::getVar('sidx', 'user_id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');

        $con = 1;
        if ($searchField != '' && $searchValue != '') {
            $con.=" and $searchField like '%$searchValue%'";
        }

        $sql = "select * from scic_result where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count("scic_result");
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query = $this->db->query($sql . " limit $start, $limit");

        $rows = $sql_query->result_array();

        $i = 0;
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            $dat = sql::row("scic_skillset", "user_id=" . $row['user_id'], "fullname");
            $notify = $row['notification'] == 1 ? 'Email Sent' : 'Pending';
            $status = $row['test_status'] == 1 ? 'Complete' : 'Incomplete';
            $responce->rows[$i]['id'] = $row['user_id'];
            $responce->rows[$i]['cell'] = array($row['email'], $dat['fullname'], $status, $notify); //$row['first_name'] . ' ' . $row['last_name'], $row['email'],
            $i++;
        }

        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mohaimen khan");
        header("Email: joyes528@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_search_options($sel = '') {
        $arr = array(
            'email' => 'Email',
        );
        $opt = '';
        foreach ($arr as $key => $value) {
            if ($sel == $key) {
                $opt.="<option value='$key' selected='selected'>$value</option>";
            } else {
                $opt.="<option value='$key'>$value</option>";
            }
        }
        return $opt;
    }

    function get_user_details($id) {
        $sql = $this->db->query("select * from user where user_id = $id");
        return $sql->row_array();
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

    function get_general_answer($id) {
        $type = 0;

        $sql = "SELECT * FROM scic_general WHERE type  = ? AND user_id=" . $id;
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

            return $result;
        } else {
            return false;
        }
    }

    function get_third_answer($id) {
        $type = 3;

        $sql = "SELECT * FROM scic_part_iii WHERE type  = ? AND user_id=" . $id;
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

    function update_gen_marks($user_id) {

        $sql = "update scic_result set
                general={$this->db->escape($_POST['general'])}
                where user_id=$user_id";

        return $this->db->query($sql);
        
    }

    function update_third_marks($user_id) {

        $sql = "update scic_result set
                third_part={$this->db->escape($_POST['third_part'])}
                where user_id=$user_id";
        return $this->db->query($sql);
    }

    function delete_result($user_id) {
        $sql = "delete from scic_result where user_id=$user_id";
        return $this->db->query($sql);
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
        $count = sql::count("scic_question","type='1' and status='active'");
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
        $message = "Candidate Name: ".$name['fullname']."</br> Candidate Email: ".$data['email']."</br> Marks in General: ".$data['general']."</br> Marks in first part:".$mul_marks.
                " Percent(".$data['first_part']." right answer among ".$count." problems) </br> Marks in Second Part:".$math_marks.
                " Percent(".$data['second_part']." right answer among ".$count_mth." problems) </br> Marks in Third Part: ".$data['third_part']."</br> Total Time Taken: ".$t_tme." Seconds </br> </br>";
        
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
            if($row['given_answer'] != $row['org_answer']){
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

?>