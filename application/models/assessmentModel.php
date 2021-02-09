<?php
class assessmentModel extends CI_Model
{
  public function getagentname(){
  	$data = $this->db->query("SELECT CONCAT(emp_id,'/',name) as name ,emp_id  FROM users WHERE role!='admin'");
  	return $data->result();
  }
}