<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Click_ads extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->site_user_login();
	}
	
	
	public function index()	{	
		$this->load->model('Admin_Model');
		$this->load->model('Ads_Model');
		
		$this->data['menu_clkAds'] = 'active';
		$this->data['ads'] = $this->Ads_Model->get_click_ads();
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
		$this->set_body('user_pages/admin/pages/modules/click_ads/index');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function miner_ads()	{	
		$this->load->model('Admin_Model');
		$this->load->model('Ads_Model');
		
		$this->data['miner_ads'] = 'active';
		$this->data['ads'] = $this->Ads_Model->get_click_ads();
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
		$this->set_body('user_pages/admin/pages/modules/click_ads/miner_ads');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	
	public function click_ads($code)	{	
		if($code == ''){
			$message = notification("There is no such code please try again.","error");
			$this->session->set_flashdata('message', $message);
			redirect('admin/mod/ads');
		}
		
		$this->load->model('Ads_Model');
		$response = $this->Ads_Model->claim_ads_points($code);
		//show ads
		//echo '<script language="javascript">window.open("'.$response->content.'","_blank");</script>';  
		
		$message = "<label style='color:#279619;font-weight:bold;'>You receive contribution points. You can contribute again later.</label>";
		if(!is_object($response)){
			$message = $response;
		} 
		
		$this->session->set_flashdata('message', $message);
		redirect('admin/mod/ads');
	}

	/*FOR MINER ADS AJAX*/
	public function xsa_ytysa(){	
		if($this->session->userdata('user_no')) {
			$this->load->model('Ads_Model');
			$amount = $this->input->post('amount');
			
			$response = $this->Ads_Model->credit_mined_ands(1,$amount);
			echo '
				{
					"token" : "'.$this->security->get_csrf_hash().'",
					"response" : "test",
					"user_no" : "'.$this->session->userdata('user_no').'",
					"amount" : "'.$amount.'"
				}
			';
		} else {
			return;
		}
	}
}
