<?php
class separationModel extends CI_Model
{

public function agentdata_applied(){
  if($_SESSION['department'] == 'MANAGEMENT'){
    $query = $this->db->query("SELECT * FROM `emp_separation_managers` RIGHT JOIN emp_resignation_revoke er ON er.emp_id = emp_separation_managers.emp_id WHERE manager_id='".$_SESSION['emp_id']."' ");
  }else{
    $query = $this->db->query('select * from users where emp_id in (SELECT emp_id from emp_resignation_revoke) order by emp_id');
  }
  return $query->result();
}

  //Insert or update
  public function insertupdatedata($table,$id,$data){
    //$check_id = $this->db->query("SELECT * FROM $table where emp_id='$id'");
    if($_SESSION['role'] != 'agent'){
      $updateVal = $this->db->where('emp_id', $id)->update($table,$data);
      if($updateVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
      }
    }else{
      $insertVal = $this->db->insert($table,$data);
      if($insertVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
      }
    }
  }

  public function getentireuser($table,$data){
    $id=$data['userid'];
    $emp_doc=$this->db->query("SELECT * FROM $table where emp_id='$id'");
    echo json_encode($emp_doc->result());
  }
  public function getentireusername($table,$id){
    $emp_doc=$this->db->query("SELECT * FROM $table where emp_id='$id'");
    return $emp_doc->result();
  }

  //insert only
  public function insertonly($table,$id,$data){
    $insertVal = $this->db->insert($table,$data);
    if($insertVal){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    }else{
        $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    }
  }

  public function getallseparation(){
    $table = 'emp_resignation_revoke';
    if($_SESSION['department'] == 'MANAGEMENT'){
      $empdetatils=$this->db->query("SELECT a.*,b.name FROM $table as a left join users b on a.emp_id=b.emp_id Left JOIN emp_separation_managers er ON er.emp_id = a.emp_id WHERE er.manager_id='".$_SESSION['emp_id']."'");
    }else if($_SESSION['department'] == 'HR' && $_SESSION['role'] != 'agent'){
      $empdetatils=$this->db->query("SELECT a.*,b.name FROM $table as a left join users b on a.emp_id=b.emp_id");
    }else{
      $empdetatils=$this->db->query("SELECT a.*,b.name FROM $table as a left join users b on a.emp_id=b.emp_id where a.emp_id='".$_SESSION['emp_id']."'");
    }
    return $empdetatils->result();
  }
  //GET
  public function updatedata($table,$index,$data){
    $updateVal = $this->db->where('id', $index)->update($table,$data);
    if($updateVal){
       $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
    }else{
        $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
    }
  }

  public function getmanagermail(){
    $id=$_POST["emp_id1"];
    $getmanageremailid=$this->db->query("SELECT * from office_mailid where emp_id IN (SELECT manager_id from emp_separation_managers where emp_id='$id')");
    return $getmanageremailid->result();
  }

}
