<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shorturl
 *
 * @author Mohaimen
 */
class Shorturl extends Controller {

    function __construct() {
        parent::Controller();
		common::is_logged();
        $this->load->model('shorturl_model');
        $this->load->library('grid');
    }

    function index() {
if(!common::view_permit()){
            common::redirect();
        }
        $gridObj = new grid();
        $gridColumn = array("Short Code", "Short URL", "URL", "Ga Campaign", "Ga Addgroup","Ga Add Content", "Ga Keyword");
        $gridColumnModel = array(
            array("name" => "shortcode",
                "index" => "shortcode",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "shorturl",
                "index" => "shorturl",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "url",
                "index" => "url",
                "width" => 150,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "ga_campaign",
                "index" => "ga_campaign",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "ga_adgroup",
                "index" => "ga_adgroup",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
			 array("name" => "ga_ad_content",
                "index" => "ga_ad_content",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "ga_keyword",
                "index" => "ga_keyword",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
       $this->session->unset_userdata('purchase_search');
       $this->session->unset_userdata('zone');
       $this->session->unset_userdata('provider_name');
       $this->session->unset_userdata('stating_date');
       $this->session->unset_userdata('ending_date');
        if ($_POST['apply_filter']) {
            $condition = '';
            $track=0;
            if ($_POST['searchField'] == 1&& $_POST['searchValue']) {
                $condition.=" shortcode LIKE '%" . $_POST['searchValue'] . "%' ";
                $track=1;
            }
            if ($_POST['searchField'] == 2&&  $_POST['searchValue']) {
                $condition.="  url LIKE '%" . $_POST['searchValue'] . "%' ";
                $track=1;
            }
  
                   
            if ($condition != '') {
                $this->session->set_userdata('purchase_search', $condition);
            }
        }
        $gridObj->setGridOptions("Url Shorter", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('shorturl/load_url'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'shorturl';
        $data['page'] = 'index';
        $data['page_title'] = 'Url Shorter';
        $this->load->view('main', $data);
    }

    function load_url() {
        $this->shorturl_model->get_shorturl_grid();
    }

    function add_url() {
	 if(!common::add_permit()){
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('add_url')) {
                if ($this->shorturl_model->add_url()) {
                    $this->session->set_flashdata('msg', 'Url Added Successfully!!!');
                    redirect('shorturl');
                }
           }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'shorturl';
        $data['page'] = 'add_url';
        $this->load->view('main', $data);
    }

    function edit_url($id = '') {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_url')) {
                if ($this->shorturl_model->update_url($id)) {
                    $this->session->set_flashdata('msg', 'Url Updated Successfully!!!');
                    redirect('shorturl');
                }
            }
        }
        $data = sql::row('urls', 'id=' . $id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'shorturl';
        $data['page'] = 'edit_url';
        $this->load->view('main', $data);
    }

    function delete_url($id = '') {

        if ($id == '') {
            redirect('shorturl');
        }
        $this->shorturl_model->delete_url($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('shorturl');
    }

   }

?>
