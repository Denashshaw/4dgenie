<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");
	}

	public function index()
	{
        $details=$this->input->post();

		if(isset($_POST['login']))
		{
			$result=$this->Mainmodel->logincheck($details);

			if($result == false)
			{
					$login["errors"]="<p style='color:red'>Username or password is wrong</p>";
					$this->load->view('login',$login);
			}
			else
			{
				$userdata = array(
					'userid'	=> $result[0]->id,
					'emp_id'    => $result[0]->emp_id,
					'user_id'	=> $result[0]->user_id,
					'department'=> $result[0]->department,
                   	'username'  => $result[0]->username,
                   	'name'      => $result[0]->name,
				   	'role' 		=> $result[0]->role,
						'client' => $result[0]->client,
                   	'hrms_logged_in' => TRUE
               );
					$getusermailid=$this->Mainmodel->getusermail($result[0]->emp_id);
					if(sizeof($getusermailid) > 0){
						$userdata['mailid'] = $getusermailid[0]->mail_id;
						$userdata['mail_pw'] = base64_encode($getusermailid[0]->password);
					}

				$this->db->query("UPDATE users SET status='loggedin' WHERE user_id='".$userdata['user_id']."' ");

				$this->session->set_userdata($userdata);

				//Check Timesheet Rejected
				$this->checktimesheet();


				//redirect('home/index');
			}
		}
		else
		{
			$this->load->view('login');
		}

	}

	public function checktimesheet()
	{
		$this->load->model('Timesheet_model');
		$data['checktimesheet']=$this->Timesheet_model->checkrejected('timesheet_report',$_SESSION['emp_id']);
		if(sizeof($data['checktimesheet']) > 0){
			$this->load->view('RejectedTimesheet',$data);
		}else{
			redirect('home/index');
		}
	}

	public function signout()
	{
		$userdata=$this->session->all_userdata();

		$this->db->query("UPDATE users SET status='loggedout' WHERE user_id='".$userdata['user_id']."' ");

  		$this->session->unset_userdata('hrms_logged_in');
		redirect("login/index");
	}

}

?>
