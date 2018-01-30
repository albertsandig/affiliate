<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class SUB_Controller extends CI_Controller  {
	public $data = array();
	public $css	= array();
	public $javascript = array();
	public $Sjavascript = array(); // special javascript
	
	function __construct(){
		parent::__construct();
		$this->load->helper('string_util');
		$this->add_javascript('components/scripts/js/ads.js');
	}
	
	/*
		Redirect to login page if user is is not login
	*/
	
	function site_user_login(){
		$is_login = $this->session->userdata('logged_in');
		if(!isset($is_login) || !$is_login ){
			$message = notification(" Login first.","error");
			$this->session->set_flashdata('message', $message);
			redirect('login');
		} 
	}
	
	/*
		Redirect to admin page if user is already login
	*/
	
	function is_user_already_login(){
		$is_login = $this->session->userdata('logged_in');
		if(isset($is_login) || $is_login ){
			redirect('admin/user');
		} 
	}
	
	
	function logout(){
		$this->load->model('SUB_Model');
		$message = $this->SUB_Model->logout_user();
		
		$data = array(
			  'email'     		,
			  'user_no'    	,
			  'type_no'     	,
			  'name'     		,
			  'user_type'     ,
			  'profile_pic'   ,
			  'logged_in' 		
			);
	
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('message', $message);
		redirect('login');
	}
	
	//TEMPLATE
	function set_body($body)
	{
		$this->data['body'] = $body; 
		$this->data['css'] = $this->get_css();	
		$this->data['javascript'] = $this->get_javascript();	
	}
	
	
	//CSS
	function add_css($src){
		array_push($this->css,base_url($src));
	}
	
	function get_css(){
		$css = "";
		foreach($this->css as $_css)
			$css .= "<link href='".$_css."' rel='stylesheet' type='text/css' />
	 ";	
			
		return $css;
	}
	// own library
	function add_javascript($src){
		array_push($this->javascript,base_url($src));
	}
	// from other website
	function import_javascript($src){
		array_push($this->javascript,$src);
	}
	
	// with require function
	function special_javascript($data_main,$src){
		$script =  "<script data-main='".$data_main."' src='".base_url($src)."'></script>
		";
		
		array_push($this->Sjavascript,$script);
		
	}
	
	function get_javascript(){
		$javscript = "";
		foreach($this->javascript as $_javscript)
			$javscript .= "<script src='".$_javscript."' type='text/javascript' ></script>
	 ";
	 
		foreach($this->Sjavascript as $_javscript)
			$javscript .= $_javscript;
		
		return $javscript;
	}
	
}