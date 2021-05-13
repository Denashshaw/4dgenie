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
.settdstyle{
  font-weight:bold;
  font-size:15px;
}
#chartdiv {
  width: 100%;
  height: 300px;
}

</style>
<?php
 include('header.php');
$userdata=$this->session->all_userdata();
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
      <div class="col-md-10 activity">Employee Attendance</div>
			<div class="col-md-2 activity" style="color:#bc1a1a6e;cursor:pointer" onclick="viewholidays()"><i class="fa fa-gift"></i> Holidays</div>
		</div>

<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">

    <!-- <form id="attendfilter"> -->
    <div class="col-md-9">
      <table><tr>
      <td>
      <p>Employee</p>
      <select class="form-control useridvalattendance" id="useridemp" name="useridemp" required>
        <?php if($userdata['role'] != 'agent'){ ?>
        <option style="display: none;" value="" selected>Select Employee ID</option>
        <option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option>
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
          <button class="check-in" onclick="getattendanceview()" style="background:#1abc9c">Submit</button>
      </td>
      </tr>
    </table>
    </div>
    <div class="col-md-3">
      <div style="text-align:center;margin:10%">
        <i class="fa fa-clock-o" style="font-size:20px;"></i><span id="inouttime"></span>
      </div>
    </div>
    <!-- </form> -->



    <!-- <div class="card card-body" style="width:15%;margin-left:2%;background-color:#3fc98e ">
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
    </div> -->

</div>
<br>
<div class="row">

  <div class="col-md-8">
    <div class="card card-body" style="background:#1abc9c;text-align:center">
      <h5 id="monthandyearview" style="font-family: 'Montserrat', sans-serif;"></h5>
    </div>
    <table class="table table-bordered viewtabel" id="myTable" style="font-size:14px;">
      <thead>
        <tr>

          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
          <th>Sunday</th>
        <tr>
      </thead>
      <tbody id="tableprint" style="background-color:#dddddd70;">

      </tbody>
    </table>
  </div>
  <div class="col-md-4">
      <table class="table table-bordered  rounded shadow">
        <tbody>
          <tr>
            <td style="background:#1abc9ca1">
              Present
            </td>
            <td style="background:#bc1a1a6e">
              Holiday
            </td>
            <td style="background:#c1be53">
              Absent
            </td>
            <td style="background:#5384c1">
              Leave
            </td>
          </tr>
        </tbody>
      </table>
      <!-- <p>Anual Leave Summary</p> -->
      <table class="table table-bordered  rounded shadow" style="display:none;">
        <thead>
          <tr>
            <th>Status</th>
            <th>Casual</th>
            <th>Privilege</th>
            <th>Sick leave</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Actual</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
          </tr>
          <tr>
            <td>Obtained</td>
            <td>2</td>
            <td>0</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Balance</td>
            <td>10</td>
            <td>12</td>
            <td>10</td>
          </tr>
        </tbody>
      </table>
      <div class="col-md-4 card card-body shadow rounded" style="font-family: 'Montserrat', sans-serif;font-size:12px;font-weight:bold;float:left">
          <b>LOP: <span id="lopcount"></span></b>
      </div>
      <div class="col-md-8 card card-body shadow rounded" style="font-family: 'Montserrat', sans-serif;font-size:12px;font-weight:bold">
          <b>Permission: <span id="permissionview"></span></b>
      </div>
  </div>
</div>

</div>
</div>
</div>
</body>
<div class="modal fade" id="viewdatedata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Dateofview"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div id="viewentireview">

        <table class="table table-bordered">
          <tr>
            <td><b>Check-In</b><p id="checkinview" style="color:#1abc9c"></p></td>
            <td><b>Check-Out</b><p id="checkoutview" style="color:#bc1a1a6e"></p></td>
            <td><b>Worked Hour</b><p id="whview"></p></td>
          </tr>
        </table>
        <br>
        <div class="row">
          <div class="col-md-6">
              <p>Break Details</p>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Break-In</th>
                  <th>Break-Out</th>
                  <th>Total Duration</th>
                </tr>
              </thead>
              <tbody id="breakdetails">

              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <div id="viewproper">
              <p>Production Percentage<a href="<?php base_url(); ?>Timesheet" style="color:red;float:right;font-weight:bold">TS</a></p>
              <div id="chartdiv"></div>
            </div>
          </div>

        </div>
      </div>
      <div id="otherpresent">
          <h4 id="status"></h4>
          <p id="status_details"></p>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="Holidaylist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Holidays</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Date</th>
              <th>Festival</th>
            </tr>
          </thead>
          <tbody id="viewholiday">

          </tbody>
        </table>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

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
  var monthyearinput = $('#attendancedatepicker').val();
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getReportAttendance",
    method : "POST",
    data : {"userid":$('#useridemp').val(),"monthyear":monthyearinput},
    success : function(datares){
      var dataset = JSON.parse(datares);
      var data = dataset.attendancedata;
      var mlist = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
      var getusermy=parseInt(monthyearinput.split("-")[0])-1;
      $('#monthandyearview').html(mlist[getusermy]+', '+monthyearinput.split("-")[1]);
      var days=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        var out='';

        var i;
        var flag=0;
        var lop=0;
        for(var j=0;j<6;j++){
          var checkrow=0;
          out +='<tr>';
          if(flag == 0){
            i=0;
            flag=1;
          }

          for(i;i<data.length;i++){
            if(data[i]['Day'] == 'Sunday'){
              checkrow = checkrow+1;
            }


            if(data[i]['Status'] == '<p id="presentid">Present</p>'){
              var tdstyle=' style="font-weight:bold;font-size:15px;background:#1abc9ca1;cursor:pointer"';
              var st='Present';
            }else if(data[i]['Status'] == '<p id="leaveid">Leave</p>'){
              var tdstyle=' style="font-weight:bold;font-size:15px;background:#5384c1;cursor:pointer"';
              var st='Leave';
            }else if(data[i]['Status'] == 'Holiday'){
              if(data[i]['checkin'] != ''){
                  var tdstyle=' style="font-weight:bold;font-size:15px;background:#1abc9ca1;cursor:pointer"';
                  var st='Present';
              }else{
                  var tdstyle=' style="font-weight:bold;font-size:15px;background:#bc1a1a6e;cursor:pointer"';
                  var st='Holiday';
              }
            }
            else{
              var tdstyle=' style="font-weight:bold;font-size:15px;background:#c1be53;cursor:pointer"';
              var st='Absent';
              lop++;
            }
            //Before 01 Date print '-' value
            var date_no=data[i]['Date'].split('-')[0];
            if(j == 0  &&  date_no == '01'){
              var localflag=1;
              days.forEach((dayslist) => {
                if(dayslist == data[i]['Day']){
                  out +='<td '+tdstyle+' onclick="popupopendateview(`'+$('#useridemp').val()+'`,`'+data[i]['Date']+'`,`'+data[i]['checkin']+'`,`'+data[i]['checkout']+'`,`'+data[i]['worktimingg']+'`,`'+st+'`,`'+data[i]['Status_details']+'`)">'+date_no+'</td>';
                  localflag++;
                }else{
                  if(localflag == 1){
                    out +='<td >-</td>';
                  }
                }
              });

            }else{
              out +='<td '+tdstyle+' onclick="popupopendateview(`'+$('#useridemp').val()+'`,`'+data[i]['Date']+'`,`'+data[i]['checkin']+'`,`'+data[i]['checkout']+'`,`'+data[i]['worktimingg']+'`,`'+st+'`,`'+data[i]['Status_details']+'`)">'+date_no+'</td>';
            }
            if(checkrow != 0){
              i++;
              break;
            }
          }
          out +='</tr>';
        }
        $('#lopcount').html(lop);

      $('#tableprint').html(out);

      $('#inouttime').html('  '+dataset.shiftdetails[0].checkin+' - '+dataset.shiftdetails[0].checkout);
    }
  });

  //get Permission Details
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getpermission",
    method : "POST",
    data : {"userid":$('#useridemp').val(),"monthyear":monthyearinput},
    success : function(datares){
      var perres=JSON.parse(datares);
      var count_per=0;
      perres.forEach((permissionhour) => {
        count_per = parseInt(count_per)+parseInt(permissionhour['permission_hours']);
      });
      $('#permissionview').html(count_per+' Hour');
    }
  });

}


function popupopendateview(emp_id,dateview,checkin,checkout,worktime,status,status_details) {
  $('#viewdatedata').modal('show');
  $('#viewdatedata #Dateofview').html(dateview);
  if(checkin){
    $('#viewentireview').show();
      $('#otherpresent').hide();
    $('#viewdatedata #checkinview').html('<br><p style="font-size:12px;">'+checkin+'</p>');
    $('#viewdatedata #checkoutview').html('<br><p style="font-size:12px;">'+checkout+'</p>');
    $('#viewdatedata #whview').html('<br><p style="font-size:12px;">'+worktime+'</p>');
  }else{
    $('#viewentireview').hide();
    $('#otherpresent').show();
    var printstatus;
    if(status == 'Leave'){
      printstatus='Leave';
    }else if(status == 'Holiday'){
       var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
       var dtpassing=dateview.split("-");
       var binddt='"'+dtpassing[1]+'/'+dtpassing[0]+'/'+dtpassing[2]+'"';
       var dayname=new Date(binddt).getDay();
        if(days[dayname] == 'Saturday' || days[dayname] == 'Sunday'){
          printstatus='Holiday';
        }else{

        }

    }
    else{
      printstatus='Absent';
    }
    $('#otherpresent #status').html(printstatus);
    $('#otherpresent #status_details').html(status_details);
  }

  //get production percentage;
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getproductionpercentage",
    method : "POST",
    data : {"userid":emp_id,"date":dateview},
    success : function(datares){
      var datasetgiven = JSON.parse(datares);
      if(datasetgiven.value){
        $('#viewproper').show();
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add data
        chart.data = [datasetgiven];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.stroke = am4core.color("#5384c1");
        categoryAxis.renderer.grid.template.location = 0;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "value";
        series.dataFields.categoryX = "category";
        series.columns.template.tooltipHTML = "<p>{categoryX}</p><h4>{valueY}%</h4>";
        series.name = "Sales";

        // Create value axis range
        var range = valueAxis.axisRanges.create();
        range.value = 92;
        range.endValue = 100;
        range.axisFill.fill = am4core.color("#396478");
        range.axisFill.fillOpacity = 0.2;
        range.grid.strokeOpacity = 0;
      }
      else{
        $('#viewproper').hide();
      }
    }
  });

  //get break details
  $.ajax({
    url : "<?php echo base_url(); ?>Attendance/getbreakdetails",
    method : "POST",
    data : {"userid":emp_id,"date":dateview},
    success : function(dataresbk){
      var res=JSON.parse(dataresbk);
      var out='';
      if(res.length >0){
      res.forEach((itemi) => {
        out +='<tr>';
        var intime=new Date(itemi['breakin_time']);
        out +='<td>'+intime.getHours()+':'+intime.getMinutes()+':'+intime.getSeconds()+'</td>';
        var outtime=new Date(itemi['breakout_time']);
        out +='<td>'+outtime.getHours()+':'+outtime.getMinutes()+':'+outtime.getSeconds()+'</td>';
        out +='<td>'+itemi['break_inout_diff']+'</td>';
        out +='</tr>';

      });
    }else{
      out +='<tr><td colspan="3">No Break Data Found</td></tr>';
    }
      $('#breakdetails').html(out);
    }
  });
}

function viewholidays() {
  if($('#useridemp').val() && $('#attendancedatepicker').val()){
    $.ajax({
      url : "<?php echo base_url(); ?>Attendance/getHolidaylist",
      method : "POST",
      data : {"userid":$('#useridemp').val(),"monthyear":$('#attendancedatepicker').val()},
      success : function(dataresbk){
        var res=JSON.parse(dataresbk);
        $('#Holidaylist').modal('show');
        var out='';
        res.forEach((item) => {
          if(new Date(item['holiday_date']) > new Date()){
            out +='<tr><td >'+item['holiday_date']+'</td><td>'+item['festival']+'</td></tr>';
          }else{
            out +='<tr  style=" text-shadow: 0 0 12px black;"><td >'+item['holiday_date']+'</td><td>'+item['festival']+'</td></tr>';
          }

        });
        $('#viewholiday').html(out);
      }
    });
  }else{
    alert("Agent name & Month-Year value required");
  }
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
