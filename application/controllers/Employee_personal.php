<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Employee_personal extends CI_Controller {

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
		$getuserdet = $this->empdetailsModel->gettableemp('emp_personal_details',$_POST);
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



		//Emp Education

		public function geteducationdetials(){
			$getedu = $this->empdetailsModel->gettableemp('emp_education',$_POST);
			echo json_encode($getedu);
		}

		public function addeducation(){
			// $dataset=[];
			// 	$delete_query = $this->db->query("DELETE FROM emp_education WHERE Emp_id='".$_POST['Emp_id'][0]."'");
			// $getcount=count($_POST['Emp_id']);
			//  for($i=0;$i<$getcount;$i++) {
			// 	 array_push($dataset,array("Emp_id"=>$_POST['Emp_id'][$i],"Emp_name"=>$_POST['Emp_name'][$i],"University"=>$_POST['University'][$i],"Course"=>$_POST['Course'][$i],"Year"=>$_POST['Year'][$i],"Score"=>$_POST['Score'][$i],"created_date"=> date('Y-m-d H:i:s')));
		 	// }
			// $insertstatus = $this->empdetailsModel->bulkinsert('emp_education',$dataset);
			$config['upload_path'] = './documents/education/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png|doc|pdf';
			$config['max_size']     = '1200';
			$this->load->library('upload', $config);
			if($_POST['userid']){
				$splitid = explode("/",$_POST['userid']);
			}else{
				$splitid = explode("/",$_POST['useridempagent']);
			}
			$dataset = array(
				"Emp_id" => $splitid[0],
				"Emp_name" => $splitid[1],
				"University1" => $_POST['empSchooluniver1'],
				"Course1" => $_POST['empCourse1'],
				"Percentage1" => $_POST['empPercen1'],
				"StartYear1" => $_POST['empstartdate1'],
				"EndYear1" => $_POST['empenddate1'],
				//"Doc1" => $_POST['empDocument1'],
				"University2" => $_POST['empSchooluniver2'],
				"Course2" => $_POST['empCourse2'],
				"Percentage2" => $_POST['empPercen2'],
				"StartYear2" => $_POST['empstartdate2'],
				"EndYear2" => $_POST['empenddate2'],
				//"Doc2" => $_POST['empDocument2'],
				"University3" => $_POST['empSchooluniver3'],
				"Course3" => $_POST['empCourse3'],
				"Percentage3" => $_POST['empPercen3'],
				"StartYear3" => $_POST['empstartdate3'],
				"EndYear3" => $_POST['empenddate3'],
				//"Doc3" => $_POST['empDocument3'],
				"University4" => $_POST['empSchooluniver4'],
				"Course4" => $_POST['empCourse4'],
				"Percentage4" => $_POST['empPercen4'],
				"StartYear4" => $_POST['empstartdate4'],
				"EndYear4" => $_POST['empenddate4'],
			//	"Doc4" => $_POST['empDocument4'],
				"University5" => $_POST['empSchooluniver5'],
				"Course5" => $_POST['empCourse5'],
				"Percentage5" => $_POST['empPercen5'],
				"StartYear5" => $_POST['empstartdate5'],
				"EndYear5" => $_POST['empenddate5'],
			//	"Doc5" => $_POST['empDocument5']
				"Institute" =>  $_POST['empSchooluniverOther1'],
				"Other_Course1" =>  $_POST['empCourseOther1'],
				"Other_Percentage1" =>  $_POST['empPercenOther1'],
				"Other_startyr1" =>  $_POST['empstartdateOther1'],
				"Other_endyr1" =>  $_POST['empenddateOther1'],
				"Other_Institute2" =>  $_POST['empSchooluniverOther2'],
				"Other_Course2" =>  $_POST['empCourseOther2'],
				"Other_Percentage2" =>  $_POST['empPercenOther2'],
				"Other_startyr2" =>  $_POST['empstartdateOther2'],
				"Other_endyr2" =>  $_POST['empenddateOther2'],
			);
			
			if ( $this->upload->do_upload('empDocument1')){
				$dataset['Doc1'] = $this->upload->data('file_name');
			}
			if ( $this->upload->do_upload('empDocument2')){
				$dataset['Doc2'] = $this->upload->data('file_name');
			}
			if ( $this->upload->do_upload('empDocument3')){
				$dataset['Doc3'] = $this->upload->data('file_name');
			}
			if ( $this->upload->do_upload('empDocument4')){
				$dataset['Doc4'] = $this->upload->data('file_name');
			}
			if ( $this->upload->do_upload('empDocument5')){
				$dataset['Doc5'] = $this->upload->data('file_name');
			}

			if ( $this->upload->do_upload('empDocumentOther1')){
				$dataset['Other_doc1'] = $this->upload->data('file_name');
			}
			if ( $this->upload->do_upload('empDocumentOther2')){
				$dataset['Other_doc2'] = $this->upload->data('file_name');
			}
		
			$empid =$splitid[0];

			$finduserid = $this->db->select('*')->from('emp_education')->where('Emp_id',$empid)->get()->result();
			if(count($finduserid) > 0){
				$updateVal = $this->db->where('Emp_id', $empid)->update('emp_education',$dataset);
					 if($updateVal){
	
						$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
					 }else{
						$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
					 }
		 }
		 else{
			$insertVal = $this->db->insert('emp_education',$dataset);
			if($insertVal){

				 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
			}else{
					$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');

			}
		}
			redirect('empinfoControl');
		}

		public function getempEducationdetails(){
			$getedu = $this->empdetailsModel->gettableemp('emp_education',$_POST);
			echo json_encode($getedu);
		}

//Family details

		public function getfamilydetials(){
			$getfml = $this->empdetailsModel->gettableemp('emp_family',$_POST);
			echo json_encode($getfml);
		}
		public function addfamily(){
			$dataset=[];
			$delete_query = $this->db->query("DELETE FROM emp_family WHERE Emp_id='".$_POST['Emp_id'][0]."'");
			$getcount=count($_POST['Emp_id']);
			 for($i=0;$i<$getcount;$i++) {
				 array_push($dataset,array("Emp_id"=>$_POST['Emp_id'][$i],"Emp_name"=>$_POST['Emp_name'][$i],"Relationship"=>$_POST['relation'][$i],"Name"=>$_POST['name'][$i],"Contact"=>$_POST['contact'][$i],"created_date"=> date('Y-m-d H:i:s')));
			}
			$insertstatus = $this->empdetailsModel->bulkinsert('emp_family',$dataset);

			echo json_encode($insertstatus);

		}

//exp Details

	public function getexpdetials(){
		$getexp = $this->empdetailsModel->gettableemp('emp_experience',$_POST);
		echo json_encode($getexp);
	}

	public function addworkexpenice(){
		$config['upload_path'] = './documents/professional_experience/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png|doc|pdf';
		$config['max_size']     = '1200';
		$this->load->library('upload', $config);
		if($_POST['userid']){
			$splitid = explode("/",$_POST['userid']);
		}else{
			$splitid = explode("/",$_POST['useridempagent']);
		}
		$dataset = array(
			"Emp_id" => $splitid[0],
			"Emp_name" => $splitid[1],
			"organization1" => $_POST['preCompany1'],
			"process1" => $_POST['process1'],
			"doj1" => date("Y-m-d", strtotime($_POST['joiningdate1'])),
			"termdate1" => date("Y-m-d", strtotime($_POST['termdate1'])),
			"organization2" => $_POST['preCompany2'],
			"process2" => $_POST['process2'],
			"doj2" => date("Y-m-d", strtotime($_POST['joiningdate2'])),
			"termdate2" => date("Y-m-d", strtotime($_POST['termdate2'])),
			"organization3" => $_POST['preCompany3'],
			"process3" => $_POST['process3'],
			"doj3" => date("Y-m-d", strtotime($_POST['joiningdate3'])),
			"termdate3" => date("Y-m-d", strtotime($_POST['termdate3'])),
		);
		
		if ( $this->upload->do_upload('expcertificate1')){
			$dataset['Doc1'] = $this->upload->data('file_name');
		}
		if ( $this->upload->do_upload('expcertificate2')){
			$dataset['Doc2'] = $this->upload->data('file_name');
		}
		if ( $this->upload->do_upload('expcertificate3')){
			$dataset['Doc3'] = $this->upload->data('file_name');
		}
	
		$empid =$splitid[0];

		$finduserid = $this->db->select('*')->from('emp_experience')->where('Emp_id',$empid)->get()->result();
		if(count($finduserid) > 0){
			$updateVal = $this->db->where('Emp_id', $empid)->update('emp_experience',$dataset);
				 if($updateVal){

						$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
				 }else{
						 $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');

				 }
	 }
	 else{
		$insertVal = $this->db->insert('emp_experience',$dataset);
		if($insertVal){
			 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
		}else{
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');

		}
	}
		redirect('empinfoControl');
	}


	// pre-screening 

	public function addprescreening(){
		$config['upload_path'] = './documents/prescreening/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png|doc|pdf';
		$config['max_size']     = '1200';
		$this->load->library('upload', $config);

		$splitRefname = explode("/",$_POST['userid']);
		$dataset = array(
			"Temp_id" => uniqid(),
			"Name" => $_POST['interviewempname'],
			"Phone" => $_POST['interPhone'],
			"Emailid" => $_POST['emailid'],
			"Source" => $_POST['interSource'],
			"Ref_id" => $splitRefname[0],
			"Ref_name" => $splitRefname[1],
			"Interviewed_for_Process" => $_POST['interviewedforprocess'],
			"Interviewed_byHR" => $_POST['useridinterviewedHR'],
			"Interdate" => $_POST['interdate'],
			"HRStatus" => $_POST['selecthrstatus'],
			"Interviewed1" => $_POST['useridinterviewed1'],
			"Status1" => $_POST['selecthrstatus1'],
			"InterviewDate1" => $_POST['interdate1'],
			"Feedback1" => $_POST['feedback1'],
			"Interviewed2" => $_POST['useridinterviewed2'],
			"Status2" => $_POST['selecthrstatus2'],
			"InterviewDate2" => $_POST['interdate2'],
			"Feedback2" => $_POST['feedback2'],
		);
		
		if ( $this->upload->do_upload('emp_photo')){
			$dataset['emp_photo'] = $this->upload->data('file_name');
		}
		if ( $this->upload->do_upload('resume')){
			$dataset['resume'] = $this->upload->data('file_name');
		}
		if ( $this->upload->do_upload('aadhar')){
			$dataset['aadhar'] = $this->upload->data('file_name');
		}
		if ( $this->upload->do_upload('pan')){
			$dataset['pan'] = $this->upload->data('file_name');
		}

		$dataset['created_date'] = date('Y-m-d H:i:s');
		$insertVal = $this->db->insert('emp_prescreening',$dataset);
		if($insertVal){
			 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
		}else{
				$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
		}
		redirect('empinfoControl');
	}
	//management insert
	public function getmandetials(){
		$getexp = $this->empdetailsModel->gettableemp('emp_management',$_POST);
		echo json_encode($getexp);
	}

		public function  addmanagement(){
			$dataset = array(
				"Emp_id" => $_POST['empidmana'],
				"Emp_name" => $_POST['empnameman'],
				"Work_email" => $_POST['workemail'],
			  "Process" =>$_POST['process'],
				"Designation" => $_POST['designation'],
			  "Exp_in_MB" =>$_POST['expinMB'],
			 	"First_MB_Employer" =>$_POST['firstMBEmployee'],
			  "Start_Date_WithFirst_MB_Employer" =>$_POST['StartDate_FirstMB'],
			  "Other_Past_MB_Employers" =>$_POST['OtherPastMB'],
			  "MB_Softwares_Worked_On" =>  implode(",",$_POST['MBSoftwareon']),
			 	"MB_Specialties_Worked_On" =>  implode(",",$_POST['MBSpecial']),
			 	"MB_Processed_Worked_On" =>$_POST['MBProcessWork'],
			  "LinkedIn" =>$_POST['Linkedin'],
			  "Facebook" =>$_POST['Facebookid']
			);
			$empid=$_POST['empidmana'];
			$finduserid = $this->db->select('*')->from('emp_management')->where('Emp_id',$empid)->get()->result();
			if(count($finduserid) > 0){
				 $dataset['updated_date'] = date('Y-m-d H:i:s');
				 $updateVal = $this->db->where('Emp_id', $empid)->update('emp_management',$dataset);
					if($updateVal){
						$this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
					}else{
						$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
					}
			}
			else{
				$dataset['created_date'] = date('Y-m-d H:i:s');
					$insertVal = $this->db->insert('emp_management',$dataset);
						if($insertVal){

							 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
						}else{
								$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');

						}

			}
			redirect('Employee_personal/index');
		}
}
?>
