<?php  
class Break_inout_model extends CI_Model  
{     
 	public function breakin_data($data)
	{	
		$this->db->insert('breakin_breakout',$data);
		redirect('home/index');
	}

	public function BreakHrmStatus(){
		$query=$this->db->query("SELECT max(id) as id FROM breakin_breakout where user_id='".$this->input->post('id')."'");
		$res = $query->row();
		if($res->id!=''){
			$selectAll_query = $this->db->query("SELECT * FROM breakin_breakout where id='".$res->id."'");
			$selectAll_result = $selectAll_query->row();
			return $selectAll_result;
		}
		else{
			return FALSE;
		}
	}
}  

 ?>