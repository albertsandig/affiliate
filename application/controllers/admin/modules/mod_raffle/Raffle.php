<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->load->model('modules/Raffle_Model');
		
		$this->site_user_login();
	}
	
	public function index(){
		access_level('ADMIN_ACCESS');
		$this->data['menu_raffle'] = 'active';
		
		$search = '';
		
		if(!empty($this->input->post('search')))
			$search = $this->input->post('search');
			
		//LOAD DATA
		$this->data['raffles'] = $this->Raffle_Model->get_all_raffles($search);
		$this->data['search'] = $search;
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/raffle/index');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	
	public function create(){
		access_level('ADMIN_ACCESS');
		
		$this->data['menu_raffle_create'] = 'active';
		$this->data['title'] = 'Create';
		
		//LOAD MODEL
		$this->data['raffle'] = '';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		$this->add_javascript('components/plugins/ckeditor/ckeditor.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/raffle/edit');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function update($id){
		access_level('ADMIN_ACCESS');
		
		$this->data['menu_raffle_create'] = 'active';
		$this->data['title'] = 'Update';
		$this->data['id'] = $id;
		
		//LOAD MODEL
		$this->data['raffle'] = $this->Raffle_Model->get_raffle($id);
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		$this->add_javascript('components/plugins/ckeditor/ckeditor.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/raffle/edit');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function save(){
		access_level('ADMIN_ACCESS');
		
		
		
		$inputs = array(
				'title'  => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'code' => $this->input->post('code'),
				'raffle_draw' => $this->input->post('raffle_draw'),
				'thumbnail'  => $this->input->post('thumbnail'),
				'max_winner'   => $this->input->post('max_winner')
		);
		
		foreach ($inputs AS $key => $value){
			if(strcmp($value,'') == 0){
				$response['message'] = notification("Missing input. Please fillup everything","error");
				$this->session->set_flashdata('message',$response);
				redirect('admin/mod/raffle/create');
			}
		}
		
		if(empty($this->input->post('_id'))){ 
			$response['message'] = $this->Raffle_Model->create_raffle($inputs);
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/raffle/list');
		} else {
			$id = $this->input->post('_id');
			$response['message'] = $this->Raffle_Model->update_raffle($inputs,$id);
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/raffle/update/'.$id);
		}
		
		
		
		
	}
}
