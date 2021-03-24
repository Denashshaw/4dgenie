<body>
<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
        <?php include('page_head.php');
				$datateam = getDatacount($agent_data);
				?>

					<div class="row activity-row">
						<div class="col-md-10 activity">Agent List</div>
            <div style="float: right;">
              <button class="btn btn-primary" onclick="openmodal()" style="float: right;">Add Agent</button>
            </div>
					</div>
					<div class="row activity-row">
						<div class="col-md-2 activity">
							<div class="card card-body shadow-lg h-1 bg-white rounded">
								Total Employee
								<h2 style="text-align:center"><?php echo sizeof($agent_data); ?></h2>
							</div>
						</div>
						<div class="col-md-2 activity">
							<div class="card card-body shadow-lg  bg-white rounded">
								Voice Team
								<h2 style="text-align:center"> <?php print_r($datateam['Voiceteamcount']); ?></h2>
							</div>
						</div>
						<div class="col-md-2 activity">
							<div class="card card-body shadow-lg  bg-white rounded">
								Data Team
								<h2 style="text-align:center"> <?php print_r($datateam['Datateamcount']); ?></h2>
							</div>
						</div>

						<div class="col-md-2 activity">
							<div class="card card-body shadow-lg  bg-white rounded">
								Management
								<h2 style="text-align:center"> <?php print_r($datateam['Managementcount']); ?></h2>
							</div>
						</div>
						<div class="col-md-4 activity">
							<table class="table table-bordered shadow-lg  bg-white">
								<tr>
									<td>HR <h4 style="float:right"><?php print_r($datateam['hrcount']); ?></h4></td>
									<td>Business Dev <h4 style="float:right"><?php print_r($datateam['Bsdeveopl']); ?></h4></td>
								</tr>
								<tr>
									<td>Software <h4 style="float:right"><?php print_r($datateam['softwarecount']); ?></h4></td>
									<td>IT  <h4 style="float:right"><?php print_r($datateam['Itcount']); ?></h4></td>
								</tr>
							</table>
						</div>

					</div>
					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
							<table class="table" id="tabledata">
								<thead>
									<tr>
										<th scope="col">Emp ID</th>
										<th scope="col">Name</th>
										<th scope="col">Username</th>
										<th scope="col">Role</th>
										<th scope="col">Dept</th>
										<th scope="col">Client</th>
										<th scope="col">Action</th>
								</thead>
								<tbody>
								<?php if($agent_data!=''){?>

								<?php foreach($agent_data as $agentdata){ ?>
									<tr >
								<th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id;?></span></th>
								<td><?php echo ucfirst($agentdata->name);?></td>
								<td><?php echo ucfirst($agentdata->username);?></span></td>
								<td><?php echo ucfirst($agentdata->role);?></span></td>
								<td><?php echo ucfirst($agentdata->department);?></span></td>
								<td><?php echo ucfirst($agentdata->client);?></span></td>
								<td>
										<?php if($userdata['role'] == 'admin' || ($userdata['role'] == 'supervisor' && $userdata['department'] == 'HR')){ ?>
									<span style="cursor:pointer"><a onclick="Deactivate(`<?php echo $agentdata->emp_id;?>`)">Deactivate</a></span>
								<?php } ?>
									<span class="emp-break-in"><a href="javaScript:void(0)" class=""
										onclick="editagent(`<?php echo $agentdata->user_id; ?>`,`<?php echo $agentdata->emp_id; ?>`,`<?php echo $agentdata->name; ?>`,`<?php echo $agentdata->username; ?>`,`<?php echo $agentdata->role; ?>`,`<?php echo $agentdata->department; ?>`,`<?php echo $agentdata->sub_department; ?>`,`<?php echo $agentdata->checkin; ?>`,`<?php echo $agentdata->checkout; ?>`,`<?php echo $agentdata->client; ?>`,`<?php echo $agentdata->doj; ?>`)">Edit</a></span>
								<!-- <span class="emp-break-out"><a href="<?php echo base_url()?>adduser/deleteuser/<?php echo $agentdata->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>	 -->
								</td>
								</tr>



<!-- Modal -->


								<?php } ?>

									<?php foreach ($agent_data_deactive as $a_deactuv) { ?>
										<tr style="background:#ead5dc">
											<th scope="row"><span class="emp-id"><?php echo $a_deactuv->emp_id;?></span></th>
											<td><?php echo ucfirst($a_deactuv->name);?></td>
											<td><?php echo ucfirst($a_deactuv->username);?></span></td>
											<td><?php echo ucfirst($a_deactuv->role);?></span></td>
											<td><?php echo ucfirst($a_deactuv->department);?></span></td>
											<td><?php echo ucfirst($a_deactuv->client);?></span></td>
											<td>
												<?php if($userdata['role'] == 'admin' || ($userdata['role'] == 'supervisor' && $userdata['department'] == 'HR')){ ?>
												<span style="cursor:pointer"><a  onclick="Activate(`<?php echo $a_deactuv->emp_id;?>`)">Activate</a></span>
											<?php } ?>
												<span class="emp-break-in" ><a href="javaScript:void(0)"  class="" data-toggle="modal" data-target="#edit_Modal_<?php echo $a_deactuv->id;?>">Edit</a></span>
											<!-- <span class="emp-break-out"><a href="<?php echo base_url()?>adduser/deleteuser/<?php echo $a_deactuv->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>	 -->
											</td>

										</tr>
								<?php	} ?>

							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="padding-top:1px;" class="modal fade" id="edit_Modal" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="mons modal-title">Update Agent</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div class="modal-body mons">
	        <form method="post" action="<?php echo base_url();?>adduser/updateuser">
	          <p class="">Employee ID:</p>
	           <input class="col-md-12 col-xs-12 form-control" type="hidden" id="userid" name="userid" placeholder="Emp ID" required=""  readonly>
	          <input class="col-md-12 col-xs-12 form-control" type="text" id="emp_id" name="emp_id" placeholder="Emp ID" required="" value="<?php echo $agentdata->emp_id;?>" readonly>
	          <p class="">Employee Name:</p>
	          <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="" value="<?php echo $agentdata->name;?>">
	          <p class="">User Name:</p>
	          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="" value="<?php echo $agentdata->username;?>">
	          <p class="">Role:</p>
	          <select class="form-control" name="role" id="role" required="">
	            <option value="">--Select--</option>
	            <option value="agent" <?php if($agentdata->role=="agent") echo 'selected="selected"'; ?>>Agent</option>
	            <option value="supervisor" <?php if($agentdata->role=="supervisor") echo 'selected="selected"'; ?>>Supervisor</option>
	          </select><br>
	          <?php
	            $sql=$this->db->query("SELECT * FROM department");
	            $dep=$sql->result();
	          ?>

	          <p class="">Department:</p>
	            <select class="form-control" name="department" id="departmentupdate" required="" onchange="fixtimingupdate(this.value)">
	              <option value="">--Select--</option>
	              <?php for($i=0;$i<count($dep);$i++) { ?>
	                <option  value="<?php echo $dep[$i]->department;?>" <?php if($dep[$i]->department==$agentdata->department) echo 'selected="selected"'; ?>><?php echo $dep[$i]->department?></option>
	              <?php } ?>
	            </select><br>

							<div id="subdt_viewupdate" >
							<p class="">Sub Department:</p>
								<select class="form-control" name="subdepartment" id="subdepartmentupdate" >
									<option value="">--Select--</option>
									<?php for($i=0;$i<count($dep);$i++){
										if($dep[$i]->department !='MANAGEMENT' && $dep[$i]->department != 'ADMIN'){
										?>
										<option value="<?php echo $dep[$i]->department;?>"><?php echo $dep[$i]->department?></option>
									<?php }
								} ?>
								</select>
							</div>

	            <div class="row">
	              <div class="col-md-6">
	              <p>In Time</p>
	                <input type="time" class="form-control" id="checkintimingupdate"  name="checkintimingupdate"  value="<?php echo $agentdata->checkin;?>">
	              </div>
	              <div class="col-md-6">
	              <p>Out Time</p>
	              <input type="time" class="form-control" id="checkouttimingupdate"  name="checkouttimingupdate"  value="<?php echo $agentdata->checkout;?>">
	              </div>
	          </div><br>
	          <?php
	            $client=explode(',',$agentdata->client);
	            $clisql=$this->db->query("SELECT * FROM client");
	            $client_data=$clisql->result();
	          ?>
	          <p class="">Client:</p>
	          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="client[]" id="updatemultclient" required="">

	          <?php foreach($client_data as $cli){ ?>
	            <option value="<?php echo trim($cli->client);?>" <?php if(in_array($cli->client, $client) == 1) echo 'selected="selected"'; ?>><?php echo $cli->client?></option>
	          <?php } ?>
	          </select>
	          <br>
		<p class="">Date of Join:</p>
		<input class="col-md-12 col-xs-12 form-control" type="date" id="doj" name="doj" required="" value="<?php echo $agentdata->doj;?>">
		<br>
	            <input type="submit" name="fupdate" class="apply formSubmit" value="Submit" >
	            <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
	        </form>
	        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
	      </div>
	    </div>
	  </div>
	</div>
</main>

<?php

function getDatacount($obj){
	$datacount=0;
	$voicecount=0;
	$managementcount=0;
	$BScount=0;
	$hrcount=0;
	$softwarecount=0;
	$itcount=0;
	foreach($obj as $a){
			if($a->department == 'DATA'){
				$datacount++;
			}else if($a->department == 'VOICE'){
				$voicecount++;
			}else if($a->department == 'MANAGEMENT'){
				$managementcount++;
			}else if($a->department == 'BUSINESS DEVELOPMENT'){
				$BScount++;
			}else if($a->department == 'HR'){
				$hrcount++;
			}else if($a->department == 'SOFTWARE'){
				$softwarecount++;
			}else if($a->department == 'IT'){
				$itcount++;
			}else{

			}
	}
	return array("Datateamcount"=>$datacount,"Voiceteamcount"=>$voicecount,"Managementcount"=>$managementcount,"Bsdeveopl"=>$BScount,"hrcount"=>$hrcount,"softwarecount"=>$softwarecount,"Itcount"=>$itcount);
}

 ?>

</div>
<script>
function editagent(id,emp_id,name,userid,role,department,subdepartment,intime,outtime,client,doj) {
	$('#edit_Modal').modal('show');
	$('#edit_Modal #userid').val(id);
	$('#edit_Modal #emp_id').val(emp_id);
	$('#edit_Modal #name').val(name);
	$('#edit_Modal #username').val(userid);
	$('#edit_Modal #role').val(role);
	$('#edit_Modal #departmentupdate').val(department);
	if(department =='MANAGEMENT'){
		$('#edit_Modal #subdt_viewupdate').show();
		$('#edit_Modal #subdepartmentupdate').val(subdepartment);
	}else{
		$('#edit_Modal #subdt_viewupdate').hide();

	}
	$('#edit_Modal #checkintimingupdate').val(intime);
	$('#edit_Modal #checkouttimingupdate').val(outtime);

	$.each(client.split(","), function(i,e){
	    $("#edit_Modal #updatemultclient option[value='" + e + "']").prop("selected", true);
	});
	$('#edit_Modal #doj').val(doj);
}
function doconfirm()
{
  let del=confirm("Are you sure to delete permanently?");
  if(del!=true)
  {
    return false;
  }
}

$('#tabledata').DataTable({
	dom: 'Bfrtip',
	lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
	 buttons: [
		'pageLength',
		{
		 extend:'excel',
		 title: 'Agent Report',
	 },
	 {
		 extend:'pdf',
		 title: 'Agent Report',
	 },
	 {
		 extend:'print',
		 title: 'Agent Report',
	 }
	 ],
});

var $rows = $('#tabledata tr');
$('#search').keyup(function(){
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function(){
       var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
       return !~text.indexOf(val);
    }).hide();
});
</script>
<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="agentadd">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Add Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/adduser">
          <p class="">Employee ID:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="userid" name="userid" placeholder="Emp ID" required="">
          <p class="">Employee Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="">
          <p class="">User Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="">
          <p class="">Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="password" name="password" placeholder="Password" required="">
          <p id="err" style="color:red;"></p>
          <p class="">Role:</p>
          <select class="form-control" name="role" required="">
            <option value="">--Select--</option>
            <option value="agent">Agent</option>
            <option value="supervisor">Supervisor</option>
          </select>
          <br>
          <?php
          $sql=$this->db->query("SELECT * FROM department");
          $dep=$sql->result();
          ?>
          <p class="">Department:</p>
            <select class="form-control" name="department" id="department" required="" onchange="fixtiming()">
              <option value="">--Select--</option>
              <?php for($i=0;$i<count($dep);$i++){ ?>
                <option value="<?php echo $dep[$i]->department;?>"><?php echo $dep[$i]->department?></option>
              <?php } ?>
            </select>
          <br>
					<div id="subdt_view">
					<p class="">Sub Department:</p>
						<select class="form-control" name="subdepartment" id="subdepartment" >
							<option value="">--Select--</option>
							<?php for($i=0;$i<count($dep);$i++){
								if($dep[$i]->department !='MANAGEMENT' && $dep[$i]->department != 'ADMIN'){
								?>
								<option value="<?php echo $dep[$i]->department;?>"><?php echo $dep[$i]->department?></option>
							<?php }
						} ?>
						</select>
					</div>
					<br>
          <div class="row">
              <div class="col-md-6">
              <p>In Time</p>
                <input type="time" class="form-control" id="checkintiming"  name="checkintiming">
              </div>
              <div class="col-md-6">
              <p>Out Time</p>
              <input type="time" class="form-control" id="checkouttiming"  name="checkouttiming">
              </div>
          </div><br>
          <?php
            $clisql=$this->db->query("SELECT * FROM client");
            $cli=$clisql->result();
          ?>
          <p class="">Client:</p>
          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="client[]" required="">
             <?php for($i=0;$i<count($cli);$i++){ ?>
                <option value="<?php echo $cli[$i]->client;?>"><?php echo $cli[$i]->client?></option>
              <?php } ?>
            <!-- <option value="RCM">RCM</option> -->
          </select>
          <br>

          <p class="">Date of Join:</p>
          <input class="col-md-12 col-xs-12 form-control" type="date" id="doj" name="doj" required="">
	 <br>
            <input type="submit" name="fadd" class="apply formSubmit" value="Submit" >
            <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>
<script>
$('#subdt_view').hide();
$('#subdt_viewupdate').hide();
function openmodal(){
  $('#agentadd').modal('toggle');
}
function fixtimingupdate(data){
  var dpt = data;
  if(dpt == 'DATA'){
    $('#checkintimingupdate').val('09:00');
    $('#checkouttimingupdate').val('18:00');
  }
  else if(dpt == 'VOICE'){
    $('#checkintimingupdate').val('18:30');
    $('#checkouttimingupdate').val('03:30');
  } else if(dpt == 'SOFTWARE'){
    $('#checkintimingupdate').val('13:00');
    $('#checkouttimingupdate').val('22:00');
  }else{
    $('#checkintimingupdate').val('');
    $('#checkouttimingupdate').val('');
  }
	if(dpt == 'MANAGEMENT'){
		$('#subdt_viewupdate').show();
	}else{
		$('#subdt_viewupdate').hide();
	}
}

function fixtiming(){
  var dpt = $('#department').children("option:selected").val();
  if(dpt == 'DATA'){
    $('#checkintiming').val('09:00');
    $('#checkouttiming').val('18:00');
  }
  else if(dpt == 'VOICE'){
    $('#checkintiming').val('18:30');
    $('#checkouttiming').val('03:30');
  } else if(dpt == 'SOFTWARE'){
    $('#checkintiming').val('13:00');
    $('#checkouttiming').val('22:00');
  }else{
    $('#checkintiming').val('');
    $('#checkouttiming').val('');
  }
	if(dpt == 'MANAGEMENT'){
		$('#subdt_view').show();
	}else{
		$('#subdt_view').hide();
	}
}


function Deactivate(client){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Adduser/Deactivate',
		data   : {emp_id:client},
		dataType: 'json',
		success : function(data){
			console.log(data);
			window.location.reload();
		}
	});
}

function Activate(client){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Adduser/Activate',
		data   : {emp_id:client},
		dataType: 'json',
		success : function(data){
			console.log(data);
		 window.location.reload();
		}
	});
}
</script>
</body>
</html>
