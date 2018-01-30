<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('module'))
{	

	/*
		in controller
		
		$this->load->helper('module');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('module');
		
	*/
   function module($class = "",$function_name = ""){
		return base_url('admin/mod/'.$class.'/'.$function_name);
   }   
}