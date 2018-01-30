<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	function get_profile()	{	
		$query = $this->db->query("
			SELECT 		
				firstname,
				lastname,
				age,
				birthday,
				gender,
				address,
				mobile_number,
				verify,
				create_date,
				img_source,
				peso_address
			FROM user_info
			WHERE 
				user_no = ?
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->row();
		}
	}
	
	function get_wallet($id = 0)	{	
		if($id == 0) {
			$query = $this->db->query("
				SELECT 		
					B.icon,
					FORMAT(A.amount, 2) AS amount
				FROM user_wallet AS A
				INNER JOIN currency_type AS B
					USING (currency_type_id)
				WHERE 
					user_no = ?
				ORDER BY B.currency_type_id
			",array(
				$this->session->userdata('user_no')
			));
			
			if(!$query){
				return notification($this->db->error()['message'],"error");
			} else {
				return  $query->result();
			}
		} else {
						$query = $this->db->query("
				SELECT 		
					B.icon,
					FORMAT(A.amount, 2) AS amount
				FROM user_wallet AS A
				INNER JOIN currency_type AS B
					USING (currency_type_id)
				WHERE 
					user_no = ? AND
					currency_type_id = ?
				ORDER BY B.currency_type_id
			",array(
				$this->session->userdata('user_no'),
				$id
			));
			
			if(!$query){
				return notification($this->db->error()['message'],"error");
			} else {
				return  $query->row();
			}
		}
	}
	
	function get_team(){
		$query = $this->db->query("
			SELECT
				A.user_no,
				CAST(A.create_date AS DATE) AS create_date,
				CONCAT(A.firstname,' ',A.lastname) AS name
			FROM user_info AS A
			INNER JOIN refer AS B
				ON A.user_no = B.user_no
			WHERE B.referedBy = ?
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	/* DEPOSIT */
	function get_deposit()	{	
		$query = $this->db->query("
			SELECT 		
				CONCAT('TI-',A.transaction_id) AS transaction_id,
				A.deposit_date,
				B.amount,
				C.name AS currency_type
			FROM deposit_transactions AS A
			INNER JOIN transaction_type AS B
				USING (transaction_type_id)
			INNER JOIN currency_type AS C
				USING (currency_type_id)
			WHERE 
				user_no = ?
			ORDER BY A.deposit_date DESC
			LIMIT 20;
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	
	function get_deposit_transaction_time($code)	{	
		$query = $this->db->query("
			SELECT 		
				A.end_time
			FROM deposit_transactions AS A
			INNER JOIN transaction_type AS B
				USING (transaction_type_id)
			WHERE 
				user_no = ? AND
				end_time > CURRENT_TIMESTAMP AND 
				code = ?
			LIMIT 1;
		",array(
			$this->session->userdata('user_no'),
			$code
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			if(is_object($query->row()))
				return  $query->row()->end_time;
			else 
				return null;
		}
	}
	
	/* WITHDRAWAL */
	function get_withdrawal_transaction()	{	
		$query = $this->db->query("
			SELECT 		
				CONCAT('WT-',A.withdrawal_transaction_id) AS transaction_id,
				A.status								,
				A.reference_id						,
				A.peso_address						,
				A.amount								,
				A.request_date						,
				A.approve_date					
			FROM withdrawal_transaction AS A
			WHERE A.user_no = ?
			ORDER BY A.withdrawal_transaction_id DESC
			LIMIT 20
		",array(
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	function request_withdrawal()	{	
		$query = $this->db->query("
			CALL procedure_request_withdrawal(
				?,
				?
			);
		",array(
			$this->session->userdata('user_no'),
			$this->input->post('amount')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>The request is successful. Please wait at least 1 week for approval.</label>";
		}
	}
	
	function approve_withdrawal()	{	
		$query = $this->db->query("
			CALL procedure_approve_withdrawal(
				?,
				?
			);
		",array(
			$this->input->post('tId'),
			$this->input->post('refId')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>Successfully approve the payment request ID ".$this->input->post('tId').".</label>";
		}
	}
	
	function get_all_withdrawals($search = '')	{	
		if(strcmp($search,'') == 0){
			$query = $this->db->query("
				SELECT 		
					CONCAT(B.firstname, ' ',B.lastname) AS name,
					A.withdrawal_transaction_id,
					A.status								,
					A.reference_id						,
					A.peso_address						,
					A.amount								,
					A.request_date						,
					A.approve_date					
				FROM withdrawal_transaction AS A
				INNER JOIN user_info	AS B
					USING (user_no)
				ORDER BY A.status,A.withdrawal_transaction_id DESC
				LIMIT 20
			");
		} else {
			$query = $this->db->query("
				SELECT 		
					B.name,
					A.withdrawal_transaction_id,
					A.status								,
					A.reference_id						,
					A.peso_address						,
					A.amount								,
					A.request_date						,
					A.approve_date					
				FROM withdrawal_transaction AS A
				INNER JOIN (
					SELECT 
						A.user_no,
						CONCAT(A.firstname, ' ',A.lastname) AS name
					FROM user_info AS A
					WHERE MATCH (email,firstname, lastname,address,mobile_number) AGAINST (?)
				) AS B
					USING (user_no)
				ORDER BY B.name DESC
				LIMIT 20
			",array(
				$search
			));
		}
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	/*DASHBOARD*/
	
	function get_report($for_user = false)	{	
		if($for_user) {
			$query = $this->db->query("
				SELECT 
					(CURRENT_DATE - INTERVAL (A._day-1) DAY) AS deposit_date,
					COALESCE(COUNT(CASE WHEN B.ads_type_id = 1 then 1 END),0) AS LAZADA,
					COALESCE(COUNT(CASE WHEN B.ads_type_id = 2 then 1 END),0) AS PROPELLER
				FROM days AS A
				LEFT JOIN (
					SELECT 
						CURRENT_DATE - CAST(A.deposit_date AS DATE) + 1 AS num,
						B.ads_type_id
					FROM deposit_transactions AS A
					INNER JOIN transaction_type AS B
						USING (transaction_type_id)
					WHERE 
						A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY) AND
						A.user_no = ?
				) AS B ON A._day = B.num
				GROUP BY A._day
				ORDER BY A._day DESC;
			",array(
				$this->session->userdata('user_no')
			));
		} else {
			$query = $this->db->query("
				SELECT 
					(CURRENT_DATE - INTERVAL (A._day-1) DAY) AS deposit_date,
					COALESCE(COUNT(CASE WHEN B.ads_type_id = 1 then 1 END),0) AS LAZADA,
					COALESCE(COUNT(CASE WHEN B.ads_type_id = 2 then 1 END),0) AS PROPELLER
				FROM days AS A
				LEFT JOIN (
					SELECT 
						CURRENT_DATE - CAST(A.deposit_date AS DATE) + 1 AS num,
						B.ads_type_id
					FROM deposit_transactions AS A
					INNER JOIN transaction_type AS B
						USING (transaction_type_id)
					WHERE 
						A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
				) AS B ON A._day = B.num
				GROUP BY A._day
				ORDER BY A._day DESC;
			");
		}
		
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	/*
		REMARKS: This was used in input helper
	*/
	function get_currency(){
		$query = $this->db->query("
			SELECT 
				A.currency_type_id AS id,
				A.name
			FROM currency_type AS A
			ORDER BY A.currency_type_id DESC;
		");
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
		/*
		REMARKS: This was used in input helper
	*/
	
	function get_ads_type(){
		$query = $this->db->query("
			SELECT 
				A.ads_type_id AS id,
				A.name
			FROM ads_type AS A;
		");
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
}
