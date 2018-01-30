<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Click_ads_admin extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->site_user_login();
	}

	public function index()	{	
		access_level('ADMIN_ACCESS');
		$this->load->model('Ads_Model');
		
		$this->data['menu_transaction_type'] = 'active';
		$this->data['list_advertisement'] = $this->Ads_Model->advertisements();
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		$this->add_javascript('components/scripts/js/timer.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/click_ads/admin_ads_list');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function create()	{	
		access_level('ADMIN_ACCESS');
		
		$this->data['menu_c_transaction_type'] = 'active';
		$this->data['advertisement'] = new StdClass;
		$this->data['title'] = 'Create';
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		$this->add_javascript('components/plugins/ckeditor/ckeditor.js');
		
		$this->add_javascript('components/scripts/js/timer.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/click_ads/admin_edit');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function update($id)	{	
		access_level('ADMIN_ACCESS');
		$this->load->model('Ads_Model');
		
		$this->data['advertisement'] = $this->Ads_Model->get_advertisement($id);
		$this->data['id'] = $id;
		$this->data['title'] = 'Update';
		$this->data['menu_transaction_type'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		$this->add_javascript('components/plugins/ckeditor/ckeditor.js');
		
		$this->add_javascript('components/scripts/js/timer.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/click_ads/admin_edit');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	
	/* PROCESS */
	public function process()	{	
		access_level('ADMIN_ACCESS');
		
		$inputs = array(
				//'_id',
				'url',
				'amount',
				'code',
				'duration',
				'ad_type',
				'currency_type',
				'duration_unit'
		);
		
		foreach ($inputs AS &$input){
			if(empty($this->input->post($input))){
				$response = notification("Missing Input. Please fill up everything.","error");
				$this->session->set_flashdata('message', $response);
				redirect('admin/mod/ads/create');
			}
		}
		
		if(!get_duration_unit($this->input->post('duration_unit'),false)){
			$response = notification("Error input in duration unit","error");
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/ads/create');		
		}
		
		if(!get_currency($this->input->post('currency_type'),false)){
			$response = notification("Error input in currency unit","error");
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/ads/create');		
		}
		
		if(!get_ads_type($this->input->post('ad_type'),false)){
			$response = notification("Error input in ads type","error");
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/ads/create');		
		}
	
		
		$this->load->model('Ads_Model');
		
		if(empty($this->input->post('_id'))){
			$response = $this->Ads_Model->create_advertisement();
		}	else {
			$response = $this->Ads_Model->update_advertisement($this->input->post('_id'));
			$this->session->set_flashdata('message', $response);
			redirect('admin/mod/ads/update/'.$this->input->post('_id'));
		}
		
		$this->session->set_flashdata('message', $response);
		redirect('admin/mod/ads/list');
	}
	
	
}
