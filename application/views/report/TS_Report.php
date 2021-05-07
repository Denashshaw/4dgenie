
<div class="page-wrapper chiller-theme toggled">
<style>
.dataTables_wrapper {
    font-family: tahoma;
    font-size: 11px;
}
#todate,#fromdate{
 font-size:12px;
 font-weight: bold;
}
.select2-selection__rendered {
        font-size:12px !important;
 }
</style>

<?php
 $this->load->view('header');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.jqueryui.min.css">
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.jqueryui.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<main class="page-content">

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
  <div class="container-fluid p-0">
    <?php $this->load->view('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Time Sheet Report</div>
		</div>
    <div class="row activity-row">
      <div class="col-md-12 activity">

        <div class="row emp-table ">
         <div class="col-md-12 table-responsive" >
              <form method="post" id="timesheetfilter" action="<?php echo base_url(); ?>Timesheet/TimesheetReport">
           <div class="row">
             <div class="col-md-2">
               <p>From Date</p>
               <input type="text" id="fromdate" name="fromdate" class="form-control" value="<?php echo date('m/01/Y',); ?>">
             </div>
             <div class="col-md-2">
               <p>To Date</p>
               <input type="text" id="todate" name="todate" class="form-control" value="<?php echo date('m/d/Y'); ?>">
             </div>
             <div class="col-md-2">
               <p>Agent</p>
                <select class="form-control" name="agent" id="agents" style="font-size:12px;font-weight:bold" >
                </select>
             </div>
             <div class="col-md-2">
               <p>Category</p>
                <select class="form-control" id="category" name="category" style="font-size:12px;font-weight:bold">
                  <option value="Summary">Summary</option>
                  <option value="Raw Data">Raw Data</option>
                </select>
             </div>
             <div class="col-md-2">
               <input type="submit" class="check-in subbtn" value="Submit" name="submit" style="margin-top:20%">
             </div>
             <?php if(!$getagent_data){ ?>
             <div class="col-md-2" style="font-size:12px;text-align:center">
               <div class="card" style="background:#007a8080;">
                 <br><b>Overall Percentage</b>
                 <p id="over_percentage" style="font-size:20px;">0%</p>
               </div>
             </div>
           <?php } ?>
           </div>
            </form>
           <br>
           <?php if($getagent_report){ ?>
           <table class="table table-bordered" id="dtset">
             <thead>
               <tr>

                 <th>Report Date</th>
                 <?php if($_SESSION['role'] !='agent'){ ?>
                   <th>Agent</th>
                 <?php } ?>
                 <th>Closing Date</th>
                 <th>Category</th>
                 <th>Status</th>
                 <th>Reviewer</th>
                 <!-- <th>Reviewer Commend</th> -->
                 <th>Total Time Spent</th>
                 <th>Productive Hours</th>
                 <th>Non Productive Hours</th>
                 <th>Total Production Count</th>
                 <?php if($_SESSION['role'] !='agent'){ ?>
                 <th>Total Target Count</th>
               <?php } ?>
                 <th>Productivity Percentage</th>

               </tr>
             </thead>
             <tbody>

            <?php
            $days_before=date('Y-m-d', strtotime('-7 days'));
            $workedcount=0;
            $targetcount=0;
            foreach($getagent_report as $a){ ?>
              <tr>
                <td ><?php echo date_format(date_create($a->report_date),"d-m-Y"); ?></td>
                <?php if($_SESSION['role'] !='agent'){ ?>
                  <td><b style="cursor:pointer;color:#429abb;" onclick="viewpopupdetails('<?php echo $a->report_date; ?>','<?php echo $a->emp_id; ?>')"><?php echo $a->emp_id."/".$a->name; ?></b></td>
                <?php } ?>
                <td><?php echo date_format(date_create($a->updated_date),"d-m-Y"); ?></td>
                <td><?php echo $a->category; ?></td>
                <?php
                if($a->status == 'Initiated'){
                  $bg='style="color:#007bff;font-weight:bold;"';
                }else if($a->status == 'Accepted'){
                  $bg='style="color:#3fc98e;font-weight:bold;"';
                }else if($a->status == 'Rejected'){
                  $bg='style="color:#ff5c4b;font-weight:bold;"';
                }else if($a->status == 'Re-submitted'){
                  $bg='style="color:#c93f78;font-weight:bold;"';
                }else{}
                ?>
                <td <?php echo $bg; ?>><?php echo $a->status; ?></td>
                <td><?php echo $a->reviewer_id."/".$a->reviewer_name; ?></td>
                <!-- <td><?php echo $a->reviewer_commend; ?></td> -->
                <td><?php echo  date_format(date_create($a->totaltime_spend),"H:i"); ?></td>
                <td><?php echo date_format(date_create($a->productive_time),"H:i"); ?></td>
                <td><?php echo date_format(date_create($a->non_productive_time),"H:i"); ?></td>
                <td><?php echo $a->total_production;
                $workedcount += $a->total_production;
                ?></td>
                <?php $targetcount += $a->total_target;
                if($_SESSION['role'] !='agent'){ ?>
                <td><?php echo $a->total_target;
                ?></td>
              <?php } ?>
                <td><h5><?php echo $a->overall_percentage; ?></h5></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>

        <?php } ?>

        <?php if($getagent_data){ ?>
          <table class="table table-bordered" id="rawdatafix">
            <thead>
              <tr>
                <th>Agent</th>
                <th>Department</th>
                <th>Report Date</th>
                <th>Category</th>
                <th>Client</th>
                <th>Type</th>
                <th>Task</th>
                <th>Sub-Task</th>
                <th>Time Spent</th>
                <th>Count</th>
                <th>Target/hr</th>
                  <th>To be Achived</th>
                <th>Percentage</th>
                <th>Agent Comments</th>
                <th>Reviewer</th>
                <th>Reviewer Comments</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tempid='';
              $i=0;
              foreach($getagent_data as $b){
                if($tempid == $b->emp_id){

                }else{
                  if($i == 0){

                  }else{
                  ?>
                  <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                  </tr>
                  <?php
                  }
                }
                ?>
                <tr>
                  <td><?php echo $b->emp_id.'/'.$b->name; ?></td>
                  <td><?php echo $b->department; ?></td>
                  <td><?php echo $b->report_date; ?></td>
                  <td><?php echo $b->category; ?></td>
                  <?php if($b->sub_task == 'Break'){ ?>
                    <td><?php echo 'Default Break'; ?></td>
                  <?php }else{ ?>
                    <td><?php echo explode("/",$b->client)[1]; ?></td>
                  <?php } ?>

                  <td><?php echo $b->type; ?></td>
                  <?php if($b->type == 'Productive'){ ?>
                    <td><?php echo explode("/",$b->task)[1]; ?></td>
                    <td><?php echo explode("/",$b->sub_task)[1]; ?></td>
                  <?php }else{ ?>
                    <td><?php echo $b->task; ?></td>
                    <td><?php echo $b->sub_task; ?></td>
                  <?php } ?>
                  <td><?php echo $b->time_spent; ?></td>
                  <td><?php echo $b->count_production; ?></td>
                  <td><?php echo $b->target; ?></td>
                  <td><?php echo $b->tobe_achived; ?></td>
                  <td><?php echo $b->percentage; ?></td>
                  <td><?php echo $b->comments; ?></td>
                  <td><?php echo $b->reviewer_id.'/'.$b->reviewer_name; ?></td>
                  <td><?php echo $b->reviewer_comments; ?></td>

                </tr>
              <?php
              $tempid=$b->emp_id;
              $i++;
            } ?>
            </tbody>
          </table>
        <?php } ?>
         </div>
        </div>
      </div>
    </div>

  </div>
</main>
<script type="text/javascript">
  $('#over_percentage').html('<?php echo round(((int)$workedcount/(int)$targetcount)*100).'%'; ?>');
</script>
<div class="modal fade bd-example-modal-lg viewtimesheet" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Time-Sheet Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

              <table class="table table-bordered">
                <tr>
                  <td> Agent Name:<br><br><b style="font-size:15px" id="agent"></b></td>
                  <td> Report Date:<br><br><b id="dateofreport"></b></td>
                  <td> HRMS Check-In Time:<br><br><b id="checkindt"></b></td>
                  <td> HRMS Check-Out Time:<br><br><b id="checkoutdt"></b></td>
                  <td> Working Duriation:<br><br><b id="checkinoutduriation"></b></td>
                </tr>
              </table>
          </div>
            <div class="card card-body " style="margin-left:1%;height:5rem">
              <p> Total Time Spent</p>
              <p id="totalassignedhours" style="font-weight:bold">00:00</p>
            </div>
            <div class="card card-body" style="height:5rem">
              <p> Productive Time</p>
              <p id="productivetime" style="font-weight:bold">00:00</p>
            </div>
            <div class="card card-body"  style="height:5rem">
              <p> Non-Productive Time</p>
              <p id="non_productivetime" style="font-weight:bold">00:00</p>
            </div>
            <div class="card card-body"  style="height:5rem">
              <p> Total Production Count</p>
              <p id="totalcount" style="font-weight:bold">0</p>
            </div>
            <div class="card card-body" style="margin-right:1%;height:5rem">
              <p> Overall Percentage</p>
              <p id="overallpercentage" style="font-weight:bold">0%</p>
            </div>
            <br>
          <div class="col-md-12" style="padding-top:2%">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Client</th>
                  <th>Type</th>
                  <th>Task</th>
                  <th>Sub-Task</th>
                  <th>Time Spent</th>
                  <th>Count</th>
                  <th>Target/hr</th>
                    <th>To be Achived</th>
                  <th>Percentage</th>
                  <th>Agent Comments</th>
                  <th>Reviewer Comments</th>
                </tr>
              </thead>
              <tbody id="printview">
              </tbody>
            </table>
          </div>
          <div class="col-md-12 card card-body shadow rounded detailsview" style="margin:1%">
            <b>Details:</b>
            <p id="percentagebelow90" style="font-size:12px"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="check-in" style="" onclick="statusupdate('Accepted')" value="Accepted">
        <input type="button" class="check-out" style="" onclick="statusupdate('Rejected')" value="Rejected">

      </div>
    </div>
  </div>
</div>
<script>

$(document).ready(function(){

  if(localStorage.getItem("oncecallval")  == null){
    localStorage.setItem("oncecallval","yes");
      //$('.subbtn').trigger('click');
      $('#timesheetfilter').submit();
  }

})
var test="<?php echo $userdata['department'] ?>";
var role ="<?php echo $userdata['role'] ?>";
if(test == 'MANAGEMENT' || role == 'supervisor')
{
$('#dtset').DataTable({
  dom: 'Bfrtip',
  order: [[ 0, "asc" ]],
  "bSortCellsTop": true,
  buttons: [
  {
     extend:'excel',
     title: 'Timesheet Report',
   },
   {
     extend:'pdf',
     title: 'Timesheet Report',
     orientation: 'landscape',
     pageSize: 'LEGAL'
   },
   {
     extend:'print',
     title: 'Timesheet Report',
   }
   ],
});
$('#rawdatafix').DataTable({
  dom: 'Bfrtip',
   "ordering": false,
  "bSortCellsTop": true,
  buttons: [
  {
     extend:'excel',
     title: 'Timesheet Report',
   }
   ],
});
}else{
  $('#dtset').DataTable();
}
$('#fromdate,#todate').datepicker();

$.ajax({
  url:"<?php echo base_url(); ?>Timesheet/getagentlist",
  method:"POST",
  success:function(dataset){
    var res = JSON.parse(dataset);
    var out='';
    <?php if($_SESSION['role']!='agent'){ ?>
      out +='<option value="All" selected>All</option>';
    <?php }else{ ?>
    out +='<option value="<?php echo $_SESSION['emp_id'].'/'.$_SESSION['name']; ?>" ><?php echo $_SESSION['emp_id'].'/'.$_SESSION['name']; ?></option>';
    <?php } ?>
    if(res.length != 0){

      for(var i=0;i<res.length;i++){
        out +='<option value="'+res[i]['emp_id']+'/'+res[i]['agent_name']+'">'+res[i]['emp_id']+'/'+res[i]['agent_name']+'</option>';
      }
    }
    $('#agents').html(out);
  }
});
$('#agents').select2();
function viewpopupdetails(rep_date,empid){
  $.ajax({
    url:"<?php echo base_url(); ?>Timesheet/gettaskdetails",
    method:"POST",
    data:{"repDate":rep_date,"emp_id":empid},
    success:function(dataset){
      var resdataset = JSON.parse(dataset);
      var res=resdataset.getdata;
    //  console.log(res);
      var res_report=resdataset.getdata_report;
      if(res.length > 0){
        $('.viewtimesheet').modal('show');
        var out=0;
        var indexget=[];
        for(var i=0;i<res.length;i++){
          out +='<tr>';
          if(res[i]['sub_task'] == 'Break'){
            out +='<td>Default Break</td>';
          }else{
            out +='<td>'+res[i]['client'].split('/')[1]+'</td>';
          }
          if(res[i]['type'] =='Productive'){
            out +='<td>'+res[i]['type']+'</td>';
            out +='<td>'+res[i]['task'].split('/')[1]+'</td>';
            out +='<td>'+res[i]['sub_task'].split('/')[1]+'</td>';
          }else{
            out +='<td>'+res[i]['type']+'</td>';
            out +='<td>'+res[i]['task']+'</td>';
            out +='<td>'+res[i]['sub_task']+'</td>';
          }
          out +='<td>'+res[i]['time_spent']+'</td>';
          out +='<td>'+res[i]['count_production']+'</td>';
          out +='<td>'+res[i]['target']+'</td>';
          out +='<td>'+res[i]['tobe_achived']+'</td>';
          out +='<td>'+res[i]['percentage']+'</td>';
          out +='<td>'+res[i]['comments']+'</td>';
          out +='<td><input type="text" class="form-control" id="reviewer_comments'+res[i]['id']+'" value="'+res[i]['reviewer_comments']+'" style="font-size:12px;font-weight:bold"></td>';
          out +='</tr>';
          indexget.push(res[i]['id']);
        }
        localStorage.setItem("fields",indexget);
        $('#printview').html(out);
      }

      if(res_report.length > 0){
        $('#agent').html(res_report[0]['emp_id']+'/'+res_report[0]['name']);
        $('#dateofreport').html(res_report[0]['report_date']);
        $('#totalassignedhours').html(res_report[0]['totaltime_spend']);
        $('#productivetime').html(res_report[0]['productive_time']);
        $('#non_productivetime').html(res_report[0]['non_productive_time']);
        $('#totalcount').html(res_report[0]['total_production']);
        $('#overallpercentage').html(res_report[0]['overall_percentage']);
        if(res_report[0]['percentagebelow90']){
          $('.detailsview').show();
          $('#percentagebelow90').html(res_report[0]['percentagebelow90']);
        }else{
          $('.detailsview').hide();
        }
      }

    }
  });
  //get checkin-checkout
  $.ajax({
    url:"<?php echo base_url(); ?>Timesheet/getcheckinout",
    method:"POST",
    data:{"repDate":rep_date,"emp_id":empid},
    success:function(dataset){
      var res = JSON.parse(dataset);
      $('#checkindt').html(res[0]['checkin_time']);
      $('#checkoutdt').html(res[0]['checkout_time']);
      $('#checkinoutduriation').html(res[0]['check_inout_diff']);
    }
  });
}

function statusupdate(status) {
  var empid="<?php echo $_SESSION['emp_id']; ?>";
  var name="<?php echo $_SESSION['name']; ?>";
  var getids=localStorage.getItem("fields");
  var id=getids.split(",");
  var commendarray=[];
  id.forEach((val) => {
      var inputval="#reviewer_comments"+val;
      if($(inputval).val()){

        commendarray.push({"id":val,"reviewer_comments":$(inputval).val(),"status":status,"reviewer_id":empid,"reviewer_name":name});
      }else{
        commendarray.push({"id":val,"reviewer_comments":'',"status":status,"reviewer_id":empid,"reviewer_name":name});
      }
  });

  $.ajax({
    url:"<?php echo base_url(); ?>Timesheet/reviewerupdatestatus",
    method:"POST",
    data:{"dt":commendarray},
    success:function(dataset){
      if(dataset == '"updated"'){
          // $('.viewtimesheet').modal('hide');
          // $('#timesheetfilter').submit();
          location.reload();
      }else{

      }
    }
  });
  //console.log(commendarray);

}

</script>
