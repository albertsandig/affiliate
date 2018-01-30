<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	function claim_reward($code)	{	
		$query = $this->db->query("
			CALL procedure_deposit_ads(
				?,
				?
			);
		",array(
			$this->session->userdata('user_no'),
			$code
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>Congratulations you receive your reward.</label>";
		}
	}
}
