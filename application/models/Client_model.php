<?php
 class Client_model extends CI_Model
 {

	public function add_client_data($client){
		$this->db->insert_batch('client',$client);
        $this->session->set_flashdata('msg','<p style="color:green;font-size:16px;margin-top:2%;margin-left:3.2%;">Client Added Successfully!');
        redirect('client/add_client');
	}
  public function update_client($old,$new){
    $update=$this->db->query("UPDATE client SET client='".$new."' WHERE client='".$old."'");
    if($update){ return true;}
   else{ return false;}
  }
	public function client_data(){
		$dep = $this->db->query("SELECT * FROM client ORDER BY client asc");
		return $dep->result();
	}
  public function unlikeclient_data(){
    $res = $this->db->query("SELECT * FROM hideclient");
    return $res->result();
  }

  public function deact($data){
    $userdata=$this->session->all_userdata();
    $role=$userdata['role'];
    $client=$data['client'];
    $key=$data['key'];

    $res = $this->db->query("Delete FROM client WHERE client='".$client."' AND keyword='".$key."'");

    $res1 = $this->db->query("Insert into hideclient(client,keyword,created_date,created_by) values('".$client."','".$key."','".date('Y-m-d H:i:s')."','".$role."')");

  }

  public function act($data){
    $userdata=$this->session->all_userdata();
    $role=$userdata['role'];
    $client=$data['client'];
    $key=$data['key'];

    $res = $this->db->query("Delete FROM hideclient WHERE client='".$client."' AND keyword='".$key."'");

    $res1 = $this->db->query("Insert into client(client,keyword,created_date,created_by) values('".$client."','".$key."','".date('Y-m-d H:i:s')."','".$role."')");

  }
	public function initial_add($uqid)
	{
		$initial_add_data = array(
			'name'   => $_POST['pre_name'],
			'mobile' => $_POST['pre_mobile'],
			'email'  => $_POST['pre_email'],
      'temp_id' => $uqid
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

  //jagan
  public function getdata($table,$id){
    if($id == 'all'){
      $dt = $this->db->query("SELECT * FROM $table");
    }else{
      $dt = $this->db->query("SELECT * FROM $table WHERE id=$id");
    }

    return $dt->result();
  }

  public function getothersdata($table,$id){
    $dt = $this->db->query("SELECT * FROM $table where temp_id='$id'");
    return $dt->result();
  }

  public function updatestatus($table){
    $tid=$_GET['temp_id'];
    $st=$_GET['status'];
    $this->db->query("UPDATE $table SET status=$st where temp_id='$tid'");
  }

  public function getothersdata_test($table,$id){
    $dt = $this->db->query("SELECT * FROM $table where temp_id='$id'");
    $data=$dt->result();
    $question_array=array();
    $questions = explode(",",$data[0]->questions);
    $candidateanswer = explode(",",$data[0]->candidate_answer);
    $index=0;
    $correct=0;$wrong=0;

    foreach($questions as $q){
      $dt = $this->db->query("SELECT * FROM interviewtest where id=$q");
      $datasetres=$dt->result();

      $answer =$datasetres[0]->answer;

      $cand_answer =  $candidateanswer[$index];
      if($cand_answer!='' && $answer == $cand_answer){
        $setcorrect=1;
      }else{
        $setcorrect=0;
      }

      if($cand_answer!=''){
        $question_array[$index]=array("question"=>$datasetres[0]->question,"correct_answer"=>$datasetres[0]->answer,"candidate_answer"=>$cand_answer,"correst"=>$setcorrect);
      }else{
            $question_array[$index]=array("question"=>$datasetres[0]->question,"correct_answer"=>$datasetres[0]->answer,"candidate_answer"=>'-',"correst"=>$setcorrect);
      }


      $index++;
    }


  return  $question_array;
  }

  // denash shaw code start

   public function insert_task()
   {
     $department = $this->input->post('department');
     $deprt_res = $this->db->select('id')->from('department')->where('department', $department)->get()->row();

     if ($_SESSION['department'] == 'MANAGEMENT') {
       $result = $this->db->select('id')->from('department')->where('department', $_SESSION['sub_department'])->get()->row();
       $insert_arr = array(
         'task' => $this->input->post('task_val'),
         'task_type' => $this->input->post('task_type'),
         'department' => $result->id
       );
     } else {
       $insert_arr = array(
         'task' => $this->input->post('task_val'),
         'task_type' => $this->input->post('task_type'),
         'department' => $deprt_res->id
       );
     }
     return $this->db->insert("client_task", $insert_arr);
   }

   public function get_task_data()
   {

     $this->db->select('id')->from('department');
     if ($_SESSION['department'] == 'MANAGEMENT') {
       $deprt_res = $this->db->where('department', $_SESSION['sub_department'])->get()->row();
     } else {
       $deprt_res = $this->db->where('department', $_SESSION['department'])->get()->row();
     }
     return $this->db->select('id, task')->from('client_task')->where('department', $deprt_res->id)->get()->result_array();
   }

   public function insert_subtask_data()
   {
     $insert_arr = array(
       'task_id' => $_POST['subtask_task'],
       'sub_task' => $_POST['sub_task_val']
     );
     return $this->db->insert('client_sub_task', $insert_arr);
   }

   public function get_client_data()
   {
     $multi_client = $_SESSION['client'];
     $client_arr = explode(',', $multi_client);
     $client_val = [];
     $i = 0;
     foreach ($client_arr as $client) {
       $res = $this->db->select('id, client')->from('client')->where('client', $client)->get()->row();

       if ($res) {
         $client_val[$i++] = $res;
       }
     }

     return $client_val;
   }

   public function get_sub_task_val()
   {
     return $this->db->select('id, sub_task')->from('client_sub_task')->where('task_id', $_POST['target_task_tab'])->get()->result();
   }

   public function get_agents_for_user()
   {
     return $this->db->select("CONCAT(emp_id, '/', agent_name) as id, CONCAT(emp_id, '/', agent_name) as text")->from('emp_separation_managers')->where('manager_id', $_SESSION['emp_id'])->get()->result();
   }

   public function insert_target_details()
   {
     $split_client = $_POST['multiple_agent'];
     foreach ($split_client as $key => $value) {
       $splitemp = explode("/", $value);
       $agent_id = $splitemp[0];
       $agent_name = $splitemp[1];
       $insert_arr = array(
         'client' => $_POST['client_drop'],
         'task' => $_POST['target_task_tab'],
         'sub_task' => $_POST['target_subtask'],
         'agent_id' => $agent_id,
         'agent_name' => $agent_name,
         'created_by' => $_SESSION['name'],
         'agent_name' => $agent_name,
         'target_value' => $_POST['target_val'],
       );
       $this->db->insert('client_target', $insert_arr);
     }

     return $this->db->insert_id();
   }

   public function generate_task_table()
   {
     $this->db->select('client_task.id,client_task.*')->from('client_task')->join('department', 'department.id = client_task.department');
     if ($_SESSION['department'] == 'MANAGEMENT') {
       return $this->db->where('department.department', $_SESSION['sub_department'])->get()->result();
     } else {
       return $this->db->where('department.department', $_SESSION['department'])->get()->result();
     }
   }

   public function delete_task()
   {
     return $this->db->where('id', $_POST['task_id'])->delete('client_task');
   }

   public function generate_subtask_table()
   {
     $this->db->select('client_task.task, client_sub_task.sub_task, client_sub_task.id')->from('client_task')
       ->join('client_sub_task', 'client_sub_task.task_id = client_task.id')
       ->join('department', 'department.id = client_task.department');
     if ($_SESSION['department'] == 'MANAGEMENT') {
       return $this->db->where('department.department', $_SESSION['sub_department'])->get()->result();
     } else {
       return $this->db->where('department.department', $_SESSION['department'])->get()->result();
     }
   }

   public function delete_sub_task()
   {
     return $this->db->where('id', $_POST['sub_task_id'])->delete('client_sub_task');
   }

   public function get_task_setup_table()
   {
     return $this->db->select('client_target.agent_id, client_target.agent_name,client_target.created_by,client_target.updated_by , client_target.id')->from('client_target')
       ->join('client_task', 'client_task.id = client_target.task', 'left')
       ->join('client_sub_task', 'client_sub_task.id = client_target.sub_task', 'left')
       ->join('client', 'client.id = client_target.client', 'left')
       ->join('department', 'department.id = client_task.department', 'left')
       ->where('department.department', $_SESSION['department'])
       ->group_by('client_target.agent_id')
       ->get()->result();
   }

   public function delete_target_data()
   {
     return $this->db->where('id', $_POST['target_id'])->delete('client_target');
   }

   /*   public function edit_task_data()
   {
     return $this->db->select('*')->from('client_task')->where('id', $_POST['task_id'])->get()->row();
   } */

   public function task_modal_submit()
   {
     $update_arr = array(
       'task' => $_POST['task_popup']
     );
     return $this->db->where('id', $_POST['task_edit_id'])->update('client_task', $update_arr);
   }


   public function edit_sub_task_data()
   {
     return $this->db->select('*')->from('client_sub_task')->where('id', $_POST['task_id'])->get()->row();
   }

   public function sub_task_modal_submit()
   {
     $update_arr = array(
       'sub_task' => $_POST['sub_task_popup']
     );
     return $this->db->where('id', $_POST['sub_task_edit_id'])->update('client_sub_task', $update_arr);
   }

   public function get_view_target_data()
   {
     //return $this->db->select('*')->from('client_target')->where('agent_id', $_POST['agent_id'])->get()->result();
     return $this->db->select('client_target.agent_id, client_task.task, client_sub_task.sub_task , client_target.id, client.client, client_target.target_value')->from('client_target')
       ->join('client_task', 'client_task.id = client_target.task', 'left')
       ->join('client_sub_task', 'client_sub_task.id = client_target.sub_task', 'left')
       ->join('client', 'client.id = client_target.client', 'left')
       ->join('department', 'department.id = client_task.department', 'left')
       ->where('department.department', $_SESSION['department'])
       ->where('agent_id', $_POST['agent_id'])
       ->where('client_target.client', $_POST['client_id'])->get()->result();
   }

   public function target_form_data()
   {
     $ans = [];
     $i = 0;
     foreach ($_POST as $param_name => $param_val) {
       // $matches = (int) filter_var($param_name, FILTER_SANITIZE_NUMBER_INT);
       $matches = preg_replace('/[^0-9]/', '', $param_name);
       $ans[$i]['id'] = $matches;
       $ans[$i]['target_value'] = $param_val;
       $ans[$i]['updated_by'] = $_SESSION['name'];
       $i++;
     }

     $this->db->update_batch('client_target', $ans, 'id');
   }

   // denash shaw code end

 }
?>
