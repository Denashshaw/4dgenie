<?php
class Timesheet_model extends CI_Model
{
  public function checkrejected($table,$emp)
  {
    $res=$this->db->query("SELECT * from $table where emp_id='$emp' and status='Rejected' limit 1");
    return $res->result();
  }
  public function logoutreason($data){
    $res = $this->db->where('id',$data['id'])->update('checkin_checkout',array("reason"=>$data['reason']));
    if($res){
        return "Updated Successfully";
    }else{
      return "Not Updated";
    }
  }

  public function getlastlogoutuser(){
    $empid = $_SESSION['emp_id'];
    $id=$_POST['checkids'];
    $res = $this->db->query("SELECT * from checkin_checkout where emp_id='$empid' and reason!='' and id=$id" )->result();
    if($res){
      return "Data found";
    }else{
      return "Data Not found";
    }
  }

  public function getreport_per(){
    $emp_id=$_SESSION['emp_id'];
    $res= $this->db->query("SELECT * FROM emp_separation_managers where emp_id='$emp_id' and manager_id!='M542'");
    return $res->result();
  }

  public function datastore($table,$dataset){
    $emp=$dataset[0]['emp_id'];
    $dt=$dataset[0]['report_date'];
    $check=$this->db->query("SELECT * FROM $table where emp_id='$emp' and report_date='$dt'");

    if($check->num_rows() > 0){
      //update
      for($i=0;$i<sizeof($dataset);$i++){
        $dataset[$i]['updated_date']=date('Y-m-d H:i:s');
      }
      $this->db->where('report_date',$dt)->update_batch($table,$dataset,'emp_id');
      return "Update Success";
    }else{
      //insert
      for($i=0;$i<sizeof($dataset);$i++){
        $dataset[$i]['created_date']=date('Y-m-d H:i:s');
      }
      $this->db->insert_batch($table,$dataset);
      return "Insert Success";
    }
  }


  public function datastore_report($table,$dataset){
    $emp=$dataset['emp_id'];
    $dt=$dataset['report_date'];
    $check=$this->db->query("SELECT * FROM $table where emp_id='$emp' and report_date='$dt'");

    if($check->num_rows() > 0){
      //update
        $dataset['updated_date']=date('Y-m-d H:i:s');
      $this->db->where(["emp_id"=>$emp,'report_date'=>$dt])->update($table,$dataset);
      return "Update Success";
    }else{
      //insert
      $dataset['created_date']=date('Y-m-d H:i:s');
      $this->db->insert($table,$dataset);
      setcookie('success',"Time-Sheet Submitted Successfully!!!",time() + 3, "/");
      return "Insert Success";
    }
  }

  public function getlist(){
    $fromdate=date_format(date_create($_POST['fromdate']),"Y-m-d");
    $todate=date_format(date_create($_POST['todate']),"Y-m-d");
    if($_POST['agent'] =='All'){
      $empid=$_SESSION["emp_id"];
        $res = $this->db->query("SELECT * FROM timesheet_report where (emp_id IN (select emp_id from emp_separation_managers where manager_id='$empid') or emp_id='$empid') and updated_date between '$fromdate 00:00:00' and '$todate 23:59:59'");
    }else{
      $emp=explode("/",$_POST['agent']);
      $res = $this->db->query("SELECT * FROM timesheet_report where emp_id='$emp[0]' and updated_date between '$fromdate 00:00:00' and '$todate 23:59:59'");
    }



    return $res->result();
//   return $this->db->last_query();die;

  }

  public function getuser(){
    $emp_id=$_SESSION['emp_id'];
    $res = $this->db->query("SELECT * FROM emp_separation_managers where manager_id='$emp_id'");
    return $res->result();
  }

  public function client_data()
  {
    $emp_id=$_SESSION['emp_id'];
    //  $res = $this->db->query("SELECT  FROM client_target where agent_id='$emp_id'");
    $res = $this->db->query("SELECT DISTINCT a.* FROM `client` a inner join client_target b on a.id=b.client and b.agent_id='$emp_id'");
    return $res->result();
  }
  public function gettask_data(){
    $task_type=$_POST['type'];
    $department=$_SESSION['department'];
    $getdata=$this->db->query("SELECT * FROM client_task where task_type='$task_type' and department in (SELECT id from department where department='$department')");
    return $getdata->result();
  }
  public function getsubtask_data()
  {
    $task=explode("/",$_POST['task']);
    $getdata=$this->db->query("SELECT * FROM client_sub_task where task_id='$task[0]'");
    return $getdata->result();
  }
  public function usertarget($dataset){
    $client=explode("/",$dataset['client']);
    $task=explode("/",$dataset['task']);
    $subtask=explode("/",$dataset['sub_task']);
    $emp=$_SESSION['emp_id'];
    $get_targetdata=$this->db->query("SELECT * FROM client_target where task='$task[0]' and sub_task='$subtask[0]' and client='$client[0]' and agent_id='$emp'");
    return $get_targetdata->result();
  }

  public function gettimesheetdata_agent(){
    $emp=$_POST['emp_id'];
    $repdate=$_POST['repDate'];
    $res = $this->db->query("SELECT * FROM timesheet where emp_id='$emp' and report_date='$repdate'");
    return $res->result();
  }
  public function gettimesheetdata_agent_report()
  {
    $emp=$_POST['emp_id'];
    $repdate=$_POST['repDate'];
    $res = $this->db->query("SELECT * FROM timesheet_report where emp_id='$emp' and report_date='$repdate'");
    return $res->result();
  }

  public function update_reviewerstatus($table,$data){
    $empid=$data[0]['id'];
    $getempid=$this->db->query("SELECT emp_id,report_date from $table where id='$empid'")->result();
    $empid=$getempid[0]->emp_id;
    $report_date=$getempid[0]->report_date;
    $this->db->where(["emp_id"=>$empid,"report_date"=>$report_date])->update('timesheet_report',array("status"=>$data[0]['status'],"reviewer_id"=>$data[0]['reviewer_id'],"reviewer_name"=>$data[0]['reviewer_name']));

    $res=$this->db->update_batch($table,$data,'id');
    if($res){
      return "updated";
    }else{
      return "not updated";
    }
  }

  public function count_nofifi($tb)
  {
    $emp=$_SESSION['emp_id'];
    $sql=$this->db->query("Select count(*) as countval from $tb where (status='Initiated' or status='Re-submitted') and emp_id in(select emp_id from emp_separation_managers where manager_id='$emp' )");
    return $sql->result();
  }

  public function rejected_date($tb){
    $emp=$_POST['empid'];
    $report_date=$_POST['report_date'];
    $sql=$this->db->query("Select * from $tb where emp_id='$emp' and status='Rejected' and report_date='$report_date'");
    return $sql->result();
  }

  public function update_rej_data($data)
  {
    $this->load->library('session');
    $dtset=array(
      "emp_id"=>$this->session->emp_id,
      "name"=>$this->session->name,
      "department"=>$this->session->department,
      "report_date"=>$this->input->post('set_reportdate'),
      "category"=>$this->input->post('set_category'),
      "client"=>$this->input->post('client'),
      "type"=>$this->input->post('Typeprocess'),
      "task"=>$this->input->post('task'),
      "sub_task"=>$this->input->post('subtask'),
      "time_spent"=>$this->input->post('timespend'),
      "count_production"=>$this->input->post('count_prod'),
      "target"=>$this->input->post('target'),
      "percentage"=>$this->input->post('percentageval_set'),
      "comments"=>$this->input->post('usercomments'),
      "reviewer_id"=>$this->input->post('reviewer_id'),
      "reviewer_name"=>$this->input->post('reviewer_name'),
      "status"=>'Rejected',
      "created_date"=>date('Y-m-d H:i:s')
    );
    $res=$this->db->insert("timesheet",$dtset);
    if($res){
      return "Success";
    }else{
      return "Failed";
    }
  }

  public function updaterow_rej_data($value)
  {
    $dt=array(
      "time_spent"=>$value['timespendupdate'],
      "count_production"=>$value['countupdate'],
      "target"=>$value['targetupdate'],
      "percentage"=>$value['percentageupdate_data'],
      "comments"=>$value['commentsupdate']
    );
    $rs = $this->db->where('id',$value['indexid'])->update('timesheet',$dt);
    if($res){
      return "Success";
    }else{
      return "Failed";
    }
  }
  public function updateentire_sheet($value)
  {
    $res = $this->db->where('emp_id',$value['emp_id'])->where('report_date',$value['report_date'])->update('timesheet',$value);
    return $res;
  }
  public function updateentire_report($value)
  {
    $res = $this->db->where('emp_id',$value['emp_id'])->where('report_date',$value['report_date'])->update('timesheet_report',$value);
    return $res;
  }
}
?>
