<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Logindetails extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");	
		$userdata=$this->session->all_userdata();

	}

	public function index(){
		$this->load->view('login_details');
	}

}

?>