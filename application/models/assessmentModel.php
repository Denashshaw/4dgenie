<?php
class assessmentModel extends CI_Model
{
  public function getagentname(){
  	$data = $this->db->query("SELECT CONCAT(emp_id,'/',name) as name ,emp_id  FROM users WHERE role!='admin'");
  	return $data->result();
  }
  public function addquestionModel($table,$data){

    $insertresult = $this->db->insert_batch($table,$data);
    if($insertresult){
      return "Success";
    }else{
      return "Failed";
    }
  }
  public function checktitle($table,$title){
    $data = $this->db->query("SELECT * FROM $table where title='$title'");
    return $data->result();
  }
  public function getallreport(){
  //  $data = $this->db->query("SELECT * FROM assessment_question");
  $query = "SELECT LENGTH(`emp_id`) - LENGTH(REPLACE(`emp_id`, ',', '')) + 1 as noof_emp_id,emp_id,title,count(*) as noof_questions,GROUP_CONCAT(id) as questions,created_date FROM `assessment_question` group by title";
  $data = $this->db->query($query);
    return $data->result();
  }

  public function getquestion($table,$question){
    $query = "SELECT * FROM $table where id in($question)";
    $data = $this->db->query($query);
    return $data->result();
  }
  public function getagentview_test($agentids,$title){
    $agentdetails=array();
    $i=0;
    foreach ($agentids as $agentid) {
      $splitemp=explode("/",$agentid);

      $agentdetails[$i]['empid']=$splitemp[0];
      $agentdetails[$i]['name']=$splitemp[1];
      $username=$this->db->query("SELECT * from assessment_test where emp_id='$splitemp[0]' and title='$title'");
      if($username->num_rows() > 0){
        $row = $username->first_row();
        $agentdetails[$i]['status']='Completed';
        $agentdetails[$i]['mark']= $row->mark;
        $agentdetails[$i]['date']= $row->created_date;
      }else{
        $agentdetails[$i]['status']='Pending';
        $agentdetails[$i]['mark']= '';
        $agentdetails[$i]['date']= '';
      }
      $i++;
    }

    return $agentdetails;
  }

  //AGENT test
  public function getagentpending(){
    $empid=$_SESSION['emp_id'];
    $query="SELECT DISTINCT `title`,emp_id FROM `assessment_question` where emp_id like '%$empid%' and title not in(select title from assessment_test where emp_id='$empid')";
    $res = $this->db->query($query);
    return $res->result();
  }

  public function getquestion_test($table,$title){
    $query="SELECT * FROM $table where title='$title' ORDER BY RAND()";
    $res=$this->db->query($query);
    return $res->result();
  }

  //Reprot
  public function titleview(){
    return $this->db->query("Select DISTINCT title from assessment_question")->result();
  }

  public function scoreview($title){
    $getagents=$this->db->query("SELECT emp_id from assessment_question where title='$title' limit 1")->result();
    $emp_details=explode(",",$getagents[0]->emp_id);
    return $emp_details;
  }
  public function rawdataview($title){
    $getquestion=$this->db->query("SELECT * from assessment_question where title='$title' order by id")->result();
    $emp_details=explode(",",$getquestion[0]->emp_id);
    $dataset=array();
    $q=array();
    $e=0;
    $datarow_correctans=array("-","-");
    foreach ($getquestion as $a) {
      $cor=$a->correct;
      $datarow_correctans[$e+2]=$a->$cor;
      $e++;
    }
    array_push($dataset,$datarow_correctans);
    $datarow=array("EmpID","Name");
    foreach ($getquestion as $a) {
      $datarow[$i+2]=$a->question;
      array_push($q,array($a->id,$a->correct,$a->a,$a->b,$a->c,$a->b));
      $i++;
    }
    array_push($dataset,$datarow);
    foreach($emp_details as $emp){
      $agentdetails=explode("/",$emp);
      $emp_id=$agentdetails[0];
      $ind=0;
      $getres=$this->db->query("Select * from assessment_test where emp_id='$emp_id' and title='$title'")->result();
      $datarow_second[$ind]=array($emp_id,$agentdetails[1]);

      for($k=0;$k<sizeof($q);$k++){

        if($getres){
          $agentans_questionlist=explode(",",$getres[0]->questions);
          $agent_ans=explode(",",$getres[0]->agent_ans);
          for($j=0;$j<sizeof($agentans_questionlist);$j++){
            if($agentans_questionlist[$j] == $q[$k][0]){

              if($agent_ans[$j] == 'a'){
                $getans=2;
              }else if($agent_ans[$j] == 'b'){
                  $getans=3;
              }else if($agent_ans[$j] == 'c'){
                  $getans=4;
              }else if($agent_ans[$j] == 'd'){
                  $getans=5;
              }else{
                $getans='';
              }

              if($agent_ans[$j] == $q[$k][1]){
                $questionans=1;
              }else{
                $questionans=0;
              }
            //  $questionval[$k]=$questionans;
              $agent_answer_final = $q[$k][$getans];
              $datarow_second[$ind][$k+2]=array($agent_answer_final,$questionans);


            }else{
            }
          }
        }else{
            $datarow_second[$ind][$k+2]='-';
        }
      }
      $ind++;
      array_push($dataset,$datarow_second);
      //array_push($dataset,$questionval);
    }
    return $dataset;
  }
}
