<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Checkin_checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");	
		$this->load->model("Check_inout_model");	
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		}
	}


	public function CheckIn(){
		$userdata=$this->session->all_userdata();

		date_default_timezone_set('Asia/Kolkata');
		$time = date('Y-m-d H:i:s');
				
		$data = array(
			'user_id'     => $userdata['user_id'],
        	'emp_id'      => $userdata['emp_id'],
			'department'  => $userdata['department'],
			'username'	  => $userdata['username'],
			'name'  	  => $userdata['name'],
			'role'        => $userdata['role'],
			'checkin_time'=> $time,
			'created_date'=> $time,
			'check_inout_flag'=>1
		);
    	
    	$result = $this->Check_inout_model->checkin_data($data);
	}

	public function CheckOut(){
		$userdata=$this->session->all_userdata();

		date_default_timezone_set('Asia/Kolkata');
		$time_one = date('Y-m-d');

		$sql=$this->db->query("SELECT * from checkin_checkout WHERE user_id='".$userdata['user_id']."' AND created_date >= '".$time_one."' ORDER BY id desc");
		$rec_count = $sql->num_rows();

		if($rec_count >= 2){
			$per_mins = 0;
		}else{
			$per_time = $this->uri->segment('3');
			$per_mins = $per_time;
		}

		$time = date('Y-m-d H:i:s');
		$sql = $this->db->query("SELECT * from checkin_checkout WHERE user_id='".$userdata['user_id']."' ORDER BY id desc");
		$res = $sql->result();


		$to_time   = strtotime($res[0]->checkin_time);
		$from_time = strtotime($time);
		$tot_mins  = round(abs($to_time - $from_time) / 60,2). " minute";
		$final     = ($tot_mins+$per_mins)*60;
		$hours     = floor($final / 3600);
		$minutes   = floor(($final / 60) % 60);
		$seconds   = $final % 60;

		$check_inout_diff ="$hours hours:$minutes mins:$seconds secs";

		$this->db->query("UPDATE checkin_checkout SET checkout_time='".$time."',check_inout_diff='".$check_inout_diff."',check_inout_flag=0 WHERE user_id='".$userdata['user_id']."' and id='".$res[0]->id."' ");

		redirect('home/index');
	
	}

	public function checkStatus()
    {
        $result = $this->Check_inout_model->checkHrmStatus();
        echo json_encode($result);
    }

    public function checkPermission()
    {
        $result = $this->Check_inout_model->checkPermission();
        if($result){
        	echo json_encode($result);
        }else{
        	echo '';
        }
    }

    public function insertPermission()
    {
    	$per_time = $this->input->post('per_time');
        $update = $this->Check_inout_model->insertPermission($per_time);
        echo json_encode($update);
    }
	
}

?>