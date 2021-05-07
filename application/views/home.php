<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
select{
	font-size:12px;
}
input[type=time]::datetime-edit-field.numeric{

    display: inline !important;

}
.fa-pencil-alt{
  color:#24cb5b;
  font-size:15px;
  cursor:pointer;
  padding:15%;
}
.fa-trash{
  color:#ff5c4b;
  font-size:18px;
  cursor:pointer;
}

</style>

<div class="page-wrapper chiller-theme toggled">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" <?php if($userdata['role']!='admin'){?>style="min-height:780px;"<?php } ?>>
				<?php include('page_head.php');?>


					<div class="row activity-row">
						<div class="col-md-12 activity">Activity</div>
					</div>

					<div class="row activity-table">
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/checkin.jpg"><br><br>
							<a href="<?php echo base_url();?>Checkin_checkout/CheckIn"><button class="check-in" id="checkin">Check-In</button></a>
							</div>
						</div>
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/start-break.jpg"><br><br>
							<a href="<?php echo base_url();?>Breakin_breakout/BreakIn"><button class="start-break" id="breakin" >Start Break</button></a>
							</div>
						</div>
						<!-- <div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/permission.png"><br><br>
							<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
								<select class="permission start-break">
									<option value="0 mins">Permission</option>
									<option value="30 mins">30 Minutes</option>
									<option value="60 mins">60 Minutes</option>
									<option value="90 mins">90 Minutes</option>
									<option value="120 mins">120 Minutes</option>
								</select>
							</div>
						</div> -->
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/end-break.jpg"><br><br>
							<a href="<?php echo base_url();?>Breakin_breakout/BreakOut"><button class="start-break" id="breakout">End Break</button></a>
							</div>
						</div>
						<div class="col-6 col-md-3">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/checkout.jpg"><br><br>
							<a onclick="redirectUser()" style="color:#fff;"><button class="check-out" id="checkout" >Check-out</button></a>
							</div>
						</div>
					</div>

					<div class="row emp-table" id="viewrejectedsheet"  style="display:none;">
						<div class="col-md-12 table-responsive">
							<div class="activity" style="text-align:center;border-bottom: 2px  solid #5caddc;">TIMESHEET</div><br>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="card card-body shadow " align="center">
										<p>Your Timesheet Rejected!!! Do you want to Re-submit the form now?</p>
										<div  align="center">
												<button type="button" class="check-in" onclick="location.replace('<?php echo base_url();?>Login/checktimesheet');" style="width:30%;">Go to Rejected Timesheet</button>
										</div>

									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
					<br>

					<div class="row emp-table viewtimesheet" style="display:none;">
						<div class="col-md-12 table-responsive">
							<div class="activity" style="text-align:center;border-bottom: 2px  solid #5caddc;">TIMESHEET</div><br>
							<div class="row">
								<div class="col-md-3" style="display:none">
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
											<select id="client" name="client" class="form-control" style="font-size:12px;" onblur="checkclient()">
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
											<input type="text" id="count_prod" name="count_prod" class="form-control" onblur="calculatepercentage()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="font-size:12px;">
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




						<div class="row emp-table" id="emp-table">
							<div class="col-md-12 table-responsive">
								<table class="table brktime">
									<thead>
										<tr>
										    <th scope="col">Emp ID</th>
										    <th scope="col">Name</th>
										    <th scope="col">Check-IN</th>
										    <th scope="col">Start Break</th>
										    <th scope="col">End Break</th>
										    <th scope="col">Break Period</th>
										    <th scope="col">Check-Out</th>
										    <th scope="col">Permission</th>
										    <th scope="col">Hours Spent</th>
										</tr>
									</thead>
									<tbody>
									<?php if($login_data!=''){?>
								<tr>
									<?php foreach($login_data as $logdata){?>
									<th scope="row"><span class="emp-id"><?php echo $logdata->emp_id;?></span></th>
									<?php
									$cmnt=$this->db->query("SELECT * FROM checkin_checkout WHERE user_id='".$logdata->user_id."' ORDER BY id desc");
									$cmnt1=$this->db->query("SELECT * FROM breakin_breakout WHERE user_id='".$logdata->user_id."' ORDER BY id desc limit 0,3");
                        			$checkin=$cmnt->result();
                        			$breakin=$cmnt1->result();
                        			?>
									<td><?php echo $logdata->name;?></td>
									<td><span class="emp-break-in"><?php echo $checkin[0]->checkin_time;?></span></td>
									<td><span class="emp-break-in">
									<?php
										for($i=0;$i<count($breakin);$i++){
										    echo $breakin[$i]->breakin_time.'<br>';
										}
									?>
									</span></td>
									<td><span class="emp-break-out">
										<?php
										for($i=0;$i<count($breakin);$i++){
										    echo $breakin[$i]->breakout_time.'<br>';
										}
										?>
									</span></td>
									<td><span class="" style="color:#5778dc;">
									<?php
									$tst=strtotime('00:00:00');
									$totaltime = 0;
										for($i=0;$i<count($breakin);$i++){

										  echo $breakin[$i]->break_inout_diff.'<br>';
											$seconds = explode(":", str_replace(array(' hour',' mins',' secs'),'',$breakin[$i]->break_inout_diff));
											$addtime = (string)date("H:i:s",strtotime(str_replace(array(' hour',' mins',' secs'),'',$breakin[$i]->break_inout_diff)));
											$timeinsec = strtotime($addtime) - $tst;
											$totaltime = $totaltime + $timeinsec;

										}
										$h = sprintf("%02d",intval($totaltime / 3600));
										$totaltime = $totaltime - ($h * 3600);
										$m = sprintf("%02d",intval($totaltime / 60));
										$s = sprintf("%02d",$totaltime - ($m * 60));
									?>
									</span>
									<!-- <span class="emp-break-out">Total Break: <?php echo $total_bktime+$minutes;?> Mins <?php echo $secondsleft;?> Secs</span> -->
									<span class="emp-break-out">Total Break: <?php echo $h." Hour:".$m." Mins:".$s." Secs"; ?></span>
									</td>
									<td><span class="emp-break-out"><?php echo $checkin[0]->checkout_time;?></span></td>
									<td><span class="permission_val" style="color: #938554;">0 mins</span></td>
								    <td><span class=""><?php echo $checkin[0]->check_inout_diff;?></span></td>
								</tr>
								<?php } } ?>
								</tbody>
								</table>
							</div>
						</div>

						<?php if($userdata['role']=='admin'){?>
							<div class="row activity-row">
								<div class="col-md-3 activity">Employee Login Info</div>
									<div class="col-md-9 activity">
										<div class="form-group has-search">
											<span class="fa fa-search form-control-feedback"></span>
											<input type="text" class="search-input" placeholder="Search" id="search">
										</div>
									</div>
								</div>
								<div class="row emp-table">
									<div class="col-md-12 table-responsive">
										<table class="table" id="tabledata">
										    <thead>
										    	<tr>
										      		<th scope="col">Emp ID</th>
										      		<th scope="col">Agent Name</th>
										      		<th scope="col">Dept</th>
										      		<th scope="col">CheckIn Duration</th>
										      		<th scope="col">Status</th>
										    	</tr>
										  	</thead>
											<tbody>
										  		<?php if($emp_data!=''){?>
										    	<tr>
										      	<?php foreach($emp_data as $agentdata){ ?>
										      	<th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id;?></span></th>
										        <td><?php echo ucfirst($agentdata->name);?></td>
										        <td><?php echo ucfirst($agentdata->department);?></td>
										        <?php
										        $cmnt=$this->db->query("SELECT * FROM checkin_checkout WHERE user_id='".$agentdata->user_id."' ORDER BY id desc");
                        					    $check_in=$cmnt->result();
                        					   ?>
										       <td><span class="emp-hours-spent"><?php echo $check_in[0]->check_inout_diff;?></span></td>
										       <td><span class="<?php if($agentdata->status=='loggedin') echo "available"; else echo "loggedout" ?>"><?php echo ucfirst($agentdata->status);?></span></td>
										    	</tr>
												<?php } } ?>
											</tbody>
										</table>
									</div>
									<input type="button" id="seeMoreRecords" value="Show More" class="check-in">
                  					<input type="button" id="seeLessRecords" value="Show Less" class="check-out">
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</main>
		</div>
	</body>

<div class="modal fade" id="reasonfor_leaving" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pending Time Sheet</h5>
      </div>
      <div class="modal-body">
        <p>Date</p>
				<?php
				$empid=$_SESSION['emp_id'];
					$cmnt=$this->db->query("SELECT * FROM checkin_checkout WHERE emp_id='".$empid."' ORDER BY id desc");
					$checkin=$cmnt->result();
				?>
				<input type="hidden" id="id" value="<?php echo $checkin[0]->id; ?>">
				<input type="text" name="pendingtask_dt" value="<?php echo date_format(date_create($checkin[0]->checkin_time),"Y-m-d"); ?>" id="pendingtask_dt" readonly>
				<p>Comment</p>
				<textarea name="comments_pending" id="comments_pending" rows="5" cols="50"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="pendingtaskupdate()">Save changes</button>
				 <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
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
<script type="text/javascript">
$(document).ready(function(){
		$('#get_below90details').hide();
	$.ajax({
		url: '<?php echo base_url(); ?>Timesheet/getclientlist',
		method:'POST',
		success: function(res){
			var resdata=JSON.parse(res);
			var outclient='';
			outclient='<option value="">Select Client</option>';
			for(var i=0;i<resdata.length;i++){
				if(i == 0){
					var setselected = 'selected';
				}
				outclient += '<option value="'+resdata[i]['id']+'/'+resdata[i]['client']+'" '+setselected+'>'+resdata[i]['client']+'</option>';
			}
			$('#client').html(outclient);
		}
	})

	$.ajax({
		url: '<?php echo base_url(); ?>Timesheet/getreporting',
		method:'POST',
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
})
var flag_set=true;
function redirectUser(){
	var dept='<?php echo $_SESSION["department"]; ?>';
	var empidg='<?php echo $_SESSION["emp_id"]; ?>';
	var role='<?php echo $_SESSION["role"]; ?>';
	if(dept == 'MANAGEMENT' || dept == 'ADMIN' || dept=='IT' || dept == 'SOFTWARE' || dept == 'BUSINESS DEVELOPMENT' || empidg == 'M542' || role == 'supervisor'){
		var per_time = $('.permission').val();
    location.replace('<?php echo base_url();?>Checkin_checkout/CheckOut/'+parseInt(per_time));
	}else{
		//check Rejection

		$.ajax({
			url : "<?php echo base_url(); ?>Timesheet/getrejectedlist",
			method : "POST",
			success : function(datares){
				var getRgej =JSON.parse(datares);
				if(getRgej.length > 0){
					$('#viewrejectedsheet').show();
				}else{
		if(localStorage.getItem('timing')){
	  	var currentrunningtime = localStorage.getItem('timing').split(":");
			var hours =parseInt(currentrunningtime[0]);

		//	if(hours > 11 && hours < 24){
				if(hours > 11){
				$.ajax({
					method : 'post',
					url    : '<?php echo base_url()?>Timesheet/checklateupdate',
					data : {'checkids':localStorage.getItem('checkid')},
					success: function(data){
					//	console.log(data);
						if(data == '"Data Not found"'){
								$('#reasonfor_leaving').modal('show');
						}else{
							$('#reasonfor_leaving').modal('hide');
						}
						$('.viewtimesheet').show();
					}
				});

			}
			else{
				$('.viewtimesheet').show();
			}
		}


		if(flag_set){
			client.push($('#client ').val());
			typeval.push('Non-Productive');
			task.push('Personal');
			subtask.push('Break');
			timespent.push('01:00');
			countdown.push('-');
			comments.push('');
			target.push('-');
			per.push('');
			set_tobe_achieved.push('-');
			displaytimesheetdata();
			flag_set = false;
		}

		}
	}
});
	}


}

$(document).ready(function(){
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Checkin_checkout/checkPermission',
		method:'POST',
		success: function(res){
			if(res){
				var per_hr = JSON.parse(res);
				per_hr == 1 ? per_hr='1 hour' : per_hr=per_hr+' hours';
				$('.permission_val').html(per_hr);
			}
		},
		failed: function(err){
			console.log(err)
		}
	});
	checkinstatus();
	breakinstatus();
});

/* $('.permission').change(function(){
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Checkin_checkout/insertPermission',
		method: 'POST',
		data: {
			'per_time': $('.permission').val()
		},
		success: function(res){
			$('.permission_val').html($('.permission').val());
			$('.permission').prop("disabled", true);
		},failed: function(err){
			console.log(err);
		}
	});
}); */

var name = '<?php echo $userdata['name'];?>';
function notification(){

  if(!window.Notification){
    console.log('Browser does not support notifications.');
  }
  else{
    //check if permission is already granted
    if(Notification.permission === 'granted'){
        var notify = new Notification('Hi' + " " + name + '...!',{
        body: 'Welcome to HRMS...',
        icon: 'https://www.4dglobalinc.com/wp-content/uploads/2017/09/4D-Global-Logo-01-1-e1507835142952.png',
      });
    }
  }
}

var $rows = $('#tabledata tr');
$('#search').keyup(function(){
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function(){
       var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
       return !~text.indexOf(val);
    }).hide();
});


   	function checkinstatus(){
		var id = '<?php echo $userdata['user_id']; ?>';
		$.ajax({
			type   : 'ajax',
			method : 'post',
			url    : '<?php echo base_url();?>Checkin_checkout/checkStatus',
			data   : {id:id},
			dataType: 'json',
			success : function(data){
				if(data!=false){
					if(data.check_inout_flag==1){
						$('#checkin').prop("disabled", true).css('opacity',0.5);
						$('#checkout').prop("disabled", false);
					}
					else{
						$('#checkin').prop("disabled", false);
						$('#checkout').prop("disabled", true).css('opacity',0.5);
					}
				}
				else if(data==false){
					$('#checkout').prop("disabled", true).css('opacity',0.5);
					//$('#breakout').prop("disabled", true).css('opacity',0.5);
				}
			},
			error : function(){
				alert('Sorry, Something Went Wrong');
			}
		});
	}


	function breakinstatus(){
		var id = '<?php echo $userdata['user_id']; ?>';
		$.ajax({
    		type   : 'ajax',
			method : 'post',
    		url    : '<?php echo base_url()?>Breakin_breakout/BreakStatus',
    		data   : {id:id},
    		dataType: 'json',
    		success: function(data){
    			if(data!=false){
					if(data.break_inout_flag==1){
						$('#breakin').prop("disabled", true).css('opacity',0.5);
						$('#breakout').prop("disabled", false);
					}
					else{
						$('#breakin').prop("disabled", false);
						$('#breakout').prop("disabled", true).css('opacity',0.5);
					}
				}
				else if(data==false){
					$('#breakout').prop("disabled", true).css('opacity',0.5);
				}
    		},
    		error: function() { alert("Error posting feed."); }
  		});
	}

var trs       = $("#tabledata tr");
var btnMore   = $("#seeMoreRecords");
var btnLess   = $("#seeLessRecords");
var trsLength = trs.length;

var currentIndex = 10;

trs.hide();
trs.slice(0, 10).show();
checkButton();

btnMore.click(function(e){
  e.preventDefault();
  $("#tabledata tr").slice(currentIndex, currentIndex + 10).show();
  currentIndex += 10;
  checkButton();
});

btnLess.click(function(e){
  e.preventDefault();
  $("#tabledata tr").slice(currentIndex - 10, currentIndex).hide();
  currentIndex -= 10;
  checkButton();
});

function checkButton()
{

  var currentLength = $("#tabledata tr:visible").length;

    if(currentLength >= trsLength)
      btnMore.hide();
    else
      btnMore.show();

    if(trsLength > 10 && currentLength > 10)
      btnLess.show();
    else
      btnLess.hide();
}

window.addEventListener("unload", function(){
  var count = parseInt(sessionStorage.getItem('counter') || 0);
  sessionStorage.setItem('counter', ++count)
}, false);

if(sessionStorage.getItem('counter') == null){
 notification();
}
console.log(sessionStorage.getItem('counter'));



//Timesheet
function checkclient(){
	if(!$('#client').val()){
		alert("Please Select Client");
	}
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
			$('#count_prod').show();
		}
		if(types.value == 'Non-Productive'){
			if(dpt == 'DATA'){
        $('#task').attr('readonly', false);
      }
			out_type +='<option value="Non-Productive">Non-Productive</option><option value="Personal">Personal</option>';
			$('#target').val(0);
			$('#task').html(out_type);
			$('#count_prod').hide();

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
		}
		$('#subtask').html(out_subtype);
	}
	// if(subtype.value == 'Voice'){
	// 	out_subtype +='<option value="Call-Hard">Call - Hard</option><option value="Call-Moderate">Call - Moderate</option><option value="Call-Easy">Call - Easy</option>';
	// }
	// if(subtype.value == 'Non-Voice'){
	// 	out_subtype +='<option value="Review">Review</option><option value="Self-Resolved">Self-Resolved</option>';
	// }
	// if(subtype.value == 'Training'){
	// 	out_subtype +='<option value="OJT">OJT</option><option value="Project Specific Training ">Project Specific Training</option>';
	// }
	//
	// if(subtype.value == 'Non-Productive'){
	// 	out_subtype +='<option value="Team Meeting">Team Meeting</option><option value="Client Down Time">Client Down Time</option>';
	// 	out_subtype +='<option value="One To One Meeting">One To One Meeting</option><option value="Training">Training</option>';
	// }
	// if(subtype.value == 'Personal'){
	// 	out_subtype +='<option value="Break" >Break</option><option value="System Down">System Down</option>';
	// 	out_subtype +='<option value="Cab Late">Cab Late</option><option value="Permission">Permission</option>';
	// }

}


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


function timesheetadd(){
	calculatepercentage();
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

function displaytimesheetdata(){
	var out='';
	var productivetimeget=moment.duration ('00:00');
	var nonproductivetimeget=moment.duration ('00:00');
	var getbreaktiming=moment.duration ('00:00');
	if(client.length > 0){
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
			out +='<td>'+timespent[i]+'</td>';
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

		$('#overallpercentage').html(val_overallper+'%');

		if(val_overallper < 90){
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

function pendingtaskupdate(){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url()?>Timesheet/updatelatelogout',
		data   : {id:$('#id').val(),"reason":$('#comments_pending').val()},
		success :function(data){
			if(data =='"Updated Successfully"'){
				$('#reasonfor_leaving').modal('hide');
			}
		}
	})
}
function logooutsubmit(){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url()?>Timesheet/timesheet_submit',
		data   : {
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
				var per_time = $('.permission').val();
				 location.replace('<?php echo base_url();?>Checkin_checkout/CheckOut/'+parseInt(per_time));
			}
			if(data == '"Insert Success"'){
			//	swal("Success", "Time-Sheet Submitted Successfully!!!", "success");
				var per_time = $('.permission').val();
			  location.replace('<?php echo base_url();?>Checkin_checkout/CheckOut/'+parseInt(per_time));
			//	location.reload();

			}
		}
	});
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
					//return;
				}
			}
		});
	}
}

function checktargetsetup(){
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
	}
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
					//	font-size:'10px',
        });

    });

		$(document).ready(function(){
		setInterval(function(){
		  var base_url = "<?php echo base_url(); ?>";
		  $.ajax({
		    url : base_url+"Notification/viewcheckinduriation",
		    method : "POST",
		    success : function(datares){
		      var res=JSON.parse(datares);
		      localStorage.setItem('checkid',res[0]['id']);
		      localStorage.setItem('timing',res[0]['timedifferent']);
		      if(parseInt(res[0]['timedifferent'].split(":")[0]) > 24){}else{
		        $('#timer').html('<b id="timerview"><i class="fa fa-clock" aria-hidden="true"></i><span class="runingtime">'+res[0]['timedifferent']+'</span></b>');
		      }
		    }
		  });
		}, 1000);
		});


//test SP




</script>
</html>
