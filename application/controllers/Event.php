<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Event_Model'); 
		
		$this->data['header'] = 'event_page/header';
		$this->data['footer'] = 'event_page/footer';
	}

	public function index()
	{
		$this->add_css('components/assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->add_css('components/assets/plugins/font-awesome/css/font-awesome.css');
		$this->add_css('components/assets/css/styles.css');
		
		$this->add_javascript('components/assets/plugins/jquery-1.12.3.min.js');
		$this->add_javascript('components/assets/plugins/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js');
		$this->add_javascript('components/assets/js/main.js');
		$this->add_javascript('components/scripts/js/test.js');
		$this->add_javascript('components/scripts/js/mymoney.js');
		
		$this->data['event_no'] = '20171202';
		$this->data['no_of_participants'] = $this->Event_Model->participatants_number('20171202');
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/iCheck/icheck.min.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.js');
		
		$this->set_body('event_page/pages/index');
		$this->load->view('event_page/template',$this->data);
	}
	
	public function error(){
		
		$this->add_css('components/assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->add_css('components/assets/plugins/font-awesome/css/font-awesome.css');
		$this->add_css('components/assets/css/styles.css');
		
		$this->add_javascript('components/assets/plugins/jquery-1.12.3.min.js');
		$this->add_javascript('components/assets/plugins/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js');
		$this->add_javascript('components/assets/js/main.js');
		$this->add_javascript('components/scripts/js/test.js');
		$this->add_javascript('components/scripts/js/mymoney.js');
		
		$this->data['event_no'] = '20171202';
		$this->data['no_of_participants'] = $this->Event_Model->participatants_number('20171202');
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/iCheck/icheck.min.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.js');
		
		$this->set_body('event_page/pages/error');
		$this->load->view('event_page/template',$this->data);
	}
	
	public function participate(){
		if(empty($this->input->post('event_no')) ||
			empty($this->input->post('mobile_number')) ||
			empty($this->input->post('name')) 
			){
			$response = notification("Missing field. Please check input.","error");
			$this->session->set_flashdata('message', $response);
			redirect('event/index#win_load');
		} 
		
		if(strcmp($this->input->post('event_no'),'20171202') != 0){
			$response = notification("Event does not exist! Please don't alter the event code.","error");
			$this->session->set_flashdata('message', $response);
			redirect('event/index#win_load');
		}
		
		
		$response = $this->Event_Model->participate();
		$this->session->set_flashdata('message', $response);
		redirect('event/index#win_load');
	}
}
