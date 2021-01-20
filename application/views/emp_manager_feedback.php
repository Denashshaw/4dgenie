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
.table-bordered {
    border: 1px solid #dee2e6;
    background: whitesmoke;
}

.complete{
    display:none;
}

.more {
    background: #f8f9fa;
    color: red;
    font-size: 13px;
    padding: 3px;
    cursor: pointer;
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
			<div class="col-md-12 activity">One on One Feedback</div>
		</div>
    <?php
   // echo $this->session->flashdata('msg');
    ?>
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
    <!-- <form id="attendfilter"> -->


    <!-- </form> -->
<br><br>
<div class="col-md-12">
  <br>
  <div>
    <?php if($userdata['role'] == 'agent'){ ?>
    <button  onclick="viewhrfeedback()" style="margin-left:90%" class="check-out">Add</button>
    <?php } ?>
    <?php if($userdata['department'] =='MANAGEMENT' || $userdata['role'] =='supervisor'){ ?>
      <form method="POST" action="<?php echo base_url(); ?>Feedbackform/uploadcsv"  enctype="multipart/form-data">
        <input type="file" id="uploadcsv" name="uploadcsv" style="margin-left:70%;width:250px;float:left" class="form-control" accept=".csv">
        <input type="submit" class="btn btn-success">
      </form>
    <?php } ?>
    <div class="card card-body" style="display:none" id="viewoneononeform">
    <form action="<?php echo base_url(); ?>Feedbackform/addmonthlyfeedbackAgent" method="POST">
    <div  class="row" >
      <div class="col-md-4" style="border-right: 2px solid #cec4c4;">
        <p>Employee</p>
        <!-- <select class="form-control useridhrfeedback" id="useridemp" name="useridemp" onchange="showvalue()" required>
          <?php if($userdata['role'] != 'agent'){ ?>
          <option style="display: none;" value="" selected>Select Employee ID</option>
            <?php foreach ($emp_data as $emp) { ?>
              <option value="<?php echo $emp->emp_id.'/'.$emp->name.'/'.$emp->department.'/'.$emp->manager_id.'/'.$emp->reporting_manager.'/'.$emp->designation; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
            <?php } ?>
          <?php }?>
        </select> -->
        <?php foreach ($emp_data as $emp) {
          if($emp->emp_id == $userdata['emp_id']){
          ?>
          <input type="hidden" id="useridemp" name="useridemp" value="<?php echo $emp->emp_id.'/'.$emp->name.'/'.$emp->department.'/'.$emp->manager_id.'/'.$emp->reporting_manager.'/'.$emp->designation; ?>">
        <input type="text" id="emp_details" name="emp_details" class="form-control" value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" readonly>
        <?php
        }
      } ?>
      </div>
      <div class="col-md-4"  style="border-right: 2px solid #cec4c4;">
        <p>Designation</p>
        <h5 id="employeedesignation"></h5>
      </div>
      <div class="col-md-4" >
        <p>Department</p>
        <h5 id="employeedepartment" ></h5>
      </div>

      <div class="col-md-12"  style="padding-top:5%;">
        <table class="table table-bordered menu1">
          <tr>
              <td style="min-width: 189px ! important">
                <p>Reviewer Name</p>
                <h5 ><?php if($userdata['department'] == 'MANAGEMENT'){ echo '<b>'.$userdata['emp_id']."/ ".$userdata['name'].'</b>'; }else{
                  ?><b id="employeesupervisor"></b><?php
                } ?></h5>
              </td>

              <td>
                <p>Date</p>
                <input type="date" id="getdate" name="getdate" value="<?php echo date('Y-m-d'); ?>" style="margin-top: 1%;" >
              </td>
              <td>
                <p>Month & Year</p>
                <input type="text" id="monthdatepicker" name="monthdatepicker"  value="<?php echo date("m",strtotime("-1 month"))."-".date("Y"); ?>" style="margin-top: 1%;">
              </td>
          </tr>
        </table>
      </div>
      <br><br>
      <div class="col-md-12" style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Achievements</p>
          <textarea class="form-control" id="achivements" name="achivements" required rows=5 required></textarea>
      </div>
      <div class="col-md-12"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Area of Improvement</p>
        <textarea class="form-control" id="areaofimporvement" name="areaofimporvement" required rows=5 required></textarea>
      </div>
      <div class="col-md-12"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Goals for next month</p>
        <textarea class="form-control" id="goalsfornexmonth" name="goalsfornexmonth" required rows=5 required></textarea>
      </div>
      <div class="col-md-12"  style="padding-top:2%;">
      <li class="list-group-item"  style="background-color:#e4e4e4">Employee Comments</p>
        <textarea class="form-control" id="emp_remark" name="emp_remark" required rows=5 ></textarea>
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

<br>
  <table class="table table-bordered table-responsive tableprint">
    <thead>
      <tr>
      <?php if($userdata['department'] =='MANAGEMENT' || $userdata['role'] == 'supervisor'){ ?>
        <th>Action</th>
      <?php } ?>
        <th>Emp ID/Name</th>
        <th>Date</th>
        <th>Month & Year</th>

        <th>Department</th>
        <th>Designation</th>
        <th>Reviewer</th>
        <th>Reviewer Title</th>
        <th>Production %</th>
        <th>Quality %</th>
        <th>Attendance</th>
        <th>Time Efficiency</th>

        <th>Achievements</th>
        <th>Area of Improvement</th>
        <th>Goals for next month</th>
        <th>Employee Comments</th>
        <th>Reviewer Comments</th>
        <!-- <th>Revoke Date</th> -->
        <?php if($userdata['department'] =='MANAGEMENT'  || $userdata['role'] == 'supervisor'){ ?>
        <th>Action</th>
      <?php } ?>
      </tr>
    </thead>
    <tbody style="background-color:white">
      <?php
      $i=0;
      foreach($manager_feedback as $a){

      ?>
      <tr>
      <?php if($userdata['department'] =='MANAGEMENT'  || $userdata['role'] == 'supervisor'){ ?>
        <td ><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#19a938;cursor:pointer"  onclick="viewstatusupdate(`<?php echo $a->id; ?>`)" ></i></td>
        <?php } ?>
        <td><?php echo ucfirst($a->emp_id."/".$a->name);?></td>
        <td><?php echo $a->date_apply;?></td>
        <td><?php echo ucfirst($a->monthyear); ?></td>
        <td><?php echo ucfirst($a->department);?></td>
        <td><?php echo ucfirst($a->designation);?></td>
        <td><?php echo ucfirst($a->reviewer_id."/".$a->reviewer_name );?></td>
        <td><?php echo ucfirst($a->reviewer_title);?></td>
        <td><?php echo ucfirst($a->produnction_perc);?></td>
        <td><?php echo ucfirst($a->quality_perc);?></td>
        <td><?php echo ucfirst($a->attendance);?></td>
        <td><?php echo ucfirst($a->time_efficiency);?></td>


        <td >
          <span class="readmore">
            <?php
            $achieven_len = strlen($a->achievements);
            echo ucfirst(substr($a->achievements,0,50));
            ?>
          </span>
          <?php if($achieven_len > 50){ ?>
            <span class="complete"><?php echo ucfirst(substr($a->achievements,50,$achieven_len)); ?></span>
           <span class="more">more...</span>
          <?php } ?>
        </td>
        <td>
          <span class="readmore">
            <?php
            $areaofimport_len = strlen($a->area_of_improvement);
            echo ucfirst(substr($a->area_of_improvement,0,50));
            ?>
          </span>
          <?php if($areaofimport_len > 50){ ?>
            <span class="complete"><?php echo ucfirst(substr($a->area_of_improvement,50,$areaofimport_len)); ?></span>
           <span class="more">more...</span>
          <?php } ?>
        </td>
        <td>
          <span class="readmore">
            <?php
            $goalsfornextmonth_len = strlen($a->goals_for_next_month);
            echo ucfirst(substr($a->goals_for_next_month,0,50));
            ?>
          </span>
          <?php if($goalsfornextmonth_len > 50){ ?>
            <span class="complete"><?php echo ucfirst(substr($a->goals_for_next_month,50,$goalsfornextmonth_len)); ?></span>
           <span class="more">more...</span>
          <?php } ?>
        </td>
        <td>
          <span class="readmore">
            <?php
            $emplouyeecom_len = strlen($a->employee_com);
            echo ucfirst(substr($a->employee_com,0,50));
            ?>
          </span>
          <?php if($emplouyeecom_len > 50){ ?>
            <span class="complete"><?php echo ucfirst(substr($a->employee_com,50,$emplouyeecom_len)); ?></span>
           <span class="more">more...</span>
          <?php } ?>
        </td>
        <td>
          <span class="readmore">
            <?php
            $reviewercom_len = strlen($a->reviewer_comm);
            echo ucfirst(substr($a->reviewer_comm,0,50));
            ?>
          </span>
          <?php if($reviewercom_len > 50){ ?>
            <span class="complete"><?php echo ucfirst(substr($a->reviewer_comm,50,$reviewercom_len)); ?></span>
           <span class="more">more...</span>
          <?php } ?>
        </td>

        <?php if($userdata['department'] =='MANAGEMENT'  || $userdata['role'] == 'supervisor'){ ?>
        <td ><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#19a938;cursor:pointer"  onclick="viewstatusupdate(`<?php echo $a->id; ?>`)" ></i></td>
        <?php } ?>

      </tr>




    <?php } ?>
    </tbody>
  </table>

  <div class="modal fade bd-example-modal-xl viewdetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="headersetup"> Feedback Form</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
          <form action="<?php echo base_url(); ?>Feedbackform/updatereviewer" method="POST">
          <div class="row">
          <input type="hidden" id="empidval" name="empidval">
          <input type="hidden" id="indexplace" name="indexplace">
            <div class="col-md-6 card" style="background:#78a9dc91">
              <table class="table table-bordered" style="background: whitesmok !important">
                <tr>
                  <td>Employee</td>
                  <td id="empid"></td>
                  <td>Reviewer</td>
                  <td id="reviewer"></td>
                </tr>
                <tr>
                  <td>Designation</td>
                  <td id="designationview"></td>
                  <td>Department</td>
                  <td id="departmentview"></td>
                </tr>
                <tr>
                  <td>Month & Year</td>
                  <td id="monthview"></td>
                  <td>Date</td>
                  <td id="dateview"></td>
                </tr>
              </table>
              <div class="card card-body">
                <b>Achievements</b>
                <div id="achivementview" style="max-height:80px;overflow-y: auto;"></div>
              </div>
              <div class="card card-body">
                <b>Area of Improvement</b>
                <div id="areaofimproveview" style="max-height:80px;overflow-y: auto;"></div>
              </div>
              <div class="card card-body">
                <b>Goals for next month</b>
                <div id="goalview" style="max-height:80px;overflow-y: auto;"></div>
              </div>
              <div class="card card-body">
                <b>Employee Comments</b>
                <div id="emp_comm_view" style="max-height:80px;overflow-y: auto;"></div>
              </div>

            </div>
            <div class="col-md-6" style="font-size:12px;">
            <p  style="font-size:12px;">Reviewer Title</p>
            <input type="text" class="form-control" id="reviewtitle" name="reviewtitle" required>
            <br>

            <table class="table table-bordered menu2">
              <tr >
                  <td>
                    <p style="font-size:12px;">Production %</p>
                    <input type="text" id="prod_percentage" name="prod_percentage" class="form-control" style="font-size: 12px;" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  required>
                  </td>
                  <td>
                    <p  style="font-size:12px;">Quality %</p>
                    <input type="text" id="quality_percenatage" name="quality_percenatage" class="form-control"  style="font-size:12px;"  required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p  style="font-size:12px;">Attendance</p>
                    <input type="text" id="attendance" name="attendance" class="form-control"  style="font-size:12px;"  required>
                  </td>
                  <td>
                    <p  style="font-size:12px;">Time Efficiency</p>
                    <input type="text" id="timeefficiency" name="timeefficiency" class="form-control"  style="font-size:12px;"  required>
                  </td>
              </tr>
            </table>

            <p style="font-size:12px;">Reviewer Comments</p>
            <textarea class="form-control" rows=10 id="reviewercomm" name="reviewercomm"></textarea>
                <div class="col-md-6"  style="margin-left:45%;padding-top:5%;">
              <input type="submit" class="check-in" >
          </div>
      </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>




  </div>
</div>
</div>
</div>
</body>

<?php if($userdata['department'] != 'MANAGEMENT'){ ?>
  <script>
    $('.menu1 input').prop("readonly", true);
    $('#monthdatepicker').attr('disabled', true);
    $('.menu2 input').prop("readonly", true);
    //$('#monthdatepicker').attr('disabled', true);
  </script>
<?php } ?>
<script>
$(".more").click(function(){

}, function(){
  if($(this).text() == 'more...'){

$(this).text("less..").siblings(".complete").show();
}else{
$(this).text("more..").siblings(".complete").hide();
}
});

showvalue();
function showvalue(){
    //var emp_id = $("#useridemp").children("option:selected").val();
    var emp_id = $("#useridemp").val();
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



function viewstatusupdate(i){
  $('#indexplace').val(i);
  $.ajax({
    url : "<?php echo base_url(); ?>Feedbackform/getFeedbackdetails",
    method : "POST",
    data : {"indexid":i},
    success : function(datares){
      var res = JSON.parse(datares);
      console.log(res);
      $('#empidval').val(res[0]['emp_id']+'/'+res[0]['name']);
      $('#empid').html('<b>'+res[0]['emp_id']+'/'+res[0]['name']+'</b>');
      $('#reviewer').html('<b>'+res[0]['reviewer_id']+'/'+res[0]['reviewer_name']+'</b>');
      $('#designationview').html('<b>'+res[0]['designation']+'</b>');
      $('#departmentview').html('<b>'+res[0]['department']+'</b>');
      $('#dateview').html('<b>'+res[0]['date_apply']+'</b>');
      $('#monthview').html('<b>'+res[0]['monthyear']+'</b>');
      $('#achivementview').html('<p style="font-size:12px">'+res[0]['achievements']+'</p>');
      $('#areaofimproveview').html('<p style="font-size:12px">'+res[0]['area_of_improvement']+'</p>');
      $('#goalview').html('<p style="font-size:12px">'+res[0]['goals_for_next_month']+'</p>');
      $('#emp_comm_view').html('<p style="font-size:12px">'+res[0]['employee_com']+'</p>');
    }
  });

  var ts='.viewdetails';
  $(ts).modal('toggle');
}

$("#monthdatepicker").datepicker( {
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months",
});




$('#monthdatepicker').change(function() {
  getattendanceview();
});

function getattendanceview(){
  var d = new Date();
  var twoDigitMonth = (d.getMonth()+1);
  var todaydate =d.getDate() + "-" + twoDigitMonth +"-"+d.getFullYear();
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getReportAttendance",
    method : "POST",
    data : {"userid":$('#useridemp').val(),"monthyear":$('#monthdatepicker').val()},
    success : function(datares){
      var dataset = JSON.parse(datares);
      var data=dataset.attendancedata;
     // console.log(data);
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
      console.log(absentcount);
      $('#averageAbsentDays').val(absentcount);
    }
  });
}
$(document).ready( function () {
    var test="<?php echo $userdata['department'] ?>";
    var role ="<?php echo $userdata['role'] ?>";
  if(test == 'MANAGEMENT' || role == 'supervisor')
  {
    $('.tableprint').DataTable({
      dom: 'Bfrtip',
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
       buttons: [
        'pageLength',
        {
         extend:'excel',
         title: 'One on One Feedback Report',
       },
       {
         extend:'pdf',
         title: 'One on One Feedback Report',
       },
       {
         extend:'print',
         title: 'One on One Feedback Report',
       }
       ],
    });
  }else{
    $('.tableprint').DataTable();
  }
});
$('.useridhrfeedback').select2();

//viewSeparation();
function viewhrfeedback(){

  $('#viewoneononeform').toggle();

}


</script>
