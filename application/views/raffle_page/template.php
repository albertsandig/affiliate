<?php 
	 $this->load->view($header);
	
	if(isset($sidebar)){
		 $this->load->view($sidebar);
	}
	
	 $this->load->view($body);
	
	 $this->load->view($footer);
?>