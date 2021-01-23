<?php
 class Mainmodel extends CI_Model
 {

	public function logincheck($details){
		$q = $this->db->select('username')->from('users')->where(array('username' => $details['username'],'password'=>md5($details['password'])))->get();
		if($q->num_rows() == 0){
			return false;
		}
		else
		{
			$this->db->where(array('username' => $details['username'],'password'=>md5($details['password'])));
			$query  =  $this->db->get('users');
			return $query->result();
		}

	}

	public function logindata(){
		$userdata=$this->session->all_userdata();
		$login =$this->db->query("SELECT * FROM users WHERE username='".$userdata['username']."' ");
		return $login->result();
	}

	public function agentdata(){
		$user =$this->db->query("SELECT * FROM users WHERE role!='admin' ");
		return $user->result();
	}

  public function change_password($details){

  		if($details['new_password']==$details['confirm_password'])
  		{
  			$this->db->query("UPDATE users SET password='".md5($details['confirm_password'])."' WHERE user_id='".$details['userid']."' ");
  		}
  		else{
  			$this->session->set_flashdata('msg','<p style="color:red">Confirm Password & New Password Does Not Match!..');
  	        redirect('home');
  	        return FALSE;
  		}

  		if($this->db->affected_rows() > 0){
  	        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Password Updated successfully!..');
  	        redirect('home');
  	        return TRUE;
  	    }
  	    else{
  	        $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Password not Updated!..');
  	        redirect('home');
  	        return FALSE;
  	    }
  	}


	public function ck_bk_assign_status(){
		$query=$this->db->query("SELECT max(id) as id FROM break_request where user_id='".$this->input->post('id')."'");
		$res = $query->row();
		if($res->id!=''){
			$selectAll_query = $this->db->query("SELECT * FROM break_request where id='".$res->id."'");
			$selectAll_result = $selectAll_query->row();
			return $selectAll_result;
		}
		else{
			return FALSE;
		}
	}


	public function bk_modify_status(){
		$query=$this->db->query("UPDATE break_request SET break_request_flag='0' where user_id='".$this->input->post('id')."'");
		//$query->result();
	}

  public function reset_password($details){

  if($details['reset_new_password']==$details['reset_confirm_password'])
  {
    $this->db->query("UPDATE users SET password='".md5($details['reset_confirm_password'])."' WHERE user_id='".$details['userid']."' ");
  }
  else{
    $this->session->set_flashdata('msg','<p style="color:red">Confirm Password & New Password Does Not Match!..');
        redirect('home');
        return FALSE;
  }

  if($this->db->affected_rows() > 0){
        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Password Updated successfully!..');
        redirect('home');
        return TRUE;
    }
    else{
        $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Password not Updated!..');
        redirect('home');
        return FALSE;
    }
}

//jagan 21-01-2021
public function getusermail($id){
    $usermail =$this->db->query("SELECT * FROM officemail WHERE emp_id='$id'");
    return $usermail->result();
  }
//jagan 21 end

 }

 ?>
