<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('access_level'))
{	

	/*
		in controller
		
		$this->load->helper('access');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function access_level($access_rights){
		$CI = & get_instance();
		
		switch($access_rights){
			case 'ADMIN_ACCESS':
				$user_type = array('ADMIN','SUPERUSER');
				if(!in_array($CI->session->userdata('user_type'), $user_type))
					redirect('admin/access_error');
			break;
			case 'USER_ACCESS':
				$user_type = array('USER');
				if(!in_array($CI->session->userdata('user_type'), $user_type))
					redirect('admin/access_error');
			break;
		};
		
		return;
	}
}



if ( ! function_exists('access_level_view'))
{	
	/*
		in controller
		
		$this->load->helper('access');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function access_level_view($access_rights){
		$CI = & get_instance();
		
		switch($access_rights){
			case 'ADMIN_ACCESS':
				$user_type = array('ADMIN','SUPERUSER');
				if(!in_array($CI->session->userdata('user_type'), $user_type))
					return false;
			break;
			case 'USER_ACCESS':
				$user_type = array('USER');
				if(!in_array($CI->session->userdata('user_type'), $user_type))
					return false;
			break;
		};
		
		return true;
	}
}

