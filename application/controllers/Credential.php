<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credential extends SUB_Controller {
	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/credential/header';
		$this->data['footer'] = 'user_pages/credential/footer';
		
		$this->load->model('Credential_Model'); 
	}
	
	function login(){
		$this->is_user_already_login();
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		$this->add_css('components/plugins/iCheck/square/blue.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/plugins/iCheck/icheck.min.js');
	
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.js');
		//LOAD TEMPLATE
		$this->set_body('user_pages/credential/pages/login');
		
		$this->load->view('user_pages/credential/template',$this->data);
	}
	
	function register($id = 0)
	{	
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		$this->add_css('components/plugins/iCheck/square/blue.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/plugins/iCheck/icheck.min.js');
		
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.date.extensions.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.extensions.js');
		
		$this->add_javascript('components/scripts/js/password_handler.js');
		
		//LOAD DATA
		$this->data['id'] = $id;
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/credential/pages/register');
		
		$this->load->view('user_pages/credential/template',$this->data);
	}
	
	function terms()	{	
		echo 'This page is not done, <a href="'.base_url('credential/register').'">go back to registration</a>.';
	}
	
	function insert(){
		$referral_no = $this->input->post('referral');
		
		if(!is_numeric($referral_no)){
			$response = notification("Referral must be numeric","error");
			$this->session->set_flashdata('message', $response);
			redirect('register');
		}
		
		if(empty($this->input->post('email')) ||
			empty($this->input->post('password')) ||
			empty($this->input->post('firstname')) || 
			empty($this->input->post('lastname')) ||
			empty($this->input->post('mobile_number')) 
			){
			$response = notification("Missing field. Please check input.","error");
			$this->session->set_flashdata('message', $response);
			redirect('register/'.$referral_no);
		} 
		
		if(strcmp($this->input->post('password'),$this->input->post('password')) !== 0) { 
			$response = notification("Password is not equal to Confirm password.","error");
			$this->session->set_flashdata('message', $response);
			redirect('register/'.$referral_no);
		}
		
		if (strlen($this->input->post('password')) < 9) {
			$response = notification("Password must be atleast 8 characters","error");
			$this->session->set_flashdata('message', $response);
			redirect('register/'.$referral_no);
		}
		
		$response = $this->Credential_Model->register($referral_no);
		$this->session->set_flashdata('message', $response);
		redirect('register/'.$this->input->post('referral'));
	}
	
	function verify_user($userId,$verified){
		if($this->Credential_Model->is_alredy_verified($userId)){
			$response = "<label style='color:#279619;font-weight:bold;'>You account was already verified.</label>";
			$this->session->set_flashdata('message', $response);
			redirect('admin/account');
		}
		
		if(md5($userId) == $verified){
			$response = $this->Credential_Model->verify_user($userId);
			$this->session->set_flashdata('message', $response);
			redirect('admin/account');
		}
	}

	function send_verification(){
		$id = $this->session->userdata('user_no');
		$email = $this->session->userdata('email');
		$name = $this->session->userdata('name');
		
		if($this->Credential_Model->is_alredy_verified($id)){
			$response = "<label style='color:#279619;font-weight:bold;'>You account was already verified.</label>";
		} else {
		
			$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',
				  'smtp_port' => 465,
				  'smtp_user' => 'als.solution.2017@gmail.com', // change it to yours
				  'smtp_pass' => 'Machinedoll2012', // change it to yours
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap' => TRUE
			);
			
			$message = "
				Dear User: ".$name.", </br></br>
				
				Verify your account by clicking this link.</br></br>
				https://alsolution.000webhostapp.com/verify/".$id ."/".md5($id)."
				</br>
				</br>
				Thank you
			";
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('Als Solution'); 	// change it to yours
			$this->email->to($email);					// change it to yours
			$this->email->subject('Verification From Al\'s Solution');
			$this->email->message($message);
			
			if($this->email->send())	{
				$response = "<label style='color:#279619;font-weight:bold;'>Verification was successfully sent.</label>";
			}	else	{
				$response =  show_error($this->email->print_debugger());
			}
		}
		$this->session->set_flashdata('message', $response);
		redirect('admin/account');
	}
	
	function login_user(){
		$message = "";
		if(empty($this->input->post('email')) ||
			empty($this->input->post('password'))
			){
			$message = notification("Invalid username or password.","error");
			$this->session->set_flashdata('message', $message);
			redirect('login');
		} 
		
		$response = $this->Credential_Model->login();
		
		if(is_object($response)){
			$message = notification("Successfully Login");
			$this->session->set_flashdata('message', $message);
			
			$data = array(
					  'email'     		=> $response->email,
					  'user_no'    	=> $response->user_no,
					  'type_no'     	=> $response->type_no,
					  'name'     		=> $response->name,
					  'user_type'     => $response->user_type,
					  'profile_pic'   => $response->profile_pic,
					  'logged_in' 		=> TRUE
			);

			$this->session->set_userdata($data);
			redirect('admin/user');
		} else {
			$message = notification("Invalid username or password.","error");
			$this->session->set_flashdata('message', $message);
			redirect('login');
		}
	}
}
