<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Candidate_interview extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("Client_model");
		$this->load->model("Check_Break_Report");
		$userdata=$this->session->all_userdata();
		
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		}
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('candidate_prescreening');
	}

	public function initial_add()
	{
		//Refer to client model
		$result = $this->Client_model->initial_add();
		if($result){
			$this->session->set_flashdata('msg','<p style="color:green;margin-left:3%;margin-top:3%;">Data Inserted Successfully!');
			redirect('Candidate_interview/index');
		}else{
			$this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Inserted! Please try again later!');
			redirect('Candidate_interview/index');
		}
	}

	public function get_interview_list()
	{
		$interview_list = $this->Client_model->get_interview_list();
		echo json_encode($interview_list);
	}

	public function Onboarding_emp_view()
	{
		$this->load->view('header');
		$this->load->view('onboarding_emp_view');
	}

	public function add_onboard_data()
	{
		$update_res = $this->Client_model->add_onboard_data();
		print_r($update_res);
	}

	public function get_onboard_data()
	{
		$get_onboard_data = $this->Client_model->get_onboard_data();
		echo json_encode($get_onboard_data);
	}

}