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
#presentid{
      background-color:#3fc98e;
      border-radius: 25px;
      color:white;
      text-align: center;
}
#absentid{
      background-color:#ff5c4b;
      border-radius: 25px;
      color:white;
      text-align: center;
}
#leaveid{
      background-color:#536ece;
      border-radius: 25px;
      color:white;
      text-align: center;
}
</style>
<?php
 include('header.php');
$userdata=$this->session->all_userdata();
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
						<div class="col-md-12 activity">Employee Attendance</div>
		</div>
      
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
   
    <!-- <form id="attendfilter"> -->
    <div class="col-md-12">
      <table><tr>
      <td>
      <p>Employee</p>
      <select class="form-control useridvalattendance" id="useridemp" name="useridemp" required>
        <?php if($userdata['role'] != 'agent'){ ?>
        <option style="display: none;" value="" selected>Select Employee ID</option>
          <?php foreach ($emp_data as $emp) { ?>
            <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
          <?php } ?>
        <?php }else{ ?>
           <option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option>
        <?php } ?>
      </select>
      </td>
      <td>
      <p>Month & Year</p>
      <input type="text" id="attendancedatepicker" name="attendancedatepicker" value="<?php echo date("m-Y"); ?>">
      </td>
      <td><br><br>
          <button class="check-in" onclick="getattendanceview()">Submit</button>
      </td>
      </tr>
    </table>
    </div>
    <!-- </form> -->
    
  

    <div class="card card-body" style="width:15%;margin-left:2%;background-color:#3fc98e ">
      <p style="color:white">Present</p>
      <h1  style="color:white" id="presentcount"></h1>
    </div>

    <div class="card  card-body" style="width:15%;margin-left:2%;background-color: #536ece">
       <p style="color:white">Leave</p>
      <h1  style="color:white" id="leavecount"></h1>
    </div>

   <div class="card  card-body" style="width:15%;margin-left:2%; margin-right: :2%;background-color:#ff5c4b">
     <p style="color:white">Absent</p>
      <h1  style="color:white" id="absentcount"></h1>
    </div>
    <div class="card  card-body" style="width:10%;margin-left:2%; margin-right: :2%;background-color:#7d8a98">
     <p style="color:white">Late Login</p>
      <h1  style="color:white" id="Lateloginid"></h1>
    </div>
    <div class="card  card-body" style="width:10%;margin-left:2%; margin-right: :2%;background-color:#7d8a98">
     <p style="color:white">Early Logout</p>
      <h1  style="color:white" id="Earlylogoutid"></h1>
    </div>
 
</div>
<br>
<div class="card card-body shifttiming">
</div>
  <br>
  <table class="table table-bordered" id="myTable" style="font-size:14px;">
    <thead>
      <tr>
        <td class="colhead">Date</td>
        <!-- <td class="colhead">Day</td> -->
        <td class="colhead">Status</td>
        <td class="colhead">Login Time</td>
        <td class="colhead">Logout Time</td>
        <td class="colhead">Total Login Hr</td>
        <td class="colhead">Total Permission</td>
        <td class="colhead">Total Break Hr</td>
      </tr>
    </thead>
    <tbody id="attendanceresone">
          
    </tbody>
</table>
</div>
</div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
$('.useridvalattendance').select2();

$("#attendancedatepicker").datepicker( {
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months"
});
<?php if($userdata['role'] == 'agent'){ ?>
  getattendanceview();
<?php } ?>
function getattendanceview(){
  var d = new Date();
  var twoDigitMonth = (d.getMonth()+1);
  var todaydate =twoDigitMonth + "/" + d.getDate()+"/"+d.getFullYear();
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getReportAttendance",
    method : "POST",
    data : {"userid":$('#useridemp').val(),"monthyear":$('#attendancedatepicker').val()},
    success : function(datares){
      var dataset = JSON.parse(datares);
      var data = dataset.attendancedata;
      var out ='';
      var presentcount=0;
      var leavecount=0;
      var absentcount=0;
      var latelogin_count =0;
      var earlylogout_count =0;
      for(var i=0;i<data.length;i++){
        if(data[i]['permission'] != null){
        var per = data[i]['permission'] 
       }else{
        var per ='';
       }
       if(data[i]['Day'] == 'Sunday'){
        out += '<tr style="background-color:#ff8f008a">';
     
       }else{
        out += '<tr>';
       
       }
       
       //Check in different
       var dtofDB = data[i]['Date'].split("-");
       var dtcuu = dtofDB[2]+"/"+ dtofDB[1] +"/"+ dtofDB[0];
      var ft =(dtcuu+" "+dataset.shiftdetails[0].checkin);
       
       var att_checkin_gettime = data[i]['checkin'].split(" ");
       var att_checkin = att_checkin_gettime[0].split("-");
       var att_checkin_order = att_checkin[2]+"/"+ att_checkin[1] +"/"+ att_checkin[0];
       var attcheck = (att_checkin_order+" "+att_checkin_gettime[1]);
      
      var currentval = new Date(ft);
      // 10 min extra time 
      var start_actual_time = new Date(currentval.getTime() + 10*60000);
      var end_actual_time = new Date(attcheck);
      var formatted = calculateTimediff(start_actual_time,end_actual_time);
      var timesplit1 = formatted.split(":");
      //console.log(timesplit1);
      //without 10 mins 
      var formatted_without = calculateTimediff(currentval,end_actual_time);
      
      if(att_checkin_gettime[1] == undefined){
        var time_in = '';
      }else{
        var time_in =att_checkin_gettime[1];
      }

      // Check out time
      var ft2 =(dtcuu+" "+dataset.shiftdetails[0].checkout);
       
       var att_checkout_gettime = data[i]['checkout'].split(" ");
       var att_checkout = att_checkout_gettime[0].split("-");
       var att_checkout_order = att_checkout[2]+"/"+ att_checkout[1] +"/"+ att_checkout[0];
       var attcheck1 = (att_checkout_order+" "+att_checkout_gettime[1]);
      
      var currentval_out = new Date(ft2);
      // 10 min extra time 
      var start_actual_time_out = new Date(currentval_out.getTime() - 10*60000);
      var end_actual_time_out = new Date(attcheck1);
      console.log(end_actual_time_out+" - "+start_actual_time_out);
      var formatted_out = calculateTimediff(end_actual_time_out,start_actual_time_out);
      var timesplit1_out = formatted_out.split(":");
      console.log(timesplit1_out);
      //without 10 mins 
      var formatted_without_out = calculateTimediff(end_actual_time_out,currentval_out);
      
      if(att_checkout_gettime[1] == undefined){
        var time_out = '';
      }else{
        var time_out   =att_checkout_gettime[1];
      }

        var dtget=data[i]['Date'];
        var expdt=dtget.split("-");
        var dtformate=expdt[1]+"/"+expdt[0]+"/"+expdt[2];
        var dtof=new String(new Date(dtformate));
        var split_dt = dtof.split(' 00:00:00 ');
        out += '<td>'+split_dt[0]+'</td>';

       // out += '<td>'+data[i]['Day']+'</td>';
        out += '<td>'+data[i]['Status']+'</td>';
        if(timesplit1[0] == 'NaN' || parseInt(timesplit1[0]) == '0-1' || timesplit1[0] == '0-2' || (parseInt(timesplit1[0]) == 0 && parseInt(timesplit1[1]) == 0)){
          out += '<td>'+time_in+'</td>';
        }
        if(parseInt(timesplit1[0]) > 0 || parseInt(timesplit1[1]) > 0 ){
          latelogin_count++;
          out += '<td onclick="viewlatelogin(`'+dataset.shiftdetails[0].checkin+'`,`'+time_in+'`,`'+data[i]['Date']+'`,`'+formatted_without+'`)"><p style="border: 1px solid #ad0a64;padding:5%" >'+time_in+'</p></td>';  
        }
        if(timesplit1_out[0] == 'NaN' || parseInt(timesplit1_out[0]) == '0-1' || timesplit1_out[0] == '0-2' || (parseInt(timesplit1_out[0]) == 0 && parseInt(timesplit1_out[1]) == 0)){
          out += '<td>'+time_out+'</td>';
        }
        if(parseInt(timesplit1_out[0]) > 0 || parseInt(timesplit1_out[1]) > 0 ){
          earlylogout_count++;
          out += '<td onclick="viewlatelogout(`'+dataset.shiftdetails[0].checkout+'`,`'+time_out+'`,`'+data[i]['Date']+'`,`'+formatted_without_out+'`)"><p style="border: 1px solid #ad0a64;padding:5%" >'+time_out+'</p></td>';  
        }
        //out += '<td>'+time_out+'</td>';
        out += '<td>'+data[i]['worktimingg']+'</td>';
        out += '<td>'+per+'</td>';
        out += '<td>'+data[i]['braktime']+'</td>';
        out += '</tr>';

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
      $('#Lateloginid').html(latelogin_count);
      $('#Earlylogoutid').html(earlylogout_count);
      $('#presentcount').html(presentcount);
      $('#leavecount').html(leavecount);
      $('#absentcount').html(absentcount);
      $('#attendanceresone').html(out);
      var checkintim = dataset.shiftdetails[0].checkin;
      var checkout = dataset.shiftdetails[0].checkout;
      $('.shifttiming').html("<h4 style='text-align:center'>"+checkintim+" - "+checkout+"</h4>"); 
    }
  });
}
function viewlatelogout(shifttime,logintime,logindate,timedifferent){
  $('#checkout_notification').modal('toggle');
        console.log(shifttime);
        var spt = timedifferent.split(':');
        $('#checkout_notification #date1').html("<h4 style='text-align:center;margin-top:20%'>"+logindate+"</h4>");
        $('#checkout_notification #shifttime_in').html("Shift Time:<br><b>"+shifttime+"</b>");
        $('#checkout_notification #logintime_in').html("Login Time:<br><b>"+logintime+"</b>");
        if(spt[0] != '00'){
          var h_print = spt[0]+" Hours "+spt[1]+" Minutes";
        }else{
          var h_print = spt[1]+" Minutes";
        }
        $('#checkout_notification #logintime_in_differe').html("Time Different<br><h5>"+h_print+"</h5>");
}
function viewlatelogin(shifttime,logintime,logindate,timedifferent){
  $('#checkin_notification').modal('toggle');
        console.log(shifttime);
        var spt = timedifferent.split(':');
        $('#checkin_notification #date1').html("<h4 style='text-align:center;margin-top:20%'>"+logindate+"</h4>");
        $('#checkin_notification #shifttime_in').html("Shift Time:<br><b>"+shifttime+"</b>");
        $('#checkin_notification #logintime_in').html("Login Time:<br><b>"+logintime+"</b>");
        if(spt[0] != '00'){
          var h_print = spt[0]+" Hours "+spt[1]+" Minutes";
        }else{
          var h_print = spt[1]+" Minutes";
        }
        $('#checkin_notification #logintime_in_differe').html("Time Different<br><h5>"+h_print+"</h5>");
}
function calculateTimediff(starttime,endtime){
      var diff = endtime - starttime;
      var diffSeconds = diff/1000;
      var HH = Math.floor(diffSeconds/3600);
      var MM = parseInt(Math.floor(diffSeconds%3600)/60);
      
      var formatted_res= ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM)
      
      return formatted_res;
     }
</script>
<div class="modal fade" id="checkin_notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Late Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" style="border: 1px solid #ad0a64">
          <tr  style="border: 1px solid #ad0a64">
            <td rowspan=3 id="date1"  style="border: 1px solid #ad0a64"></td>
            <td id="shifttime_in"  style="border: 1px solid #ad0a64"></td>
          </tr>
          <tr  style="border: 1px solid #ad0a64">
            <td id="logintime_in"  style="border: 1px solid #ad0a64"></td>
          </tr>
          <tr  style="border: 1px solid #ad0a64">
            <td id="logintime_in_differe"  style="border: 1px solid #ad0a64"></td>
          </tr>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="checkout_notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Early Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" style="border: 1px solid #ad0a64">
          <tr  style="border: 1px solid #ad0a64">
            <td rowspan=3 id="date1"  style="border: 1px solid #ad0a64"></td>
            <td id="shifttime_in"  style="border: 1px solid #ad0a64"></td>
          </tr>
          <tr  style="border: 1px solid #ad0a64">
            <td id="logintime_in"  style="border: 1px solid #ad0a64"></td>
          </tr>
          <tr  style="border: 1px solid #ad0a64">
            <td id="logintime_in_differe"  style="border: 1px solid #ad0a64"></td>
          </tr>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>