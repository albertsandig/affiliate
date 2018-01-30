<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	/* Use in user */
	function get_click_ads()	{	
		$query = $this->db->query("
			SELECT 
			A.transaction_type_id,
			A.amount,
			A.code,
			A.url,
			A.content,
			CONCAT(A.duration,' ',A.duration_unit,'(s)') AS duration,
			B.name AS advertisement_name,
			C.name AS currency_name,
			C.icon
		FROM transaction_type AS A
		INNER JOIN ads_type AS B
			USING (ads_type_id)
		INNER JOIN currency_type AS C
			USING (currency_type_id)
		WHERE A.transaction_type_id NOT IN ( 
					SELECT 
						A.transaction_type_id
					FROM deposit_transactions AS A
					WHERE A.end_time >= CURRENT_TIMESTAMP AND
							A.user_no = ?
				)
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	
	/* Use in admin */
	function advertisements()	{	
		$query = $this->db->query("
			SELECT 
				A.transaction_type_id,
				A.code,
				A.amount,
				A.duration,
				B.name AS advertisement_name,
				C.name AS currency_name,
				C.icon
			FROM transaction_type AS A
			INNER JOIN ads_type AS B
				USING (ads_type_id)
			INNER JOIN currency_type AS C
				USING (currency_type_id)
			LIMIT 100;
		");
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	function claim_ads_points($code)	{	
	
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
			return $query->row();
		}
	}
	
	function credit_mined_ands($currency_id,$amount)	{	
		
		$query = $this->db->query("
			CALL procedure_miner_deposit(
				?,
				?,
				?
			);
		",array(
			$this->session->userdata('user_no'),
			$amount,
			$currency_id
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return true;
		}
	}
	
	
	function get_advertisement($id)	{	
		$query = $this->db->query("
			SELECT 
				A.code,
				A.ads_type_id,
				A.currency_type_id,
				A.duration,
				A.duration_unit,
				A.amount,
				A.content AS url
			FROM transaction_type AS A
			WHERE A.transaction_type_id = ? ;
		",array(
			$id
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->row();
		}
	}
	
	
	function create_advertisement()	{	
		$query = $this->db->query("
			CALL procedure_create_ads(
				?,
				?,
				?,
				?,	
				?,
				?,
				?,
				?,
				?
			)
		",array(
			$this->input->post('code'),
			$this->input->post('ad_type'),
			$this->input->post('currency_type'),
			$this->input->post('duration'),
			$this->input->post('duration_unit'),
			get_url_shorter(base_url()."admin/mod/ads/contribute/".$this->input->post('code')), //shortend
			$this->input->post('url'),							// whole url
		   $this->input->post('amount'),
		   $this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>Advertisement is successfully added.</label>";
		}
	}
	
	function update_advertisement($id)	{	
		$query = $this->db->query("
			CALL procedure_update_ads(
				?,
				?,
				?,
				?,
				?,
				?,	
				?,
				?,
				?,
				?
			)
		",array(
			$id,
			$this->input->post('code'),
			$this->input->post('ad_type'),
			$this->input->post('currency_type'),
			$this->input->post('duration'),
			$this->input->post('duration_unit'),
			get_url_shorter(base_url()."admin/mod/ads/contribute/".$this->input->post('code')), //shortend
			$this->input->post('url'),	
		   $this->input->post('amount'),
		   $this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>Advertisement is successfully updated.</label>";
		}
	}
	
}
