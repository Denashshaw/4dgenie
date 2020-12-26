<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ERROR);
class Emp_leave_permission extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("empdetailsModel");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}
	public function index() {
		$data['emp_data']  = $this->empdetailsModel->agentdata();
		$this->load->view('header');
		$this->load->view('emp_leave_permission', $data);
	}

	public function emp_leave_add()
	{
		$insert_status = $this->empdetailsModel->emp_leave_add();
		echo $insert_status;
	}

	public function permission_data_save()
	{		
		$insert_status = $this->empdetailsModel->permission_data_save();
		echo json_encode($insert_status);
	} 

	public function get_managers_list()
	{		
		$managers_list =  $this->empdetailsModel->get_managers_list();
		echo json_encode($managers_list);
	}

	public function emp_permission_list()
	{
		$permission_lists = $this->empdetailsModel->emp_permission_list();
		echo json_encode($permission_lists);
	}

	public function validate_approve_permission()
	{
		$vali_approv = $this->empdetailsModel->validate_approve_permission();		
		echo json_encode($vali_approv);
	}

	public function check_permission_exists()
	{
		$check_per = $this->empdetailsModel->check_permission_exists();				
		echo json_encode($check_per);
	}

	public function get_permission_count()
	{
		$permission_count = $this->empdetailsModel->get_permission_count();
		echo $permission_count;
	}

	public function emp_leave_list()
	{
		$get_leave_data = $this->empdetailsModel->get_emp_leave_list();
		echo json_encode($get_leave_data);
	}

	public function check_leave_emp()
	{
		$leave_type = $this->input->post('leave_type');
		$leave_result = $this->empdetailsModel->check_leave_emp();

		$response = array($leave_type => $leave_result);
		echo json_encode($response);
	}

	public function validate_approve_leave()
	{
		$leav_app_status = $this->empdetailsModel->validate_approve_leave();
		print_r($leav_app_status);
	}
}
?>