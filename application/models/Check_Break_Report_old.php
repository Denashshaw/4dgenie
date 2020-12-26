<?php  
class Check_Break_Report extends CI_Model{  

	public function ck_in_report($chkin_details){
		$from_date = $chkin_details['fromdate'];
		$to_date   = $chkin_details['todate'];
	 	$user_id   = $chkin_details['user_id'];
	 	if($user_id!=''){
		$report = $this->db->query('SELECT * FROM checkin_checkout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');
	 	}
	 	else{
		$report = $this->db->query('SELECT * FROM checkin_checkout WHERE created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" and role!="admin" ORDER BY id desc');	
	 	}
		return $report->result();
	}
       
	public function bk_in_report($brkin_details){
		$from_date = $brkin_details['fromdate'];
		$to_date   = $brkin_details['todate'];
	 	$user_id   = $brkin_details['user_id'];
		if($user_id!=''){
		$report = $this->db->query('SELECT * FROM breakin_breakout WHERE user_id="'.$user_id.'" and  created_date BETWEEN "'.$from_date.'" and "'.$to_date.'" ORDER BY id desc');
	 	}
	 	else{
		$report = $this->db->query('SELECT * FROM breakin_breakout WHERE created_date BETWEEN "'.$from_date.'" and "'.$to_date.'"  ');
		}	

		return $report->result();
	}

}

?>