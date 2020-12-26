<?php  
 class Department_model extends CI_Model  
 {  

	public function add_department_data($depart){
		$this->db->insert_batch('department',$depart);  
        $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Department Added Successfully!');
        redirect('department/add_department');
	}

	public function department_data(){
		$dep = $this->db->query("SELECT * FROM department");
		return $dep->result();
	}

 }  

 ?>