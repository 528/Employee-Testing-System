<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Mohaimen
 */
class home extends Controller {
    function  __construct() {
        parent::Controller();
    }
    function index(){
        $data['dir']='home';
        $data['page']='index';
	$data['page_title'] = 'Employee Testing Module :: Space Coast IC, Inc.';
        $this->load->view('main',$data);
    }
}
?>
