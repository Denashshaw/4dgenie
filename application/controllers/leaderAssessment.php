<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class leaderAssessment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("assessmentModel");
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function index(){

		$this->load->view('leaderAssessmentview');
	}

	public function getagentlist(){
		$dataset = $this->assessmentModel->getagentname();
		echo json_encode($dataset);
	}
}

?>