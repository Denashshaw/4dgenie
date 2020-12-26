<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class empinfoControl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("empdetailsModel");
		$this->load->model("Mainmodel");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function index(){
 		$search_text = "";
		if($this->input->post('search') != NULL){
		 $search_text = $this->input->post('empSearch');
		 $this->session->set_userdata(array("search"=>$search_text));
	 	}
		 else{
			 if($this->session->userdata('search') != NULL){
				 $search_text = $this->session->userdata('search');
			 }
		 }

		$data['search'] = $search_text;

		$data["allcnt"] = count($this->empdetailsModel->countrows($data['search']));

		$config = array();
		$config["base_url"]    = base_url() . "empinfoControl/index";
		$config["total_rows"]  = $data["allcnt"];
		$config["per_page"]    = 10;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page=$this->uri->segment(3);
		}else{
			$page=0;
		}

		$data['emp_list']=$this->empdetailsModel->getEmplist($data['search'],$config["per_page"],$page);

		$data["links"]  = $this->pagination->create_links();
		$data['emp_data']   = $this->empdetailsModel->agentdata();
		$data['prescreening']   = $this->empdetailsModel->getempprescreening();
		$this->load->view('emp_information',$data);
	}

	public function addEmp(){
		$insertstatus = $this->empdetailsModel->addDetails($_POST);
		redirect('empinfoControl/index');

	}
	public function DeleteEmpPersonal(){
		$insertstatus = $this->empdetailsModel->removeDetails($_GET);
		redirect('empinfoControl/index');
	}

	public function getuserdetials(){
		$getuserdet = $this->empdetailsModel->getDetails($_POST);
		echo json_encode($getuserdet);
	}

	public function updateEmp(){
		$insertstatus = $this->empdetailsModel->updateDetails($_POST);
		redirect('empinfoControl/index');
	}

	public function export(){
		if($_POST['excel']){
			$fieldname=implode(",",$_POST['fields']);
			$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
				$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
				$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
				$f=$_POST['fields'];
				$columnHeader="Emp ID" . "\t" . "Emp Name" . "\t" ;
				for($i=0;$i< sizeof($f);$i++){
					$columnHeader += printf($f[$i] ."\t");
				}

	    	$setData = '';
	    	foreach ($report_query->result_array() as $row) {
	        $rowData = '';
	        foreach ($row as $value) {
	          $value = '"' . $value . '"' . "\t";
	          $rowData .= $value;
	        }
	        $setData .= trim($rowData) . "\n";
	      }
				$filename= 'EmployeeInformation_Reoprt.xls';
	      header("Content-type: application/octet-stream");
	      header("Content-Disposition: attachment; filename=$filename");
	      header("Pragma: no-cache");
	      header("Expires: 0");
	     	echo ucwords($columnHeader) . "\n" . $setData . "\n";
			}
			if($_POST['approve']){
				$fieldname=implode(",",$_POST['fields']);
				$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
				$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
				$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
				$count=sizeof($_POST['fields'])-4;

				$reshtml='';
				$date =date('d-m-Y');
				$f=$_POST['fields'];

					$reshtml .= '<br><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;">
					<tr style="border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;"><th colspan="4"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="10" style="font-size:16px;text-align:center"><br>Employee Information</th><th colspan="4" style="text-align:right">'.$date.'</th></tr></thead></table><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr  style="border: 1px solid gray;">';
			//	$columnHeader="";

				for($i=0;$i< sizeof($f);$i++){
					$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">'.str_replace("_"," ",$f[$i]) .'</th>');
				}

				$reshtml .='</tr>	</thead><tbody style="font-size:8px;">';

					foreach (	$report_query->result_array() as $row) {
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
	 			$pdf->SetTitle('Employee Information');
	 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
 				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	 			$pdf->SetDisplayMode('real', 'default');
				 if(sizeof($_POST['fields']) > 8){
					 $pdf->AddPage('L');
				 }else{
					 $pdf->AddPage();
				 }

	 		 	$pdf->writeHTML($reshtml, true, 0, true, 0);
	 			$pdf->Output('EmpInformation.pdf', 'I');
			}
		}

		public function exportpreview(){

			$fieldname=implode(",",$_POST['fields']);
			$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
			$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
			$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
			$count=sizeof($_POST['fields'])-4;


			$date =date('d-m-Y');
			$f=$_POST['fields'];
				$setData ='';
				$setData .= "<div style='overflow-x: auto;overflow-y: auto;'><table  style='border: 1px solid black;font-size:10px;' >	<thead  style='border: 1px solid black;''>
				<tr style='border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;'><th colspan='2'><img src='".base_url()."img/logo.jpg' style='width:60%;height:70%;align:right'></th><th colspan='$count' style='font-size:25px;text-align:center'>Employee Information</th><th colspan='2' style='text-align:right'>$date</th></tr>
				<tr  style='border: 1px solid black;'>";
		//	$columnHeader="";

			for($i=0;$i< sizeof($f);$i++){
				$setData .= trim("<th style='border: 1px solid black;'>".$f[$i] ."</th>");
			}

			$setData .="</tr>	</thead><tbody>";

    	foreach ($report_query->result_array() as $row) {
        $rowData = '<tr style="border: 1px solid black;">';
        foreach ($row as $value) {
          $value = '<td  style="border: 1px solid black;">' . $value . '</td>' ;
          $rowData .= $value;
        }
        $setData .= $rowData . "</tr>";
      }

			$setData .= "</tbody></table></div>";
     	echo $setData;

		}

		public function get_social_links_data(){
			$get_social_data = $this->empdetailsModel->get_social_links_data();
			echo json_encode($get_social_data);
		}
	
		public function update_social_links_data(){
			return $this->empdetailsModel->update_social_links_data();			 
		}
	
		public function get_emp_department(){
			$emp_client_data = $this->empdetailsModel->get_emp_department();
			echo json_encode($emp_client_data);
		}
	
		public function get_all_clients(){
			$get_all_clients = $this->empdetailsModel->get_all_clients();
			echo json_encode($get_all_clients);
		}
	
		public function get_all_departs(){
			$get_all_departs = $this->empdetailsModel->get_all_departs();
			echo json_encode($get_all_departs);
		}
	
		public function add_transfer_data(){
			$add_transfer_data = $this->empdetailsModel->add_transfer_data();
			echo json_encode($add_transfer_data);
		}
	
		public function transfer_emp_list(){
			$transfer_emp_list = $this->empdetailsModel->get_all_transfer_data();
			echo json_encode($transfer_emp_list);
		}
	
		public function get_trans_emp(){
			$get_trans_emp =  $this->empdetailsModel->get_trans_emp();
			echo json_encode($get_trans_emp);
		}
	
		public function del_trans_emp()
		{
			$del_trans_emp = $this->empdetailsModel->del_trans_emp();
			return $del_trans_emp;
		}
}
?>
