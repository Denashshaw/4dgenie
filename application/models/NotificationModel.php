<?php
class NotificationModel extends CI_Model
{
    public function getnotification($data){
        $getnotification = $this->db->query("SELECT * FROM notification where emp_id='$data' Order by id DESC");
        return $getnotification->result();

    }
    public function updatenotification($data){
        $upnotification = $this->db->query("update notification set status=1 where id='$data'");
        return $upnotification->result();

    }

    public function agentdata($data){
        $userdata=$this->session->all_userdata();
        if($userdata['role'] == 'supervisor'){
            $qu = $this->db->query("SELECT CONCAT(emp_id,'/',agent_name) as id,CONCAT(emp_id,'/',agent_name) as text FROM emp_separation_managers where manager_id='$data'");
        }
        if($userdata['role'] == 'admin'){
            $qu = $this->db->query("SELECT CONCAT(emp_id,'/',name) as id,CONCAT(emp_id,'/',name) as text from users");
        }
        return $qu->result();
    }

    public function insertdataset($table,$data){
        $announcementdata=$this->db->insert_batch($table,$data);
        return 0;
    }

    public function getannouncement($empid){
        $getannouncement = $this->db->query("SELECT * FROM announcement where creater_id='$empid'");
        return $getannouncement->result();
    }

    public function fetchandinsert($table){
      $empid=$_SESSION['emp_id'];
      $resage = $this->db->query("SELECT TIMEDIFF(now(),`checkin_time`) as timedifferent FROM $table where emp_id='$empid' and  check_inout_flag=1");
      return $resage->result();
    }
}
?>
