<body>
  <style>

</style>
<div class="page-wrapper chiller-theme toggled">
<?php
 $this->load->view('header');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php $this->load->view('page_head'); ?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Leave/Permission Report</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
    <form id="getvalfilter">
<div class="row emp-table ">
  <div class="col-md-12 table-responsive" ><br>

  <div class="row">
    <div class="col-md-2">
          <p>Report Type</p>
           <select class="form-control " id="leavetype" name="leavetype" >
                  <option value="emp_leave_details" selected>Leave Report</option>
                <option value="emp_permission_details">Permission Report</option>

          </select>
  </div>
  <div class="col-md-3">
        <p>Employee</p>
         <select class=" useridnameReport2" id="useridemp" name="useridemp" style="width:250px">

            <?php if($userdata['role'] != 'agent'){ ?>
              <option value="All" selected>All</option>
              <?php
              foreach ($getagentlist as $emp) { ?>
                <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
              <?php }
          }else{
              ?><option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option><?php
            } ?>
        </select>
        </div>
        <div class="col-md-3">
            <p>From Date</p>
            <input type="text" class="form-control fromdate" id="fromdate" name="fromdate" value='<?php echo date('m/01/Y'); ?>'>
        </div>
        <div class="col-md-3">
            <p>To Date</p>
            <input type="text" class="form-control todate" id="todate" name="todate" value='<?php echo date('m/d/Y'); ?>'>
        </div>
        <div  class="col-md-1"><br>
            <input type="button" class="check-in" value="Repot" onclick="getReport()">
        </div>

    </div>
        <br>
      <div class="row">
        <div class="col-md-12" >
        <table class="table table-bordered">
          <tr id="leaveReport1">
              <td id="totalcount"></td>
              <td id="totalleavecount"></td>
              <td id="cltotal"></td>
              <td id="pltotal"></td>
              <td id="halftotal"></td>
              <td id="loptotal"></td>
          <td>
            <button type="submit" class="check-out" formaction="<?php echo base_url(); ?>Emp_leave_permission/leaveExcelexport">Excel</button>
            <br>
            <button type="submit" class="check-out" style="background:#706FAC;margin-top:10%" formaction="<?php echo base_url(); ?>Emp_leave_permission/leavePdfexport">PDF</button>
          </td>
        </tr>
        <tr id="permissionReport1">
            <td id="totalEmployee"></td>
            <td id="totalPermission"></td>
        <td>
          <button type="submit" class="check-out" formaction="<?php echo base_url(); ?>Emp_leave_permission/leaveExcelexport">Excel</button>
          <button type="submit" class="check-out" style="background:#706FAC;margin-top:10%" formaction="<?php echo base_url(); ?>Emp_leave_permission/leavePdfexport">PDF</button>
        </td>
      </tr>
        </table>
      </div>
      </form>

    <br>
        <div id="leaveReport2">
          <table class="table">
          <thead>
            <tr>
              <th>Emp ID</th>
              <th>Name</th>
              <th>Total Days Leave</th>
              <th>Status</th>
              <th>Leave Category</th>
              <th>From Date</th>
              <th>To Date</th>
              <th>Leave Details</th>
              <th>Reporting Person</th>
            </tr>
          </thead>
          <tbody id="getissuelist1">
          </tbody>
          </table>
        </div>
        <div id="permissionReport2">
          <table class="table ">
          <thead>
            <tr>
              <th>Emp ID</th>
              <th>Name</th>
              <th>Permission(Hrs)</th>
              <th>Reason</th>
              <th>Status</th>
              <th>Date</th>
              <th>Reporting Person</th>
            </tr>
          </thead>
          <tbody id="getissuelist2">
          </tbody>
          </table>
        </div>

  </div>
</div>
</body>

<script>
$('.useridnameReport2').select2({

});
function previewdata(){
  $('#previewtoprint').modal('toggle');
}
$(".fromdate").datepicker({
      altField: ".fromdate",
      altFormat: "M d, yy"
});
$(".todate").datepicker({
      altField: ".todate",
      altFormat: "M d, yy"
});

$(".showhide").click(function(){
  $(".viewcont").toggle();
});

$('.useridnameReport').select2({height: 'resolve'});


function getexcelval(){
  $.ajax({
    url : "<?php echo base_url(); ?>TicketReport/excelexport",
    method : "POST",
    data : $('#getvalfilter').serialize(),
    success : function(datares){
    //   var res = JSON.parse(datares);
    //   if(res.status == 'Success'){
    //     $(".viewcont").toggle();
    //   }else{

    //   }
    //   //viewTicket();
     }
  });

}
//viewTicket();
getReport();
function getReport(){

  //$('#emp_Separtation').hide();
  var emp_id = $("#useridemp").children("option:selected").val();
  if($('#leavetype').val() == 'emp_leave_details'){
  //  $('#totalcount #totalleavecount #cltotal #pltotal #halftotal #loptotal').visibility('visible');
   $('#leaveReport1').show();
    $('#leaveReport2').show();
    $('#permissionReport1').hide();
     $('#permissionReport2').hide();
  }else{
    $('#leaveReport1').hide();
    $('#leaveReport2').hide();
    $('#permissionReport1').show();
     $('#permissionReport2').show();
  }
    $.ajax({
      url : "<?php echo base_url(); ?>Emp_leave_permission/getleavereport",
      method : "POST",
      data : $('#getvalfilter').serialize(),
    success : function(datares){
      var res = JSON.parse(datares);
      console.log(res);
      var out='';
      if($('#leavetype').val() == 'emp_leave_details'){
        var cl_count=0;
        var totaldaysleave=0;
        var pl_count=0;
        var hf_count=0;
        var lop_count=0;
        var empid=[];
        for(var i=0;i<res.length;i++){
          var ltype=res[i].leave_type;
          if(ltype == 'cl'){
            var leavetype='Casual Leave';
            cl_count = parseInt(cl_count)+ parseInt(res[i].total_days);
          }else if(ltype == 'hd'){
            var leavetype='Half Day';
            hf_count = hf_count + 0.5;
          }else if(ltype == 'pl'){
            var leavetype='Privilege Leave';
            pl_count = parseInt(pl_count)+ parseInt(res[i].total_days);
          }else if(ltype == 'lop'){
            var leavetype='Loss Of Pay';
            lop_count = parseInt(lop_count)+ parseInt(res[i].total_days);
          }else{}
          out += '<tr>';
          out += '<td>'+res[i].emp_id+'</td>';
          out += '<td>'+res[i].emp_name+'</td>';
          out += '<td>'+res[i].total_days+'</td>';
          out += '<td>'+res[i].leave_status+'</td>';
          out += '<td>'+leavetype+'</td>';
          out += '<td>'+res[i].leave_start_date+'</td>';
          out += '<td>'+res[i].leave_end_date+'</td>';
          out += '<td>'+res[i].leave_reason+'</td>';
          out += '<td>'+res[i].manager_id+'/'+res[i].manager_name+'</td>';
          out += '</tr>';
          if(res[i].total_days == '1/2'){
            var daysget=0.5;
          }else{
            var daysget=parseInt(res[i].total_days);
          }
          totaldaysleave = totaldaysleave + daysget;
          empid[i]=res[i].emp_id;
        }

        var unique_id = empid.filter((v, i, a) => a.indexOf(v) === i);
        $('#totalcount').html('<p>Total Employee</p><h3>'+unique_id.length+'</h3>');
        $('#totalleavecount').html('<p>Total Leaves (Days)</p><h3>'+totaldaysleave+'</h3>');
        $('#cltotal').html('<p>Total Casual Leaves (Days)</p><h3>'+cl_count+'</h3>');
        $('#pltotal').html('<p>Total Privilege Leaves (Days)</p><h3>'+pl_count+'</h3>');
        $('#halftotal').html('<p>Total Halfday Leaves (Days)</p><h3>'+hf_count+'</h3>');
        $('#loptotal').html('<p>Total LOP (Days)</p><h3>'+lop_count+'</h3>');
        $('#getissuelist1').html(out);
      }else{
        var totper=0;
        for(var i=0;i<res.length;i++){
          out += '<tr>';
          out += '<td>'+res[i].emp_id+'</td>';
          out += '<td>'+res[i].emp_name+'</td>';
          out += '<td>'+res[i].permission_hours+'</td>';
          out += '<td>'+res[i].reason_for_permission+'</td>';
          out += '<td>'+res[i].status+'</td>';
          out += '<td>'+res[i].permission_date+'</td>';
          out += '<td>'+res[i].manager_id+'/'+res[i].manager_name+'</td>';
          out += '</tr>';
          totper = parseInt(totper) + parseInt(res[i].permission_hours);
        }
        $('#totalEmployee').html('<p>Total Employee</p><h3>'+res.length+'</h3>');
        $('#totalPermission').html('<p>Total Permission(Hrs)</p><h3>'+totper+'</h3>');
        $('#getissuelist2').html(out);
      }
    }
    });

}

</script>
