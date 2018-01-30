<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->site_user_login();
	}

	public function index()	{	
		$this->load->model('Admin_Model');
		
		$this->data['menu_reward'] = 'active';
		$this->data['rtm'] = $this->Admin_Model->get_deposit_transaction_time('REWARD-M');
		$this->data['rtp'] = $this->Admin_Model->get_deposit_transaction_time('REWARD-P');
		
		
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
		$this->set_body('user_pages/admin/pages/modules/reward/index');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function points()	{	
		$this->load->model('Reward_Model');
		
		$response = $this->Reward_Model->claim_reward('REWARD-P');
		$this->session->set_flashdata('messageRewardPoints', $response);
		redirect('admin/mod/reward/');
	}
	
	public function money()	{	
		$this->load->model('Reward_Model');
		
		$response = $this->Reward_Model->claim_reward('REWARD-M');
		$this->session->set_flashdata('messageRewardMoney', $response);
		redirect('admin/mod/reward/');
	}
}
