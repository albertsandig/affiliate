<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends SUB_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('Admin_Model');
		
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->site_user_login();
	}

	public function index()	{	
		$this->data['dashboard'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		$this->add_javascript('components/plugins/chartjs/Chart.js');
		
		$this->add_javascript('components/scripts/data_handler/overall_contribution.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/dashboard');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function guide()	{	
		$this->data['guide'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/guide');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function account()	{
	
		$this->data['menu_account'] = 'active';
		
		$this->data['account_info'] = $this->Admin_Model->get_profile();
		$this->data['deposits'] = $this->Admin_Model->get_deposit();
		$this->data['withdrawals'] = $this->Admin_Model->get_withdrawal_transaction();
		$this->data['wallet'] = $this->Admin_Model->get_wallet();
		$this->data['team'] = $this->Admin_Model->get_team();
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/account');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function update_account(){
		//ACIVE MENU
		$this->data['menu_update_account'] = 'active';
		
		//LOAD DATA
		$this->data['account_info'] = $this->Admin_Model->get_profile();
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.date.extensions.js');
		$this->add_javascript('components/plugins/input-mask/jquery.inputmask.extensions.js');
		
		
		$this->add_javascript('components/scripts/js/password_handler.js');
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/update_account');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function withdraw(){
		access_level('USER_ACCESS');
		
		$this->data['menu_withdraw'] = 'active';
		
		//LOAD DATA
		$this->data['account_info'] = $this->Admin_Model->get_profile();
		$this->data['wallet_php'] = $this->Admin_Model->get_wallet(1); // php
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/withdraw');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function converter(){
		access_level('USER_ACCESS');
	
		$this->data['menu_converter'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/converter');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function user_payment_request(){
		access_level('ADMIN_ACCESS');
		$search = '';
		
		if(!empty($this->input->post('search')))
			$search = $this->input->post('search');
			
		$this->data['user_payment_request'] = 'active';
		$this->data['search'] = $search;
		$this->data['payments'] = $this->Admin_Model->get_all_withdrawals($search);
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/request_payment');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	/* 
		Full name: overall contribution data 
	*/
	public function data_occ(){
		echo json_encode($this->Admin_Model->get_report());
	}
	/* 
		Full name: daily contribution data 
	*/
	public function data_dcc(){
		echo json_encode($this->Admin_Model->get_report(true));
	}
	
	
	/* SECURITY AND ADBLOCK*/
	
	public function adBlock_error(){
		$this->data['menu_adBlock'] = 'active';
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/disableAdblock');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function access_error(){
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/access_level');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
}


