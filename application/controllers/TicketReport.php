<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class TicketReport extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model("empdetailsModel");
       $this->load->model("TicketingModel");
        $this->load->library('session');
        $userdata=$this->session->all_userdata();
        if($userdata["hrms_logged_in"] != TRUE){
        redirect('login/index');
        }
    }

    public function index(){
        $data['emp_data']   = $this->empdetailsModel->agentdata();
        $this->load->view('emp_ticket_report',$data);
    }

    public function addticket(){
        $this->TicketingModel->insertticket($_POST);

        $userdetails = $_POST['uid'];
        $uid_split = explode("/",$userdetails);
        $empid=$uid_split[0];
        $name=$uid_split[1];
        $dskno = $_POST['deskno'];
        $issuetype = $_POST['issuetype'];
        $issue = $_POST['issueprb'];

        $subject = 'Desk No:'.$dskno.' - '.$issuetype;
        $message = '<p>Hi IT Team,<br>&nbsp;&nbsp;Please check my system problem, Below I have mentioned issue details<p><br><b>Issue Type: '.$issuetype.'</b><br><b>Issue Details: '.$issue.'</b><br><br>Regards,<br>'.$empid.' - '.$name;

        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
         $to = 'it@4dglobalinc.com';
        //$to ='v.jaganathan93@gmail.com';
        // $message = 'Hai jagan';
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function getreport(){
        $rpt = $this->TicketingModel->getreport($_POST);
        echo json_encode($rpt);
    }

    public function excelexport(){
		$columnHeader="Emp ID" . "\t" . "Emp Name" . "\t". "Desk No" . "\t". "Issue Type" . "\t". "Issue Details" . "\t". "Status" . "\t". "IT Remark" . "\t". "Complaint Date" . "\t"."Completed Date" . "\t". "Duriation" . "\t". "IT Person" ."\t";
	   	$setData = '';
        $rpt = $this->TicketingModel->getreport($_GET);
	  	foreach ($rpt as $row) {
			$rowData = '';
			$flag=True;
            foreach ($row as $value) {
				if($flag){$flag=False; continue;}
                $value = '"' . $value . '"' . "\t";
                $rowData .= $value;
            }
            $setData .= trim($rowData) . "\n";
        }
		$filename= 'ITHelp_Desk_Reoprt.xls';
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo ucwords($columnHeader) . "\n" . $setData . "\n";
			// if($_POST['approve']){
			//
	}
	public function pdfexport(){
		$report_query = $this->TicketingModel->getreport($_GET);
	//	$count=sizeof($_POST['fields'])-4;
		$reshtml='';
		$date =date('d-m-Y');
		$f=$_POST['fields'];
		$reshtml .= '<br><table  class="table table-responsive" style="align:Center;border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr style="border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;"><th colspan="4"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="10" style="font-size:16px;text-align:center"><br>Employee IT Help Desk</th><th colspan="4" style="text-align:right">'.$date.'</th></tr></thead></table><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr  style="border: 1px solid gray;">';

		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp ID</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Emp Name</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Desk No</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Issue Type</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Issue Details</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Status</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">IT Remark</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Complaint Date</th>');
		$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">Completed Date</th>');
		//	$columnHeader="";
		/*for($i=0;$i< sizeof($f);$i++){
			$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">'.str_replace("_"," ",$f[$i]) .'</th>');
		}*/
		$reshtml .='</tr>	</thead><tbody style="font-size:8px;">';
		foreach (	$report_query as $row) {
			$rowData = '<tr style="border: 1px solid gray;">';
			$flag=True;
		    foreach ($row as $value) {
			  if($flag){$flag=False; continue; }
		      $value = '<td  style="border: 1px solid gray;">' . $value . '</td>' ;
		      $rowData .= $value;
		    }
		    $reshtml .= $rowData . "</tr>";
		}
		$reshtml .='</tbody></table>';

		$this->load->library('Pdf');
	 	$pdf = new Pdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	 	$pdf->SetTitle('IT Help Desk Report');
	 	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	 	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	 	$pdf->SetDisplayMode('real', 'default');
		// if(sizeof($_POST['fields']) > 8){
		// 	$pdf->AddPage('L');
		// }else{

		// }
		$pdf->AddPage();
	  	$pdf->writeHTML($reshtml, true, 0, true, 0);
	 	$pdf->Output('IT Help Desk.pdf', 'I');
		// }
	}
}
?>
