<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle extends SUB_Controller {

	function __construct(){
		parent::__construct();
		
		$this->data['header'] = 'raffle_page/header';
		$this->data['footer'] = 'raffle_page/footer';
		$this->add_javascript('components/scripts/js/ads.js');
		
		$this->load->library('adblock');
		$this->data['advertisement'] = $this->adblock->get();
	}

	public function index()	{	
		$this->data['menu_raffle'] = 'active';
		$this->data['sidebar'] = 'raffle_page/sidebar';
		
		//LOAD MODEL
		$this->load->model('modules/Raffle_Model');
		$this->data['raffles'] = $this->Raffle_Model->get_raffles();
		$this->data['ended_raffles'] = $this->Raffle_Model->get_ended_raffles();
		
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/plugins/slimScroll/jquery.slimscroll.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('raffle_page/pages/index');
		
		$this->load->view('raffle_page/template',$this->data);
	}
	
	public function raffle($id)	{	
		$this->data['menu_raffle'] = 'active';
		
		$search = '';
		
		if(!empty($this->input->post('search')))
			$search = $this->input->post('search');
		
		//LOAD DATA
		$this->load->model('modules/Raffle_Model');
		$this->data['raffle'] = $this->Raffle_Model->get_raffle($id);
		$this->data['participants'] = $this->Raffle_Model->get_participants($id,$search);
		$this->data['winners'] = $this->Raffle_Model->get_winner($id);
		$this->data['search'] = $search;
		$this->data['id'] = $id;
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/plugins/slimScroll/jquery.slimscroll.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('raffle_page/pages/raffle');
		
		$this->load->view('raffle_page/template',$this->data);
	}
	
	public function participate(){
		$this->load->model('modules/Raffle_Model');
		$response['input'] = array();
		
		$inputs = array(
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'fprofile' => $this->input->post('fprofile'),
				'code' => $this->input->post('code'),
				'email'  => $this->input->post('email')
		);
		$response['input'] = $inputs ;
		
		foreach ($inputs AS $key => $value){
			if(strcmp($value,'') == 0){
				$response['message'] = notification("Missing input. Please fillup everything","error");
				$this->session->set_flashdata('message',$response);
				redirect('raffle');
			}
		}
		
		$response['message'] = $this->Raffle_Model->participate($inputs);
		
		$inputs['code'] = "";
		$inputs['fname'] = "";
		$inputs['lname'] = "";
		$inputs['fprofile'] = "";
		$inputs['email'] = "";
		$response['input'] = $inputs ;
		
		$this->session->set_flashdata('message', $response);
		redirect('raffle');
		
	}
	
	
	/* AD BLOCK */
	public function adblock()	{	
		$this->data['menu_adBlock'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/plugins/slimScroll/jquery.slimscroll.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('raffle_page/pages/error_disable_Adblock');
		
		$this->load->view('raffle_page/template',$this->data);
	}
}


