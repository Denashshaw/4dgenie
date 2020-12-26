<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR);
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$userdata=$this->session->all_userdata();
		
		if($userdata["hrms_logged_in"] != TRUE){ 
		//redirect('Logindetails/login_details');
		 	redirect('login/index');
		} 
	}
	
	public function index()
	{
		$data['login_data'] = $this->Mainmodel->logindata();
		$data['emp_data']   = $this->Mainmodel->agentdata();
		$this->load->view('home',$data);
	}

	public function agentlist(){
		$data['agent_data']=$this->Mainmodel->agentdata();
		$this->load->view('agentlist',$data);
	}

	public function assign_break(){
		$this->load->view('assign_break');
	}
	
	public function get_user(){

		$department = $this->db->query("SELECT * FROM users WHERE role NOT IN ('admin','supervisor') and created_by = '".$_POST["department"]."'");
		$res_depart=$department->result();?>
			<option value="">Select Agent</option>
        <?php foreach($res_depart as $depart){?>
            <option value="<?php echo $depart->user_id;?>"><?php echo $depart->name;?></option>
        <?php }  
	}


	public function notfound(){
		$this->load->view('notfound');
	}

	public function bk_assign_status(){
        $result = $this->Mainmodel->ck_bk_assign_status();
        echo json_encode($result);
    }

    public function bk_modify_status(){
        $result = $this->Mainmodel->bk_modify_status();
        echo json_encode($result);
    }

}

?>