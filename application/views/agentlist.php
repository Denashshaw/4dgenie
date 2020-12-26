<body>
<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-10 activity">Agent List</div>
            <div style="float: right;">
              <button class="btn btn-primary" onclick="openmodal()" style="float: right;">Add Agent</button>
            </div>
					</div>			
<!-- 
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="search-input" placeholder="Search" id="search" style="width:15% !important;">
          </div> -->

          <?php echo $this->session->flashdata('msg');?>

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
								<tr>
								<?php foreach($agent_data as $agentdata){ ?>
								<th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id;?></span></th>
								<td><?php echo ucfirst($agentdata->name);?></td>
								<td><?php echo ucfirst($agentdata->username);?></span></td>
								<td><?php echo ucfirst($agentdata->role);?></span></td>
								<td><?php echo ucfirst($agentdata->department);?></span></td>
								<td><?php echo ucfirst($agentdata->client);?></span></td>
								<td><span class="emp-break-in"><a href="javaScript:void(0)" class="" data-toggle="modal" data-target="#edit_Modal_<?php echo $agentdata->id;?>">Edit</a></span>
								<span class="emp-break-out"><a href="<?php echo base_url()?>adduser/deleteuser/<?php echo $agentdata->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>	
								</td>
								</tr>

<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="edit_Modal_<?php echo $agentdata->id;?>" role="dialog">
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
           <input class="col-md-12 col-xs-12 form-control" type="hidden" id="userid" name="userid" placeholder="Emp ID" required="" value="<?php echo $agentdata->user_id;?>" readonly>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="emp_id" name="emp_id" placeholder="Emp ID" required="" value="<?php echo $agentdata->emp_id;?>" readonly>
          <p class="">Employee Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="" value="<?php echo $agentdata->name;?>">
          <p class="">User Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="" value="<?php echo $agentdata->username;?>"> 
          <p class="">Role:</p>
          <select class="form-control" name="role" required="">
            <option value="">--Select--</option>
            <option value="agent" <?php if($agentdata->role=="agent") echo 'selected="selected"'; ?>>Agent</option>
            <option value="supervisor" <?php if($agentdata->role=="supervisor") echo 'selected="selected"'; ?>>Supervisor</option>
          </select><br>
          <?php 
            $sql=$this->db->query("SELECT * FROM department");
            $dep=$sql->result();
          ?>

          <p class="">Department:</p>
            <select class="form-control" name="department" id="departmentupdate" required="" onchange="fixtimingupdate(this)">
              <option value="">--Select--</option>
              <?php for($i=0;$i<count($dep);$i++) { ?>
                <option  value="<?php echo $dep[$i]->department;?>" <?php if($dep[$i]->department==$agentdata->department) echo 'selected="selected"'; ?>><?php echo $dep[$i]->department?></option>
              <?php } ?>
            </select><br>
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
          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="client[]" required="">
          
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

								<?php } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

			
</div>
<script>
function doconfirm()
{
  let del=confirm("Are you sure to delete permanently?");
  if(del!=true)
  {
    return false;
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
function openmodal(){
  $('#agentadd').modal('toggle');
}
function fixtimingupdate(data){
  var dpt = data.value;
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
}
</script>
</body>
</html>