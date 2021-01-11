<?php
class reportingModal extends CI_Model
{
  function allagentdata(){
  //  $agentlist = $this->db->query("SELECT * FROM users WHERE role!='admin' and emp_id not in(SELECT emp_id from emp_separation_managers)");
  $agentlist = $this->db->query("SELECT * FROM users WHERE role!='admin' and department!='MANAGEMENT'");
    return $agentlist->result();
  }

  function managerdata(){
    $managerlist = $this->db->query("SELECT * FROM users WHERE role='supervisor'");
    return $managerlist->result();
  }

  function bulkadd($dataset){
    $insertVal = $this->db->insert_batch('emp_separation_managers',$dataset);
    if($insertVal){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    }else{
        $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    }
  }

  function getreportingdetails(){
    $agentlist = $this->db->query("SELECT GROUP_CONCAT(`emp_id`,'/',agent_name SEPARATOR ',') as agent,manager_id,reporting_manager FROM `emp_separation_managers` GROUP by `manager_id`");
    return $agentlist->result();
  }
}
