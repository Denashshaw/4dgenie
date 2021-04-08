<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class ReportingPerson extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model("reportingModal");
    		$this->load->library('session');
    		$userdata=$this->session->all_userdata();
    		if($userdata["hrms_logged_in"] != TRUE){
    			redirect('login/index');
    		}
    }

    public function index(){
        $data['emp_data']   = $this->reportingModal->allagentdata();
        $data['managerdata']   = $this->reportingModal->managerdata();
        $data['reportingdetails'] = $this->reportingModal->getreportingdetails();
        $this->load->view('reporting_person',$data);
    }

    public function getReportAttendance(){
        $datares = $this->attendanceModel->getreportingdetails();
    }

    public function addreportingPerson(){
      $manager=$_POST['managerSuper'];
      $user=$_POST['useridselectbox'];
      $dataset=array();
      foreach($manager as $a){
        $expmanager=explode("/",$a);
//        print_r($expmanager);
        foreach ($user as $b) {
          $expuser=explode("/",$b);
            array_push($dataset,array(
              "agent_name" =>$expuser[1],
              "emp_id" =>$expuser[0],
              "reporting_manager" =>$expmanager[1],
              "manager_id" =>$expmanager[0]
            ));

        }
      }
      $insertdatast = $this->reportingModal->bulkadd($dataset);
      redirect('ReportingPerson');
    }

    public function updatereportingPerson(){
      $manager=$_POST['updatemanagerSuper'];
      $user=$_POST['updateuseridselectbox'];
      $dataset=array();

        $expmanager=explode("/",$manager);
//        print_r($expmanager);
        foreach ($user as $b) {
          $expuser=explode("/",$b);
            array_push($dataset,array(
              "agent_name" =>$expuser[1],
              "emp_id" =>$expuser[0],
              "reporting_manager" =>$expmanager[1],
              "manager_id" =>$expmanager[0]
            ));
            $this->db->where('manager_id',$expmanager[0])->delete('emp_separation_managers');
        }

      $insertdatast = $this->reportingModal->bulkadd($dataset);
      redirect('ReportingPerson');
    }

		public function deleted()
		{
			$deletedatast = $this->reportingModal->deletemapping($_POST['manager_id']);
      echo json_encode($deletedatast);
		}
}
