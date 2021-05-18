
<div class="page-wrapper chiller-theme toggled">
<style>

.dataTables_wrapper {
    font-family: tahoma;
    font-size: 11px;
}
#reportdate{
 font-size:12px;
 font-weight: bold;
}

#timer{
  display: none;
}
.select2-dropdown {
   font-size:12px;
}

</style>

<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<main class="page-content">

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
  <div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Time Sheet </div>
		</div>
    <div class="row activity-row">
      <div class="col-md-12 activity">

        <div class="row " style="margin-left:10%">
            <div class="col-md-3">
              <p>Agent</p>
               <select class="form-control" name="agent" id="agents" style="font-size:10px;font-weight:bold;margin-top:10%" >
               </select>
            </div>
            <div class="col-md-3">
              <p>Reporting Date</p>
              <input type="date" name="reportdate" id="reportdate"  class="form-control">
            </div>
            <div class="col-md-3">
              <input type="button" class="check-in" onclick="usersub()" name="" value="Submit" style="margin-top:12%">
            </div>
          </div>
        <div class="row">
         <div class="col-md-12">
           <div class="row emp-table viewtimesheet" style="display:none;">
 						<div class="col-md-12 table-responsive">
 							<div class="activity" style="text-align:center;border-bottom: 2px  solid #5caddc;">TIMESHEET</div><br>
 							<div class="row">
 								<div class="col-md-3" style="display:none;">
 									<p>Reporting Person</p>
 									<select id="reportingperson" class="form-control" style="font-size:14px;">
 										<option value=""></option>
 									</select>
 								</div>
 							</div><br>
 							<div class="row ">
 								<div class="card card-body shadow" style="background:Aquamarine">
 									<p> Total Time Spent</p>
 									<p id="totalassignedhours" style="font-weight:bold;font-size:25px;">00:00</p>
 								</div>
 								<div class="card card-body shadow" style="background:DarkSalmon">
 									<p> Productive Time</p>
 									<p id="productivetime" style="font-weight:bold">00:00</p>
 								</div>
 								<div class="card card-body shadow"  style="background:SteelBlue">
 									<p> Non-Productive Time</p>
 									<p id="non_productivetime" style="font-weight:bold">00:00</p>
 								</div>
 								<div class="card card-body" style="display:none">
 									<p> Total target</p>
 									<p id="totaltarget" style="font-weight:bold">0</p>
 									<p id="breaktime" style="font-weight:bold">00:00</p>
 								</div>
 								<div class="card card-body"  style="background:Wheat">
 									<p> Total Production Count</p>
 									<p id="totalcount" style="font-weight:bold">0</p>
 								</div>
 								<div class="card card-body"  style="background:#f5b3b3">
 									<p> Overall Percentage</p>
 									<p id="overallpercentage" style="font-weight:bold">0%</p>
 								</div>
 							</div><br>
 							<table class="table table-bordered brktime" >
 								<thead>
 									<tr>
 										<td style="width:15%">
 											<p>Client</p>
 											<select id="client" name="client" class="form-control" style="font-size:12px;" >
 												<option value="">Select Client</option>

 											</select>
 										</td>
 										<td>
 											<p>Type</p>
 											<select id="Typeprocess" name="Typeprocess" class="form-control" onchange="tasklistget(this)"  style="font-size:12px;">
 												<option value="">Select Type</option>
 												<option value="Productive">Productive</option>
 												<option value="Non-Productive">Non-Productive</option>
 											</select>
 										</td>
 										<td>
 											<p>Task</p>
 											<select id="task" name="task" class="form-control" onchange="sub_tasklistget(this)" style="font-size:12px;">
 												<option value="">Select Task</option>
 											</select>
 										</td>
 										<td>
 											<p>Sub-Task</p>
 											<select id="subtask" name="subtask" class="form-control" onchange="checktargetsetup()"  style="font-size:12px;" >
 												<option value="">Select Sub Task</option>
 											</select>
 										</td>
 										<td style="width:10%">
 											<p>Time Spent</p>
 											<input type="text"  id="timespend" name="timespend" value="00:00" max="12:59" onblur="calculatepercentage()" class="form-control"  style="font-size:12px;">
 										</td>
 										<td  style="width:5%">
 											<p>Count</p>
 											<input type="text" id="count_prod" name="count_prod" class="form-control" onkeyup="calculatepercentage()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="font-size:12px;">
 										</td>
 										<td style="width:5%;display:none">
 											<p>Target/hr</p>
 											<input type="text" readonly id="target" name="target" class="form-control" style="font-size:12px;">
 										</td>
 										<td style="width:5%">
 											<p>%</p>
 											<b id="percentage"></b>
 											<input type="hidden" readonly id="percentageval_set" name="percentageval_set" class="form-control" style="font-size:12px;">
 										</td>
 										<td>
 											<p>Comments</p>
 											<input type="text" id="usercomments"  name="usercomments" class="form-control"  style="font-size:12px;">
 										</td>
 										<td>
 											<!-- <button onclick="timesheetadd()" id="timerview" style="margin-top:44%;">Add</button> -->
 											<i class="fa fa-plus"   onclick="timesheetadd()" style="padding-top:151%;font-size:26px;cursor:pointer"></i>
 										</td>
 									</tr>
 								</thead>
 								<tbody id="display_data">
 								</tbody>
 							</table>

 							<div class="row">
 								<div class="col-md-3" id="get_below90details"  style="display:none;">
 								  <p>Details</p>
 								  <textarea name="get_below90details_tx" id="get_below90details_tx" rows="3" cols="30"></textarea>
 								</div>
 								<div class="col-md-9" style="text-align:center">
 									<input type="button" value="Submit" id="timerview" onclick="logooutsubmit()" class="timesheetsubmit" style="display:none;margin-top:10%">
 								</div>
 							</div>
 						</div>
 					</div>





         </div>
        </div>
      </div>
    </div>

  </div>
</main>

</div>
<script type="text/javascript">
  async function submitform() {
    var res = await calculatepercentage();
    if(res == 'yes'){
       setTimeout(function(){   $('#formsubmit').submit(); }, 1000);
    }
  }
</script>
<div class="modal fade" id="updatetimesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Time Sheet</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				 <span aria-hidden="true">&times;</span>
			 </button>
      </div>
      <div class="modal-body">
				<input type="hidden" id="indexid">
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
						<!-- <input type="time" id="timespendupdate" onblur="calculatepercentage_update()"> -->
						<input type="text" id="timespendupdate" style="width:80%" name="timespendupdate" value="00:00" max="12:59" onblur="calculatepercentage_update()">
					</div>
					<div class="col-md-3"><br>
						<p>Count</p>
						<input type="text" style="width:50%"  onblur="calculatepercentage_update()" id="countupdate"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
					</div>
					<div class="col-md-3" style="display:none;"><br>
						<p>Target/hr</p>
						<input type="text"  style="width:50%" id="targetupdate" readonly >
					</div>
					<div class="col-md-3"><br>
						<p>Percentage</p>
						<h4 id="percentageupdate" style="font-weight:bold;padding-top:10px"></h4>
						<input type="hidden" readonly id="percentageupdate_data" readonly >
					</div>
					<br>
					<div class="col-md-12"><br>
						<p>Comment</p>
						<input type="text" id="commentsupdate" width="100%">
					</div>
				</div>
				<br>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatevalueTS()">Save changes</button>
				 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include('sweetalert.php'); ?>
<script>
$(document).ready(function() {
  reportdate.max = new Date().toISOString().split("T")[0];
})
function usersub(){
  $.ajax({
    url:"<?php echo base_url(); ?>Timesheet/checktsrejectiondata",
    method:"POST",
    data:{"agent":$('#agents').val(),"report_date":$('#reportdate').val()},
    success:function(dataset){
      if(JSON.parse(dataset).length > 0){
        $('.viewtimesheet').hide();
      //  alert("Reporting Details Already Exists");
        swal("Warning", "Reporting Details Already Exists", "warning");

      }else{
        $('.viewtimesheet').show();
        $.ajax({
          url: '<?php echo base_url(); ?>Timesheet/getclientlist',
          method:'POST',
          data:{"agent":$('#agents').val()},
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

        $.ajax({
          url: '<?php echo base_url(); ?>Timesheet/getreporting',
          method:'POST',
          data:{"agent":$('#agents').val()},
          success: function(res){
            var resdata=JSON.parse(res);
            //console.log(resdata);
            var role='<?php echo $_SESSION["department"]; ?>';
            if(resdata.length == 0){
              if(role == 'MANAGEMENT' || role == 'ADMIN'){}else{
                swal("Warning", "Please contact your manager!!! Your reporting person not assigned", "warning");
                $('.viewtimesheet').css("display", "none");
              }
            }
             var outrepPerson='';
             for(var i=0;i<resdata.length;i++){
               if(i==0){
                 var setselect='selected';
               }
              outrepPerson += '<option value="'+resdata[i]['manager_id']+'/'+resdata[i]['reporting_manager']+'" '+setselect+'>'+resdata[i]['manager_id']+'/'+resdata[i]['reporting_manager']+'</option>';
             }
            $('#reportingperson').html(outrepPerson);
          }
        })


      }
    }
  });
}

function tasklistget(types){
	if(!$('#client').val()){

	}else{
		var out_type='';
		out_type +='<option value="">Select Task</option>';
    var dpt = "<?php echo $_SESSION['department']; ?>";
		if(types.value == 'Productive'){
			$.ajax({
				url: '<?php echo base_url(); ?>Timesheet/gettasklist',
				method:'POST',
				data:{"type":types.value},
				success: function(res){
					var resdata=JSON.parse(res);

					for(var i=0;i<resdata.length;i++){
            if(dpt == 'DATA'){
							$('#task').attr('readonly', true);
							out_type += '<option value="'+resdata[i]['id']+'/'+resdata[i]['task']+'" selected readonly>'+resdata[i]['task']+'</option>';

						}else{
						  out_type += '<option value="'+resdata[i]['id']+'/'+resdata[i]['task']+'">'+resdata[i]['task']+'</option>';
            }

					}
					$('#task').html(out_type);
          if(dpt == 'DATA'){
            sub_tasklistget($('#task').val());
          }
				}
			});
		}
		if(types.value == 'Non-Productive'){
      if(dpt == 'DATA'){
        $('#task').attr('readonly', false);
      }
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
			data:{"task":$('#task').val()},
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
			out_subtype +='<option value="Events">Events</option>';

		}
		if(subtype.value == 'Personal'){
			out_subtype +='<option value="Break" >Break</option><option value="System Down">System Down</option>';
			var dt="<?php echo $_SESSION['department']; ?>";
			if(dt != 'DATA'){
				out_subtype +='<option value="Cab Late">Cab Late</option>';
			}
			out_subtype +='<option value="Permission">Permission</option>';
      out_subtype +='<option value="Leave">Leave</option>';
		}
		$('#subtask').html(out_subtype);
	}
}

function checktargetsetup(){
	if($('#Typeprocess').val() == 'Productive'){
		$.ajax({
			method : 'post',
			url    : '<?php echo base_url()?>Timesheet/gettagetvalue',
			data   : {
                "agent":$('#agents').val(),
								"client":$('#client').val(),
								"task":$('#task').val(),
								"sub_task":$('#subtask').val()
							},
			success : function(resget){
				var dt=JSON.parse(resget);
				if(dt.length == 0){
					$('#timespend').hide();
					$('#count_prod').hide();
					swal("Error", "Target Not Found, Please Contact Your Supervisor!!!!", "error");
				}else{
					$('#timespend').show();
					$('#count_prod').show();
				}
			}
		});
	}else{
    if($('#subtask').val() == 'Leave'){
      $('#timespend').hide();
      $('#count_prod').hide();
    }
  }
}

async function calculatepercentage() {

	if($('#timespend').val() =='00:00' || $('#count_prod').val() == ''){   $('#percentage').html('0%');$('#percentageval_set').val(''); return 0; }
	if($('#Typeprocess').val() == 'Productive'){
		$.ajax({
			method : 'post',
			url    : '<?php echo base_url()?>Timesheet/gettagetvalue',
			data   : {
                "agent":$('#agents').val(),
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
        //  $('#needtobecompleted').val(needtocomplete);
					var Percentageval = parseInt(Math.round((parseInt($('#count_prod').val())/parseInt(needtocomplete))*100));
          var perval=Percentageval?Percentageval:0;

          if(perval != '0'){
            $('#percentageval_set').val(perval+'%');
          }else{
            $('#percentageval_set').val('');
          }
					$('#percentage').html(perval+'%');
				}else{
					alert("No Target Setup found!!!");
				}
			}
		});
	}
  return "yes";
}



$.ajax({
  url:"<?php echo base_url(); ?>Timesheet/getagentlist",
  method:"POST",
  success:function(dataset){
    var res = JSON.parse(dataset);
    var out='';
    <?php if($_SESSION['role']!='agent'){ ?>
      out +='<option value="" selected>Select agent</option>';
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

var client =[];
var typeval =[];
var task = [];
var subtask = [];
var timespent = [];
var countdown = [];
var comments = [];
var target=[];
var per=[];
var set_tobe_achieved=[];


async function timesheetadd(){

    var res = await calculatepercentage();
    if(res == 'yes'){


	if($('#subtask').val() == 'Break'){
		var timing = $('#timespend').val().split(':');
		var time1=timing[0];
		var time2=timing[1];
		if((parseInt(time1) == 0 && parseInt(time2) < 60) || (parseInt(time1) == 1 && parseInt(time2) == 0)){

		}else{
			//alert("Break hour not more than 1 hour");
			swal("Error", "Break hour not more than 1 hour", "error");
			return;
		}

	}
	var checkcount=0;
	client.forEach((item, i) => {
			if(client[i] == $('#client').val() && typeval[i] == $('#Typeprocess').val() && task[i] == $('#task').val() && subtask[i] == $('#subtask').val()){
				checkcount++;
			}
	});
	//alert(checkcount);
	if(client.length != 0 && checkcount > 0)
	{
		swal("Warning", "Details Already added!! Please check", "warning");
		return;
	}else{
		client.push($('#client').val());
		typeval.push($('#Typeprocess').val());
		task.push($('#task').val());
		subtask.push($('#subtask').val());
		timespent.push($('#timespend').val());
		if($('#Typeprocess').val() == 'Productive'){
			countdown.push($('#count_prod').val());
			var tim=$('#timespend').val();
			var timetomin=moment.duration(tim).asMinutes();
			var needtocomplete=Math.round((parseInt($('#target').val())/parseInt(60))*parseInt(timetomin));
		//	console.log(needtocomplete);
			set_tobe_achieved.push(needtocomplete);
		}else{
			countdown.push('-');
			set_tobe_achieved.push('-');
		}

		comments.push($('#usercomments').val());
		target.push($('#target').val());
		per.push($('#percentageval_set').val());

		swal("Success", "Details Added Successfully!!!", "success");

	//	$('#client').val('');
		$('#Typeprocess').val('');
		$('#task').val('');
		$('#subtask').val('');
		$('#timespend').val('00:00');
		$('#count_prod').val('0');
		$('#usercomments').val('');
		$('#target').val('');
		$('#percentageval_set').val('');
		$('#percentage').html('-');
	}
	displaytimesheetdata();
}
}

function displaytimesheetdata(){
	var out='';
	var productivetimeget=moment.duration ('00:00');
	var nonproductivetimeget=moment.duration ('00:00');
	var getbreaktiming=moment.duration ('00:00');
	if(client.length > 0){
    var showornotflag=0;
		for(var i=0;i< client.length;i++){
			if(subtask[i] == 'Break'){
				out +='<tr style="background:#d6d3d3">';
				out +='<td >Default Break</td>';

			}else{

				out +='<tr>';
				out +='<td >'+client[i].split("/")[1]+'</td>';
			}


			out +='<td>'+typeval[i]+'</td>';
			if(typeval[i] == 'Productive'){
				out +='<td>'+task[i].split("/")[1]+'</td>';
				out +='<td>'+subtask[i].split("/")[1]+'</td>';
			}else{
				out +='<td>'+task[i]+'</td>';
				out +='<td>'+subtask[i]+'</td>';
			}
      if(subtask[i] == 'Leave'){
        showornotflag++;
        out +='<td>-</td>';
      }else{
        out +='<td>'+timespent[i]+'</td>';
      }

			out +='<td>'+countdown[i]+'</td>';
			out +='<td style="display:none">'+target[i]+'</td>';
			out +='<td>'+per[i]+'</td>';
			out +='<td>'+comments[i]+'</td>';
			if(subtask[i] == 'Break'){
				out +='<td></td>';
			}
			else{
				out +='<td><i class="fas fa-pencil-alt"  onclick="updatetimesheet('+i+')"></i><i class="fa fa-trash"  onclick="removetimesheet('+i+')"></i></td>';
			}
			out +='</tr>';
			if(typeval[i] == 'Productive'){
				productivetimeget.add(timespent[i]);
			}
			if(typeval[i] == 'Non-Productive'){
				nonproductivetimeget.add(timespent[i]);
				if(subtask[i] == 'Break'){
					getbreaktiming.add(timespent[i]);
				}
			}
		}
		$('#productivetime').html(("0" +productivetimeget.hours()).slice(-2)+':'+("0" +productivetimeget.minutes()).slice(-2));
		$('#non_productivetime').html(("0" +nonproductivetimeget.hours()).slice(-2)+':'+("0" +nonproductivetimeget.minutes()).slice(-2));
	//	$('#breaktime').html(("0" +getbreaktiming.hours()).slice(-2)+':'+("0" +getbreaktiming.minutes()).slice(-2));


		var timingoverall=moment.duration ('00:00');
		if(timespent.length > 0){
			timespent.forEach((item) => {
				var timingget = moment.duration (item);
				timingoverall.add(timingget);
			});
			$('#totalassignedhours').html(("0" +timingoverall.hours()).slice(-2)+':'+("0" +timingoverall.minutes()).slice(-2));
		}else{
				$('#totalassignedhours').html("00:00");
		}


		//check working hours > 9

		if(timingoverall.hours() > 8){
			$('.timesheetsubmit').show();
		}else{
			$('.timesheetsubmit').hide();
		}
    if(showornotflag > 0){
      $('.timesheetsubmit').show();
    }

		var productioncount=0;
		countdown.forEach((counting)=>{
			if(counting == '-'){
				var ct=0;
			}else{
				var ct=counting;
			}
			productioncount = parseInt(productioncount)+parseInt(ct);
		})
		$('#totalcount').html(productioncount);

		var targetcount=0;
		var i=0;
		target.forEach((counting)=>{
			var tim=timespent[i];
			var timetomin=moment.duration(tim).asMinutes();
			if(counting == '-' ||counting == '' ){
				var needtocomplete=0;
				//set_tobe_achieved.push(0);
			}else{
				var needtocomplete=Math.round((parseInt(counting)/parseInt(60))*parseInt(timetomin));
				//set_tobe_achieved.push(needtocomplete);
			}
			targetcount = parseInt(targetcount)+parseInt(needtocomplete);
			i++;
		})
		$('#totaltarget').html(targetcount);
		 var val_overallper =Math.round((parseInt($('#totalcount').text())/parseInt($('#totaltarget').text()))*100);
     if(isNaN(val_overallper)){
       var perc_get=0;
     }else{
       var perc_get=val_overallper;
     }
		$('#overallpercentage').html(perc_get+'%');

		if(perc_get < 90){
			$('#get_below90details').show();
		}else{
			$('#get_below90details').hide();
		}

	}else{
		$('#totalassignedhours').html("00:00");
		$('#totalcount').html("0");
		$('#totaltarget').html("0");
		$('#productivetime').html("00:00");
		$('#non_productivetime').html("00:00");
		$('#breaktime').html("00:00");
		$('.timesheetsubmit').hide();
		out +='<tr><td colspan="8" style="text-align:center">No Data Found</td></tr>';
	}

	$('#display_data').html(out);
}

function removetimesheet(i){
	if(client.length >0){

		client.splice(i,1);
		typeval.splice(i,1);
		task.splice(i,1);
		subtask.splice(i,1);
		timespent.splice(i,1);
		countdown.splice(i,1);
		target.splice(i,1);
		per.splice(i,1);
		comments.splice(i,1);
		set_tobe_achieved.splice(i,1);
		swal("Success", "Details Removed Successfully!!!", "success");
	}
	displaytimesheetdata();
}


function updatetimesheet(valget){
	$('#updatetimesheet').modal('show');
	$('#timespendupdate').timepicker({
			showMeridian: false,
			showInputs: true,
			minTime: '00',
			timeFormat:'HH:mm',
			zindex: 9999999,
			interval: 5,
	});
	$('#clientid').html(client[valget]);
	$('#typeid').html(typeval[valget]);
	$('#taskid').html(task[valget]);
	$('#sub_taskid').html(subtask[valget]);
	$('#timespendupdate').val(timespent[valget]);
	$('#countupdate').val(countdown[valget]);
	$('#targetupdate').val(target[valget]);
	$('#percentageupdate_data').val(per[valget]);
	$('#percentageupdate').html(per[valget]);
	$('#commentsupdate').val(comments[valget]);
	$('#indexid').val(valget);
}

function updatevalueTS(){
	var index=$('#indexid').val();
	timespent[index]=$('#timespendupdate').val();
	countdown[index]=$('#countupdate').val();
	comments[index]=$('#commentsupdate').val();
	target[index]=$('#targetupdate').val();
	per[index]=$('#percentageupdate_data').val();
	var tim=timespent[index];
	var timetomin=moment.duration(tim).asMinutes();
	var needtocomplete=Math.round((parseInt(target[index])/parseInt(60))*parseInt(timetomin));
	set_tobe_achieved[index]=needtocomplete;
	$('#updatetimesheet').modal('hide');
	swal("Success", "Details Updated Successfully!!!", "success");
	displaytimesheetdata();
}


function logooutsubmit(){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url()?>Timesheet/timesheet_submit',
		data   : {
              "agent":$('#agents').val(),
              "reporting_date":$('#reportdate').val(),
							"client":client,
							"type":typeval,
							"task":task,
							"sub_task":subtask,
							"timespent":timespent,
							"countdown":countdown,
							"comments":comments,
							"target":target,
							"percentage":per,
							"tobe_achived":set_tobe_achieved,
							"reporting_person":$('#reportingperson').val(),
							"totaltimespend":$('#totalassignedhours').text(),
							"productive_time":$('#productivetime').text(),
							"non_rpoductive_time":$('#non_productivetime').text(),
							"totalproduction_count":$('#totalcount').text(),
							"overall_percentage":$('#overallpercentage').text(),
							"otherdetailsenter":$('#get_below90details_tx').val(),
							"target_count":$('#totaltarget').text(),
		},
		success :function(data){

			if(data == '"Update Success"'){
				swal("Success", "Time-Sheet Updated Successfully!!!", "success");
				 location.replace('<?php echo base_url();?>Timesheet');
			}
			if(data == '"Insert Success"'){
			  location.replace('<?php echo base_url();?>Timesheet');
			//	location.reload();

			}
		}
	});
}


function calculatepercentage_update() {

	if($('#timespendupdate').val() =='00:00' || $('#countupdate').val() == ''){ return 0; }
	if($('#typeid').text() == 'Productive'){
		$.ajax({
			method : 'post',
			url    : '<?php echo base_url()?>Timesheet/gettagetvalue',
			data   : {
                "agent":$('#agents').val(),
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

					var Percentageval = parseInt(Math.round((parseInt($('#countupdate').val())/parseInt(needtocomplete))*100));
					var perval=Percentageval?Percentageval:0;
					if(perval != '0'){
						$('#percentageupdate_data').val(perval+'%');
					}else{
						$('#percentageupdate_data').val('');
					}
					$('#percentageupdate').html(perval+'%');
				}else{
					alert("No Target Setup found!!!");
				}
			}
		});
	}
}

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $('#timespend').timepicker({
            showMeridian: false,
            showInputs: true,
						minTime: '00',
						timeFormat:'HH:mm',
						interval: 5,
        });

    });
</script>
