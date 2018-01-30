<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('string_util'))
{	

	/*
		in controller
		
		$this->load->helper('string_util');
		echo string_util('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('string_util');
	*/
   function string_util($object,$key){
		return (property_exists ($object, $key))? $object->$key : '';
   }   
}


if ( ! function_exists('string_date_util'))
{	

	/*
		in controller
		
		$this->load->helper('string_util');
		echo string_util('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('string_util');
	*/
   function string_date_util($object,$key){
		$string_val = (property_exists ($object, $key))? $object->$key : '';
		
		$date = date_create($string_val);
		
		return date_format($date,"d F Y");
   }   
}
