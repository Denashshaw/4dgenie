<link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css') ?>" />
<script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
<body>
<div class="page-wrapper chiller-theme toggled">
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">					
				<?php include('page_head.php');?>
					<div class="row mt-5 ml-2">
						<div class="col-md-10 activity">Employee Leave/Permission</div>
					</div>
		          	<?php echo $this->session->flashdata('msg');?>
		          	
		          	<div class="row activity-row">
			          	<div class="col-md-12 activity">			          		
						<ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size:15px;text-decoration:none;">
							<li class="nav-item">
							  <a class="nav-link active tablink" data-toggle="tab" onclick="openPage('leave', this, 'white')" data-tab-index="0" id="defaultOpen">Leave</a>
							</li>
							<li class="nav-item">
							  <a class="nav-link tablink" id="permission-tab" data-toggle="tab" data-tab-index="1" onclick="openPage('permission', this, 'white')">Permission</a>
							</li>				 
						</ul>

							<div class="tabcontent"  id="leave" style="text-decoration:none;">
								<?php// if($_SESSION['role'] == 'agent'){ ?>
								<div class="row activity-row">									
						            <div>
						              <button class="btn btn-primary" data-toggle="modal" data-target="#leaveModal" onclick="get_leave_managers_list()">Request Leave</button>
						            </div>
								</div>
							<?php //} ?>

								<div class="row emp-table">
									<div class="col-md-12 table-responsive">              
										<table class="table" id="tabledata">
											<thead>
											<tr>
												<th scope="col">Emp Name</th>
												<th scope="col">From Date</th>
												<th scope="col">To Date</th>
												<th scope="col">Leave Type</th>
												<th scope="col">Total Days</th>
												<th scope="col">Leave Status</th>
												<th scope="col">Reporting Manager</th>
												<th scope="col">Reason</th>
												<th scope="col">Action</th>
											</tr>
											</thead>
											<tbody id="leave_table"></tbody>
										</table>
									</div>
								</div>
							</div>

						  <div class="tabcontent" id="permission" style="display: none;">

						  	<div class="row activity-row">									
					            <div>
					              <button class="btn btn-primary" data-toggle="modal"  onclick="get_managers_list()">Request Permission</button>
					            </div>
							</div>

						    <div class="row emp-table">
									<div class="col-md-12 table-responsive">              
										<table class="table">
											<thead>
											<tr>
												<th scope="col">Employee Name</th>
												<th scope="col">Permission Hours</th>
												<th scope="col">Reporting Manager</th>
												<th scope="col">Reason</th>
												<th scope="col">Status</th>
												<th scope="col">Permission Taken on:</th>
												<th scope="col">Action</th>
											</tr>
											</thead>
											<tbody id="permission_table"></tbody>
										</table>
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


 <!-- Leave Modal HTML -->
	<div id="leaveModal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Employee Leave Request:</h5>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <form method="POST" id="emp_leave_form" autocomplete="off">
	            <div class="modal-body">
	            	<div class="form-group">
            			<label for="">Employee Name:</label>
            			<!-- <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $_SESSION['emp_id']; ?>">  -->           	
	            		<select name="empLeaveName" id="empLeaveName" class="col-md-12 col-xs-12 form-control" readonly required>
	            			<option value="<?php echo $_SESSION['emp_id']; ?>">
	            				<?php echo $_SESSION['name']; ?>
	            			</option>
	            		</select>
	            	</div>

	            	<div class="form-group"><br>
	            		<label for="">Select Day Type:</label> &nbsp;&nbsp;&nbsp;
	            		<select name="leave_type" id="leave_type" class="col-md-12 col-xs-12 form-control">
	            			<option value="cl">Casual Leave</option>
	            			<option value="pl">Privilege Leave</option>
	            			<option value="lop">Loss Of Pay</option>
	            			<option value="hd">Half Day</option>
	            		</select>
	            	</div><br>

	            	<div class="form-group">
	            		<label for="">Select Start Date:</label>
	            		<input type="text" class="form-control" id="lev_start_date" name="lev_start_date" required>
	            	</div>

	            	<div class="form-group">
	            		<label for="">Select End Date:</label>
	            		<input type="text" class="form-control" id="lev_end_date" name="lev_end_date" required>
	            	</div>

	            	<div class="form-group">
	            		<label for="">Total Count of Days:</label>
	            		<input type="number" id="day_count" name="day_count" readonly="true" class="form-control" value="0">
	            	</div>

	            	<div class="form-group">
	            		<label for="">Leave Reason:</label>
	            		<textarea name="lev_reason" id="lev_reason" class="form-control" required></textarea>
	            	</div><br>

	            	<div class="form-group">
	            		<label for="">Reporting Manager:</label>
	            		<select name="managers_list" id="managers_list" class="form-control" required>
	            		</select>
	            	</div>
		            
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		                <button type="submit" class="btn btn-primary">Submit</button>
		                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
		            </div>
				</div>
	            </form>	            
	        </div>
	    </div>
	</div>


 <!-- Permission Modal HTML -->
	<div id="permissionModal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Employee Permission</h5>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <form method="POST" id="emp_permission_form">
	            <div class="modal-body">
	            	<div class="form-group">
	            		<label for="">Employee Name:</label>
	            		<select name="emp_id" id="emp_id" class="col-md-12 col-xs-12 form-control" required>
	            			<option value="<?php echo $_SESSION['emp_id']; ?>">
	            				<?php echo $_SESSION['name']; ?>
	            			</option>
	            		</select>
	            		<input type="hidden" name="emp_name" id="emp_name" value="<?php echo $_SESSION['name']; ?>">
	            	</div><br>

	            	<div class="form-group">
	            		<label for="">Permission Time:</label>
	            		<select name="permission_time" id="permission_time" class="col-md-12 col-xs-12 form-control" required>
		            		<option value="1">1 Hour</option>
		            		<!-- <option value="2">2 Hours</option> -->
	            		</select><br>
	            	</div>

	            	<div class="form-group">
	            		<label>Reason for Permission:</label>
	            		<textarea name="permission_reason" id="permission_reason" class="form-control" required></textarea>
	            	</div><br>

	            	<div class="form-group">
	            		<label for="">Reporting Manager:</label>
	            		<select name="manager_id" id="manager_id" class="form-control" required>
	            		</select>
	            	</div>
	            	
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary report_btn">Submit</button>
	                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	            </div>
	            </form>	            
	        </div>
	    </div>
	</div>


<script>	
	var base_url='';
	base_url = $('#base_url').val();


	$('#defaultOpen').click(()=> {		
		generate_leave_tbl();
	});

	$('#permission-tab').click(()=> {		
		generate_permission_tbl();
	});

	function generate_permission_tbl(){
		var logged_role = "<?php echo $_SESSION['role']; ?>";
		var logged_emp_id = "<?php echo $_SESSION['emp_id']; ?>";
		$.ajax({
			url: base_url+'Emp_leave_permission/emp_permission_list',
			method: 'GET',
			success: function(res){
				var tbody ='';
				var data = JSON.parse(res);
				data.forEach(res => {
					var badge_class = '';
					var buttons = '';
					if(res.status == 'Pending'){
						badge_class ='warning';
						// if(logged_role == 'admin' || logged_role == 'supervisor'){
						if(logged_emp_id == res.manager_id){
						// if(logged_emp_id == res.emp_id){
						buttons = `<button class='btn btn-sm btn-success' title='Approve' onclick='approve_permission(`+res.id+`,"Approve")'><i class="fa fa-check" aria-hidden="true"></i></button>
								<button class='btn btn-sm btn-danger' title='Reject' onclick='approve_permission(`+res.id+`,"Reject")'><i class="fa fa-times" aria-hidden="true"></i></button>`;
						}else{
							buttons = '-';
						}
					}else if(res.status == 'Approved'){
						badge_class='success';
						buttons = '-';
					}else{
						badge_class='danger';
						buttons = '-';
					}

				tbody += `<tr><td>`+res.emp_name+`</td>
				<td>`+res.permission_hours+` Hour</td>				
				<td>`+res.manager_name+`</td>
				<td>`+res.reason_for_permission+`</td>
				<td><span class="badge badge-`+badge_class+`">`+res.status+`</span></td>
				<td>`+res.permission_date+`</td>
				<td>
					`+buttons+`
				</td></tr>`;
				});		
				$('#permission_table').html(tbody);
			},failed: function(err){
				console.log(err);
			}
		});
	}

	function generate_leave_tbl(){
		var logged_role = "<?php echo $_SESSION['role']; ?>";
		var logged_emp_id = "<?php echo $_SESSION['emp_id']; ?>";
		$.ajax({
			url: base_url+'Emp_leave_permission/emp_leave_list',
			method: 'GET',
			success: function(res){
				var tbody ='';
				var data = JSON.parse(res);				
				console.log(data);
				if(data == ''){
					$('#leave_table').html('<br><p>No Data Found!</p>');
					return false;
				}
				data.forEach(res => {	
					var badge_class = '';
					var buttons = '';
					if(res.leave_status == 'Pending'){
						badge_class ='warning';
						// if(logged_role == 'admin' || logged_role == 'supervisor'){
						if(logged_emp_id == res.manager_id){
						// if(logged_emp_id == res.emp_id){
						buttons = `<button class='btn btn-sm btn-success' title='Approve' onclick='approve_leave(`+res.id+`,"Approve")'><i class="fa fa-check" aria-hidden="true"></i></button> &nbsp;
								<button class='btn btn-sm btn-danger' title='Reject' onclick='approve_leave(`+res.id+`,"Reject")'><i class="fa fa-times" aria-hidden="true"></i></button>`;
						}else{
							buttons = '-';
						}
					}else if(res.leave_status == 'Approved'){
						badge_class='success';
						buttons = '-';
					}else{
						badge_class='danger';
						buttons = '-';
					}

					var l_type='';
					if(res.leave_type == 'cl'){
						l_type = 'Casual Leave';
					}else if(res.leave_type == 'pl'){
						l_type = 'Privilege Leave';
					}else if(res.leave_type == 'lop'){
						l_type = 'Loss Of Pay';
					}else if(res.leave_type == 'hd'){
						l_type = 'Half Day';
					}

				tbody += `<tr><td>`+res.emp_name+`</td>
				<td>`+res.leave_start_date+`</td>				
				<td>`+res.leave_end_date+`</td>
				<td>`+l_type+`</td>
				<td>`+res.total_days+`</td>
				<td><span class="badge badge-`+badge_class+`">`+res.leave_status+`</span></td>
				<td>`+res.manager_name+`</td>
				<td>`+res.leave_reason+`</td>
				<td style="display:flex !important;">
					`+buttons+`
				</td></tr>`;
				});	
				$('#leave_table').html(tbody);
			},failed: function(err){
				console.log(err);
			}
		});
	}

	function approve_leave(leave_id, leave_status){
		if(confirm('Please confirm to approve the agent permission')){
		$.ajax({
			url: base_url+'Emp_leave_permission/validate_approve_leave',
			method: 'POST',
			data: {
				"leave_id" : leave_id,
				"leave_status" : leave_status
			}, success: function(res){				
				get_badge_count();
				generate_leave_tbl();
			}, failed: function(err){
				console.log(err);
			}
		});
		}
	}

	function approve_permission(permission_id, pstatus){
		if(confirm('Please confirm to approve the agent permission')){
		$.ajax({
			url: base_url+'Emp_leave_permission/validate_approve_permission',
			method: 'POST',
			data: {
				"permission_id" : permission_id,
				"pstatus" : pstatus
			}, success: function(res){
				get_badge_count();
				generate_permission_tbl();					
			}, failed: function(err){
				console.log(err);
			}
		});
		}
	}

	$(document).ready(() =>{
		generate_leave_tbl();
		/*$('#leaveModal').on('hidden.bs.modal', function(){
	  		$('.modal-backdrop').remove();
	  	});*/

		$("#lev_start_date").datepicker({
		  altField: "#lev_start_date",
		  altFormat: "M d, yy"
		});

		$("#lev_end_date").datepicker({
		  altField: "#lev_end_date",
		  altFormat: "M d, yy"
		});
	});

	$('#lev_start_date, #lev_end_date').change(()=>{
		var lev_start_date = $('#lev_start_date').val();
		var lev_end_date = $('#lev_end_date').val();

		if(lev_start_date != '' && lev_end_date != ''){
			// alert(lev_start_date + '' +lev_end_date);
			const diffTime = Math.abs(new Date(lev_end_date) - new Date(lev_start_date));
			const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
			$('#day_count').val(diffDays);
		}
	});


	$('#emp_leave_form').submit((e) => {
		e.preventDefault();		
		var leave_type = $('#leave_type').val();
		var day_count = $('#day_count').val();		
		// console.log($("#emp_leave_form").serialize());

		// First ajax call for checking leave validation
		$.ajax({
			url: base_url+'Emp_leave_permission/check_leave_emp',
			method: 'POST',
			data: {
				"leave_type" : leave_type
			},
			success: function(res){
				var data = JSON.parse(res);
				var leave_data = data[leave_type];			
				if(leave_type == 'cl'){
					if(leave_data != '0' || leave_data != ''){
						if(day_count > 1){
							alert('One CL is available per month!');
							return false;
						}
						// alert('success CL');
						submit_leave_form();
					}else{
						alert('Already took leave go fucker');
					}
				}else if(leave_type == 'pl'){
					console.log('leave_data', leave_data, day_count);
					var total_leave_days = parseInt(leave_data) + parseInt(day_count);
					if(total_leave_days > 12 ){
						alert('Your PL exceeds in this year!');
					}else{
						submit_leave_form();
						// alert('Success PL');					
					}
				}else if(leave_type == 'hd'){
					if(day_count > 1){
						alert('Half Day leave is available for one day');
					}else{
						submit_leave_form();
					}
				}else{
					submit_leave_form();
				}
			},failed: function(err){
				console.log(err);
			}
		});	
	});

	function submit_leave_form(){
		var empLeaveName = $('#empLeaveName').text().trim();
		var manager_name = $('#managers_list option:selected').text();
		$.ajax({
			url : base_url+'Emp_leave_permission/emp_leave_add',
			method: 'POST',
			data: $("#emp_leave_form").serialize()+'&emp_name='+ empLeaveName +'&manager_name='+ manager_name,
			success: function(res){
			if(res){
				alert('Leave requested!');
				$('#leaveModal').modal('toggle');
				generate_leave_tbl();
			}
			},failed: function(err){
				console.log(err)
			}
		});	
	}

	function get_leave_managers_list(){
		var options = '';
		$.ajax({
			url: base_url+'Emp_leave_permission/get_managers_list',
			method: 'GET',
			success: function(res){
				var data = JSON.parse(res);
				data.forEach(res => {
					options += '<option value="'+res.emp_id+'">'+res.name+'</option>';
					$('#leaveModal').modal('toggle');
					$('#managers_list').html(options);
				});
			},failed: function(err){
				console.log(err);
			}
		});
	}

	function get_managers_list(){
		$.ajax({
			url: base_url+'Emp_leave_permission/check_permission_exists',
			method: 'GET',
			success: function(res){
				if(res > 0){
					alert('Already permision taken in this month! ');
					$('.report_btn').attr('disabled', true);					
				}else{
					// $('#permissionModal').modal('show');
					var options = '';
					var base_url = $('#base_url').val();
					$.ajax({
						url: base_url+'Emp_leave_permission/get_managers_list',
						method: 'GET',
						success: function(res){
							var data = JSON.parse(res);
							data.forEach(res => {
								options += '<option value="'+res.emp_id+'">'+res.name+'</option>';
									$('#permissionModal').modal('toggle');
									$('#manager_id').html(options);								
							});
						},failed: function(err){
							console.log(err);
						}
					});
				}
			},failed: function(err){
				console.log(err);
			}
		});		
	}

	$('#emp_permission_form').submit((e) => {
		var base_url = $('#base_url').val();
		var manager_name = $('#manager_id option:selected').text();
		e.preventDefault();
		$.ajax({
			url: base_url+'Emp_leave_permission/permission_data_save',
			method: 'POST',
			data: $('#emp_permission_form').serialize()+ '&manager_name='+manager_name,
			success: function(res){
				generate_permission_tbl();
				$('#permissionModal').modal('toggle');
			},failed: function(err){
				console.log(err)
			}
		});
	});

	//Date difference between count between two dates
	/*const date1 = new Date('12/17/2010');
	const date2 = new Date('12/15/2010');
	const diffTime = Math.abs(date1 - date2);
	const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
	console.log(diffDays + " days");
	alert(diffDays + " days");*/





	function openPage(pageName, elmnt, color) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablink");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].style.backgroundColor = "";
	  }
	  document.getElementById(pageName).style.display = "block";

	  elmnt.style.backgroundColor = color;
	}
</script>
</body>
</html>