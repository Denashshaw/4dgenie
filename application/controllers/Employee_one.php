<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// error_reporting(E_ERROR);
class Employee_one extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model("empdetailsModel");
		$this->load->model("Employee_one_model");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}


	public function index(){
		echo 'success';
		// $this->Employee_one_model->get_employee_one_details();
	}
}