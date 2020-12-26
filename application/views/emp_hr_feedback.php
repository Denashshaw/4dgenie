<body>
<div class="page-wrapper chiller-theme toggled">
<style>
.colhead{
  font-weight:bold;
  min-width:100px;
}
#positionview{
  position: absolute;
  top: 5px;
  right: 5px;
}
#resignation_Reason,#revoke_Reason{
    font-size:18px;
}
.dt-button .buttons-excel .buttons-html5{
  border-radius: 15px;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    border-radius: 15px;
}
.dataTables_wrapper .ui-toolbar {
    padding: 8px;
    background: white;
}
</style>


<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php') ?>
    <div class="row activity-row">
			<div class="col-md-12 activity">One on One Feedback HR</div>
		</div>
    <?php 
    //echo $this->session->flashdata('msg');
    ?>
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
    <!-- <form id="attendfilter"> -->
    <?php if($userdata['department'] != 'MANAGEMENT' || ($userdata['department'] != 'HR' && $userdata['role'] != 'supervisor') || $userdata['role'] == 'admin'){ ?>
   
    <!-- </form> -->
<br><br>
<div class="col-md-12">
  <br>
  <div>
    <?php if($userdata['department'] == 'HR'){ ?>
    <button  onclick="viewhrfeedback()" style="margin-left:90%" class="check-out">Add</button>
    <?php } ?>
    <div class="card card-body" style="display:none" id="viewoneononeform">
    <form action="<?php echo base_url(); ?>Feedbackform/addHRfeedback" method="POST">
    <div  class="row" >
      <div class="col-md-3" style="border-right: 2px solid #cec4c4;">
        <p>Employee</p>
        <select class="form-control useridhrfeedback" id="useridemp" name="useridemp" onchange="showvalue()" required>
          <?php if($userdata['role'] != 'agent'){ ?>
          <option style="display: none;" value="" selected>Select Employee ID</option>
            <?php foreach ($emp_data as $emp) { ?>
              <option value="<?php echo $emp->emp_id.'/'.$emp->name.'/'.$emp->department.'/'.$emp->manager_id.'/'.$emp->reporting_manager.'/'.$emp->designation; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
            <?php } ?>
          <?php }?>
        </select>
      </div>
      <div class="col-md-3"  style="border-right: 2px solid #cec4c4;">
        <p>Designation</p>
        <h5 id="employeedesignation"></h5>
      </div>
      <div class="col-md-3" style="border-right: 2px solid #cec4c4;" >
        <p>Department</p>
        <h5 id="employeedepartment" ></h5>
      </div>
      <div class="col-md-3">
        <p>Supervisor</p>
        <h5 id="employeesupervisor" ></h5>
      </div>
      <div class="col-md-3"  style="padding-top:2%;">
          <b>Year</b><br>
          <input type="text" id="monthdatepicker" name="monthdatepicker"  value="<?php echo date("Y"); ?>" >
      </div>
      <div class="col-md-3"  style="padding-top:2%;">
          <b>Quarterly Period</b><br>
          <!-- <input type="text" id="monthdatepicker" name="monthdatepicker"  value="<?php echo date("m-Y"); ?>" > -->
          <select class="form-control" id="quarterly" name="quarterly" style="margin-top: 10px;">
              <option value="">Select Option</option>
              <option value="Jan-Mar">Jan - Mar</option>
              <option value="Apr-Jun">Apr - Jun</option>
              <option value="Jul-Sep">Jul - Sep</option>
              <option value="Oct-Dec">Oct - Dec</option>
          </select>
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
          <b style="margin-left:50%">Date</b>
          <input type="date" id="getdate" name="getdate" value="<?php echo date('Y-m-d'); ?>" style="margin-left:50%">
      </div>
      <br><br>
      <div class="col-md-6" style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Average Absenteeism In Days<span id="averageabview" style="margin-left:10%"></span></p>
          <input type="text" class="form-control" id="averageAbsentDays" name="averageAbsentDays" required  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Reason For Absenteeism as given by employee</p>
          <input type="text" class="form-control" id="ReasonforAbsent" name="ReasonforAbsent" required>
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Happy With Your Team?</p>
          <!-- <input type="text" class="form-control" id="TeamHappy" name="TeamHappy" required> -->
          <select class="form-control" id="TeamHappy" name="TeamHappy" required onchange="if($(this).val() == 'No'){ $('#teamhappyReason').show(); }else{ $('#teamhappyReason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <br>
          <textarea name="teamhappyReason" id="teamhappyReason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Comfortable With Your Supervisor?</p>
          <!-- <input type="text" class="form-control" id="SupervisorConfortable" name="SupervisorConfortable" required> -->
          <select class="form-control" id="SupervisorConfortable" name="SupervisorConfortable" required  onchange="if($(this).val() == 'No'){ $('#conf_supervisor_Reason').show(); }else{ $('#conf_supervisor_Reason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <br>
          <textarea name="conf_supervisor_Reason" id="conf_supervisor_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
        <li class="list-group-item"  style="background-color:#e4e4e4">Do You Have Any Issues?</p>
          <!-- <input type="text" class="form-control" id="Anyissue" name="Anyissue" required> -->
          <select class="form-control"  id="Anyissue" name="Anyissue" required onchange="if($(this).val() == 'Yes'){ $('#Anyissue_Reason').show(); }else{ $('#Anyissue_Reason').hide(); }">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select><br>
          <textarea name="Anyissue_Reason" id="Anyissue_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Achiveing Your Targets?</p>
          <!-- <input type="text" class="form-control" id="Targets" name="Targets" required> -->
          <select class="form-control"  id="Targets" name="Targets" required onchange="if($(this).val() == 'No'){ $('#Targets_Reason').show(); }else{ $('#Targets_Reason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <br>
          <textarea name="Targets_Reason" id="Targets_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Any Ideas/Suggestions/Improvements?</p>
          <textarea type="text" class="form-control" id="anyideasuggest" name="anyideasuggest" required></textarea>
      </div>
      <div class="col-md-6 "  style="padding-top:2%;">
      <li class="list-group-item" style="background-color:#e4e4e4">HR Comments & Suggested Action</p>
          <textarea type="text" class="form-control" id="hrcomments" name="hrcomments" required></textarea>
      </div>
            
       <div class="col-md-6"  style="margin-left:45%;padding-top:5%;">
          <input type="submit" class="check-in" >
      </div> 
          
      </div>
    </form>
    </div>
    </div>

   </div>
</div>
  <?php } ?>
<br>
  <table class="table table-bordered table-responsive tableprint">
    <thead>
      <tr>
      <?php if($userdata['department'] =='HR'){ ?>
        <th>Action</th>
      <?php } ?>
        <th>Emp ID/Name</th>
        <th>Date</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Supervisor</th>
        <th>Average Absenteeism In Days</th>
        <th>Reason For Absenteeism</th>
        <th>Happy With Your Team?</th>
        <th>Comfortable With Your Supervisor?</th>
        <th>Any Issues?</th>
        <th>Achiveing Your Targets?</th>
        <th> Ideas/Suggestions/Improvements?</th>
        <th>HR Comments</th>
        <!-- <th>Revoke Date</th> -->
        <?php if($userdata['department'] =='HR'){ ?>
        <th>Action</th>
      <?php } ?>
      </tr>
    </thead>
    <tbody style="background-color:white">
      <?php
      $i=0;
      foreach($hr_feedback as $a){ ?>
      <tr>
      <?php if($userdata['department'] =='HR'){ ?>
        <td ><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#19a938;cursor:pointer"  onclick="viewstatusupdate(`<?php echo $a->id; ?>`,`<?php echo $a->name; ?>`,`<?php echo $a->month_year; ?>`,`<?php echo $a->avg_absentdays; ?>`,`<?php echo $a->reasonforabsent; ?>`,`<?php echo $a->team_happy; ?>`,`<?php echo $a->team_happy_reason; ?>`,`<?php echo $a->supervisor_confortable; ?>`,`<?php echo $a->supervisor_confortable_reason; ?>`,`<?php echo $a->anyissue; ?>`,`<?php echo $a->anyissue_reason; ?>`,`<?php echo $a->targets; ?>`,`<?php echo $a->targets_reason; ?>`,`<?php echo $a->anyideasuggest; ?>`,`<?php echo $a->hrcomments; ?>`)" ></i></td>
        <?php } ?>
        <td><?php echo ucfirst($a->emp_id."/".$a->name);?></td>
        <td><?php echo $a->create_date;?></td>
        <td><?php echo ucfirst($a->department);?></td>
        <td><?php echo ucfirst($a->designation);?></td>
        <td><?php echo ucfirst($a->supervisor_id."/".$a->supervisor_name );?></td>
        <td><?php echo ucfirst($a->avg_absentdays);?></td>
        <td><?php echo ucfirst($a->reasonforabsent); ?></td>
        <td><?php echo "<b>".ucfirst($a->team_happy)."</b><br>";
              if($a->team_happy == 'No'){ 
                echo ucfirst($a->team_happy_reason); 
              }
        ?></td>
        <td><?php echo "<b>".ucfirst($a->supervisor_confortable)."</b><br>";
          if($a->supervisor_confortable == 'No'){ 
            echo ucfirst($a->supervisor_confortable_reason); 
          }
        ?></td>
        <td><?php echo "<b>".ucfirst($a->anyissue)."</b><br>";
          if($a->supervisor_confortable == 'Yes'){ 
            echo ucfirst($a->anyissue_reason); 
          }
        ?></td>
        <td><?php echo  "<b>".ucfirst($a->targets)."</b><br>";
          if($a->targets == 'No'){ 
            echo ucfirst($a->targets_reason); 
          }
        
        ?></td>
        <td><?php echo  ucfirst($a->anyideasuggest);  ?></td>
        <td><?php echo  ucfirst($a->hrcomments);  ?></td>
        <?php if($userdata['department'] =='HR'){ ?>
        <td ><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#19a938;cursor:pointer"  onclick="viewstatusupdate(`<?php echo $a->id; ?>`,`<?php echo $a->name; ?>`,`<?php echo $a->month_year; ?>`,`<?php echo $a->avg_absentdays; ?>`,`<?php echo $a->reasonforabsent; ?>`,`<?php echo $a->team_happy; ?>`,`<?php echo $a->team_happy_reason; ?>`,`<?php echo $a->supervisor_confortable; ?>`,`<?php echo $a->supervisor_confortable_reason; ?>`,`<?php echo $a->anyissue; ?>`,`<?php echo $a->anyissue_reason; ?>`,`<?php echo $a->targets; ?>`,`<?php echo $a->targets_reason; ?>`,`<?php echo $a->anyideasuggest; ?>`,`<?php echo $a->hrcomments; ?>`)" ></i></td>
        <?php } ?>
        
      </tr>


      <div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
          <div class="modal-content">
            <form action="<?php echo base_url(); ?>Feedbackform/updatefeedbackhr" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <input type="hidden" name="indexid" id="indexid">
              <div class="row">
              <div class="col-md-12">
                <p id="monthandyear"></p>
              </div>
                <div class="col-md-6" style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Average Absenteeism In Days</p>
          <input type="text" class="form-control" id="updateaverageAbsentDays" name="averageAbsentDays" required  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Reason For Absenteeism as given by employee</p>
          <input type="text" class="form-control" id="updateReasonforAbsent" name="ReasonforAbsent" required>
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Happy With Your Team?</p>
          <select class="form-control" id="updateTeamHappy" name="TeamHappy" required  onchange="if($(this).val() == 'No'){ $('#update_teamhappyReason').show(); }else{ $('#update_teamhappyReason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <br>
          <textarea name="teamhappyReason" id="update_teamhappyReason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 

      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Comfortable With Your Supervisor?</p>
          <select class="form-control" id="updateSupervisorConfortable" name="SupervisorConfortable" required  onchange="if($(this).val() == 'No'){ $('#update_conf_supervisor_Reason').show(); }else{ $('#update_conf_supervisor_Reason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <br>
          <textarea name="conf_supervisor_Reason" id="update_conf_supervisor_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea>
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
        <li class="list-group-item"  style="background-color:#e4e4e4">Do You Have Any Issues?</p>
          <!-- <input type="text" class="form-control" id="updateAnyissue" name="Anyissue" required> -->
          <select class="form-control" id="updateAnyissue" name="Anyissue" required  onchange="if($(this).val() == 'Yes'){ $('#update_Anyissue_Reason').show(); }else{ $('#update_Anyissue_Reason').hide(); }">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
          <textarea name="Anyissue_Reason" id="update_Anyissue_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Are You Achiveing Your Targets?</p>
          <select class="form-control"  id="updateTargets" name="Targets" required onchange="if($(this).val() == 'No'){ $('#update_Targets_Reason').show(); }else{ $('#update_Targets_Reason').hide(); }">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <textarea name="Targets_Reason" id="update_Targets_Reason" style="display:none;" class="form-control" placeholder="Remark"></textarea> 
      </div>
      <div class="col-md-6"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Any Ideas/Suggestions/Improvements?</p>
          <textarea type="text" class="form-control" id="updateanyideasuggest" name="anyideasuggest" required></textarea>
      </div>
      <div class="col-md-6 "  style="padding-top:2%;">
      <li class="list-group-item" style="background-color:#e4e4e4">HR Comments & Suggested Action</p>
          <textarea type="text" class="form-control" id="updatehrcomments" name="hrcomments" required></textarea>

      </div>
    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    <?php } ?>
    </tbody>
  </table>

  </div>
</div>
</div>
</div>
</body>

<script>
function showvalue(){
    var emp_id = $("#useridemp").children("option:selected").val();
    var data = emp_id.split("/");
    //console.log(data);
    if(data[5]){
      $('#employeedesignation').html('<p style="font-weight:bold;">'+data[5]+'</p>');
    }else{
      $('#employeedesignation').html('');
    }
    
    if(data[2]){
      $('#employeedepartment').html('<p style="font-weight:bold;">'+data[2]+'</p>');
    }else{
      $('#employeedepartment').html('');
    }
   
    if(data[3]){
      $('#employeesupervisor').html('<p style="font-weight:bold;">'+data[3]+'/'+data[4]+'</p>');
    }else{
      $('#employeesupervisor').html('');
    }
    getattendanceview();
}



function viewstatusupdate(i,emp_name,monthyr,avg_absentdays,reasonforabsent,team_happy,team_happy_reason,supervisor_confortable,supervisor_confortable_reason,anyissue,anyissue_reason,targets,targets_reason,anyideasuggest,hrcomments){
  $('#indexid').val(i);
  var getmn = monthyr.split("-");
  var monthid=getmn[0];
  const monthNumberToLabelMap = {
  [1]: 'January',
  [2]: 'February',
  [3]: 'March',
  [4]: 'April',
  [5]: 'May',
  [6]: 'June',
  [7]: 'July',
  [8]: 'August',
  [9]: 'September',
  [10]: 'October',
  [11]: 'November',
  [12]: 'December',
}
  $('#exampleModalLongTitle').html(emp_name+' - Feedback Form Update')
  $("#updatestatus").trigger("reset");
  $('#updatestatus #monthandyear').html('<b>'+monthNumberToLabelMap[monthid]+' '+getmn[1]+'</b>');
  $('#updatestatus #updateaverageAbsentDays').val(avg_absentdays);
  $('#updatestatus #updateReasonforAbsent').val(reasonforabsent);
  $('#updatestatus #updateTeamHappy').val(team_happy);
  $('#updatestatus #updateSupervisorConfortable').val(supervisor_confortable);
  $('#updatestatus #updateAnyissue').val(anyissue);
  $('#updatestatus #updateTargets').val(targets);
  $('#updatestatus #updateanyideasuggest').val(anyideasuggest);
  $('#updatestatus #updatehrcomments').val(hrcomments);
  //$('#updatestatus #updateTargets').val(targets);
  if(team_happy == 'No'){ 
    $('#update_teamhappyReason').show();
    $('#update_teamhappyReason').val(team_happy_reason);
  }else{ $('#update_teamhappyReason').hide(); }

  if(supervisor_confortable == 'No'){ 
    $('#update_conf_supervisor_Reason').show(); 
    $('#update_conf_supervisor_Reason').val(supervisor_confortable_reason);
  }else{ $('#update_conf_supervisor_Reason').hide(); }

  if(anyissue == 'Yes'){ 
    $('#update_Anyissue_Reason').show();
    $('#update_Anyissue_Reason').val(anyissue_reason);
  }else{ $('#update_Anyissue_Reason').hide(); }

  if(targets == 'No'){ 
    $('#update_Targets_Reason').show();
    $('#update_Targets_Reason').val(targets_reason);
  }else{ $('#update_Targets_Reason').hide(); }

  var ts='#updatestatus';
  $(ts).modal('toggle');
}

$("#monthdatepicker").datepicker( {
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
});


$('#monthdatepicker').change(function() { 
  getattendanceview();
});
$('#quarterly').change(function() { 
  getattendanceview();
});

function getattendanceview(){
  var d = new Date();
  var twoDigitMonth = (d.getMonth()+1);
  var todaydate =d.getDate() + "-" + twoDigitMonth +"-"+d.getFullYear();
  var userdataval =$('#useridemp').val();
  var getidonly = userdataval.split("/");

  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getReportAttendance_hrfeedback",
    method : "POST",
    data : {"userid":getidonly[0],"monthyear":$('#monthdatepicker').val(),"quarterly":$('#quarterly').val()},
    success : function(datares){
      var dataset = JSON.parse(datares);
      var data=dataset.attendancedata;
      console.log(data);
      var presentcount=0;
      var leavecount=0;
      var absentcount=0;
      var latelogin_count =0;
      var earlylogout_count =0;
      for(var i=0;i<data.length;i++){
        if(data[i]['Date'] == todaydate){ break; }
        if(data[i]['Status'] == '<p id="presentid">Present</p>'){
          presentcount = presentcount + 1;
        }
        if(data[i]['Status'] == '<p id="leaveid">Leave</p>'){
          leavecount = leavecount + 1;
        }
        if(data[i]['Status'] == '<p id="absentid">Absent</p>'){
          absentcount = absentcount + 1;
        }
      }
      var aveAbs = parseInt(absentcount)/parseInt(3);
      $("#averageabview").html('Total Absents: '+absentcount+' Days');
      $('#averageAbsentDays').val(aveAbs.toFixed(0));
    }
  });
}
$(document).ready( function () {
    var department="<?php echo $userdata['department'] ?>";
    var role="<?php echo $userdata['role'] ?>";
  if(department == 'HR' && role =='supervisor')
  {
    $('.tableprint').DataTable({
      dom: 'Bfrtip',
       buttons: [{
         extend:'excel',
         title: 'One on One Feedback HR Report',
       },
       {
         extend:'pdf',
         title: 'One on One Feedback HR Report',
       },
       {
         extend:'print',
         title: 'One on One Feedback HR Report',
       }
       ],
    });
  }else{
    $('.tableprint').DataTabl();
  }
});
$('.useridhrfeedback').select2();

//viewSeparation();
function viewhrfeedback(){

  $('#viewoneononeform').toggle();
  
}
</script>
