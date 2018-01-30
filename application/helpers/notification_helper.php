<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('notification'))
{	

	/*
		in controller
		
		$this->load->helper('notification');
		echo notification('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('notification');
	*/
   function notification($msg = "",$type = "success"){
		if(strcmp($type ,"error") == 0)
			return "<label style='color:red;font-weight:bold;'>Error: ".$msg."</label>";
			
		return "<label style='color:#279619;font-weight:bold;'>".$msg."</label>";
   }   
}