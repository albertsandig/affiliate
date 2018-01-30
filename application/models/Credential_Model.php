<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credential_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	function register($referral)	{
		$query = $this->db->query("
			CALL procedure_create_user_registration(
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?
			);
		",array(
			$referral,
			$this->input->post('email'),
			$this->input->post('password'),
			$this->input->post('firstname'),
			$this->input->post('lastname'),
			$this->input->post('gender'),
			'',
			$this->input->post('mobile_number'),
			'',
			3
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>You are successfully registered.
			You can now  <a href='".base_url('login')."' style='color:blue'>login here.</a></label>";
		}
	} 
	
	function login()	{	
		$query = $this->db->query("
			CALL procedure_login_user(
				?,
				?
			);
		",array(
			$this->input->post('email'),
			$this->input->post('password')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->row();
		}
	}
	
	function verify_user($userId)	{	
		$query = $this->db->query("
			UPDATE user_info
			SET verify = TRUE
			WHERE 
				user_no = ?;
		",array(
			$userId
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>You account is now verified.</label>";
		}
	}
	
	function is_alredy_verified($userId)	{	
		$query = $this->db->query("
			SELECT 
				COUNT(user_no) AS verified 
			FROM user_info
			WHERE user_no = ? AND
					verify = 1;
		",array(
			$userId
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			$verified = $query->row()->verified;
			
			if($verified == 0)
				return false;
			else
				return true;
		}
	}
	
	function update_credential()	{	
		if(!empty($this->input->post('password'))){
			$query = $this->db->query("
			UPDATE user_info
			SET password = MD5(?)
			WHERE 
				user_no = ?;
			",array(
				$this->input->post('password'),
				$this->session->userdata('user_no')
			));
			
			if(!$query){
				return notification($this->db->error()['message'],"error");
			} 
		}
	
		$query = $this->db->query("
			UPDATE user_info
			SET email = ?
			WHERE 
				user_no = ?;
		",array(
			$this->input->post('email'),
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} 
		
		$query = $this->db->query("
			UPDATE user_info
			SET 
				firstname = ?,
				lastname = ?,
				age = ?,
				birthday = ?,
				gender = ?,
				address = ?,
				mobile_number = ?,
				img_source = ?,
				peso_address = ?
			WHERE 
				user_no = ?;
		",array(
			$this->input->post('fname'),
			$this->input->post('lname'),
			$this->input->post('age'),
			$this->input->post('birthday'),
			$this->input->post('gender'),
			$this->input->post('address'),
			$this->input->post('mobile_number'),
			$this->input->post('picture'),
			$this->input->post('paddress'),
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>User has been updated.
			Your picture will be updated after you relogin.
			</label>";
		}
	}
}
