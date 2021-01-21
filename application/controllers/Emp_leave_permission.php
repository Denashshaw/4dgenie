<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ERROR);
class Emp_leave_permission extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("empdetailsModel");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}
	public function index() {
		$data['emp_data']  = $this->empdetailsModel->agentdata();
		$this->load->view('header');
		$this->load->view('emp_leave_permission', $data);
	}

	public function emp_leave_add()
	{
		$insert_status = $this->empdetailsModel->emp_leave_add();
		echo $insert_status;
	}

	public function permission_data_save()
	{
		$insert_status = $this->empdetailsModel->permission_data_save();
		echo json_encode($insert_status);
	}

	public function get_managers_list()
	{
		$managers_list =  $this->empdetailsModel->get_managers_list();
		echo json_encode($managers_list);
	}

	public function emp_permission_list()
	{
		$permission_lists = $this->empdetailsModel->emp_permission_list();
		echo json_encode($permission_lists);
	}

	public function validate_approve_permission()
	{
		$vali_approv = $this->empdetailsModel->validate_approve_permission();
		echo json_encode($vali_approv);
	}

	public function check_permission_exists()
	{
		$check_per = $this->empdetailsModel->check_permission_exists();
		echo json_encode($check_per);
	}

	public function get_permission_count()
	{
		$permission_count = $this->empdetailsModel->get_permission_count();
		echo $permission_count;
	}

	public function emp_leave_list()
	{
		$get_leave_data = $this->empdetailsModel->get_emp_leave_list();
		echo json_encode($get_leave_data);
	}

	public function check_leave_emp()
	{
		$leave_type = $this->input->post('leave_type');
		$leave_result = $this->empdetailsModel->check_leave_emp();

		$response = array($leave_type => $leave_result);
		echo json_encode($response);
	}

	public function validate_approve_leave()
	{
		$leav_app_status = $this->empdetailsModel->validate_approve_leave();
		print_r($leav_app_status);
	}

	public function leavereport(){
		$data['getagentlist'] =  $this->empdetailsModel->getagentlist();
		$this->load->view('report/leave_report',$data);
	}

	public function getleavereport(){
		$userid=$_POST['useridemp'];
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$table = $_POST['leavetype'];
		$status = $_POST['status'];
		$res = $this->empdetailsModel->getleaverep($table,$userid,$fromdate,$todate,$status);
		echo json_encode($res);
	}
	public function leaveExcelexport(){
		if($_GET['leavetype'] == 'emp_leave_details'){
			$columnHeader="Emp ID" . "\t" . "Emp Name" . "\t". "Leave Start Date" . "\t". "Leave End Date" . "\t". "Total Days" . "\t". "Leave Type" . "\t". "Reason" . "\t". "Manager ID" . "\t"."Manager Name" . "\t". "Status";
			$filename= 'LeaveReport.xls';
		}else{
			$columnHeader="Emp ID" . "\t" . "Emp Name" . "\t". "Permission IN Hours" . "\t". "Reason" . "\t". "Manager ID" . "\t"."Manager Name" . "\t". "Status". "\t". "Permission Date";
			$filename= 'Permission.xls';
		}
			$setData = '';
			$rpt = $this->empdetailsModel->getleaverep_report($_GET['leavetype'],$_GET['useridemp'],$_GET['fromdate'],$_GET['todate'],$_GET['status']);
			foreach ($rpt as $row) {
			$rowData = '';
			foreach ($row as $value) {
								$value = '"' . $value . '"' . "\t";
								$rowData .= $value;
						}
						$setData .= trim($rowData) . "\n";
			}
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo ucwords($columnHeader) . "\n" . $setData . "\n";
	}

	public function leavePdfexport(){

		$reshtml='';
		$date=date('d-m-Y');
		$report_query = $this->empdetailsModel->getleaverep_report($_GET['leavetype'],$_GET['useridemp'],$_GET['fromdate'],$_GET['todate'],$_GET['status']);
		if($_GET['leavetype'] == 'emp_leave_details'){$printTitle='Employee Leave Report';}else{$printTitle='Employee Permission Details';}
		$reshtml .= '<br><table  class="table table-responsive" style="align:Center;border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr style="border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;"><th colspan="3"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="6" style="font-size:16px;text-align:center"><br>'.$printTitle.'</th><th colspan="1" style="text-align:right">'.$date.'</th></tr></thead></table><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr  style="border: 1px solid gray;">';

		if($_GET['leavetype'] == 'emp_leave_details'){
			$titleset='Employee Leave Report';
			$filename='EmpLeaveReport.pdf';

		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp ID</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp Name</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Leave Start Date</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Leave End Date</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Total Days</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Leave Type</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Reason</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Manager ID</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Manager Name</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Status</th>');

	}else{
		$titleset='Employee Permission Report';
		$filename='EmpPermissionReport.pdf';

		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp ID</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp Name</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Permission IN Hours</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Reason</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Manager ID</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Manager Name</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Status</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Permission Date</th>');
	}

		$reshtml .='</tr>	</thead><tbody style="font-size:8px;">';
		foreach (	$report_query as $row) {
			$rowData = '<tr style="border: 1px solid gray;">';
				foreach ($row as $value) {
					$value = '<td  style="border: 1px solid gray;">' . $value . '</td>' ;
					$rowData .= $value;
				}
				$reshtml .= $rowData . "</tr>";
		}
		$reshtml .='</tbody></table>';


		$this->load->library('Pdf');
		$pdf = new Pdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle($titleset);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$pdf->writeHTML($reshtml, true, 0, true, 0);
		$pdf->Output($filename, 'I');
	}
}
?>
