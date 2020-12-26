<?php
 class empdetailsModel extends CI_Model
 {

	public function getEmplist($val,$limit=NULL,$start=NULL){
    $userdata=$this->session->all_userdata();
    if($userdata['role'] == 'agent'){
      $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id='".$userdata['emp_id']."'");
    }
    else{
      if($val == ''){
        $q = $this->db->query("SELECT * FROM emp_personal_details order by Emp_id limit $start,$limit ");
      }
      else{
        $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id like '%".$val."%' or Emp_name like '%".$val."%' order by Emp_id limit $start,$limit ");
      }
    }

	  return $q->result();
	}

  public function countrows($val){
    $userdata=$this->session->all_userdata();
    if($userdata['role'] == 'agent'){
      $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id='".$userdata['emp_id']."'");
    }
    else{
      if($val == ''){
        $q = $this->db->query("SELECT * FROM emp_personal_details ");
      }
      else{
        $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id like '%".$val."%' or Emp_name like '%".$val."%' ");
      }
    }
    return $q->result();
  }

  public function agentdata(){
    $user =$this->db->query("SELECT * FROM users WHERE role!='admin' Order by Emp_id");
    return $user->result();
  }
  public function addDetails($data){
    $empid =$data['empid'];

    $getuserid = $this->db->select(['name','department','role'])->from('users')->where('emp_id',$empid)->get()->result();
    $empname = $getuserid[0]->name;

    $finduserid = $this->db->select('*')->from('emp_personal_details')->where('Emp_id',$empid)->get()->result();

     $values = array(
            "Emp_id" => $empid,
            "Emp_name" => $empname,
            "Current_Address1" => $data['address1'],
            "Current_Address2" => $data['address2'],
            "Current_Landmark" => $data['landmark'],
            "Current_City" => $data['city'],
            "Current_Pincode" => $data['pincode'],
            "Perm_Address2" => $data['PersAddress2'],
            "Perm_Landmark" => $data['Perslandmark'],
            "Perm_City" => $data['Perscity'],
            "Perm_Pincode" => $data['Perspincode'],
            "Contact_phone" => $data['phno'],
            "Personal_Email" => $data['personalEmail'],
            "DOB" => date("Y-m-d", strtotime($data['dob'])),
            "MarriedUnMarried" => $data['marriage'],
            "No_of_Child" => $data['noofChild'],
            "Anniversary" =>  date("Y-m-d", strtotime($data['weddingAniver'])),
            "Emergency_Contact_Person" => $data['emerPerson'],
            "Relationship" => $data['relationship'],
            "Emergency_Contact" => $data['emerContact'],
            "Bloodgroup" => $data['bloodgrp'],
            "Transportation" => $data['transOffice'],
            "Route" => $data['transRoute'],
            "created_date" => date('Y-m-d H:i:s'),
            "currentTeam" => $data["currentTeam"],
            "designation" => $data["designation"],
            "probationPeriod" => $data["probationPeriod"],
            "probationEnd" => date("Y-m-d", strtotime($data["probationEnd"])),
            "joiningDate" =>  date("Y-m-d", strtotime($data["joiningDate"])),
            "termDate" =>  date("Y-m-d", strtotime($data["termDate"])),
            "linkedin" => $data['linkedin'],
            "facebook" => $data['facebook'],
            // "emp_photo" => $emp_file_name,
            //"resume" => $resume_file_name,
            // "insurance" => $insurance_file_name,
            // "aadhar" => $aadhar_file_name,
            // "pan" => $pan_file_name,
            "Shift" => $data['selectshift']
    );

     if(isset($_FILES['emp_photo']['name']) && !empty($_FILES['emp_photo']['name'])){
      $emp_file_name = str_replace(" ", "", $empid."_".$_FILES['emp_photo']['name']);
      // $file_size = $_FILES['emp_photo']['size'];
      // $file_type = $_FILES['emp_photo']['type'];
      $file_tmp  = $_FILES['emp_photo']['tmp_name'];
      move_uploaded_file($file_tmp,"img/emp_images/".$emp_file_name);
      $values['emp_photo'] = $emp_file_name;
    }

     if(isset($_FILES['resume']['name']) && !empty($_FILES['resume']['name'])){
      $resume_file_name = str_replace(" ", "", $empid."_".$_FILES['resume']['name']);
      $file_tmp  = $_FILES['resume']['tmp_name'];
      move_uploaded_file($file_tmp,"img/resume/".$resume_file_name);
      $values['resume'] = $resume_file_name;
    }

    if(isset($_FILES['insurance']['name']) && !empty($_FILES['insurance']['name'])){
      $insurance_file_name = str_replace(" ", "", $empid."_".$_FILES['insurance']['name']);
      $file_tmp  = $_FILES['insurance']['tmp_name'];
      move_uploaded_file($file_tmp,"img/insurance/".$insurance_file_name);
      $values['insurance'] = $insurance_file_name;
    }

    if(isset($_FILES['aadhar']) && !empty($_FILES['aadhar']['name'])){
      $aadhar_file_name = str_replace(" ", "", $empid."_".$_FILES['aadhar']['name']);
      $file_tmp  = $_FILES['aadhar']['tmp_name'];
      move_uploaded_file($file_tmp,"img/address_proof/".$aadhar_file_name);
      $values['aadhar'] = $aadhar_file_name;
    }

    if(isset($_FILES['pan']['name']) && !empty($_FILES['pan']['name'])){
      $pan_file_name = str_replace(" ", "", $empid."_".$_FILES['pan']['name']);
      $file_tmp  = $_FILES['pan']['tmp_name'];
      move_uploaded_file($file_tmp,"img/address_proof/".$pan_file_name);
      $values['pan'] = $pan_file_name;
    }

     // echo '<pre>';print_r($values);echo '</pre>';die;

   if(count($finduserid) > 0){
      $values['updated_date'] = date('Y-m-d H:i:s');
      $updateVal = $this->db->where('Emp_id', $empid)->update('emp_personal_details',$values);
         if($updateVal){

            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
         }else{
             $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
         }
   }
   else{
     $values['created_date'] = date('Y-m-d H:i:s');
       $insertVal = $this->db->insert('emp_personal_details',$values);
         if($insertVal){

            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
         }else{
             $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
         }
   }


  }

  
  public function updateDetails($data){
  
    $values = array(
            "Current_Address1" => $data['Updateaddress1'],
            "Current_Address2" => $data['Updateaddress2'],
            "Current_Landmark" => $data['Updatelandmark'],
            "Current_City" => $data['Updatecity'],
            "Current_Pincode" => $data['Updatepincode'],
            "Perm_Address1" => $data['UpdatePersAddress1'],
            "Perm_Address2" => $data['UpdatePersAddress2'],
            "Perm_Landmark" => $data['UpdatePerslandmark'],
            "Perm_City" => $data['UpdatePerscity'],
            "Perm_Pincode" => $data['UpdatePerspincode'],
            "Contact_phone" => $data['Updatephno'],
            "Personal_Email" => $data['UpdatepersonalEmail'],
            "DOB" => $data['updateDOB'],
            "MarriedUnMarried" => $data['Updatemarriage'],
            "No_of_Child" => $data['UpdatenoofChild'],
            "Anniversary" => $data['UpdateweddingAniver'],
            "Emergency_Contact" => $data['UpdateemerContact'],
            "Bloodgroup" => $data['updateBG'],
            "Transportation" => $data['UpdatetransOffice'],
            "Education_study" => $data['UpdateEStudy'],
            "Education_institute" => $data['UpdateESchool'],
            "Education_year" => $data['UpdateEMark'],
            "Family_name" => $data['UpdateFName'],
            "Family_relationship" => $data['UpdateFRelationship'],
            "Family_contact" => $data['UpdateFContact'],
            "DOJ" => $data['Updatedoj'],
            "Work_email" => $data['Updateworkemail'],
            "Process" => $data['Updateprocess'],
            "Exp_in_MB" => $data['UpdateexpinMB'],
            "First_MB_Employer" => $data['UpdatefirstMBEmployee'],
            "Start_Date_WithFirst_MB_Employer" => $data['UpdateStartDate_FirstMB'],
            "Other_Past_MB_Employers" => $data['UpdateOtherPastMB'],
            "MB_Softwares_Worked_On" =>  implode(",",$data['UpdateMBSoftwareon']),
            "MB_Specialties_Worked_On" =>  implode(",",$data['UpdateMBSpecial']),
            "MB_Processed_Worked_On" => $data['UpdateMBProcessWork'],
            "LinkedIn" => $data['UpdateLinkedin'],
            "Facebook" => $data['UpdateFacebookid'],
            "Updated_on" => date('Y-m-d H:i:s')
      );
      $updatepr=$this->db->where('Emp_id', $data['updateempid'])->update('emp_personal_details',$values);
      if($updatepr){
  
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Update!..');
  
      }
    }

    public function get_social_links_data(){
      $emp_id = $this->input->post('emp_id');
      $res = $this->db->select('whatsapp,facebook,linkedin,pinterest,twitter')->from('emp_personal_details')->where('Emp_id', $emp_id)->get();
      return $res->row();
    }

    public function update_social_links_data(){
      $emp_id = $this->input->post('emp_id');
      $whatsapp = $this->input->post('whatsapp');
      $facebook = $this->input->post('facebook');
      $linkedin = $this->input->post('linkedin');
      $twitter = $this->input->post('twitter');
      $pinterest = $this->input->post('pinterest');

      $socialArr = array(
        'whatsapp' => $whatsapp,
        'facebook' => $facebook,
        'linkedin' => $linkedin,
        'twitter' => $twitter,
        'pinterest' => $pinterest,
      );

      $update_res = $this->db->where('Emp_id', $emp_id)->update('emp_personal_details', $socialArr);
      if($update_res){ echo 1;}
      else {echo 0;}
    }

    public function get_emp_department(){
      $emp_id = $this->input->post('emp_id');
      $emp_res = $this->db->select('department, client')->from('users')->where('emp_id', $emp_id)->get();
      return $emp_res->row();
    }

    public function get_all_clients(){
      $emp_res = $this->db->select('client')->from('users')->where('client !=', 'NULL')->group_by('client')->get();
      return $emp_res->result_array();
    }

    public function get_all_departs(){
      $emp_departs = $this->db->select('department')->from('users')->where('department !=', 'ADMIN')->group_by('department')->get();
      return $emp_departs->result_array();
    }

    public function add_transfer_data(){
      $emp_id = $this->input->post('transfer_emp');
      $emp_name = $this->input->post('emp_name');
      $current_process = $this->input->post('current_process');
      $current_client = $this->input->post('current_client');
      $transfer_process = $this->input->post('transfer_process');
      $transfer_client = $this->input->post('transfer_client');
      $reason = $this->input->post('reason');
      $approved_by = $this->input->post('approved_by');
      $approver_name = $this->input->post('approver_name');
      $formType = $this->input->post('formType');      
      $trans_id = $this->input->post('trans_id');      

      if($formType == 'update'){
        $updated_data = array(
          'department' => $transfer_process,
          'client' => $transfer_client,
          'transferred_status' => '1'
        );
        $update_user_data = $this->db->where('emp_id', $emp_id)->update('users', $updated_data);

         $transfer_data = array(
          'emp_id' => $emp_id,
          'emp_name' => $emp_name,
          'current_process' => $current_process,
          'current_client' => $current_client,
          'transfer_to_process' => $transfer_process,
          'transfer_to_client' => $transfer_client,
          'reason_for_transfer' => $reason,
          'approved_by' => $approved_by,
          'approver_name' => $approver_name
        );
         $update_transfer_data = $this->db->where('id', $trans_id)->update('internal_emp_transfer', $transfer_data);
         return $update_transfer_data;
      } else { 
        $updated_data = array(
          'department' => $transfer_process,
          'client' => $transfer_client,
          'transferred_status' => '1'
        );
        $this->db->where('emp_id', $emp_id)->update('users', $updated_data);

        $transfer_data = array(
          'emp_id' => $emp_id,
          'emp_name' => $emp_name,
          'current_process' => $current_process,
          'current_client' => $current_client,
          'transfer_to_process' => $transfer_process,
          'transfer_to_client' => $transfer_client,
          'reason_for_transfer' => $reason,
          'approved_by' => $approved_by,
          'approver_name' => $approver_name
        );
        $this->db->insert('internal_emp_transfer',$transfer_data);
        return $this->db->insert_id();
      }            
    }

    public function get_all_transfer_data()
    {

      if($_SESSION['role'] == 'agent'){
        $transfer_data = $this->db->select('*')->from('internal_emp_transfer')->where('emp_id', $_SESSION['emp_id'])->get();
      }else{
        $transfer_data = $this->db->select('*')->from('internal_emp_transfer')->get();  
      }
      
      $result_val = $transfer_data->result_array();
      return $result_val;

     /* foreach($result_val as $key => $value) {
        $emp_name = $this->db->select('emp_id, name')->from('users')->where('emp_id', $value['emp_id'])->get();
        $emp_names[$key] = (array) $emp_name->row();        
      }
        $emp_detailsnew = array('employee_results'=>$result_val, 'emp_names'=>$emp_names);
        return $emp_detailsnew;*/
    }

    public function get_trans_emp()
    {
      $trans_id = $this->input->post('trans_id');
      $trans_data = $this->db->select('*')->from('internal_emp_transfer')->where('id', $trans_id)->get();
      return $trans_data->row();
    }

    public function del_trans_emp()
    {
      $trans_id = $this->input->post('trans_id');
      return $delete_status = $this->db->where('id', $trans_id)->delete('internal_emp_transfer');
    }

    public function render_emp_name()
    {
      $emp_id = $this->input->post('emp_id');
      $get_results = $this->db->select('name')->from('users')->where('emp_id', $emp_id)->get();
      return $get_results->row();
    }



  public function removeDetails($data){
    $id=$data['empid'];
    $res = $this->db->where('Emp_id',$id)->delete('emp_personal_details');
    if($res){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted Successfully!..');
    }else{
      $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Deleted!..');
    }
  }


  public function getAllusersDetails(){
    $res = $this->db->select('*')->from('emp_personal_details')->get();
    return $res->result();
  }

  public function getempprescreening(){
    $res = $this->db->select('*')->from('emp_prescreening')->get();
    return $res->result(); 
  }

  //fetch allemployy details from single
  public function gettableemp($tablename,$data){
    $id = $data['id'];
    $res = $this->db->select('*')->from($tablename)->where('Emp_id',$id)->get();
    return $res->result();
  }
  //Comman Bulk insert  for Edu,Family,expm1
  public function bulkinsert($tablename,$data){
    $insertVal = $this->db->insert_batch($tablename,$data);
      if($insertVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
      }
  }


// denash worked part
 public function emp_leave_add()
    {      
      $emp_id = $this->input->post('empLeaveName');
      $emp_name = $this->input->post('emp_name');
      $lev_start_date = $this->input->post('lev_start_date');
      $lev_end_date = $this->input->post('lev_end_date');
      $day_count = $this->input->post('day_count');
      $lev_reason = $this->input->post('lev_reason');
      $leave_type = $this->input->post('leave_type');
      $manager_id = $this->input->post('managers_list');
      $manager_name = $this->input->post('manager_name');
      
      $insert_data = array(
        'emp_id' => $emp_id,
        'emp_name' => $emp_name,
        'total_days' => $day_count,
        'leave_start_date' => date("Y-m-d", strtotime($lev_start_date)),
        'leave_end_date' => date("Y-m-d", strtotime($lev_end_date)),
        'leave_reason' => $lev_reason,
        'leave_type' => $leave_type,
        'leave_status' => 'Pending',
        'manager_id' => $manager_id,
        'manager_name' => $manager_name,
      );      

      $this->db->insert('emp_leave_details', $insert_data);
      return $this->db->insert_id();
    }

    public function permission_data_save()
    {
      $emp_id = $this->input->post('emp_id');
      $emp_name = $this->input->post('emp_name');
      $permission_hours = $this->input->post('permission_time');
      $reason_for_permission = $this->input->post('permission_reason');
      $manager_id = $this->input->post('manager_id');
      $manager_name = $this->input->post('manager_name');

      $insert_data = array(
        'emp_id' => $emp_id,
        'emp_name' => $emp_name,
        'permission_hours' => $permission_hours,
        'reason_for_permission' => $reason_for_permission,
        'manager_id' => $manager_id,
        'manager_name' => $manager_name,
        'status'=> 'Pending'
      );
      $this->db->insert('emp_permission_details', $insert_data);
      return $insert_status = $this->db->insert_id();
    }

    public function get_managers_list()
    {
      $managers_list = $this->db->select('emp_id, name')->from('users')->where('department =', 'MANAGEMENT')->get();
      return $managers_list->result_array();
    }

    public function emp_permission_list()
    {
      if($_SESSION['department'] == 'MANAGEMENT' || $_SESSION['department'] == 'ADMIN'){
        $permission_list = $this->db->select('*')->from('emp_permission_details')->get();
      }elseif($_SESSION['role'] == 'agent'){
        $permission_list = $this->db->select('*')->from('emp_permission_details')->where('emp_id', $_SESSION['emp_id'])->get();
      }
      return $permission_list->result_array();
    }

    public function validate_approve_permission()
    {
      $p_id = $this->input->post('permission_id');
      $pstatus = $this->input->post('pstatus');
        if($pstatus == 'Approve'){
          $update_arr = array('status' => 'Approved');
        }else{
          $update_arr = array('status' => 'Rejected');
        }
      $apprv_validation = $this->db->where('id', $p_id)->update('emp_permission_details', $update_arr);
      return $apprv_validation;
    }

    public function check_permission_exists()
    {
      $emp_id = $_SESSION['emp_id'];
      $permission_res = $this->db->query("SELECT * FROM emp_permission_details WHERE emp_id='".$emp_id."' AND status='Approved' OR status = 'Pending' AND MONTH(permission_date) = MONTH(CURRENT_DATE()) AND YEAR(permission_date) = YEAR(CURRENT_DATE()) ");
      return $permission_res->num_rows();
    }

    public function get_permission_count()
    {
      $logged_manager_id = $this->input->post('logged_manager_id');
      $permission_count = $this->db->select('*')->from('emp_permission_details')->where('emp_id', $logged_manager_id)->where('status=', 'Pending')->count_all_results();
      $leave_count = $this->db->select('*')->from('emp_leave_details')->where('emp_id', $logged_manager_id)->where('leave_status=', 'Pending')->count_all_results();
      return $permission_count + $leave_count;
    }

    public function get_emp_leave_list()
    {
      return $this->db->select('*')->from('emp_leave_details')->get()->result_array();
    }

    public function check_leave_emp()
    {
      $leave_type = $this->input->post('leave_type');

      if($leave_type == 'cl'){
        $leave_data = $this->db->query("SELECT COUNT(*) as total_leave FROM emp_leave_details WHERE emp_id = '".$_SESSION['emp_id']."' AND leave_status= 'Pending' AND MONTH(date_created) = MONTH(CURDATE()) AND leave_type='".$leave_type."' ")->row();
      } else if($leave_type == 'pl'){
        $leave_data = $this->db->query("SELECT SUM(total_days) as total_leave FROM emp_leave_details WHERE emp_id = '".$_SESSION['emp_id']."' AND leave_type='".$leave_type."' ")->row();
      }else{
        return $leave_data = 0;
      }

      return $leave_data->total_leave;      
    }

    public function validate_approve_leave()
    {
      $leave_id = $this->input->post('leave_id');
      $leave_status = $this->input->post('leave_status');
        if($leave_status == 'Approve'){
          $update_arr = array('leave_status' => 'Approved');
        }else{
          $update_arr = array('leave_status' => 'Rejected');
        }
      $apprv_validation = $this->db->where('id', $leave_id)->update('emp_leave_details', $update_arr);
      return $apprv_validation;
    }


 }

 ?>
