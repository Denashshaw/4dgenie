<?php
class ticketingModel extends CI_Model
{
    public function insertticket($data){
        date_default_timezone_set("Asia/Kolkata");
        $uid =$data['uid'];
        $exp=explode("/",$uid);
        $dataset = array(
            "emp_id" => $exp[0],
            "name" => $exp[1],
            "desk_no" => $data['deskno'],
            "issue_type" => $data['issuetype'],
            "issue_details" => $data['issueprb'],
            "complaint_date" => date('Y-m-d H:i:s')
        );
        $inst = $this->db->insert('it_complaint',$dataset);
        
        if($inst){
            echo json_encode(["status"=>"Success"]);
        }else{
            echo json_encode(["status"=>"Failure"]);
        }
    }

    public function complaintretila($data){
        $exp=explode("/",$data);
        $qu="SELECT * FROM it_complaint WHERE emp_id='$exp[0]' order by status";
        $getRep = $this->db->query($qu);
        echo json_encode($getRep->result());
    }

    public function getreport($data){
        $empid=$data['useridemp'];
        $issuetype=$data['issuetype'];
        $status=$data['status'];
        $fromdate1=date_create($data['fromdate']);
        $fromdate=date_format($fromdate1,"Y-m-d");
        $todate1=date_create($data['todate']);
        $todate=date_format($todate1,"Y-m-d 23:59");
        if($empid == 'All'){
            $empfilter ='';
        }else{
            $empfilter ="emp_id='".$empid."' and";
        }
        if($issuetype == 'All'){
            $issuetype_filter ='';
        }else{
            $issuetype_filter ="issue_type='".$issuetype."' and";
        }
        if($status == 'All'){
            $status_filter ='';
        }else{
            $status_filter ="status='".$status."' and";
        }

        $qry = 'SELECT * FROM it_complaint where '.$empfilter.' '.$issuetype_filter.' '.$status_filter.' complaint_date between "'.$fromdate.'" and "'.$todate.'"';
        $resquery = $this->db->query($qry);
        return $resquery->result();
    }
}
?>