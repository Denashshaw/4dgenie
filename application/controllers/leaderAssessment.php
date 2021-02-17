<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class leaderAssessment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("assessmentModel");
		$this->load->model("feedbackModel");
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function index(){
		if($_SESSION['role'] == 'admin' || $_SESSION['department'] == 'MANAGEMENT'){
			$data['getdata']=$this->assessmentModel->getallreport();
			$this->load->view('leaderAssessmentview',$data);
		}else{
			//agent,TL
			$data['getpendingtest']=$this->assessmentModel->getagentpending();
			if(isset($_POST['selectassess']) && $_POST['selectassess']!=''){
				$data['selectassess']=$_POST['selectassess'];
				$data['question']=$this->assessmentModel->getquestion_test('assessment_question',$_POST['selectassess']);
			}
			$this->load->view('leaderAssessmentview_test',$data);
		}
	}

	public function getagentlist(){
		$dataset = $this->assessmentModel->getagentname();
		echo json_encode($dataset);
	}

	public function addquestions(){
		$tempid=uniqid();
		$empid=$_POST['empid'];
		$question_data = array();
		$i=0;
		foreach ($_POST['questions'] as $a) {
			$dataset=array(
				"emp_id"=>$empid,
				"tempid"=>$tempid,
				"title"=>$_POST['title'],
				"question"=>$a,
				"correct"=>$_POST['correct'][$i],
				"a"=>$_POST['a'][$i],
				"b"=>$_POST['b'][$i],
				"c"=>$_POST['c'][$i],
				"d"=>$_POST['d'][$i]
			);
			$i++;
			array_push($question_data,$dataset);
		}
		$splitempid=explode(",",$empid);
		foreach ($splitempid as $empidname) {
			$empd_det=explode("/",$empidname);
			$nofi_data = array(
					"emp_id" => $empd_det[0],
					"name" => $empd_det[1],
					"module_name" => "Assessment",
					"details" => $_POST['title']." - Please attend your assessment test",
					"supervisor" => 0,
					"manager" => 0,
					"status" => 0
			);
			$this->feedbackModel->addfeedback('notification',$nofi_data);
		}

		$insertdata=$this->assessmentModel->addquestionModel('assessment_question',$question_data);
		echo json_encode($insertdata);
	}

	public function checktitle(){
		$checktitle=$this->assessmentModel->checktitle('assessment_question',$_POST['titleval']);
		echo json_encode($checktitle);
	}

	public function getquestion(){
		$get_question=$this->assessmentModel->getquestion('assessment_question',$_POST['questions']);
		echo json_encode($get_question);
	}
	public function getagentview(){
		$get_agentview=$this->assessmentModel->getagentview_test($_POST['empids'],$_POST['title']);
		echo json_encode($get_agentview);
	}
	public function submittest(){
		$question=array();
		$ans=array();
		$correct=array();
		$mark=0;
		for($i=0;$i < $_POST['noof_question'] ;$i++){
			$question_get=$_POST["question".($i+1)];
			array_push($question,$question_get);
			$answer_get=$_POST["q".($i+1)];
			array_push($ans,$answer_get);
			$getans=$this->db->query("select correct from assessment_question where id=$question_get")->result();
			array_push($correct,$getans[0]->correct);
			if($getans[0]->correct == $answer_get){
				$mark++;
			}

		}
		$dataset=array(
			"emp_id"=>$_SESSION['emp_id'],
			"name"=>$_SESSION['name'],
			"title"=>$_POST['title'],
			"questions"=>implode(",",$question),
			"correct_ans"=>implode(",",$correct),
			"agent_ans"=>implode(",",$ans),
			"mark"=>$mark."/".$_POST['noof_question']
		);
		$this->db->insert('assessment_test',$dataset);
		redirect('leaderAssessment');
	}

	//Reports
	public function Accessment_report(){
		$data['title']=$this->assessmentModel->titleview();
		if(isset($_POST['selectassess'])){
			$data['select_title']=$_POST['selectassess'];
			if($_POST['selectreport'] == 'Assessment Score'){
				$data['select_report']='Assessment Score';
				$ids=$this->assessmentModel->scoreview($_POST['selectassess']);
				$data['scoreview']=$this->assessmentModel->getagentview_test($ids,$_POST['selectassess']);
			}
			if($_POST['selectreport'] == 'Assessment Raw Data'){
				$data['select_report']='Assessment Raw Data';
					$data['rawdata']=$this->assessmentModel->rawdataview($_POST['selectassess']);

			}
		}
		$this->load->view('report/assessment',$data);

	}



}

?>
