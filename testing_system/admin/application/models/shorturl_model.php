<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase_model
 *
 * @author Tamal
 */
class shorturl_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_shorturl_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            //$this->session->unset_userdata('purchase_search');
        }
        $sql = "select * from urls where " . $serachoption . $sort;
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('urls', '1');
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
            $surl="guit.biz/".$row['shortcode'];
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['shortcode'], $surl, $row['url'], $row['ga_campaign'], $row['ga_adgroup'], $row['ga_ad_content'], $row['ga_keyword']);
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

   

    function add_url() {
    
	$urlinput=mysql_real_escape_string($_POST['url']); 
$id=rand(10000,99999);
$shorturl=base_convert($id,20,36);

     $sql = "insert into urls set
                                     shortcode={$this->db->escape($shorturl)},
                                     url={$this->db->escape($_POST['url'])},
                                     ga_campaign ={$this->db->escape($_POST['ga_campaign'])},
                                     ga_adgroup ={$this->db->escape($_POST['ga_adgroup'])},
                                     ga_ad_content ={$this->db->escape($_POST['ga_ad_content'])},
                                     ga_keyword ={$this->db->escape($_POST['ga_keyword'])}";
                                     
									 return $this->db->query($sql);
    

        
    }

    function update_url($ids = '') {
	$urlinput=mysql_real_escape_string($_POST['url']); 
$id=rand(10000,99999);
$shorturl=base_convert($id,20,36);
        $sql = "update urls set
		                             shortcode={$this->db->escape($shorturl)},
                                     url={$this->db->escape($_POST['url'])},
                                     ga_campaign ={$this->db->escape($_POST['ga_campaign'])},
                                     ga_adgroup ={$this->db->escape($_POST['ga_adgroup'])},
                                     ga_ad_content ={$this->db->escape($_POST['ga_ad_content'])},
                                     ga_keyword ={$this->db->escape($_POST['ga_keyword'])} where id=" . $ids;


        return $this->db->query($sql);
    }

    function delete_url($id = '') {
        $sql = "delete from urls where id=" . $id;
        return $this->db->query($sql);
    }
    
   

}

?>
