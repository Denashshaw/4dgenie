<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Timesheet extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    $this->load->model('Client_model');
    $this->load->model('Timesheet_model');
    $userdata=$this->session->all_userdata();
    if($userdata["hrms_logged_in"] != TRUE){
      redirect('login/index');
    }
  }

	public function index(){
		if(isset($_POST['submit'])){
			 $data['getagent_report']=$this->Timesheet_model->getlist($_POST);
			// $this->load->view('timesheetview',$data);
		}else{
			$data['getagent_report']='';
			//$data['firststtimesubmit']='yes';
		}

		$this->load->view('timesheetview',$data);
	}


  public function getclientlist()
  {
    $client_data=$this->Timesheet_model->client_data();
    echo json_encode($client_data);
  }
	public function gettasklist()
	{
		$task_data=$this->Timesheet_model->gettask_data();
    echo json_encode($task_data);
	}
	public function getsubtasklist()
	{
		$subtask_data=$this->Timesheet_model->getsubtask_data();
    echo json_encode($subtask_data);
	}
	public function gettagetvalue()
	{
		$gettarget=$this->Timesheet_model->usertarget($_POST);
		echo json_encode($gettarget);
	}
  public function updatelatelogout(){
    $updatelatelog=$this->Timesheet_model->logoutreason($_POST);
    echo json_encode($updatelatelog);
  }
  public function checklateupdate(){
    $updatelateuser=$this->Timesheet_model->getlastlogoutuser();
    echo json_encode($updatelateuser);
  }

	public function getreporting(){
		$agentreport=$this->Timesheet_model->getreport_per();
		echo json_encode($agentreport);
	}

	public function getagentlist(){
		$agent_name=$this->Timesheet_model->getuser();
		echo json_encode($agent_name);
	}

	public function gettaskdetails()
	{
		$data['getdata']=$this->Timesheet_model->gettimesheetdata_agent();
		$data['getdata_report']=$this->Timesheet_model->gettimesheetdata_agent_report();
		echo json_encode($data);
	}

  public function timesheet_submit(){
    $userdata=$this->session->all_userdata();
    $emp_id=$userdata['emp_id'];
    $name=$userdata['name'];
    $department=$userdata['department'];

    $dataget=$this->db->query("SELECT * FROM checkin_checkout WHERE emp_id='".$emp_id."' ORDER BY id desc")->result();
    $checkindate=$dataget[0]->checkin_time;
    $date=date_format(date_create($checkindate),"Y-m-d");
    if($dataget[0]->reason!=''){
      $category ='Irregular';
    }else{
      $category ='Regular';
    }
    $dataset=array();
		$reporting_person=explode("/",$_POST['reporting_person']);
    for($i=0;$i<sizeof($_POST['client']);$i++){
      $dataset[$i]['emp_id']=$emp_id;
      $dataset[$i]['name']=$name;
      $dataset[$i]['department']=$department;
      $dataset[$i]['report_date']=$date;
      $dataset[$i]['category ']=$category;
      $dataset[$i]['client']=$_POST['client'][$i];
      $dataset[$i]['type']=$_POST['type'][$i];
      $dataset[$i]['task']=$_POST['task'][$i];
      $dataset[$i]['sub_task']=$_POST['sub_task'][$i];
      $dataset[$i]['time_spent']=$_POST['timespent'][$i];
      $dataset[$i]['count_production']=$_POST['countdown'][$i];
			$dataset[$i]['target']=$_POST['target'][$i];
			$dataset[$i]['percentage']=$_POST['percentage'][$i];
      $dataset[$i]['comments']=$_POST['comments'][$i];
			$dataset[$i]['reviewer_id']=$reporting_person[0];
			$dataset[$i]['reviewer_name']=$reporting_person[1];
			$dataset[$i]['status']='Initiated';
    }

		$timesheet_report_data=array(
			"emp_id"=>$emp_id,
			"name"=>$name,
			"department"=>$department,
			"report_date"=>$date,
			"category"=>$category,
			"reviewer_id"=>$reporting_person[0],
			"reviewer_name"=>$reporting_person[1],
			"status"=>'Initiated',
			"totaltime_spend"=>$_POST['totaltimespend'],
			"productive_time"=>$_POST['productive_time'],
			"non_productive_time"=>$_POST['non_rpoductive_time'],
			"total_production"=>$_POST['totalproduction_count'],
			"overall_percentage"=>$_POST['overall_percentage'],
		);

		$this->Timesheet_model->datastore_report('timesheet_report',$timesheet_report_data);


    $resGet =$this->Timesheet_model->datastore('timesheet',$dataset);
		echo json_encode($resGet);
  }

	public function reviewerupdatestatus()
	{
		$resGet =$this->Timesheet_model->update_reviewerstatus('timesheet',$_POST['dt']);
		echo json_encode($resGet);
	}

	public function getcount_notification()
	{
		$resGet =$this->Timesheet_model->count_nofifi('timesheet_report');
		echo json_encode($resGet);
	}

	public function rejectedlist()
	{
		$resGet =$this->Timesheet_model->rejected_date('timesheet');
		echo json_encode($resGet);
	}

	public function updaterejected()
	{
		$resGet =$this->Timesheet_model->update_rej_data($_POST);
		return redirect('Login/checktimesheet');
	}
	public function updaterow_rejected()
	{
		$resGet =$this->Timesheet_model->updaterow_rej_data($_POST);
		return redirect('Login/checktimesheet');
	}
	public function fulldetailsupdate(){

		$timesheet=array(
			"emp_id"=>$_SESSION['emp_id'],
			"report_date"=>$_POST['datereport'],
			"status"=>'Re-submitted',
		);
		$resGet =$this->Timesheet_model->updateentire_sheet($timesheet);

		$timesheet_report=array(
			"emp_id"=>$_SESSION['emp_id'],
			"report_date"=>$_POST['datereport'],
			"status"=>'Re-submitted',
			"totaltime_spend"=>$_POST['totaltimespend'],
			"productive_time"=>$_POST['productiontime'],
			"non_productive_time"=>$_POST['non_productivetime'],
			"total_production"=>$_POST['totalcount'],
			"overall_percentage"=>$_POST['overallpercentage'],
		);
		$resGet =$this->Timesheet_model->updateentire_report($timesheet_report);
		echo json_encode(["status"=>"Success"]);
	}

}
