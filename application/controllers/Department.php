<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Department extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Department_model");
		$userdata=$this->session->all_userdata();
		
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		} 
	}
	
	public function add_department(){
		if(isset($_POST['dsubmit'])){
			$add_deparment=$this->input->post();
			$userdata = $this->session->all_userdata();
			$depart   = array();

			date_default_timezone_set('Asia/Kolkata');
			$time = date('Y-m-d H:i:s');
			
			for($i=0;$i<count($add_deparment['department']);$i++){
			 	$depart[] = array(
                	'department'   => $add_deparment['department'][$i],
                	'created_date' => $time,
                	'created_by'   => $userdata['name']
                );
			}
			$result=$this->Department_model->add_department_data($depart);
		}
		$data['depart_data']=$this->Department_model->department_data();
		$this->load->view('add_department',$data);
	}

	public function del_department(){
		$id=$this->uri->segment(3);
		if($id !=""){
			$this->db->where('id',$id);
			$this->db->delete('department');
			$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Department Deleted Successfully..! </p>');
			redirect('department/add_department');
		}
	}

}

?>