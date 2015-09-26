<?php

$config = array(
    'valid_teacher' => array(
        array('field' => 'teacher_name', 'label' => 'Name', 'rules' => 'required'),
        array('field' => 'teacher_email', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'teacher_password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'current_institution', 'label' => 'Current Institution', 'rules' => 'required'),
        array('field' => 'graduate_institution', 'label' => 'Graduate Institution', 'rules' => 'required'),
        array('field' => 'interest_subject', 'label' => 'Interest Subject', 'rules' => 'required')
    ),
    'valid_student' => array(
        array('field' => 'user_name', 'label' => 'Name', 'rules' => 'required'),
        array('field' => 'user_email', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'user_password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'user_occupation', 'label' => 'Occupation', 'rules' => 'required'),
        array('field' => 'user_country', 'label' => 'Country', 'rules' => 'required')
    ),
    'valid_login' => array(
        //array('field'=>'type', 'label'=> 'User Type' ,'rules'=>'required'),
        array('field' => 'username', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
    'valid_forget_password' => array(
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required')
    ),
    'lecture_validation' => array(
        array('field' => 'department', 'label' => 'Department', 'rules' => 'required'),
        array('field' => 'department_id', 'label' => 'Course Title', 'rules' => 'required'),
        array('field' => 'lecture_title', 'label' => 'Lecture Title', 'rules' => 'required'),
        array('field' => 'userfile', 'label' => 'Lecture File', 'rules' => 'required')
    ),
	'register_user' => array(       
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')
    ),
    'full_name' => array(
        array('field' => 'fullname', 'label' => 'Full Name', 'rules' => 'required')
    )
);
?>
