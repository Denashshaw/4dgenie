
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Feedbackform extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
      //  $this->load->model("notificationModel");
       $this->load->model("feedbackModel");
        $this->load->library('session');
        $userdata=$this->session->all_userdata();
        if($userdata["hrms_logged_in"] != TRUE){
        redirect('login/index');
        }
    }
    // public function index(){
    //     $data['emp_data']   = $this->empdetailsModel->agentdata();
	// 	//		$data['getdata']   = $this->separationModel->getallseparation();
    //     $this->load->view('emp_separation',$data);
    // }
    public function feedbackhr(){
        $data['emp_data']   = $this->feedbackModel->agentdata();
        $data['hr_feedback'] = $this->feedbackModel->getfeedback('hr_feedback_form');
        $this->load->view('emp_hr_feedback',$data);
    }
    public function addHRfeedback(){
        date_default_timezone_set("Asia/Kolkata"); 
        $splitdata=explode("/",$this->input->post('useridemp'));     
        $dataset = array(
            "emp_id" => $splitdata[0],
            "name" => $splitdata[1],
            "department" => $splitdata[2],
            "supervisor_id" => $splitdata[3],
            "supervisor_name" => $splitdata[4],
            "designation" => $splitdata[5],
            "month_year" => $this->input->post('monthdatepicker'),
            "avg_absentdays" => $this->input->post('averageAbsentDays'),
            "reasonforabsent" => $this->input->post('ReasonforAbsent'),
            "team_happy" => $this->input->post('TeamHappy'),
            "supervisor_confortable" => $this->input->post('SupervisorConfortable'),
            "anyissue" => $this->input->post('Anyissue'),
            "targets" => $this->input->post('Targets'),
            "anyideasuggest" => $this->input->post('anyideasuggest'),
            "hrcomments" => $this->input->post('hrcomments'),
            "create_date" => $this->input->post('getdate')
        );

        if($this->input->post('TeamHappy') == 'No' ){
            $dataset['team_happy_reason'] = $this->input->post('teamhappyReason');
        }
        if($this->input->post('SupervisorConfortable') == 'No' ){
            $dataset['supervisor_confortable_reason'] = $this->input->post('conf_supervisor_Reason');
        }
        if($this->input->post('Anyissue') == 'Yes' ){
            $dataset['anyissue_reason'] = $this->input->post('Anyissue_Reason');
        }
        if($this->input->post('Targets') == 'No' ){
            $dataset['targets_reason'] = $this->input->post('Targets_Reason');
        }
        $insertdata_resp = $this->feedbackModel->addfeedback('hr_feedback_form',$dataset);
        redirect('Feedbackform/feedbackhr');
        
    }

    public function updatefeedbackhr(){
        date_default_timezone_set("Asia/Kolkata");     
        $dataset = array(
            "avg_absentdays" => $this->input->post('averageAbsentDays'),
            "reasonforabsent" => $this->input->post('ReasonforAbsent'),
            "team_happy" => $this->input->post('TeamHappy'),
            "supervisor_confortable" => $this->input->post('SupervisorConfortable'),
            "anyissue" => $this->input->post('Anyissue'),
            "targets" => $this->input->post('Targets'),
            "anyideasuggest" => $this->input->post('anyideasuggest'),
            "hrcomments" => $this->input->post('hrcomments'),
            "update_date" => date('Y-m-d H:i:s')
        );
        if($this->input->post('TeamHappy') == 'No' ){
            $dataset['team_happy_reason'] = $this->input->post('teamhappyReason');
        }
        if($this->input->post('SupervisorConfortable') == 'No' ){
            $dataset['supervisor_confortable_reason'] = $this->input->post('conf_supervisor_Reason');
        }
        if($this->input->post('Anyissue') == 'Yes' ){
            $dataset['anyissue_reason'] = $this->input->post('Anyissue_Reason');
        }
        if($this->input->post('Targets') == 'No' ){
            $dataset['targets_reason'] = $this->input->post('Targets_Reason');
        }
        $insertdata_resp = $this->feedbackModel->updatefeedback('hr_feedback_form',$_POST['indexid'],$dataset);
        redirect('Feedbackform/feedbackhr');
    }
    public function feedbackmanager(){
        $data['emp_data']   = $this->feedbackModel->agentdata();
        $data['manager_feedback'] = $this->feedbackModel->getfeedback_view('manager_feedback_form');
        $this->load->view('emp_manager_feedback',$data);
    }

    public function addmonthlyfeedbackAgent(){  
        date_default_timezone_set("Asia/Kolkata");
        $splitdata=explode("/",$this->input->post('useridemp'));    
        $mYear =date("m",strtotime("-1 month"))."-".date("Y");   
        $dataset = array(
            "emp_id" => $splitdata[0],
            "name" => $splitdata[1],
            "department" => $splitdata[2],
            "reviewer_id" => $splitdata[3],
            "reviewer_name" => $splitdata[4],
            "designation" => $splitdata[5],
            "date_apply" => $this->input->post('getdate'),
            "monthyear" => $mYear,
            "achievements" => $this->input->post('achivements'),
            "area_of_improvement" => $this->input->post('areaofimporvement'),
            "goals_for_next_month" => $this->input->post('goalsfornexmonth'),
            "employee_com" => $this->input->post('emp_remark')
        );
       // $monthyr=date('m-Y');
        $query ="SELECT * FROM manager_feedback_form WHERE emp_id='$splitdata[0]' and monthyear = '$mYear'";
        $querytocheck = $this->db->query($query);
        if($querytocheck->num_rows() > 0){
 
            $insertdata_resp = $this->feedbackModel->agent_updatefeedback('manager_feedback_form',$splitdata[0],$mYear,$dataset);
           // $this->session->set_flashdata('msg','<p style="color:blue;margin-left:3%;margin-top:3%;">Same Month you are aleady applied!..');
        }else{
            $insertdata_resp = $this->feedbackModel->addfeedback('manager_feedback_form',$dataset);
            $nofi_data = array(
                "emp_id" => $splitdata[3],
                "name" => $splitdata[4],
                "module_name" => "One on One Feedback",
                "details" => $splitdata[1]." Applied ".$mYear." Month Feedback Form",
                "supervisor" => 0,
                "manager" => 0,
                "status" => 0
            );
            $this->feedbackModel->addfeedback('notification',$nofi_data);
        }
        redirect('Feedbackform/feedbackmanager');
    }

    public function getFeedbackdetails(){
        $this->feedbackModel->getviewpart('manager_feedback_form',$_POST['indexid']);
    } 

    public function updatereviewer(){
        $userdata=$this->session->all_userdata();
        $dataset = array(
            "reviewer_title" => $_POST['reviewtitle'],
            "produnction_perc" => $_POST['prod_percentage'],
            "quality_perc" => $_POST['quality_percenatage'],
            "attendance" => $_POST['attendance'],
            "time_efficiency" => $_POST['timeefficiency'],
            "reviewer_comm" => $_POST['reviewercomm']
        );
        $splitdata = explode("/",$_POST['empidval']);
        $nofi_data = array(
            "emp_id" => $splitdata[0],
            "name" => $splitdata[1],
            "module_name" => "One on One Feedback",
            "details" => $userdata['name']." Reviewed Your Feedback Form",
            "status" => 0
        );
        $this->feedbackModel->addfeedback('notification',$nofi_data);

        $insertdata_resp = $this->feedbackModel->updatefeedback('manager_feedback_form',$_POST['indexplace'],$dataset);
        redirect('Feedbackform/feedbackmanager');

    }

    public function uploadcsv(){
        if(!empty($_FILES["uploadcsv"]["name"]))
        {
            $allowed_ext = array("csv","CSV");
            $tmp = explode('.', $_FILES["uploadcsv"]["name"]);
            $extension = end($tmp);
            if(in_array($extension, $allowed_ext))
            {
                $file_data    = fopen($_FILES["uploadcsv"]["tmp_name"], 'r');
                   $column_count = count(fgetcsv($file_data));
                while($row = fgetcsv($file_data))
                {   
                    if($row[0] == ''){ continue; }
                    $this->feedbackModel->upexceldata($row);
                }
                $this->session->set_flashdata('msg', '<p style="color:green">File uploaded successfully</p>');
            }
            else{
            $this->session->set_flashdata('msg', '<p style="color:red">Invalid file format. Please upload CSV file</p>');
            }
        }
        redirect('Feedbackform/feedbackmanager');
    }
}
?>