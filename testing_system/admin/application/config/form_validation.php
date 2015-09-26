<?php

$config = array(
    'valid_login' => array(
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
    'valid_change_password' => array(
        array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'required|callback_is_valid_user_password'),
        array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[new_password]')
    ),
    'valid_user' => array(       
        array('field' => 'user_name', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')
    ),
    'valid_general' => array(
        array('field' => 'general', 'label' => 'Marks', 'rules' => 'required'),
    ),
	'valid_third' => array(
        array('field' => 'third_part', 'label' => 'Marks', 'rules' => 'required'),
    ),
    'valid_type' => array(
        array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'required'),
        array('field' => 'type_for', 'label' => 'Type For', 'rules' => 'required')
    ),
	
	'new_question' => array(
        array('field' => 'type', 'label' => 'Section', 'rules' => 'required'),
		array('field' => 'texts', 'label' => 'Question', 'rules' => 'required')        
    ),
);
?>
