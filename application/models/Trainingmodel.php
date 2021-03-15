<?php
error_reporting(0);
class Trainingmodel extends CI_Model{
   public function agentlist()
   {
      $query = $this->db->select('*')->from('users') ->where('role!=','admin')->get();
      return $query->result();
   }

   public function agentget($id){
      $query = $this->db->select('*')->from('users') ->where('emp_id=',$id)->get();
      return $query->result();
   }

   public function materialadd($data){
      $query = $this->db->insert('trainingmaterial',$data);
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Added successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Added!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function manualadd($data){
      $query = $this->db->insert('trainingmanual',$data);
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Added successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Added!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function clientlist(){
      $query = $this->db->select("*")->from('client')->get();
      return $query->result();
   }

   public function materiallist(){
      $userdata=$this->session->all_userdata();
      if($userdata['role'] == 'admin'){
         $query = $this->db->select("t1.*")->from('trainingmaterial as t1')->get();
         $query = $this->db->query("SELECT `t1`.*,(SELECT count(*) from trainingemp t2 where `t1`.`materialfilename` = `t2`.`page`) as noperson FROM `trainingmaterial` as `t1`  ");
      }
      else{
         $query = $this->db->select("*")->from('trainingmaterial')->where(array("process" => $userdata['department']))->get();
      }
      return $query->result();
   }

   public function manuallist(){
      $userdata=$this->session->all_userdata();
      if($userdata['role'] == 'admin'){
         $query = $this->db->select("*")->from('trainingmanual')->get();
      }
      else{
         $query = $this->db->select("*")->from('trainingmanual')->where(array("process" => $userdata['department'],"client" => $userdata['loggedin_client']))->get();
      }
      return $query->result();
   }

   public function materialdelete($id){
      $query = $this->db->delete('trainingmaterial',array('id'=>$id));
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Deleted!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function manualdelete($id){
      $query = $this->db->delete('trainingmanual',array('id'=>$id));
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Deleted!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function agentstatus($data){
      $query = $this->db->insert('trainingemp',$data);
      if($query){
         $msg = array("msg" => "Status Updated");
         return $msg;
      }else{
         $msg = array("msg" => "Status Not Updated");
         return $msg;
      }
   }

   public function numofviewmaterial($data){
      $bookname = $data['bookname'];
      $qu = $this->db->select('*')->from('trainingemp')->where('page=',$bookname)->get();
      return $qu->result();
   }

   public function getprocessemp($data){
      $dpt = $data['dpt'];
      $query = $this->db->select('*')->from('users')->where('department=',$dpt)->where('role=','agent')->get();
      return $query->result();
   }

   public function assessmentadd($data){
      $query = $this->db->insert('training_assessment',$data);
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Added successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Added!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function assessmentlist(){
      $userdata=$this->session->all_userdata();
      if($userdata['role'] == 'admin'){
          $this->db->select("*")->from('training_assessment');
         $this->db->order_by("process", "asc");
         $query =$this->db->get();
      }
      else{
         $query = $this->db->select("*")->from('training_assessment')->where(array("process" => $userdata['department'],"emp_id" => $userdata['emp_id']))->get();
      }
      return $query->result();
   }

   public function assessmentdelete($id){
      $query = $this->db->delete('training_assessment',array('id'=>$id));
      if($query){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted successfully!..');
         redirect('Training');
         return TRUE;
      }else{
         $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Deleted!..');
         redirect('Training');
         return FALSE;
      }
   }

   public function assagentview($data){
      date_default_timezone_set('Asia/Kolkata');
      $userdata=$this->session->all_userdata();
      if($userdata['emp_id'] == $data['empid']){
         $this->db->set('status', 'Viewed');
         $this->db->set('takenon', date('Y-m-d H:i:s'));
         $this->db->where('id',$data['id']);
         $qu=$this->db->update('training_assessment');
         if($qu){
            redirect('Training');
            return TRUE;
         }
      }
   }

      public function assagentScoreupdate($data){
         $this->db->set('score', $data['agentscore']);
         $this->db->set('status', 'Completed');
         $this->db->where('id',$data['indexid']);
         $qu=$this->db->update('training_assessment');
         if($qu){
            redirect('Training');
            return TRUE;
         }
      }

   public function dashboarddata($data){
      $process = $data['process'];
      $agent = $data['agent'];
      if($process == 'All'){
         $draw = $this->db->query("SELECT  (SELECT count(*)  FROM `training_assessment`)totalass,(SELECT count(*)  FROM `training_assessment` where `status`='Viewed')viewed ,(SELECT count(*) as totalass FROM `training_assessment` where `status`='Completed')completed");
         $top3emp = $this->db->query("SELECT emp_id,name,score FROM `training_assessment` order by score DESC limit 3");
        foreach($top3emp->result() as $d){
           $topempid[] = $d->emp_id;
        }
        $empid_top=implode("','",$topempid);
         $bottom3emp = $this->db->query("SELECT emp_id,name,score FROM `training_assessment` where emp_id not in('$empid_top') order by score limit 3");
      }
      else{
         if($agent == 'All'){
            $draw = $this->db->query("SELECT  (SELECT count(*)  FROM `training_assessment` where process='$process')totalass,(SELECT count(*)  FROM `training_assessment` where `status`='Viewed' and process='$process')viewed ,(SELECT count(*) as totalass FROM `training_assessment` where `status`='Completed' and process='$process')completed");
            $top3emp = $this->db->query("SELECT emp_id,name,score FROM `training_assessment` where process='$process' order by score DESC limit 3");
            foreach($top3emp->result() as $d){
               $topempid[] = $d->emp_id;
            }
            $empid_top=implode("','",$topempid);
             $bottom3emp = $this->db->query("SELECT emp_id,name,score FROM `training_assessment` where emp_id not in('$empid_top') and process='$process' order by score limit 3");
         }
         else{
            $draw = $this->db->query("SELECT  (SELECT count(*)  FROM `training_assessment` where process='$process' and emp_id='$agent')totalass,(SELECT count(*)  FROM `training_assessment` where `status`='Viewed'  and process='$process' and emp_id='$agent')viewed ,(SELECT count(*) as totalass FROM `training_assessment` where `status`='Completed'  and process='$process' and emp_id='$agent')completed");

         }
      }
      if($agent =='All'){
         $dataresult['drawvalue']=$draw->result();
         $dataresult['top3emp']=$top3emp->result();
         $dataresult['bottom2emp'] = $bottom3emp->result();
      }else{
         $dataresult['drawvalue']=$draw->result();
      }
      return $dataresult;


   }

   public function getagentdash($agentid){
     $dataresult =  $this->db->query("SELECT (SELECT count(*) FROM `training_assessment` where emp_id = '$agentid' and status!='Completed')pending,(SELECT score FROM `training_assessment` where emp_id = '$agentid' and status='Completed' Order by id DESC limit 1)lastassessment,(SELECT sum(score) FROM `training_assessment` where emp_id = '$agentid' and status='Completed')totalassessmentvalue,(SELECT(sum(score)/count(*))*10 FROM `training_assessment` where emp_id = '$agentid' and status='Completed')Scorepercen");
      return $dataresult->result();
   }

   public function getagentRank($agentid){
      $dataresultRank =  $this->db->query("Select * from(SELECT emp_id, name, score, FIND_IN_SET( score, (
         SELECT GROUP_CONCAT( score
         ORDER BY score DESC )
         FROM training_assessment )
         ) AS rank
         FROM training_assessment)val where emp_id='$agentid'");

        return $dataresultRank->result();
   }
 }
?>
