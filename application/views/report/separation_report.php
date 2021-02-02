<body>
  <style>
#statusview{
  background:gray;
  text-align:center;
	border-radius: 50%;
	color:white;
}
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
			<div class="col-md-12 activity">Employee Separation Report</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
    <form id="getvalfilter">
<div class="row emp-table ">
  <div class="col-md-12 table-responsive" ><br>

  <div class="row">

  <div class="col-md-3">
    <p>Employee</p>
      <select class="useridselection" id="useridemp" name="useridemp" style="width:250px">
        <?php if($userdata['role'] != 'agent'){ ?>
        <option value="All" selected>All</option>
        <?php
          foreach ($getagentlist as $emp) { ?>
            <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->agent_name); ?></option>
          <?php }
        }else{
          ?><option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option><?php
        } ?>
      </select>
  </div>
  <div class="col-md-2">
    <p>From Date</p>
      <input type="text" class="form-control fromdate" id="fromdate" name="fromdate" value='<?php echo date('m/01/Y'); ?>'>
  </div>
  <div class="col-md-2">
    <p>To Date</p>
      <input type="text" class="form-control todate" id="todate" name="todate" value='<?php echo date('m/d/Y'); ?>'>
  </div>
    <div class="col-md-2">
      <p>Staus</p>
        <select class="form-control " id="status" name="status" >
          <option value="All" selected>All</option>
          <option value="Pending">Pending</option>
          <option value="Approved">Approved</option>
          <option value="Rejected">Rejected</option>
        </select>
    </div>
    <div  class="col-md-1"><br>
        <input type="button" class="check-in" value="Report" onclick="getseparationReport()">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12" >
      <table class="table table-bordered">
        <tr id="leaveReport1">
          <td id="totalcount"  onclick="$('#status').val('All');getseparationReport();"></td>
          <td id="pendingcount" onclick="$('#status').val('Pending');getseparationReport();"></td>
          <td id="acceptedcount"  onclick="$('#status').val('Approved');getseparationReport();"></td>
          <td id="rejectedcount"  onclick="$('#status').val('Rejected');getseparationReport();"></td>
          <td>
            <button type="submit" class="check-out" formaction="<?php echo base_url(); ?>Separation/separationExcelexport">Excel</button>
            <br>
            <button type="submit" class="check-out" style="background:#706FAC;margin-top:10%"  formaction="<?php echo base_url(); ?>Separation/separationPdfexport">PDF</button>
          </td>
        </tr>
      </table>
    </div>
  </form>
  <br>

          <table class="table table-responsive dt">
          <thead>
            <tr>
              <th>Emp ID/Name</th>
              <th>Reason</th>
              <th>Resignation date</th>
              <th>Current Status</th>
                <th> Manager ID/Name</th>
              <th>Manager Status</th>
              <th>Manager Remark</th>
                <th> HR ID/Name</th>
              <th>HR Status</th>
              <th>HR Remark</th>
              <th>Last Working Date</th>
              <th>Revoke</th>
            </tr>
          </thead>
          <tbody id="getissuelist1">
          </tbody>
          </table>

  </div>
</div>
</body>

<script>
$('.useridselection').select2({
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


function getexcelval(){
  $.ajax({
    url : "<?php echo base_url(); ?>TicketReport/excelexport",
    method : "POST",
    data : $('#getvalfilter').serialize(),
    success : function(datares){
     }
  });

}
//viewTicket();
getseparationReport();
function getseparationReport(){
  var emp_id = $("#useridemp").children("option:selected").val();

   $('#leaveReport1').show();
    $('#leaveReport2').show();

    $.ajax({
      url : "<?php echo base_url(); ?>Separation/getseparationreportview",
      method : "POST",
      data : $('#getvalfilter').serialize(),
    success : function(datares){
      var res = JSON.parse(datares);
    //  console.log(res);

       var out='';
       var approvedcount=0;
       var rejectedcount=0;
       var pendingcount=0;
       for(var i=0;i<res.length;i++){
         if((res[i].Resign_Manager_status =='' || res[i].Resign_Manager_status == undefined)  && (res[i].Resign_HR_status =='' || res[i].Resign_HR_status == undefined)){
           pendingcount  = parseInt(pendingcount)+1;
           var overallstatus='Pending';
           var bg = "style='background:#706FAC;'";
         }else if(res[i].Resign_Manager_status =='Accepted' && res[i].Resign_HR_status =='Accepted'){
           approvedcount = parseInt(approvedcount)+1;
           var overallstatus='Accepted';
           var bg = "style='background:#3fc98e;'";

         }else if(res[i].Resign_Manager_status =='Rejected' || res[i].Resign_HR_status =='Rejected'){
           rejectedcount =parseInt(rejectedcount)+1;
           var overallstatus='Rejected';
           var bg = "style='background:#ff5c4b;'";

         }else{
           var overallstatus='Pending';
           var bg = "style='background:#706FAC;'";

         }

         if($('#status').val() == 'Pending' && overallstatus == 'Pending'){
         }else if($('#status').val() == 'All'){
         }
         else if($('#status').val() == 'Approved' && overallstatus == 'Accepted'){
         }
         else if($('#status').val() == 'Rejected' && overallstatus == 'Rejected'){
         }
      else{
          continue;
         }
         out += '<tr>';
         out += '<td>'+res[i].emp_id+'/'+res[i].name+'</td>';
         out += '<td>'+res[i].Resignation_reason+'</td>';
         out += '<td>'+res[i].Resignation_date+'</td>';

         out += '<td id="statusview" '+bg+'>'+overallstatus+'</td>';
         out += '<td>'+res[i].Manager_idname+'</td>';
         out += '<td>'+res[i].Resign_Manager_status+'</td>';
         out += '<td>'+res[i].Resign_Manager_remark+'</td>';
         out += '<td>'+res[i].HR_idname+'</td>';

         out += '<td>'+res[i].Resign_HR_status+'</td>';
         out += '<td>'+res[i].Resign_HR_remark+'</td>';
         out += '<td>'+res[i].Resign_Lastworkdate+'</td>';
         out += '<td>'+res[i].Revoke_reason+'</td>';
         out += '</tr>';

       }

    //   $('.dt').DataTable();
       $('#getissuelist1').html(out);
       $('#totalcount').html('<p>Total Request</p><h3>'+res.length+'</h3>');
       $('#pendingcount').html('<p>Pending</p><h3>'+pendingcount+'</h3>');
       $('#acceptedcount').html('<p>Accepted</p><h3>'+approvedcount+'</h3>');
       $('#rejectedcount').html('<p>Rejected</p><h3>'+rejectedcount+'</h3>');
      }
    });

}

</script>
