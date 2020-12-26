<?php  
class Check_Break_Report extends CI_Model{  

	public function ck_in_report($chkin_details){
		$from_date = $chkin_details['fromdate'];
		$to_date   = $chkin_details['todate'];
	 	$user_id   = $chkin_details['user_id'];
	 	$deprt   = $chkin_details['deprt'];

	 	if($user_id!='' && $deprt!=''){
			$report = $this->db->query('SELECT * FROM checkin_checkout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" and department="'.$deprt.'" ORDER BY id desc');
	 	} else if($user_id!=''){
	 		$report = $this->db->query('SELECT * FROM checkin_checkout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');
	 	} else if($deprt!=''){
	 		$report = $this->db->query('SELECT * FROM checkin_checkout WHERE department="'.$deprt.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');
	 	} else{
			$report = $this->db->query('SELECT * FROM checkin_checkout WHERE created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');	
	 	}
		return $report->result();
	}
       
	public function bk_in_report($brkin_details){
		$from_date = $brkin_details['fromdate'];
		$to_date   = $brkin_details['todate'];
	 	$user_id   = $brkin_details['user_id'];
	 	$deprt     = $brkin_details['deprt'];

		if($user_id!='' && $deprt!=''){
			$report = $this->db->query('SELECT * FROM breakin_breakout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" and department="'.$deprt.'" ORDER BY id desc');
	 	}elseif($user_id!=''){
	 		$report = $this->db->query('SELECT * FROM breakin_breakout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');
	 	}elseif($deprt!=''){
	 		$report = $this->db->query('SELECT * FROM breakin_breakout WHERE created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" and department="'.$deprt.'" ORDER BY id desc');
	 	}else{
			$report = $this->db->query('SELECT * FROM breakin_breakout WHERE created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');
		}	

		return $report->result();
	}

}

?>