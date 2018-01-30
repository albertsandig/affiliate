<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_url_shorter'))
{	

	/*
		in controller
		
		$this->load->helper('get_url_shorter');
		echo module('Hello World','error');
		
		output : helloworld
		in auto load
		$autoload['helper'] = array('access');
		
		IMPROVEMENTS: 
			modify access level
	*/
  
	function get_url_shorter($url){
		$short_url = 'http://bc.vc/api.php?key=b22429d79b7b267d62ec628365517bd0&uid=235882&url='.$url;
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $short_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}
