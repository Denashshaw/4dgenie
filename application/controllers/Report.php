<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Report extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Check_Break_Report");
		$userdata=$this->session->all_userdata();

		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}


	public function check_report(){
		if(isset($_POST['submit'])){
			$chkin_details	   = $this->input->post();
			$data['chkin_rep'] = $this->Check_Break_Report->ck_in_report($chkin_details);
			$this->load->view('checkin_report',$data);
		}
		else{
			$this->load->view('checkin_report');
		}
	}

	public function break_report(){
		if(isset($_POST['submit'])){
			$brkin_details	   = $this->input->post();
			$data['brkin_rep'] = $this->Check_Break_Report->bk_in_report($brkin_details);
			$this->load->view('breakin_report',$data);
		}
		else{
			$this->load->view('breakin_report');
		}
	}

	public function employee_details()
	{
		$this->load->view('header');
		$this->load->view('emp_details_report', $data);
	}

	 public function get_emp_reports()
	 {
			$draw = intval($this->input->get("draw"));
			$start = intval($this->input->get("start"));
			$length = intval($this->input->get("length"));

			$query = $this->db->get("emp_personal_details");
			$data = [];
			foreach($query->result() as $r) {
				$data[] = array(
					$r->Emp_id,
					$r->Emp_name,
					$r->Current_Address1,
					$r->Current_Address2,
					$r->Current_Landmark,
					$r->Current_City,
					$r->Current_Pincode,
					$r->Perm_Address1,
					$r->Perm_Address2,
					$r->Perm_Landmark,
					$r->Perm_City,
					$r->Perm_Pincode,
					$r->Contact_phone,
					$r->Personal_Email,
					$r->DOB,
					$r->MarriedUnMarried,
					$r->No_of_Child,
					($r->Anniversary == "1970-01-01") ? 'Not Updated' : $r->Anniversary,
					$r->Emergency_Contact,
					$r->Bloodgroup,
					$r->Transportation,
					$r->Route,
					$r->currentTeam,
					$r->designation,
					$r->probationPeriod,
					($r->probationEnd == "1970-01-01") ? 'Not Updated' : $r->probationEnd,
					($r->joiningDate == "1970-01-01") ? 'Not Updated' : $r->joiningDate,
					($r->termDate  == "1970-01-01") ? 'Not Updated' : $r->termDate,
					($r->resume) ? '<span class="text-success">Uploaded</span>' : '<span class="text-danger">Not Uploaded</span>',
					($r->insurance) ? '<span class="text-success">Uploaded</span>' : '<span class="text-danger">Not Uploaded</span>',
					($r->aadhar) ? '<span class="text-success">Uploaded</span>' : '<span class="text-danger">Not Uploaded</span>',
					($r->pan) ? '<span class="text-success">Uploaded</span>' : '<span class="text-danger">Not Uploaded</span>',
				);
			}

			$result = array(
							 "draw" => $draw,
								 "recordsTotal" => $query->num_rows(),
								 "recordsFiltered" => $query->num_rows(),
								 "data" => $data
						);
			echo json_encode($result);
			exit();
	 }
}

?>
