<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Adduser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Mainmodel");
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function Deactivate(){
		$activedeactive=$this->Mainmodel->activedeactive('users','hideusers',$_POST['emp_id']);
		echo json_encode([$res=>'1']);
			 exit;
	}
	public function Activate(){
		$activedeactive=$this->Mainmodel->activedeactive('hideusers','users',$_POST['emp_id']);
		echo json_encode([$res=>'1']);
			 exit;
	}
/*
	public function adduser()
	{
		$userdata=$this->session->all_userdata();

		if ($userdata["hrms_logged_in"] != TRUE ){
			redirect('login/index');
		}

		if(isset($_POST['fadd']))
		{
			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			$details=$this->input->post();

			$check=$this->db->query("SELECT * FROM users WHERE emp_id='".$_POST['userid']."' OR username='".$_POST['username']."' ");

			if($check->num_rows() == 0){
				$client_arr = $details['client'];
				$client_val = implode(",", $client_arr);
				$digits = 4;
				$emp_id = rand(pow(10, $digits-1), pow(10, $digits)-1);
				$empid  = "4DG-".$emp_id;


				$data = array(
					'user_id'   => $empid,
        			'emp_id'    => $details['userid'],
					'name'	    => $details['name'],
					'username'  => $details['username'],
					'password'  => md5($details['password']),
					'role'      => $details['role'],
					'department'=> $details['department'],
					'client'    => $client_val,
					'created_on'=> $time,
					'created_by'=> $userdata['name'],
					'doj' => $details['doj'],
					'checkin' => $details['checkintiming'],
					'checkout' => $details['checkouttiming']
				);
				if($details['department'] == 'MANAGEMENT'){
						$data['sub_department']=$details['subdepartment'];
				}

		  		$this->db->insert('users',$data);

				$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully created..!</p>');
			}
			else{
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">User Emp Id or Username already exist..!</p>');
			}
			redirect('home/agentlist');
		}

	}


	public function updateuser(){
		$userdata=$this->session->all_userdata();

		if ($userdata["hrms_logged_in"] != TRUE ){
			redirect('login/index');
		}

		if(isset($_POST['fupdate']))
		{
			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');

			$details=$this->input->post();
			//$check=$this->db->query("SELECT * FROM users WHERE user_id='".$_POST['empid']."'");
			if($details['name'] != ''){
				$client_arr = $details['client'];
				$client_val = implode(",", $client_arr);

				$data = array(
					'name'	    => $details['name'],
					'username'  => $details['username'],
					'role'      => $details['role'],
					'department'=> $details['department'],
					'client'    => $client_val,
					'created_on'=> $time,
					'created_by'=> $userdata['name'],
					'doj' => $details['doj'],
					'checkin' => $details['checkintimingupdate'],
					'checkout' => $details['checkouttimingupdate']
				);
				if($details['department'] == 'MANAGEMENT'){
						$data['sub_department']=$details['subdepartment'];
				}
				$this->db->where('user_id',$details['userid']);
		  		$this->db->update('users',$data);

				$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully Updated..!</p>');
			}
			else{
				$this->session->set_flashdata('msg', '<p style="color:red">Update Failed</p>');
			}
			redirect('home/agentlist');
		}
	}
*/


	public function deleteuser(){
		$id=$this->uri->segment(3);
		if($id !=""){
			$this->db->where('id',$id);
			$this->db->delete('users');
			$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Deleted Successfully..! </p>');
			redirect('home/agentlist');
		}
	}

	public function chpass(){
		if(isset($_POST['password'])){
			$details=$this->input->post();
			$data["pass"]=$this->Mainmodel->change_password($details);
			$this->load->view('agentlist',$data);
		}
		$this->load->view('agentlist');
	}

	public function reset_password(){
		if(isset($_POST['reset_password'])){
			$details=$this->input->post();
			$data["pass"]=$this->Mainmodel->reset_password($details);
			$this->load->view('agentlist',$data);
		}
	}

	// denash shaw code starts

		public function adduser()
		{
			$userdata = $this->session->all_userdata();

			if ($userdata["hrms_logged_in"] != TRUE) {
				redirect('login/index');
			}

			if (isset($_POST['fadd'])) {
				date_default_timezone_set('Asia/Kolkata');
				$time = date('Y-m-d H:i:s');

				$details = $this->input->post();
				$check = $this->db->query("SELECT * FROM users WHERE emp_id='" . $_POST['userid'] . "' OR username='" . $_POST['username'] . "' ");

				if ($check->num_rows() == 0) {
					$client_arr = $details['client'];
					$client_val = implode(",", $client_arr);

					$reportingPerson = $_POST['reportingPerson'];
					foreach ($reportingPerson as $value) {
						$ans = explode('/', $value);
						$sep_data = array(
							'agent_name' => $details['name'],
							'emp_id' => $details['userid'],
							'reporting_manager' => $ans[1],
							'manager_id' => $ans[0]
						);
						// $this->db->insert('emp_separation_managers', $sep_data);
						$mail_id_arr = $this->db->select('mail_id')->from('office_mailid')->where('emp_id', $ans[0])->get()->result();
						foreach ($mail_id_arr as $mail_id) {
							$this->load->config('email_interview');
							$this->load->library('email');
							$from_m = $this->config->item('smtp_user');
							//$to_m = 'denashshaw@gmail.com';
							// $to = 'it@4dglobalinc.com';
							$to_m = $mail_id->office_mailid;
							$subject_m = '4D Global - ' . $details['userid'] . '' . $details['name'] . ' Employee Joined';
							$message_m = '<p>Hi ' . $ans[1] . ',<br>&nbsp;&nbsp;New Employee has been joined in our organization. Agent details are listed below: </p><br><table class="table" style="height:105px;border-collapse: collapse;" border="1" width="565"><tbody><tr><td style="width:282px;text-align: center;">ID</td><td style="width:282px;text-align: center;">' . $_POST['userid'] . '</td></tr><tr><td style="width:282px;text-align: center;">Name</td><td style="width:282px;text-align: center;">' . $_POST['name'] . '</td></tr><tr><td style="width:282px;text-align: center;">Department</td><td style="width:282px;text-align: center;">' . $_POST['department'] . '</td></tr><tr><td style="width:282px;text-align: center;">Client</td><td style="width:282px;text-align: center;">' . $client_val . '</td></tr><tr><td style="width:282px;text-align: center;">Shift Timing</td><td style="width:282px;text-align: center;">' . $_POST['checkintiming'] . ' - ' . $_POST['checkouttiming'] . '</td></tr><tr><td style="width:282px;text-align: center;">Manager/TL</td><td style="width:282px;text-align: center;">' . $ans[1] . '</td></tr><tr><td style="width:282px;text-align: center;">Created On</td><td style="width:282px;text-align: center;">' . date("Y-m-d") . '</td></tr><tr><td style="width:282px;text-align: center;">Created By</td><td style="width:282px;text-align: center;">' . $_SESSION['emp_id'] . '/' . $_SESSION['name'] . '</td></tr></tbody></table><br><br>Regards,<br>HR';

							$this->email->set_newline("\r\n");
							$this->email->set_mailtype("html");
							$this->email->from($from_m);
							$this->email->to($to_m);
							$this->email->subject($subject_m);
							$this->email->message($message_m);
							$this->email->send();
						}
					}

					$digits = 4;
					$emp_id = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
					$empid  = "4DG-" . $emp_id;

					$data = array(
						'user_id'   => $empid,
						'emp_id'    => $details['userid'],
						'name'	    => $details['name'],
						'username'  => $details['username'],
						'password'  => md5($details['password']),
						'role'      => $details['role'],
						'department' => $details['department'],
						'sub_department' => $details['subdepartment'],
						'client'    => $client_val,
						'created_on' => $time,
						'created_by' => $userdata['name'],
						'doj' => $details['doj'],
						'checkin' => $details['checkintiming'],
						'checkout' => $details['checkouttiming']
					);

					$from = $this->config->item('smtp_user');
					// $to =$_POST['pre_email'];
					$to = 'it@4dglobalinc.com';
					$subject = '4D Global - ' . $details['userid'] . '' . $details['name'] . ' Employee Joined';
					$message = '<p>Hi IT TEAM,<br>&nbsp;&nbsp;New Employee has been joined in our organization. Agent details are listed below: </p><br><table style="height:105px;border-collapse: collapse;" border="1" width="565"><tbody><tr><td style="width:282px;text-align: center;">ID</td><td style="width:282px;text-align: center;">' . $_POST['userid'] . '</td></tr><tr><td style="width:282px;text-align: center;">Name</td><td style="width:282px;text-align: center;">' . $_POST['name'] . '</td></tr><tr><td style="width:282px;text-align: center;">Department</td><td style="width:282px;text-align: center;">' . $_POST['department'] . '</td></tr><tr><td style="width:282px;text-align: center;">Client</td><td style="width:282px;text-align: center;">' . $client_val . '</td></tr><tr><td style="width:282px;text-align: center;">Shift Timing</td><td style="width:282px;text-align: center;">' . $_POST['checkintiming'] . ' - ' . $_POST['checkouttiming'] . '</td></tr><tr><td style="width:282px;text-align: center;">Manager/TL</td><td style="width:282px;text-align: center;">' . $_POST['reportingPerson'] . '</td></tr><tr><td style="width:282px;text-align: center;">Created On</td><td style="width:282px;text-align: center;">' . date("Y-m-d") . '</td></tr><tr><td style="width:282px;text-align: center;">Created By</td><td style="width:282px">' . $_SESSION['emp_id'] . '/' . $_SESSION['name'] . '</td></tr></tbody></table><br><br>Regards,<br>HR';

					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->from($from);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);
					// $this->email->send();

					$this->db->insert('users', $data);

					$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully created..!</p>');
				} else {
					$this->session->set_flashdata('msg', '<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">User Emp Id or Username already exist..!</p>');
				}
				redirect('home/agentlist');
			}
		}


		public function updateuser()
		{
			$userdata = $this->session->all_userdata();

			if ($userdata["hrms_logged_in"] != TRUE) {
				redirect('login/index');
			}

			if (isset($_POST['fupdate'])) {
				date_default_timezone_set('Asia/Kolkata');
				$time = date('Y-m-d H:i:s');

				$details = $this->input->post();
				//$check=$this->db->query("SELECT * FROM users WHERE user_id='".$_POST['empid']."'");
				if ($details['name'] != '') {
					$client_arr = $details['client'];
					$client_val = implode(",", $client_arr);

					$data = array(
						'name'	    => $details['name'],
						'username'  => $details['username'],
						'role'      => $details['role'],
						'department' => $details['department'],
						'sub_department' => $details['subdepartment'],
						'client'    => $client_val,
						'created_on' => $time,
						'created_by' => $userdata['name'],
						'doj' => $details['doj'],
						'checkin' => $details['checkintimingupdate'],
						'checkout' => $details['checkouttimingupdate']
					);

					$this->db->limit(1)->where('user_id', $details['userid'])->update('users', $data);
					// $this->db->update('users', $data);

					$reportingPerson = $_POST['reportingPerson'];
					if (isset($_POST['reportingPerson'])) {
						$i = 0;
						foreach ($reportingPerson as $value) {
							$ans = explode('/', $value);
							$sep_data[$i] = array(
								'agent_name' => $details['name'],
								'emp_id' => $details['emp_id'],
								'reporting_manager' => $ans[1],
								'manager_id' => $ans[0]
							);
							$i++;
						}
						$get_data = $this->db->select('*')->from('emp_separation_managers')->where('emp_id', $details['emp_id'])->get()->row();
						if ($get_data) {
							$this->db->where('emp_id', $_POST['emp_id']);
							$this->db->delete('emp_separation_managers');
							// $this->db->insert_batch('emp_separation_managers', $sep_data);
							// $this->db->update('emp_separation_managers', $sep_data);
						}
						$this->db->insert_batch('emp_separation_managers', $sep_data);
					}

					$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">User Successfully Updated..!</p>');
				} else {
					$this->session->set_flashdata('msg', '<p style="color:red">Update Failed</p>');
				}
				redirect('home/agentlist');
			}
		}

		// denash shaw code ends


}

?>
