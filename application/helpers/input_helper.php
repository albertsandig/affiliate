<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_duration_unit'))
{	

	/*
		in controller
		
		$this->load->helper('get_duration_unit');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function get_duration_unit($in_value = '', $show = true){
		$units = array('MINUTE','SECOND');
		if($show) {
			$select = '<select name="duration_unit" class="form-control" required>';
			foreach($units AS &$unit){
				$is_selected = ($in_value == $unit) ? 'selected' : '' ;
				$select = $select . '<option '.$is_selected.' value="'.$unit.'" >'.$unit.'</option>';
			}
			$select .= '</select>';			
			return $select;
		} else{
			if($in_value == '' || !in_array($in_value, $units))
				return false;
			
			return true;
		}
	}
	
}

if ( ! function_exists('get_currency'))
{	

	/*
		in controller
		
		$this->load->helper('get_currency');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function get_currency($in_value = 0, $show = true){
		$CI = & get_instance();
		$CI->load->model('Admin_Model');
		
		$currencies = $CI->Admin_Model->get_currency();
		if($show) {
			$select = '<select name="currency_type" class="form-control" required>';
			foreach($currencies AS $currency){
				$is_selected = ($in_value == $currency->id) ? 'selected' : '' ;
				$select = $select . '<option '.$is_selected.' value="'.$currency->id.'">'.$currency->name.'</option>';
			}
			$select .= '</select>';			
			return $select;
		} else{
			if($in_value == 0 )
				return false;
				
			foreach($currencies AS $currency){
				if($currency->id == $in_value)
					return true;
			}
			
			return false;
		}
	}
}


if ( ! function_exists('get_ads_type'))
{	

	/*
		in controller
		
		$this->load->helper('get_ads_type');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function get_ads_type($in_value = 0, $show = true){
		$CI = & get_instance();
		$CI->load->model('Admin_Model');
		
		$ads_type = $CI->Admin_Model->get_ads_type();
		if($show) {
			$select = '<select name="ad_type" class="form-control" required>';
			foreach($ads_type AS $ad_type){
				$is_selected = ($in_value == $ad_type->id) ? 'selected' : '' ;
				$select = $select . '<option '.$is_selected.' value="'.$ad_type->id.'">'.$ad_type->name.'</option>';
			}
			$select .= '</select>';			
			
			return $select;
		} else{
			
			if($in_value == 0 )
				return false;
				
			foreach($ads_type AS $ad_type){
				if($ad_type->id == $in_value)
					return true;
			}
			
			return false;
		}
	}
}
