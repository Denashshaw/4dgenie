<?php
class Training extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Trainingmodel");
        $this->load->helper('cookie');
		//$this->load->model("Check_Break_Report");
        
        $uid = uniqid();

	}

    public function index(){
        $userdata=$this->session->all_userdata();
          //  set_cookie('tabview','dashboard','999600');

        $data['clientval'] = $this->Trainingmodel->clientlist();
        $data['manualview'] = $this->Trainingmodel->manuallist();

        $data['materiallist'] = $this->Trainingmodel->materiallist();
        $data['agentlist']=$this->Trainingmodel->agentlist();

        $data['assessment']=$this->Trainingmodel->assessmentlist();

        if($userdata['role'] !='admin'){
            $data['agentdash']=$this->Trainingmodel->getagentdash($userdata['emp_id']);
            $data['agentRank'] =$this->Trainingmodel->getagentRank($userdata['emp_id']);
        }
        
  
        $this->load->view('trainingmain',$data);
    }

    public function getemp(){
        $id=$_POST['id'];
        $agentvalue=$this->Trainingmodel->agentget($id);
        echo json_encode($agentvalue);
    }

    public function mediauload(){
        set_cookie('tabview','manual','999600');

        $details=$this->input->post();
        $processname = $details['process'];

        if($_FILES['gtm']['name']!=''){
           
            $file_name = explode(".",$_FILES['gtm']['name']);
            $newfilename = $processname.'_'.round(microtime(true)) . '.' . end($file_name);
            $file_tmp  = $_FILES['gtm']['tmp_name'];
      		move_uploaded_file($file_tmp,"training_module/Generalmaterial/".$newfilename);
        }else{
            $newfilename ='';
        }
        date_default_timezone_set('Asia/Kolkata');
        $dataset = array(
           'process' => $processname,
           'materialfilename' => $newfilename,
           'status' => "Initiated",
           'created_date' => date('Y-m-d H:i:s')
        );
        $materialadd=$this->Trainingmodel->materialadd($dataset);
        //redirect('Training');
    }

    public function deleteid(){
        $id = $this->uri->segment(3);
        $dt =$this->Trainingmodel->materialdelete($id);
    }

    public function deletemanualid(){
        $id = $this->uri->segment(3);
        $dt =$this->Trainingmodel->manualdelete($id);
    }

    //manualupload
    public function manualup(){
        $manualdata = $this->input->post();
        $preocess =  $manualdata['processname'];
        $client = $manualdata['clientname'];
        if($_FILES['standardoperation']['name']!=''){
            $standardoperationfile_name =  explode(".",$_FILES['standardoperation']['name']);
            $newstandardoperationfile_name = $preocess."_standardoperation_".round(microtime(true)) . '.' . end($standardoperationfile_name);
      		$standardoperationfile_tmp  = $_FILES['standardoperation']['tmp_name'];
      		move_uploaded_file($standardoperationfile_tmp,"training_module/StandardOperatingProcedures/".$newstandardoperationfile_name);
        }else{
            $newstandardoperationfile_name ='';
        }

        if($_FILES['clientSwmanual']['name']!=''){
            $clientSwmanualfile_name =  explode(".",$_FILES['clientSwmanual']['name']);
            $newclientSwmanualfile_name = $preocess."_clientSwmanual_".round(microtime(true)) . '.' . end($clientSwmanualfile_name);
      		$clientSwmanualfile_tmp  = $_FILES['clientSwmanual']['tmp_name'];
      		move_uploaded_file($clientSwmanualfile_tmp,"training_module/ClientSoftwareManual/".$newclientSwmanualfile_name);
        }else{
            $newclientSwmanualfile_name ='';
        }

        if($_FILES['speInstruction']['name']!=''){
            $speInstructionfile_name =  explode(".",$_FILES['speInstruction']['name']);
            $newspeInstructionfile_name = $preocess."_speInstruction_".round(microtime(true)) . '.' . end($speInstructionfile_name);
      		$speInstructionfile_tmp  = $_FILES['speInstruction']['tmp_name'];
      		move_uploaded_file($speInstructionfile_tmp,"training_module/SpecialInstructions/".$newspeInstructionfile_name);
        }else{
            $newspeInstructionfile_name ='';
        }
        date_default_timezone_set('Asia/Kolkata');
        $dataset = array(
            'process' => $preocess,
            'client' => $client,
            'standardoperation' => $newstandardoperationfile_name,
            'clientSwmanual' => $newclientSwmanualfile_name,
            'speInstruction' => $newspeInstructionfile_name,
            'status' => "Initiated",
            'created_date' => date('Y-m-d H:i:s')
        );
        $datadd=$this->Trainingmodel->manualadd($dataset);
    }

    //materialview
    public function viewmaterial(){
        $this->load->view('materialviewpage');
    }

    //manualview
    public function viewmanual(){
        $data['page1']=$this->input->get('page1');
        $data['page2']=$this->input->get('page2');

        $this->load->view('manualviewpage',$data);
    }

    //agentupdate
    public function materialReaded(){
        $userdata=$this->session->all_userdata();
        $page = $this->input->post('materialname');
        $empid=$userdata['emp_id'];
        $name=$userdata['name'];
        date_default_timezone_set('Asia/Kolkata');
        $dataset = array(
            'type' => 'Manual',
            'emp_id' => $empid,
            'name' => $name,
            'page' => $page,
            'status' => "Read",
            'created_date' => date('Y-m-d H:i:s')
        );
        $datadd=$this->Trainingmodel->agentstatus($dataset);
        echo json_encode($datadd);
    }

    public function getviewempMaterial(){
        $datadd=$this->Trainingmodel->numofviewmaterial($_POST);
        echo json_encode($datadd);
    }

    public function getprocessemp(){
        $datagent=$this->Trainingmodel->getprocessemp($_POST);
        echo json_encode($datagent);
    }

    public function assessmentadd(){
        date_default_timezone_set('Asia/Kolkata');
        $expagent = explode("/",$_POST['agentname']);
        $dataset = array(
            "process" =>  $_POST['processname'],
            "emp_id" => $expagent[0],
            "name" => $expagent[1],
            "assessment_url" => $_POST['assessment'],
            "status" => "Assigned",
            'created_date' => date('Y-m-d H:i:s')
        );
        $datadd=$this->Trainingmodel->assessmentadd($dataset);
    }

    public function deleteassessment(){
        $id = $this->uri->segment(3);
        $dt =$this->Trainingmodel->assessmentdelete($id);
    }

    public function agentassessmenttaken(){
        $dt =$this->Trainingmodel->assagentview($_POST);
    }

    public function assScoreUpdate(){
        $dt =$this->Trainingmodel->assagentScoreupdate($_POST);
    }

    public function dashboardval(){
        $dash =$this->Trainingmodel->dashboarddata($_POST);
        echo json_encode($dash);
    }
}
?>