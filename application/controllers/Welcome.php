<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends SUB_Controller {

	function __construct(){
		parent::__construct();
		
		$this->data['header'] = 'welcome_page/header';
		$this->data['footer'] = 'welcome_page/footer';
		//$this->load->library('cloudinarylib');
		$this->load->library('adblock');
		$this->data['advertisement'] = $this->adblock->get();
	}

	public function index()	{	
		
		$this->add_css('components/assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->add_css('components/assets/plugins/font-awesome/css/font-awesome.css');
		$this->add_css('components/assets/css/styles.css');
		
		$this->add_javascript('components/assets/plugins/jquery-1.12.3.min.js');
		$this->add_javascript('components/assets/plugins/bootstrap/js/bootstrap.min.js');
		$this->add_javascript('components/assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js');
		$this->add_javascript('components/assets/js/main.js');
		
		$this->set_body('welcome_page/pages/index');
		$this->load->view('welcome_page/template',$this->data);
		
		//echo cl_image_tag("sample.jpg", array( "alt" => "Sample Image" ));
		
		//$data['imageupload'] = \Cloudinary\Uploader::upload("C:/Users/admin/Desktop/invitation card/bfa9813e10500840bccbe292f69d5c29.jpg");
	}
}
