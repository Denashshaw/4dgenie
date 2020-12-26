<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Ticket extends CI_Controller {

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
        $this->load->view('emp_ticket',$data);
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

    public function getticket_agent(){
        $rpt = $this->TicketingModel->complaintretila($_POST['uid']);
    }
}
?>
