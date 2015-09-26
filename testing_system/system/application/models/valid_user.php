<?php

Class Valid_user extends Model {

    function user_validation() {
        $username = $_POST['email'];
        $userpass = $_POST['password'];
        //$usertype=$_POST['type'];
        $sql = "SELECT * FROM scic_user WHERE username  = ? AND password = ? AND status='active'";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($username, $userpass));
        if ($query->num_rows() == 1) {
            $result = $query->result_array();
            $this->session->set_userdata('logged_in', $result[0][id]);
            $this->session->set_userdata('email', $result[0][username]);
            $this->session->set_userdata('type', 'skill_ass');

            return true;
        } else {
            return false;
        }
    }

    function disable_user() {
        $sql = "update scic_user set status='inactive' where id=" . $this->session->userdata('logged_in');
        $this->db->query($sql);
    }
	
	function register_user() {
	$sql = "SELECT * FROM scic_user WHERE username  = ?";
        //echo $sql;
        // exit;
        $query = $this->db->query($sql, array($_POST['email']));
		if ($query->num_rows() == 1) {
		return false;
		}
        $sql = "insert into scic_user set
                username={$this->db->escape($_POST['email'])},
                password={$this->db->escape($_POST['password'])},
                status='active'";
        return $this->db->query($sql);
    }

}

?>
