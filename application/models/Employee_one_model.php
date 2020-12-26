<?php 
	
	class Employee_one_model extends CI_Model
	{
		
		public function get_employee_one_details(){
			$userdata=$this->session->all_userdata();
			$query = $this->db->query("SELECT * FROM employee_meeting");
			return $query->result();
		}
	}
?>