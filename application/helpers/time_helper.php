<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_end_time'))
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
  
	function get_end_time($code){
		$CI = & get_instance();
		$CI->load->model('Admin_Model');
		return $CI->Admin_Model->get_deposit_transaction_time($code);
	}
}


