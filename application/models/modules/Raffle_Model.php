<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	function	get_all_raffles($search = ''){
		if($search == ''){
			$query = $this->db->query("
				SELECT 		
					A.raffle_id	,	
					A.code			,	 
					A.image			,	 
					A.prize	AS title,	 
					A.description	,	  
					A.max_winner	,	  
					A.raffle_draw,
					(A.raffle_draw < CURRENT_TIMESTAMP) AS status
				FROM raffle AS A
				ORDER BY A.raffle_draw
				LIMIT 15;
			");
		} else {
			$query = $this->db->query("
				SELECT 		
					A.raffle_id	,	
					A.code			,	 
					A.image			,	 
					A.prize	AS title,	 
					A.description	,	  
					A.max_winner	,	  
					A.raffle_draw,
					(A.raffle_draw < CURRENT_TIMESTAMP) AS status
				FROM raffle AS A
				WHERE MATCH  (A.prize,A.code, A.description)
				AGAINST ( ? IN NATURAL LANGUAGE MODE)
				ORDER BY A.raffle_draw
				LIMIT 15;
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
	
	function	get_raffles(){
		
		$query = $this->db->query("
			SELECT 		
				A.raffle_id	,	
				A.code			,	 
				A.image			,	 
				CONCAT(SUBSTRING(A.prize, 1, 20),' ...')	AS title,	 
				CONCAT(SUBSTRING(A.description, 1, 40),' ...')	AS description,	 
				A.max_winner	,	  
				A.raffle_draw
			FROM raffle AS A
			WHERE A.raffle_draw >= CURRENT_TIMESTAMP
			ORDER BY A.raffle_draw;
		");
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	function	get_ended_raffles(){
		$query = $this->db->query("
			SELECT 		
				A.raffle_id	,	
				A.code			,	 
				A.image			,	 
				CONCAT(SUBSTRING(A.prize, 1, 20),' ...')	AS title,	 
				CONCAT(SUBSTRING(A.description, 1, 40),' ...')	AS description,	 
				A.max_winner	,	  
				A.raffle_draw
			FROM raffle AS A
			WHERE A.raffle_draw < CURRENT_TIMESTAMP
			ORDER BY A.raffle_draw
			LIMIT 20;
		");
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	function	get_raffle($id){
		$query = $this->db->query("
			SELECT 		
				A.raffle_id	,	
				A.code			,	 
				A.image			,	 
				A.prize	AS title,	 
				A.description	,	  
				A.max_winner	,	  
				CAST(A.raffle_draw AS DATE) AS raffle_draw 
			FROM raffle AS A
			WHERE A.raffle_id = ?;
		",array(
			$id
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->row();
		}
	}
	
	function	get_participants($id,$search = ''){
		if($search == ''){
			$query = $this->db->query("
				SELECT 		
					CONCAT(A.fname,' ',A.lname) AS name,
					A.fb_profile		,
					A.email_address	,
					A.date_created AS date_participated	
				FROM raffle_participant AS A
				WHERE A.raffle_id = ?
				ORDER BY A.date_created DESC
				LIMIT 10;
			",array(
				$id
			));
		} else {
			$query = $this->db->query("
				SELECT 		
					CONCAT(A.fname,' ',A.lname) AS name,
					A.fb_profile		,
					A.email_address	,
					A.date_created AS date_participated	
				FROM raffle_participant AS A
				WHERE A.raffle_id = ? AND
				MATCH  (A.fname,A.lname, A.email_address)
				AGAINST ( ? IN NATURAL LANGUAGE MODE)
				ORDER BY A.date_created DESC
				LIMIT 10;
			",array(
				$id,
				$search
			));
		}
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	function	get_winner($id){
		$query = $this->db->query("
			SELECT 		
				CONCAT(A.fname,' ',A.lname) AS name,
			   A.fb_profile		,
				A.email_address	,
			   A.date_created AS date_participated	
			FROM raffle_participant AS A
			INNER JOIN raffle_winner AS B
				USING (p_no)
			WHERE A.raffle_id = ?;
		",array(
			$id
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  $query->result();
		}
	}
	
	
	function	participate($input){
		$query = $this->db->query("
			CALL procedure_participate_raffle(
				?,
				?,
				?,
				?,
				?
			);
		",array(
			$input['code'],
			$input['fname'],
			$input['lname'],
			$input['fprofile'],
			$input['email']
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  "<label style='color:#279619;font-weight:bold;'>You have successfully submitted your entry. Click the raffle prize to search your name.</label>";
		}
	}
	
	function	create_raffle($input){
	
		$query = $this->db->query("
			CALL procedure_raffle_insert(
				?,
				?,
				?,
				?,
				?,
				?,
				?
			);
		",array(
			$input['code'],
			$input['thumbnail'],
			$input['title'],
			$input['content'],
			$input['max_winner'],
			$input['raffle_draw'],
			$this->session->userdata('user_no')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  "<label style='color:#279619;font-weight:bold;'>You have successfully create a raffle.</label>";
		}
	}
	
	function	update_raffle($input,$id){
	
		$query = $this->db->query("
			CALL procedure_raffle_update(
				?,
				?,
				?,
				?,
				?,
				?,
				?
			);
		",array(
			$id,
			$input['code'],
			$input['thumbnail'],
			$input['title'],
			$input['content'],
			$input['max_winner'],
			$input['raffle_draw']
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return  "<label style='color:#279619;font-weight:bold;'>You have successfully updated the raffle.</label>";
		}
	}
}
