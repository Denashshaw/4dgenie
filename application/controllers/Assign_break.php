<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Assign_break extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		//$this->load->model("Break_model");
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		} 
	}
	
	public function assign(){
		if(isset($_POST['submit']))
		{
			$break_details=$this->input->post();
			$userdata = $this->session->all_userdata();
			$depart   = array();

			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			for($i=0;$i<count($break_details['user']);$i++)
			{
				$username=$this->db->query('SELECT * FROM users WHERE user_id="'.$break_details['user'][$i].'" ');
				$name=$username->result();

				$assign_break[] = array(
                	'user_id'   		=> $break_details['user'][$i],
                	'name'              => $name[0]->name,
                	'supervisor_name'	=> $break_details['department'],
                	'break_assigned_by' => $userdata['name'],
                	'break_start_time'  => $break_details['start_break'],
                	'break_end_time'    => $break_details['end_break'],
                	'break_request_flag'=> 1,
                	'created_date'      => $time
            	);

            	$enter_break[] = array(
					'user_id'     => $break_details['user'][$i],
        			'emp_id'      => $name[0]->emp_id,
					'department'  => $name[0]->department,
					'username'	  => $name[0]->username,
					'name'  	  => $name[0]->name,
					'role'        => $name[0]->role,
					'breakin_time'=> $break_details['start_break'],
					'created_date'=> $time,
					'break_inout_flag'=>1
				);
			}
			$this->db->insert_batch('break_request',$assign_break); 
		
			$this->db->insert_batch('breakin_breakout',$enter_break);
		
			$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Break Assigned Successfully..!</p>');
			redirect('home/assign_break');
		}
		//$this->load->view('assign_break');
	}

}

?>