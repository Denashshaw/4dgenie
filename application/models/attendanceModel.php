<?php
class attendanceModel extends CI_Model
{
    public function getattendanceview($data){
        $id = $data['userid'];
        $monthyear = $data['monthyear'];
       	$montexp = explode("-",$monthyear);
       	$month =$montexp[0];
       	$year = $montexp[1];

		 $days = cal_days_in_month(CAL_GREGORIAN,$month,$year); // Days in current month
		//echo $days;\
		 $attendancearray = array();
		 $index=0;

     //shift getTime
     $selectuser = $this->db->query("SELECT department,checkin,checkout FROM users WHERE emp_id='".$id."'");
 		$userdet = $selectuser->result();

    $shift_intime=$userdet[0]->checkin;
    $shift_outtime=$userdet[0]->checkout;

		for($i=1;$i<= $days; $i++){
			$date = date(sprintf("%02d",$i)."-".$month."-".$year);
      if($date == date('d-m-Y', time() + 86400)){
        break;
      }
			$attendancearray[$index]["Date"] = $date;
			$attendancearray[$index]["Day"] = date_format(date_create($year."-".$month."-".sprintf("%02d",$i)),"l");
			$ckdate = date($year."-".$month."-".sprintf("%02d",$i));

			//Checkinoput
			$query = "SELECT * FROM checkin_checkout WHERE emp_id='".$id."'		 and  date(created_date)='".$ckdate."'";
			$quRes = $this->db->query($query);

			if($quRes->row() > 0){
				$queryres = $quRes->result();
				$attendancearray[$index]['checkin']= date_format(date_create($queryres[0]->checkin_time),"d-m-Y H:i:s");
				$attendancearray[$index]['checkout']= date_format(date_create($queryres[0]->checkout_time),"d-m-Y H:i:s");
				$attendancearray[$index]['worktimingg']=$queryres[0]->check_inout_diff;
				$attendancearray[$index]['permission']=$queryres[0]->permission;
			}else{
				$attendancearray[$index]['checkin']= '';
				$attendancearray[$index]['checkout']= '';
				$attendancearray[$index]['worktimingg']='';
				$attendancearray[$index]['permission']='';
			}

			//Breakdetails
			$querybreak = "SELECT * FROM breakin_breakout WHERE emp_id='".$id."'		 and  date(created_date)='".$ckdate."'";
			$quResbreak = $this->db->query($querybreak);
			if($quResbreak->row() > 0){
				$queryresbreak = $quResbreak->result();
				$attendancearray[$index]['braktime']=$queryresbreak[0]->break_inout_diff;
			}else{
				$attendancearray[$index]['braktime']='';
			}

			if($attendancearray[$index]["Day"] == 'Sunday'){
				$attendancearray[$index]['Status'] = 'Holiday';
			}else if($attendancearray[$index]["Day"] == 'Saturday' && ($shift_intime[0] == 1 && $shift_intime[1] > 7)){
        $attendancearray[$index]['Status'] = 'Holiday';
      }
			else if($attendancearray[$index]['checkin']!=''){
		        $attendancearray[$index]['Status'] = '<p id="presentid">Present</p>';
		    }
		    else{
		    	$queryleave = "SELECT * FROM emp_leave_details WHERE emp_id='".$id."'	and  ('".$ckdate."' between leave_start_date and leave_end_date)";
		    	//echo $queryleave;
				$quResleave = $this->db->query($queryleave);
				if($quResleave->row() > 0){
					$attendancearray[$index]['Status'] = '<p id="leaveid">Leave</p>';
				}else{
		        	$attendancearray[$index]['Status'] = '<p id="absentid">Absent</p>';
				}
		    }

			$index++;
		}


		echo json_encode(array("attendancedata"=>$attendancearray,"shiftdetails"=>$userdet));
    }
}
?>
