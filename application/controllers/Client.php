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
	//jagan start
	public function update_client(){
	$oldclientname=$this->input->post('clientnameold');
	$newclientname=$this->input->post('clientnamenew');
	$checkuser = $this->Client_model->update_client($oldclientname,$newclientname);
	if($checkuser){
		$this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Updated Successfully!');
	}
	$data['client_data']=$this->Client_model->client_data();
	$data['unlikeclient_data']=$this->Client_model->unlikeclient_data();
	$this->load->view('add_client',$data);
	}

		public function add_client(){
			if(isset($_POST['csubmit'])){
				$add_client=$this->input->post();
				$userdata = $this->session->all_userdata();
				$client   = array();

				date_default_timezone_set('Asia/Kolkata');
				$time = date('Y-m-d H:i:s');
				$data['client_data']=$this->Client_model->client_data();
				for($i=0;$i<count($add_client['client']);$i++){
					$checkuser = $this->Client_model->check_client($add_client['client'][$i]);

					if(count($checkuser) > 0){
						$this->session->set_flashdata('msg','<p style="color:red;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Name Already Exists!');
					}
					else{
						if(preg_match('/[^a-z0-9 _]+/i', $add_client['client'][$i])) {
							$this->session->set_flashdata('msg','<p style="color:red;font-size:16px;margin-top:2%;margin-left:3.2%;">Special Characters are not allowed!');
							redirect('add_client');
						}
						$clientname = $add_client['client'][$i];
						// $clientname = substr($add_client['client'][$i], 0, 2);
						// $uid = mt_rand(100000, 999999);

						$client[] = array(
										'client'   => $add_client['client'][$i],
										'created_date' => $time,
										'keyword' => str_replace(' ', '', strtolower($clientname)),
										'created_by'   => $userdata['name']
									 );
					}

				}

				if(count($client) > 0){
					$result=$this->Client_model->add_client_data($client);
					if($result){
						$this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Added Successfully!');
					}
				}

			}
			$data['client_data']=$this->Client_model->client_data();
			$data['unlikeclient_data']=$this->Client_model->unlikeclient_data();
			$this->load->view('add_client',$data);
		}
		//jagan end

		public function del_client(){
			$id=$this->uri->segment(3);
			if($id !=""){
				$this->db->where('id',$id);
				$this->db->delete('client');
				$this->session->set_flashdata('msg', '<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Client Deleted Successfully..! </p>');
				redirect('client/add_client');
			}
		}

		public function Deactivate(){
			$data=$this->Client_model->deact($_POST);
			echo json_encode([$res=>'1']);
				 exit;

		}

		public function Activate(){
			$data=$this->Client_model->act($_POST);
			echo json_encode([$res=>'1']);
				 exit;

		}


		// denash shaw code start
	public function client_target()
	{
		$data['target_data'] = $this->Client_model->get_task_setup_table();
		$this->load->view('client_target', $data);
	}

	public function insert_task()
	{
		$insert_status = $this->Client_model->insert_task();
		echo json_encode($insert_status);
	}

	public function get_task_data()
	{
		$data = $this->Client_model->get_task_data();
		echo json_encode($data);
	}

	public function insert_subtask_data()
	{
		$data = $this->Client_model->insert_subtask_data();
		echo json_encode($data);
	}

	public function get_client_data()
	{
		$data = $this->Client_model->get_client_data();
		echo json_encode($data);
	}
	public function get_sub_task_val()
	{
		$data = $this->Client_model->get_sub_task_val();
		echo json_encode($data);
	}

	public function get_agents_for_user()
	{
		$data = $this->Client_model->get_agents_for_user();
		echo json_encode($data);
	}

	public function insert_target_details()
	{
		$data = $this->Client_model->insert_target_details();
		echo json_encode($data);
	}

	public function generate_task_table()
	{
		$data = $this->Client_model->generate_task_table();
		echo json_encode($data);
	}

	public function delete_task()
	{
		$data = $this->Client_model->delete_task();
		echo json_encode($data);
	}

	public function generate_subtask_table()
	{
		$data = $this->Client_model->generate_subtask_table();
		echo json_encode($data);
	}

	public function delete_sub_task()
	{
		$data = $this->Client_model->delete_sub_task();
		echo json_encode($data);
	}

	/* public function get_task_setup_table()
	{
		$data = $this->Client_model->get_task_setup_table();
		echo json_encode($data);
	} */

	public function delete_target_data()
	{
		$data = $this->Client_model->delete_target_data();
		echo json_encode($data);
	}

	/* public function edit_task_data()
	{
		$data = $this->Client_model->edit_task_data();
		echo json_encode($data);
	} */

	public function task_modal_submit()
	{
		$data = $this->Client_model->task_modal_submit();
		echo json_encode($data);
	}

	public function edit_sub_task_data()
	{
		$data = $this->Client_model->edit_sub_task_data();
		echo json_encode($data);
	}

	public function sub_task_modal_submit()
	{
		$data = $this->Client_model->sub_task_modal_submit();
		echo json_encode($data);
	}

	public function get_view_target_data()
	{
		$data = $this->Client_model->get_view_target_data();
		echo json_encode($data);
	}

	public function target_form_data()
	{
		$data = $this->Client_model->target_form_data();
		echo json_encode($data);
	}

	// denash shaw code end

}

?>
