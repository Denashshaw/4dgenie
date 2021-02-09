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
		$data['candidate_interviewdata'] = $this->Client_model->getdata('candidate_interview','all');
		$this->load->view('candidate_prescreening',$data);
	}
	public function getcandidate(){
		$data = $this->Client_model->getdata('candidate_interview',$_GET['indexid']);
		echo json_encode($data);
	}

	public function initial_add()
	{
		//Refer to client model\
		$uqid= uniqid();
		$result = $this->Client_model->initial_add($uqid);

		$this->load->config('email_interview');
		$this->load->library('email');
		$from = $this->config->item('smtp_user');
		$to =$_POST['pre_email'];
//	$to = 'v.jaganathan93@gmail.com';
		$subject = '4D Global - Interview Form';
		$message = '<p>Hi '.ucfirst($_POST['pre_name']).',<br>&nbsp;&nbsp;Please fill your details using this Link. <br><br><a href="https://www.4dglobalinc.com/resources/interview/?Refid='.$uqid.'" style="font-weight:bold">Click Here</a><br><br>Regards,<br>HR';
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();

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

	public function getworkexpeience(){
		$data = $this->Client_model->getothersdata('candidate_past_work',$_GET['temp_id']);
		echo json_encode($data);
	}

	public function geteducation(){
		$data = $this->Client_model->getothersdata('candidate_education',$_GET['temp_id']);
		echo json_encode($data);
	}
	public function acceptedorrejected(){
		$this->Client_model->updatestatus('candidate_interview');
		redirect('Candidate_interview/index');
	}

	public function gettestview(){
		$data = $this->Client_model->getothersdata_test('interviewresult',$_GET['tempid']);
		echo json_encode($data);
	}

}
