<?php  
 class Client_model extends CI_Model  
 {  

	public function add_client_data($client){
		$this->db->insert_batch('client',$client);  
        $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Added Successfully!');
        redirect('client/add_client');
	}

	public function client_data(){
		$dep = $this->db->query("SELECT * FROM client ORDER BY client asc");
		return $dep->result();
	}

	public function initial_add()
	{
		$initial_add_data = array(
			'name'   => $_POST['pre_name'],
			'mobile' => $_POST['pre_mobile'],
			'email'  => $_POST['pre_email'],
		);

		$this->db->insert('candidate_interview', $initial_add_data);
		return $this->db->insert_id();
	}

	public function get_interview_list()
	{
		return $this->db->select('*')->from('candidate_interview')->get()->result_array();
	}

	public function add_onboard_data()
	{
		$name = $this->input->post('name');
		$value = $this->input->post('value');
		$onboard_emp_id = $this->input->post('onboard_emp_id');

		$split_val = $_POST['value'];
		$split_res =  explode(';', $split_val);
		$status = $split_res[0];
		$action_required = $split_res[1];
		$preboarding = $split_res[2];
		$responsible = $split_res[3];


		$check_id=$this->db->select('*')->from('onboarding_emp')->where('emp_id',$onboard_emp_id)->where('keyword',$name)->get()->row();		

		if($check_id){
			$arayVal = array(
				'responsible' => $responsible,
				'person' => $_SESSION['name'],
				'person_id' => $_SESSION['emp_id'],
				'status'=> $status
			);

			$this->db->where('emp_id', $onboard_emp_id)->where('keyword',$name)->update('onboarding_emp', $arayVal);
			return $this->db->affected_rows();
		}else{	
			$arayVal = array(
				'emp_id' => $onboard_emp_id,
				'keyword' => $name,
				'preboarding' => $preboarding,
				'action_required' => $action_required,			
				'responsible' => $responsible,
				'person' => $_SESSION['name'],
				'person_id' => $_SESSION['emp_id'],
				'status'=> $status
			);

			$this->db->insert('onboarding_emp', $arayVal);
			return $this->db->insert_id();
		}
	}

	public function get_onboard_data()
	{
		$onboard_emp_id = $this->input->post('onboard_emp_id');
		return $this->db->select('*')->from('onboarding_emp')->where('emp_id', $onboard_emp_id)->get()->result_array();
	}
 }  

 ?>