<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->site_user_login();
	}
	
	public function update_credential(){
		$this->load->model('Credential_Model');
		
		$message = "";
		if(empty($this->input->post('fname')) ||
			empty($this->input->post('lname')) ||
			empty($this->input->post('age')) || 
			empty($this->input->post('birthday')) ||
			empty($this->input->post('email')) ||
			empty($this->input->post('address')) ||
			empty($this->input->post('mobile_number')) 
			){
			$message = notification("Missing field. Please check input.","error");
			$this->session->set_flashdata('message', $message);
			redirect('admin/update');
		} 
		
		if(!empty($this->input->post('password')) ||
			!empty($this->input->post('cpassword')) ){
			
			if(strcmp($this->input->post('password'),$this->input->post('cpassword')) != 0){
				$message = notification("Password and Confirm Password must be equal","error");
				$this->session->set_flashdata('message', $message);
				redirect('admin/update');				
			}
		}
		
		$message = $this->Credential_Model->update_credential();
		$this->session->set_flashdata('message', $message);
		redirect('admin/update');
	}
	
	
	public function request_withdrawal(){
		$this->load->model('Admin_Model');
		
		if(empty($this->input->post('amount'))){
			$message = notification("Please input amount","error");
			$this->session->set_flashdata('message', $message);
			redirect('admin/withdraw');
		}
	
		$response = $this->Admin_Model->request_withdrawal();
		$this->session->set_flashdata('message', $response);
		redirect('admin/withdraw');
	}
	
	public function approve_withdrawal(){
		$this->load->model('Admin_Model');
		if(	empty($this->input->post('tId')) ||
				empty($this->input->post('refId'))
			){
			$message = notification("Invalid or Empty Input is detected.","error");
			$this->session->set_flashdata('message', $message);
			redirect('admin/payment_request');
		}
		
		if(!access_level_view('ADMIN_ACCESS')){
			$message = notification("You do not have permission to proceed in this transaction.","error");
			$this->session->set_flashdata('message', $message);
			redirect('admin/payment_request');
		}
		
		$response = $this->Admin_Model->approve_withdrawal();
		$this->session->set_flashdata('message', $response);
		redirect('admin/payment_request');
	}
}


