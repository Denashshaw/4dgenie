<?php  
class Check_inout_model extends CI_Model  
{     
 	public function checkin_data($data)
	{	
		$this->db->insert('checkin_checkout',$data);
		redirect('home/index');
	}

	public function checkHrmStatus(){
			
		$query=$this->db->query("SELECT max(id) as id FROM checkin_checkout where user_id='".$this->input->post('id')."'");
		$res = $query->row();
		if($res->id!=''){
			$selectAll_query = $this->db->query("SELECT * FROM checkin_checkout where id='".$res->id."'");
			$selectAll_result = $selectAll_query->row();
			return $selectAll_result;
		}
		else{
			return FALSE;
		}
	}

	public function checkPermission(){
		$userdata=$this->session->all_userdata();
		$time = date('Y-m-d');
		$query = $this->db->query("SELECT permission_hours FROM emp_permission_details where emp_id='".$userdata['emp_id']."' AND permission_date >= '".$time."' ORDER BY id DESC LIMIT 1");
		$res = $query->row();

		if($res && $res->permission_hours){
			return $res->permission_hours;
		}else{
			return false;
		}
	}

	public function insertPermission($per_mins){
		$userdata=$this->session->all_userdata();
		$today = date('Y-m-d');
		$query=$this->db->query("UPDATE checkin_checkout SET permission='".$per_mins."' where emp_id='".$userdata['emp_id']."' AND created_date >= '".$today."' ");

		if($this->db->affected_rows() > 0){
	        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Permission Updated successfully!..');
	        redirect('home/agentlist');
	    }
	    else{
	        $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Permission not Updated!..');
	        redirect('home/agentlist');
	    }
	}

}  

 ?>