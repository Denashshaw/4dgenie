<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Client extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Client_model");
		$userdata=$this->session->all_userdata();
		
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		} 
	}
	
	public function add_client(){
		if(isset($_POST['csubmit'])){
			$add_client=$this->input->post();
			$userdata = $this->session->all_userdata();
			$client   = array();

			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');
			
			for($i=0;$i<count($add_client['client']);$i++){
			 	$client[] = array(
                	'client'   => $add_client['client'][$i],
                	'created_date' => $time,
                	'created_by'   => $userdata['name']
                );
			}
			$result=$this->Client_model->add_client_data($client);
		}
		$data['client_data']=$this->Client_model->client_data();
		$this->load->view('add_client',$data);
	}

	public function del_client(){
		$id=$this->uri->segment(3);
		if($id !=""){
			$this->db->where('id',$id);
			$this->db->delete('client');
			$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Client Deleted Successfully..! </p>');
			redirect('client/add_client');
		}
	}

}

?>