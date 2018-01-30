<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends SUB_Controller {

	function __construct(){
		parent::__construct();
		$this->data['header'] = 'user_pages/admin/header';
		$this->data['sidebar'] = 'user_pages/admin/sidebar';
		$this->data['footer'] = 'user_pages/admin/footer';
		
		$this->site_user_login();
	}

	public function index()	{	
		$this->data['menu_quiz'] = 'active';
		
		//LOAD CSS
		$this->add_css('components/bootstrap/css/bootstrap.css');
		$this->add_css('components/dist/css/skins/skin-blue.css');
		$this->add_css('components/dist/css/AdminLTE.css');
		
		//LOAD JAVASCRIPT
		$this->add_javascript('components/plugins/jQuery/jQuery-2.1.4.min.js');
		$this->add_javascript('components/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/dist/js/app.min.js');
		
		//LOAD TEMPLATE
		$this->set_body('user_pages/admin/pages/modules/quiz/index');
		
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function create()	{	
		$this->data['menu_quiz_create'] = 'active';
		
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
		$this->set_body('user_pages/admin/pages/modules/quiz/create');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function participate()	{	
		$this->data['menu_participate'] = 'active';
		
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
		$this->set_body('user_pages/admin/pages/modules/quiz/participate');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
	
	public function question($id)	{	
		$this->data['menu_participate'] = 'active';
		$this->data['id'] = $id;
		
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
		$this->set_body('user_pages/admin/pages/modules/quiz/question');
		
		$this->load->view('user_pages/admin/template',$this->data);
	}
}
