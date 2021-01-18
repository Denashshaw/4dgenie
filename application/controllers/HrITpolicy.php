<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class HrITpolicy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model("empdetailsModel");
		$this->load->model("Policymodel");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

  public function index(){
    $this->load->view('hrit_policy');
  }

  public function addcontent(){
    $dataset=array(
      "type"=>$_POST['policytype'],
    //  "viewcontent"=>htmlspecialchars($_POST['policytextcontent'])
      "viewcontent"=>$_POST['policytextcontent']
    );
    $this->Policymodel->adddata('ithr_policy',$dataset);
    redirect('HrITpolicy');
  }

  public function getdatapolicy(){
    $getdata=$this->Policymodel->getdata('ithr_policy',$_POST['selectedoption']);
    echo json_encode($getdata);
  }

}
?>
