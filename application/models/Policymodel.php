<?php
 class Policymodel extends CI_Model
 {

	public function adddata($table,$dataset){
    $gettype=$dataset['type'];
    $checkconent = $this->db->query("select * from $table where type='$gettype'");
    if($checkconent->num_rows() > 0){
      $this->db->where('type',$gettype)->update($table,$dataset);
      $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Updated Successfully!');
    }else{
		    $this->db->insert($table,$dataset);
        $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Added Successfully!');
    }
    redirect('HrITpolicy');
  }

  public function getdata($table,$type){
    $r = $this->db->query("SELECT * FROM $table where type='$type'");
    return $r->result();
  }
}
