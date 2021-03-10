<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ERROR);
class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("NotificationModel");
		$userdata=$this->session->all_userdata();

	}

	public function index(){
		$userdata=$this->session->all_userdata();
        $empid= $userdata['emp_id'];
		$data['emp_data'] = $this->NotificationModel->agentdata($empid);
		$data['get_announcement'] = $this->NotificationModel->getannouncement($empid);
		$this->load->view('announcement',$data);
	}
	public function getAgentdata(){
		$userdata=$this->session->all_userdata();
        $empid= $userdata['emp_id'];
		$emp_data = $this->NotificationModel->agentdata($empid);
		echo json_encode($emp_data);
	}

	public function getnofi(){
        $send = $this->NotificationModel->getnotification($_POST['emp_id']);
         echo json_encode($send);
    }

    public function updatenotification(){
        $this->NotificationModel->updatenotification($_POST['indexid']);
	}

	public function addannouncement(){
		$userdata=$this->session->all_userdata();

		$empid_set = $_POST['useridselectbox'];
		$dataset=array();
		$notificationsend=array();

		foreach($empid_set as $emp){
			$getemp=explode("/",$emp);
			array_push($dataset,array(
				"emp_id" => $getemp[0],
				"name" => $getemp[1],
				"module_name" => $_POST['module_name'],
				"details" => $_POST['details'],
				"creater_id" => $userdata['emp_id'],
				"creater_name" => $userdata['name'],
				"created_date" => $_POST['getdate']
			));
			array_push($notificationsend,array(
				"emp_id" => $getemp[0],
				"name" => $getemp[1],
				"module_name" => $_POST['module_name'],
				"details" => $_POST['details']
			));
		}
		$dataset1 = $this->NotificationModel->insertdataset('announcement',$dataset);
		$dataset2 = $this->NotificationModel->insertdataset('notification',$notificationsend);
		redirect('Notification');
	}

	//timerdata
	public function viewcheckinduriation(){
		$res = $this->NotificationModel->fetchandinsert('checkin_checkout');
		echo json_encode($res);
	}
}

?>
