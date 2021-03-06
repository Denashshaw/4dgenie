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
        setcookie("success","Updated Successfully", time() + 2, "/");
        // $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
      }else{
        setcookie("error","Not Updated!", time() + 2, "/");
        //  $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
      }
    }else{
      $insertVal = $this->db->insert($table,$data);
      if($insertVal){
        setcookie("success","Inserted Successfully", time() + 2, "/");
        // $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
      }else{
        setcookie("error","Not Inserted!", time() + 2, "/");
        //  $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
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
  // public function insertonly($table,$id,$data){
  //   $insertVal = $this->db->insert($table,$data);
  //   if($insertVal){
  //     $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
  //   }else{
  //       $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
  //   }
  // }

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
      setcookie("success","Updated Successfully", time() + 2, "/");
      // $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
    }else{
        setcookie("error","Not Updated!", time() + 2, "/");
        //$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
    }
  }

  public function getmanagermail(){
    if($_POST['empid1']){
      $id=$_POST["empid1"];
    }else{
      $id=$_POST["emp_id1"];
    }

  //  $getmanageremailid=$this->db->query("SELECT * from office_mailid where emp_id IN (SELECT manager_id from emp_separation_managers where emp_id='$id')");
    $getmanageremailid=$this->db->query("SELECT * from officemail where emp_id IN (SELECT manager_id from emp_separation_managers where emp_id='$id')");
  //  return $this->db->last_query();die;
    return $getmanageremailid->result();
  }

  public function agentmailid($id){
    $query=$this->db->query("SELECT * from officemail where emp_id='$id'");
    return $query->result();
  }

  public function addfeedback($table,$data){
      $insertqu = $this->db->insert($table,$data);
      if($insertqu){
          return TRUE;
      }else{
          return FALSE;
      }
  }

  public function reportview($data){
    $fromdate=date_create($data['fromdate']);
    $fromdt=date_format($fromdate,'Y-m-d');
    $todate=date_create($data['todate']);
    $todt=date_format($todate,'Y-m-d');
    $empid=$data['useridemp'];
    $status=$data['status'];

    $query="SELECT a.*,b.name FROM emp_resignation_revoke as a left join users b on a.emp_id=b.emp_id WHERE a.Resignation_date between '$fromdt' and '$todt'";

    $res = $this->db->query($query);
    return $res->result();
  }

  public function reportview_export($data){
    $fromdate=date_create($data['fromdate']);
    $fromdt=date_format($fromdate,'Y-m-d');
    $todate=date_create($data['todate']);
    $todt=date_format($todate,'Y-m-d');
    $empid=$data['useridemp'];
    $status=$data['status'];

    $query="SELECT a.emp_id as `Emp ID`,b.name as `Name`,a.Resignation_reason as `Resignation Reason`,a.Resignation_date as `Applied Date`,a.Resign_Manager_status as `Manager Status`,a.Resign_Manager_remark as `Manager Remark`,a.Resign_Lastworkdate as `Last Working Date`,a.Resign_HR_status as `HR Staus`,a.Resign_HR_remark as `HR Remark`,a.Revoke_reason as `Revoke Reason`,a.Revoke_date as `Revoke Date`  FROM emp_resignation_revoke as a left join users b on a.emp_id=b.emp_id WHERE a.Resignation_date between '$fromdt' and '$todt'";

    $res = $this->db->query($query);
      return $res;
  }
}
