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
class mod_user extends Model {

    function __construct() {
        parent::Model();
    }

    function get_user_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');

        $con = 1;
        if ($searchField != '' && $searchValue != '') {
            $con.=" and $searchField like '%$searchValue%'";
        }

        $sql = "select * from scic_user where  $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count("scic_user");
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
            $status = $row[status] == 'active' ? 'Active' : 'Inactive';
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['username'], $row['password'], $status); //$row['first_name'] . ' ' . $row['last_name'], $row['email'],
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
            'username' => 'User Name',
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

    function save_user() {
        $password = $_POST['password'];

        $sql = "insert into scic_user set
                username={$this->db->escape($_POST['user_name'])},
                password={$this->db->escape($password)},
                date={$this->db->escape(date('Y-m-d'))}";
        return $this->db->query($sql);
    }

    function update_user() {
        $user_id = $this->session->userdata('edit_user_id');
        $password = $_POST['password'];


        $sql = "update scic_user set
                username={$this->db->escape($_POST['user_name'])},
                password={$this->db->escape($password)}
                where id=$user_id";
        return $this->db->query($sql);
    }

    function delete_user($user_id) {
        $sql = "delete from scic_user where id=$user_id";
        $this->db->query($sql);
        $sql = "delete from scic_skillset where user_id=$user_id";
        $this->db->query($sql);
        $sql = "delete from scic_general where user_id=$user_id";
        $this->db->query($sql);
        $sql = "delete from scic_part_i where user_id=$user_id";
        $this->db->query($sql);
        $sql = "delete from scic_part_ii where user_id=$user_id";
        $this->db->query($sql);
        $sql = "delete from scic_part_iii where user_id=$user_id";
        $this->db->query($sql);
        return;
    }
	
	function empty_user(){
	$sql = "delete from scic_user";
        $this->db->query($sql);
        $sql = "delete from scic_skillset";
        $this->db->query($sql);
        $sql = "delete from scic_general";
        $this->db->query($sql);
        $sql = "delete from scic_part_i";
        $this->db->query($sql);
        $sql = "delete from scic_part_ii";
        $this->db->query($sql);
        $sql = "delete from scic_part_iii";
        $this->db->query($sql);
        return;
	}

}

?>