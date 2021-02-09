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
        $question_array[$index]=array("question"=>$datasetres[0]->question,"correct_answer"=>$datasetres[0]->$answer,"candidate_answer"=>$datasetres[0]->$cand_answer,"correst"=>$setcorrect);
      }else{
            $question_array[$index]=array("question"=>$datasetres[0]->question,"correct_answer"=>$datasetres[0]->$answer,"candidate_answer"=>'-',"correst"=>$setcorrect);
      }
      $index++;
    }


  return  $question_array;
  }
 }

 ?>
