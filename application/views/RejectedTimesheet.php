
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
.sidenav{
  display: none;
  position: relative;
}
#timer{
  display: none;
}
.p-0{
    padding: 0!important;
    position: absolute;
    left: 10px;
}
.row{
  margin-right: 108px;
}
.fa-stack{
  display: none !important;
}
</style>

<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<main class="page-content">

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
  <div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Time Sheet </div>
		</div>
    <div class="row activity-row">
      <div class="col-md-12 activity">

        <div class="row">
          <div class="col-md-2">
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item  bg-danger text-white">
                <b style="font-size:12px;">Status</b>
                <h4><?php echo $checktimesheet[0]->status; ?></h4>
              </li>
              <li class="list-group-item">
                <p><?php echo date_format(date_create($checktimesheet[0]->report_date),"m/d/Y"); ?></p>
              </li>
              <li class="list-group-item">
                <p><?php echo $checktimesheet[0]->reviewer_id."/ ".$checktimesheet[0]->reviewer_name; ?></p>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-10">
          <div class="row">
          <div class="card card-body">
            <p> Total Time Spent</p>
            <p id="totalassignedhours" style="font-weight:bold">00:00</p>
          </div>
          <div class="card card-body">
            <p> Productive Time</p>
            <p id="productivetime" style="font-weight:bold">00:00</p>
          </div>
          <div class="card card-body">
            <p> Non-Productive Time</p>
            <p id="non_productivetime" style="font-weight:bold">00:00</p>
          </div>
          <div class="card card-body">
            <p> Total Production Count</p>
            <p id="totalcount" style="font-weight:bold">0</p>
          </div>
          <div class="card card-body">
            <p> Overall Percentage</p>
            <p id="overallpercentage" style="font-weight:bold">0%</p>
          </div>
        </div>
        </div>

        </div>
        <div class="row emp-table ">
         <div class="col-md-12 table-responsive" >
         <br>
           <table class="table table-bordered table-hover" id="dtset"  style="cursor:pointer">
             <form class="" action="<?php echo base_url(); ?>Timesheet/updaterejected" method="post">
               <input type="hidden" name="set_reportdate" id="set_reportdate">
               <input type="hidden" name="set_category" id="set_category">
               <input type="hidden" name="reviewer_id" id="reviewer_id">
               <input type="hidden" name="reviewer_name" id="reviewer_name">
             <thead>
               <tr>
                 <td>
                   <p>Client</p>
                   <select id="client" name="client" class="form-control" style="font-size:12px;" required>
                   </select>
                 </td>
                 <td>
                   <p>Type</p>
                   <select id="Typeprocess" name="Typeprocess" class="form-control" onchange="tasklistget(this)"  style="font-size:12px;" required>
                     <option value="">Select Type</option>
                     <option value="Productive">Productive</option>
                     <option value="Non-Productive">Non-Productive</option>
                   </select>
                 </td>
                 <td>
                   <p>Task</p>
                   <select id="task" class="form-control" name="task" onchange="sub_tasklistget(this)" style="font-size:12px;" required>
                     <option value="">Select Task</option>
                   </select>
                 </th>
                 <td>
                   <p>Sub Task</p>
                   <select id="subtask" name="subtask" class="form-control"  style="font-size:12px;" required>
                     <option value="">Select Sub Task</option>
                   </select>
                 </td>
                 <td>
                   <p>Time Spent</p>
                  <input type="time"  id="timespend" name="timespend" value="00:00" max="12:59" onblur="calculatepercentage()" class="form-control"  style="font-size:12px;" required>
                 <td>
                   <p>Count</p>
                   <input type="text" id="count_prod" name="count_prod" class="form-control" onblur="calculatepercentage()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="font-size:12px;">
                </td>
                 <td>
                   <p>Target</p>
                   <input type="text" readonly id="target" name="target"class="form-control" style="font-size:12px;">
                 </td>
                 <td>
                   <p>Percentage</p>
                   <b id="percentage"></b>
                   <input type="hidden" readonly id="percentageval_set" name="percentageval_set" class="form-control" style="font-size:12px;">
                 </td>
                 <td>
                   <p>Agent Comment</p>
                   <input type="text" id="usercomments" name="usercomments" class="form-control"  style="font-size:12px;" >
                 </td>
                 <td><p>Reviewer Comment</p></td>
                 <td>
                   <p>Action</p>
                   <button type="submit" id="completed-task" class="form-control fabutton">
                        <i class="fa fa-plus fa-lg"></i>
                  </button>

                 </td>
               </tr>
             </thead>
           </form>
             <tbody id="printdata">
            </tbody>
          </table>
          <div class="" align="center">
            <input type="button" class="check-in" value="submit" onclick="submitfinalform()">

          </div>
         </div>
        </div>
      </div>
    </div>

  </div>
</main>

</div>
<div class="modal fade" id="updatetimesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Time Sheet</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				 <span aria-hidden="true">&times;</span>
			 </button>
      </div>
  <form class="" action="<?php echo base_url(); ?>Timesheet/updaterow_rejected" method="post">
      <div class="modal-body">


        <input type="hidden" id="indexid" name="indexid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-body rounded shadow">
              <p>Client</p>
              <b id="clientid"></b>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-body rounded shadow">
              <p>Type</p>
              <b id="typeid"></b>
            </div>
          </div>

          <div class="col-md-12">
          <div class="card card-body">
          <table class="table table-bordered">
            <tr>
              <td>
                <p>Task</p>
                <b id="taskid"></b>
              </td>
              <td>
                <p>Sub Task</p>
                <b id="sub_taskid"></b>
              </td>
            </tr>
          </table>
          </div>
          </div>
          <br>
          <div class="col-md-3">
            <br>
            <p>Time Spent</p>
            <input type="time" id="timespendupdate" name="timespendupdate" onblur="calculatepercentage_update()">
          </div>
          <div class="col-md-3"><br>
            <p>Count</p>
            <input type="text" style="width:50%"  onblur="calculatepercentage_update()" id="countupdate" name="countupdate"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
          </div>
          <div class="col-md-3"><br>
            <p>Target</p>
            <input type="text"  style="width:50%" id="targetupdate" name="targetupdate" readonly >
          </div>
          <div class="col-md-3"><br>
            <p>Percentage</p>
            <h4 id="percentageupdate" style="font-weight:bold;padding-top:10px"></h4>
            <input type="hidden" readonly id="percentageupdate_data" name="percentageupdate_data" readonly >
          </div>
          <br>
          <div class="col-md-12"><br>
            <p>Comment</p>
            <input type="text" id="commentsupdate" name="commentsupdate" width="100%">
          </div>
        </div>
        <br>



      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
				 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>

$.ajax({
  url:"<?php echo base_url(); ?>Timesheet/rejectedlist",
  method:"POST",
  data:{"empid":'<?php echo $checktimesheet[0]->emp_id; ?>',"report_date":'<?php echo $checktimesheet[0]->report_date; ?>'},
  success:function(dataset){
    var res = JSON.parse(dataset);
    var out='';
    var timingoverall=moment.duration ('00:00');
    var productivetime=moment.duration ('00:00');
    var non_productivetime=moment.duration ('00:00');
    var total_production=0;
    var lengthofperc=0;
    var overallpercentage=0;
    for(var i=0;i<res.length;i++){
      out +='<tr>';
      out +='<td>'+res[i]['client'].split('/')[1]+'</td>';
      out +='<td>'+res[i]['type']+'</td>';
      if(res[i]['type'] == 'Productive'){
        out +='<td>'+res[i]['task'].split('/')[1]+'</td>';
        out +='<td>'+res[i]['sub_task'].split('/')[1]+'</td>';
        productivetime.add(res[i]['time_spent']);

      }else{
        out +='<td>'+res[i]['task']+'</td>';
        out +='<td>'+res[i]['sub_task']+'</td>';
        non_productivetime.add(res[i]['time_spent']);

      }

      out +='<td>'+res[i]['time_spent']+'</td>';
      out +='<td>'+res[i]['count_production']+'</td>';
      out +='<td>'+res[i]['target']+'</td>';
      out +='<td>'+res[i]['percentage']+'</td>';
      out +='<td>'+res[i]['comments']+'</td>';
      out +='<td>'+res[i]['reviewer_comments']+'</td>';

      out +='<td><i class="fas fa-pencil-alt" style="font-size:25px;" onclick="updatetimesheet(JSON.parse(\''
   + JSON.stringify(res[i]).replace(/'/g, '&apos;').replace(/"/g, '&quot;') + '\'))"></i></td>';
      out +='</tr>';
      total_production = parseInt(total_production)+parseInt(res[i]['count_production']);
      timingoverall.add(res[i]['time_spent']);

      if(res[i]['percentage'] !=''){
        var getvalues = res[i]['percentage'].replace("%","");
        lengthofperc++;
        overallpercentage = parseInt(overallpercentage)+parseInt(getvalues);
      }

    }
    var val_overallper =Math.round((parseInt(overallpercentage)/parseInt(lengthofperc)));
    $('#overallpercentage').html(val_overallper+'%');

    $('#totalassignedhours').html(("0" +timingoverall.hours()).slice(-2)+':'+("0" +timingoverall.minutes()).slice(-2));
    $('#productivetime').html(("0" +productivetime.hours()).slice(-2)+':'+("0" +productivetime.minutes()).slice(-2));
    $('#non_productivetime').html(("0" +non_productivetime.hours()).slice(-2)+':'+("0" +non_productivetime.minutes()).slice(-2));
    $('#totalcount').html(total_production);


    $('#set_reportdate').val(res[0]['report_date']);
    $("#set_category").val(res[0]['category']);
    $("#reviewer_id").val(res[0]['reviewer_id']);
    $("#reviewer_name").val(res[0]['reviewer_name']);
    $('#printdata').html(out);

    var totalhr = parseInt($('#totalassignedhours').text().split(":")[0]);
    if(totalhr > 8){
      $('#finalsubmit').show();
    }else{
      $('#finalsubmit').hide();
    }
  }
});


$.ajax({
  url: '<?php echo base_url(); ?>Timesheet/getclientlist',
  method:'POST',
  success: function(res){
    var resdata=JSON.parse(res);
    var outclient='';
    outclient='<option value="">Select Client</option>';
    for(var i=0;i<resdata.length;i++){
      outclient += '<option value="'+resdata[i]['id']+'/'+resdata[i]['client']+'">'+resdata[i]['client']+'</option>';
    }
    $('#client').html(outclient);
  }
})
function tasklistget(types){
	if(!$('#client').val()){

	}else{
		var out_type='';
		out_type +='<option value="">Select Task</option>';
		if(types.value == 'Productive'){
			$.ajax({
				url: '<?php echo base_url(); ?>Timesheet/gettasklist',
				method:'POST',
				data:{"type":types.value},
				success: function(res){
					var resdata=JSON.parse(res);

					for(var i=0;i<resdata.length;i++){
						out_type += '<option value="'+resdata[i]['id']+'/'+resdata[i]['task']+'">'+resdata[i]['task']+'</option>';
					}
					$('#task').html(out_type);
				}
			});
		}
		if(types.value == 'Non-Productive'){
			out_type +='<option value="Non-Productive">Non-Productive</option><option value="Personal">Personal</option>';
			$('#task').html(out_type);
		}

	}
}
function sub_tasklistget(subtype){
	var out_subtype='';
	out_subtype +='<option value="">Select Sub-Task</option>';
	if($('#Typeprocess').val() == 'Productive'){
		$.ajax({
			url: '<?php echo base_url(); ?>Timesheet/getsubtasklist',
			method:'POST',
			data:{"task":subtype.value},
			success: function(res){
				var resdata=JSON.parse(res);
				for(var i=0;i<resdata.length;i++){
					out_subtype += '<option value="'+resdata[i]['id']+'/'+resdata[i]['sub_task']+'">'+resdata[i]['sub_task']+'</option>';
				}
				$('#subtask').html(out_subtype);
			}
		});
	}else{
		if(subtype.value == 'Non-Productive'){
			out_subtype +='<option value="Team Meeting">Team Meeting</option><option value="Client Down Time">Client Down Time</option>';
			out_subtype +='<option value="One To One Meeting">One To One Meeting</option><option value="Training">Training</option>';
		}
		if(subtype.value == 'Personal'){
			out_subtype +='<option value="Break" >Break</option><option value="System Down">System Down</option>';
			out_subtype +='<option value="Cab Late">Cab Late</option><option value="Permission">Permission</option>';
		}
		$('#subtask').html(out_subtype);
	}
}

function calculatepercentage() {

	if($('#timespend').val() =='00:00' || $('#count_prod').val() == ''){ return 0; }
	if($('#Typeprocess').val() == 'Productive'){
		$.ajax({
			method : 'post',
			url    : '<?php echo base_url()?>Timesheet/gettagetvalue',
			data   : {
								"client":$('#client').val(),
								"task":$('#task').val(),
								"sub_task":$('#subtask').val()
							},
			success : function(resget){
				var data_gettarget=JSON.parse(resget);
				if(data_gettarget  !=''){
				var targetval=data_gettarget[0]['target_value'];

					$('#target').val(targetval);
					var tim=$('#timespend').val();
					var timetomin=moment.duration(tim).asMinutes();
					var needtocomplete=Math.round((parseInt(targetval)/parseInt(60))*parseInt(timetomin));

					var Percentageval = Math.round((parseInt($('#count_prod').val())/parseInt(needtocomplete))*100);

					$('#percentageval_set').val(Percentageval+'%');
					$('#percentage').html(Percentageval+'%');
				}else{
					alert("No Target Setup found!!!");
				}
			}
		});
	}
}


function updatetimesheet(res){
	$('#updatetimesheet').modal('show');
  console.log(res.id);
  $('#clientid').html(res.client);
	 $('#typeid').html(res.type);
	 $('#taskid').html(res.task);
	 $('#sub_taskid').html(res.sub_task);
	 $('#timespendupdate').val(res.time_spent);
	 $('#countupdate').val(res.count_production);
	 $('#targetupdate').val(res.target);
	 $('#percentageupdate_data').val(res.percentage);
	 $('#percentageupdate').html(res.percentage);
	 $('#commentsupdate').val(res.comments);
	 $('#indexid').val(res.id);
}

function calculatepercentage_update() {

	if($('#timespendupdate').val() =='00:00' || $('#countupdate').val() == ''){ return 0; }
	if($('#typeid').text() == 'Productive'){
		$.ajax({
			method : 'post',
			url    : '<?php echo base_url()?>Timesheet/gettagetvalue',
			data   : {
								"client":$('#clientid').text(),
								"task":$('#taskid').text(),
								"sub_task":$('#sub_taskid').text()
							},
			success : function(resget){
				var data_gettarget=JSON.parse(resget);
				if(data_gettarget !=''){
				var targetval=data_gettarget[0]['target_value'];

					$('#targetupdate').val(targetval);
					var tim=$('#timespendupdate').val();
					var timetomin=moment.duration(tim).asMinutes();
					var needtocomplete=Math.round((parseInt(targetval)/parseInt(60))*parseInt(timetomin));

					var Percentageval = Math.round((parseInt($('#countupdate').val())/parseInt(needtocomplete))*100);

					$('#percentageupdate_data').val(Percentageval+'%');
					$('#percentageupdate').html(Percentageval+'%');
				}else{
					alert("No Target Setup found!!!");
				}
			}
		});
	}
}


function submitfinalform() {
  var dt="<?php echo $checktimesheet[0]->report_date; ?>";
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url()?>Timesheet/fulldetailsupdate',
    data   : {
              "totaltimespend":$('#totalassignedhours').text(),
              "productiontime":$('#productivetime').text(),
              "non_productivetime":$('#non_productivetime').text(),
              "totalcount":$('#totalcount').text(),
              "overallpercentage":$('#overallpercentage').text(),
              "datereport":dt
            },
    success : function(resget){
      location.replace('<?php echo base_url();?>Login/checktimesheet');
    }
  });
}


</script>
