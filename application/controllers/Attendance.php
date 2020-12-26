<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Attendance extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model("empdetailsModel");
        $this->load->model("attendanceModel");
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
    }
    
    public function index(){
        $data['emp_data']   = $this->empdetailsModel->agentdata();
        $this->load->view('emp_attendance',$data);
    }

    public function getReportAttendance(){
        $datares = $this->attendanceModel->getattendanceview($_POST);
    }
}