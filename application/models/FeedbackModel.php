<?php
class FeedbackModel extends CI_Model
{
    function agentdata(){
        $qu = $this->db->query("SELECT a.`emp_id`,a.`name`,a.`role`,a.`department`,b.manager_id,b.reporting_manager,c.designation FROM `users` a left join emp_separation_managers b on a.emp_id=b.emp_id left join emp_personal_details c on a.emp_id=c.emp_id");
        return $qu->result();
    }

    function agentdata_hrfeedback(){
        $qu = $this->db->query("SELECT a.`emp_id`,a.`name`,a.`role`,a.`department`,(select b.manager_id from emp_separation_managers b where a.emp_id=b.emp_id limit 1) as manager_id,(select b.reporting_manager from emp_separation_managers b where a.emp_id=b.emp_id limit 1) as reporting_manager,(select c.designation FROM emp_personal_details c where a.emp_id=c.emp_id limit 1) as designation from users a where a.role!='admin' order by a.emp_id");
        return $qu->result();
    }

    function addfeedback($table,$data){
        $insertqu = $this->db->insert($table,$data);
        if($insertqu){
            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Added Successfully!..');

  	        return TRUE;
        }else{
            $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Added!..');

  	        return FALSE;
        }
    }

    function updatefeedback($table,$id,$data){
        $updatetqu = $this->db->where('id',$id)->update($table,$data);
        if($updatetqu){
            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');

  	        return TRUE;
        }else{
            $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Updated!..');

  	        return FALSE;
        }
    }

    function getfeedback($table){
        $query = $this->db->query("Select * from $table");
        return $query->result();
    }

    function getfeedback_view($table){
        $userdata=$this->session->all_userdata();
        if($userdata['role']  == 'agent'){
            $query = $this->db->query("Select * from $table where emp_id='".$userdata['emp_id']."'");
        }else if($userdata['role'] =='supervisor'){
            //$query = $this->db->query("Select * from $table where reviewer_id='".$userdata['emp_id']."'");
            $query = $this->db->query("SELECT a.* FROM `manager_feedback_form` as a WHERE a.emp_id in (select emp_id from emp_separation_managers where manager_id='".$userdata['emp_id']."') ORDER BY id DESC");
        }
        else{
            $query = $this->db->query("Select * from $table");
        }

        return $query->result();
    }

    function getviewpart($table,$ind){
        $query = $this->db->query("Select * from $table where id='".$ind."'");
        echo json_encode($query->result());
    }

    function agent_updatefeedback($table,$emp_id,$mY,$data){
        $updatetqu = $this->db->where(['emp_id'=>$emp_id,"monthyear"=>$mY])->update($table,$data);
        if($updatetqu){
            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');

  	        return TRUE;
        }else{
            $this->session->set_flashdata('msg','<p style="color:red;margin-left:3%;margin-top:3%;">Not Updated!..');

  	        return FALSE;
        }
    }

    function upexceldata($data){
        $getdate_m = date_create('01-'.$data[2]);
        $getmY = date_format($getdate_m,"m-Y");
        $dataset = array(
            "emp_id" => $data[0],
            "name" => $data[1],
            "monthyear" => $getmY,
            "produnction_perc" => $data[3],
            "quality_perc" => $data[4],
            "attendance" => $data[5],
            "date_apply" => date("Y-m-d")
        );
        $check=$this->db->query("SELECT * FROM manager_feedback_form where emp_id='$data[0]'");
        if($check->num_rows() > 0){
            $this->db->where("emp_id",$data[0])->update("manager_feedback_form",$dataset);
        }else{
            $this->db->insert("manager_feedback_form",$dataset);
        }
    }
}
?>
