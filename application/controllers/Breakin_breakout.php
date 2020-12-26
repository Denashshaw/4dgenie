<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Breakin_breakout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");	
		$this->load->model("Break_inout_model");	
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		}
	}

	public function BreakIn(){
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
			'breakin_time'=> $time,
			'created_date'=> $time,
			'break_inout_flag'=>1
		);
    	
    	$result = $this->Break_inout_model->breakin_data($data);
	}

	public function BreakOut(){
		$userdata=$this->session->all_userdata();

		date_default_timezone_set('Asia/Kolkata');
		$time = date('Y-m-d H:i:s');

		$sql = $this->db->query("SELECT * from breakin_breakout WHERE user_id='".$userdata['user_id']."' ORDER BY id desc");
		$res = $sql->result();

		$to_time   = strtotime($res[0]->breakin_time);
		$from_time = strtotime($time);
		$tot_mins  = round(abs($to_time - $from_time) / 60,2). " minute";
		$final     = $tot_mins*60;
		$hours     = floor($final / 3600);
		$minutes   = floor(($final / 60) % 60);
		$seconds   = $final % 60;

		$check_inout_diff ="$minutes mins:$seconds secs";

		$this->db->query("UPDATE breakin_breakout SET breakout_time='".$time."',break_inout_diff='".$check_inout_diff."',break_inout_flag=0 WHERE user_id='".$userdata['user_id']."' and id='".$res[0]->id."' ");

		redirect('home/index');
	
	}

	public function BreakStatus(){
		$result = $this->Break_inout_model->BreakHrmStatus();
        echo json_encode($result);
	}
}

?>