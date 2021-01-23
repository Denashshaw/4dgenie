
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Separation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model("empdetailsModel");
       $this->load->model("separationModel");
        $this->load->library('session');
        $userdata=$this->session->all_userdata();
        if($userdata["hrms_logged_in"] != TRUE){
        redirect('login/index');
        }
    }

    public function index(){
        $data['emp_data']   = $this->separationModel->agentdata_applied();
				$data['getdata']   = $this->separationModel->getallseparation();
        $this->load->view('emp_separation',$data);
    }
		public function getmanagerdata(){
			$data = $this->separationModel->getallseparation();
			echo json_encode($data);
		}
		public function updatestatus(){
    	$this->load->library('officemail');
      $userdata=$this->session->all_userdata();
			$usermailid=$userdata['mailid'];
			$usermailpw=base64_decode($userdata['mail_pw']);

      $getmanageremailid = $this->separationModel->getmanagermail();
      $getuserdetails= $this->separationModel->getentireusername('users',$_POST['empid1']);
			if($userdata['department'] == 'MANAGEMENT'){
					if($_POST['statusvalue'] == 'Accepted'){
							$status = 'Accepted';
					}else{ $status = 'Rejected'; }

					$dataset = array(
						"Resign_Manager_status" => $status,
						"Resign_Manager_remark" => $_POST['statustext']
					);

					if($_POST['revoke_Reason'] !=''){
						$dataset["Revoke_reason"] = $_POST['revoke_Reason'];
						$dataset["Revoke_date"] = date('Y-m-d');
						$message = '<p>Hi,<br>&nbsp;&nbsp;Manager Status: <h3>'. $status.'</h3>&nbsp;&nbsp;Agent Revoke Remark:<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$_POST["revoke_Reason"].'<br>&nbsp;&nbsp;<b>Department - '.$getuserdetails[0]->department.'</b><br><br><a href="http://192.168.2.193/4dgenie">Goto HRMS</a><br><br>Regards,<br>'.$userdata['name'];
          }else{
						$message = '<p>Hi,<br>&nbsp;&nbsp;Manager Status: <h3>'. $status.'</h3>&nbsp;&nbsp;Manager Remark:<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$_POST["statustext"].'<br>&nbsp;&nbsp;<b>Department - '.$getuserdetails[0]->department.'</b><br><br><a href="http://192.168.2.193/4dgenie">Goto HRMS</a><br><br>Regards,<br>'.$userdata['name'];
					}

          $to = 'muthu@4dglobal.in';
					//$to='jaganathan@4dglobal.in';
          $subject = 'Employee: '.$_POST['empid1'].'-'.$getuserdetails[0]->name.' Resignation/Revoke';

					if($status == 'Accepted'){
							$this->officemail->sendmail($usermailid,$usermailpw,$to,'',$subject,$message);
					}
			}
			if($userdata['department'] == 'HR'){
        $date_get= date_create($_POST['lasteworkingdate']);
				$dt_format = date_format($date_get,"Y-m-d");
				if($_POST['statusvalue'] == 'Accepted'){
					$status = 'Accepted';
				}else{ $status = 'Rejected'; }
				$dataset = array(
					"Resign_HR_status" => $status,
          "Resign_HR_remark" => $_POST['statustext'],
          "Resign_Lastworkdate" =>  $dt_format
        );
				$getagentmailid=$this->separationModel->agentmailid($_POST['empid1']);
				$to=$getagentmailid[0]->mail_id;
				$cc = $getmanageremailid[0]->mail_id;
        $subject = 'Employee: '.$_POST['empid1'].'-'.$getuserdetails[0]->name.' Resignation/Revoke';
        $message = '<p>Hi '.$getuserdetails[0]->name.',<br>&nbsp;&nbsp;HR Status: <h3>'. $status.'</h3>&nbsp;&nbsp;HR Remark:<br>&nbsp;&nbsp;&nbsp;&nbsp;'.$_POST["statustext"].'<br>&nbsp;&nbsp;<b>Last Working Date: '.$dt_format.'</b><p>Department - '.$getuserdetails[0]->department.'</p><br><br><a href="http://192.168.2.193/4dgenie">Goto HRMS</a><br><br>Regards,<br>'.$userdata['name'];
			$this->officemail->sendmail($usermailid,$usermailpw,$to,$cc,$subject,$message);
				//Agent send notification
				$nofi_data = array(
						"emp_id" => $getagentmailid[0]->emp_id,
						"name" => $getagentmailid[0]->name,
						"module_name" => "Emp Separation",
						"details" => $subject.' - STATUS',
						"status" => 0
				);
				$this->separationModel->addfeedback('notification',$nofi_data);
			}
			$this->separationModel->updatedata('emp_resignation_revoke',$_POST['indexid'],$dataset);
			redirect('Separation');
		}
    public function separation_ResignUpload(){

				$this->load->library('officemail');

				$userdata=$this->session->all_userdata();
				$usermailid=$userdata['mailid'];
				$usermailpw=base64_decode($userdata['mail_pw']);
        $getmanageremailid = $this->separationModel->getmanagermail();
        $getuserdetails= $this->separationModel->getentireusername('users',$_POST['emp_id1']);
				$reporting_person_mailid = $getmanageremailid[0]->mail_id;

				$to = $getmanageremailid[0]->mail_id;
				$subject = 'Employee: '.$_POST['emp_id1'].'-'.$getuserdetails[0]->name.' Resignation/Revoke';
				$message = '<p>Hi '.$getmanageremailid[0]->name.',<br>&nbsp;&nbsp;'. $_POST['resignation_Reason'].'</b><br><br><b>Department - '.$getuserdetails[0]->department.'</b><br><br><a href="http://192.168.2.193/4dgenie">Goto HRMS</a><br><br>Regards,<br>'.$_POST['emp_id1'].' - '.$getuserdetails[0]->name;
				//HR Supervisor
				$cc = 'muthu@4dglobal.in';
				$this->officemail->sendmail($usermailid,$usermailpw,$to,$cc,$subject,$message);

     		if($userdata['role'] == 'agent'){
           	$dataset = array(
          		"emp_id" => $_POST['emp_id1'],
             	"Resignation_reason" => $_POST['resignation_Reason'],
             	"Resignation_date" => date('Y-m-d')
           	);
				}
				$nofi_data = array(
						"emp_id" => $getmanageremailid[0]->emp_id,
						"name" => $getmanageremailid[0]->name,
						"module_name" => "Emp Separation",
						"details" => $subject,
						"status" => 0
				);
				$this->separationModel->addfeedback('notification',$nofi_data);

     		$this->separationModel->insertupdatedata('emp_resignation_revoke',$_POST['emp_id1'],$dataset);
     		redirect('Separation');
     }
    public function separation_RevokeUpload(){
        $userdata=$this->session->all_userdata();
        if($userdata['role'] == 'agent'){
            $dataset = array(
                "emp_id" => $_POST['emp_id2'],
                "Revoke_reason" => $_POST['revoke_Reason'],
                "Revoke_date" => date('Y-m-d')
            );
        }
        $this->separationModel->insertupdatedata('emp_resignation_revoke',$_POST['emp_id2'],$dataset);
        redirect('Separation');
    }

    public function getuserdata(){
        $this->separationModel->getentireuser('emp_resignation_revoke',$_POST);
    }

  }
