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
class question_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_question_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = " ORDER BY $sortname $sortorder";
        $searchField = $_REQUEST['searchField']; //common::getVar('searchField');
        //$searchValue = common::getVar('searchValue');
        $con = 1;

        if ($searchField != '0' && $searchField != '') {
            $searchField = $searchField - 1;
            $con.=" and type = $searchField ";
        }

        $sql = "select * from scic_question where " . $con . $sort;

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('scic_question', '1');
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
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
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) {
            if ($row['type'] == 0)
                $label = "General";
            else if ($row['type'] == 1)
                $label = "First Part";
            else if ($row['type'] == 2)
                $label = "Second part";
            else if ($row['type'] == 3)
                $label = "Third part";
            else
                $label = "None";

            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['texts'], $label, $row['status']);
            $i++;
        }


        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author:Mohaimen khan");
        header("Email: joyes@sec.ac.bd");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function add_question() {

        $sql = "insert into scic_question set
                                     texts={$this->db->escape($_POST['texts'])},
                                     type ={$this->db->escape($_POST['type'])}";

        $this->db->query($sql);
        $id = mysql_insert_id();
        if ($_POST['type'] == 1) {
            $sql = "insert into scic_multi_ans set
                                     qid={$id},
									 first={$this->db->escape($_POST['first'])},
									 second={$this->db->escape($_POST['second'])},
									 third={$this->db->escape($_POST['third'])},
									 fourth={$this->db->escape($_POST['fourth'])}";
            $this->db->query($sql);
        }
        $sql = "insert into scic_answer set
                                     ans_number={$id},
									 answer={$this->db->escape($_POST['answer'])},
                                     type ={$this->db->escape($_POST['type'])}";
        return $this->db->query($sql);
    }

    function update_question() {
        $ids = $this->session->userdata('edit_qid');
        $sql = "update scic_question set
		                             texts={$this->db->escape($_POST['texts'])},
                                     type ={$this->db->escape($_POST['type'])}
                                      where id=" . $ids;


        $this->db->query($sql);

        if ($_POST['type'] == 1) {
            $sql = "update scic_multi_ans set
                                     first={$this->db->escape($_POST['first'])},
									 second={$this->db->escape($_POST['second'])},
									 third={$this->db->escape($_POST['third'])},
									 fourth={$this->db->escape($_POST['fourth'])} 
									 where qid=" . $ids;
            $this->db->query($sql);
        }

        $sql = "update scic_answer set
                                     answer={$this->db->escape($_POST['answer'])},
                                     type ={$this->db->escape($_POST['type'])}
									 where ans_number=" . $ids;
        return $this->db->query($sql);
    }

    function delete_question($id = '') {
        $ty = sql::row('scic_multi_ans', 'qid=' . $id);
        if ($ty != null) {
            $sql = "delete from scic_multi_ans where qid=" . $id;
            $this->db->query($sql);
        }
        $sql = "delete from scic_question where id=" . $id;
        $this->db->query($sql);
        $sql = "delete from scic_answer where ans_number=" . $id;
        return $this->db->query($sql);
    }

}

?>
