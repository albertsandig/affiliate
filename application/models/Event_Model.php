<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_Model extends SUB_Model {
	function __construct(){
		parent::__construct();
	}
	
	function participate()	{	
		$query = $this->db->query("
			CALL procedure_participate_event(
				?,
				?,
				?
			);
		",array(
			$this->input->post('event_no'),
			$this->input->post('mobile_number'),
			$this->input->post('name')
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			return "<label style='color:#279619;font-weight:bold;'>You are successfully registered.";
		}
	}
	
	function participatants_number($event_no)	{	
		$query = $this->db->query("
			SELECT count(p_no) as participants
			FROM participated_event
			WHERE event_no = ?
		",array(
			$event_no
		));
		
		if(!$query){
			return notification($this->db->error()['message'],"error");
		} else {
			$row = $query->row();
			return $row->participants;
		}
	}
	
}
