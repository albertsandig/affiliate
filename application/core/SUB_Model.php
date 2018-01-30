<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class SUB_Model extends CI_Model  {
	
	function __construct(){
		parent::__construct();
	}
	
	function logout_user(){
		$query = $this->db->query("
			CALL procedure_logout_user(
				?
			);
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  notification("Successfully logout user.");
		}
	}
	
}