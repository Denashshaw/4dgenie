<div class="page-wrapper chiller-theme toggled">
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
				<?php include('page_head.php');?>

					<div class="row activity-row">
						<div class="col-md-9 activity">Onboarding New Employee: </div>						
						<div class="col-md-3 activity pr-5">
							<?php $sql=$this->db->query("SELECT * FROM users where role='agent' ");
								$users=$sql->result(); ?>
							<select class="form-control" id="onboard_emp_id">
								<option value="">Select any Agent</option>
								<?php for($i=0;$i<count($users);$i++){ ?>
								<option value="<?php echo $users[$i]->emp_id;?>"><?php echo $users[$i]->name;?></option>
                  				<?php } ?>
							</select>
							<br>
						</div>
					</div>
					
					<div class="row activity-table table_div">
						<div class="col-md-12 table-responsive">	
							<table class="tg" id="tableDiv">
								<thead>
								  <tr>
								    <th class="tg-7btt">Pre-Boarding</th>
								    <th class="tg-fymr">Day</th>
								    <th class="tg-7btt">Action Required</th>
								    <th class="tg-7btt">Responsible Person</th>
								    <!-- <th class="tg-fymr">Person</th> -->
								    <th class="tg-fymr" style="width: 90px;">Status</th>
								    <th class="tg-fymr">Date Updated</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
								    <td class="tg-9wq8" rowspan="5">Email confirmation - New Employee</td>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Welcome Message</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person1"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){ ?>
								    		<input type="radio" name="welcome_message" value="1;Welcome Message;Email confirmation - New Employee;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="welcome_message" value="0;Welcome Message;Email confirmation - New Employee;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status1"></span> <?php } ?>
								    </td>
								    <td id="date1" class="tg-0pk" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Documents to bring</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person2"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="docs_to_bring" value="1;Documents to bring;Email confirmation - New Employee;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="docs_to_bring" value="0;Documents to bring;Email confirmation - New Employee;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status2"></span> <?php } ?>
								    </td>
								    <td id="date2" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Start date, Shift timings, location and contact person</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person3">HR</span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="start_shift" value="1;Start date, Shift timings, location and contact person;Email confirmation - New Employee;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="start_shift" value="0;Start date, Shift timings, location and contact person;Email confirmation - New Employee;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status3"></span> <?php } ?>
								    </td>
								    <td id="date3" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Inform dress code</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person4"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="inform_dress_code" value="1;Inform dress code;Email confirmation - New Employee;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="inform_dress_code" value="0;Inform dress code;Email confirmation - New Employee;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status4"></span> <?php } ?>
								    </td>
								    <td id="date4" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Attach HR handbook/company profile</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person5"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="hr_handbook" value="1;Attach HR handbook/company profile;Email confirmation - New Employee;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="hr_handbook" value="0;Attach HR handbook/company profile;Email confirmation - New Employee;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status5"></span> <?php } ?>
								    </td>
								    <td id="date5" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="3">Introductory Email - Existing Employees</td>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">New employee's title and team</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person6"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="title_team" value="1;New employee's title and team;Introductory Email - Existing Employees;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="title_team" value="0;New employee's title and team;Introductory Email - Existing Employees;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status6"></span> <?php } ?>
								    </td>
								    <td id="date6" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Announce Start date, shift timings and location</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person7"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="announce_timings" value="1;Announce Start date, shift timings and location;Introductory Email - Existing Employees;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="announce_timings" value="0;Announce Start date, shift timings and location;Introductory Email - Existing Employees;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status7"></span> <?php } ?>
								    </td>
								    <td id="date7" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">New employee's background with photograph (if available)</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person8"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="backgrnd_poto" value="1;New employee's background with photograph (if available);Introductory Email - Existing Employees;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="backgrnd_poto" value="0;New employee's background with photograph (if available);Introductory Email - Existing Employees;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status8"></span> <?php } ?>
								    </td>
								    <td id="date8" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="4">New employees’ HR and IT requirement</td>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Prepare Hardware and Software as required by the process</td>
								    <!-- <td class="tg-c3ow">IT</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">IT<span id="person9"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'IT'){?>
								    		<input type="radio" name="hardware_software" value="1;Prepare Hardware and Software as required by the process;Introductory Email - Existing Employees;IT">
								    		<label for="">Yes</label>
								    		<input type="radio" name="hardware_software" value="0;Prepare Hardware and Software as required by the process;Introductory Email - Existing Employees;IT">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status9"></span> <?php } ?>
								    </td>
								    <td id="date9" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Create New employee's logins (GreytHR/HR-HRMS/Biometric)</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person10"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="emp_logins" value="1;Create New employee's logins (GreytHR/HR-HRMS/Biometric);New employees’ HR and IT requirement;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="emp_logins" value="0;Create New employee's logins (GreytHR/HR-HRMS/Biometric);New employees’ HR and IT requirement;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status10"></span> <?php } ?>
								    </td>
								    <td id="date10" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Create HR documents and forms</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person11"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="create_docs" value="1;Create HR documents and forms;New employees’ HR and IT requirement;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="create_docs" value="0;Create HR documents and forms;New employees’ HR and IT requirement;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status11"></span> <?php } ?>
								    </td>
								    <td id="date11" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Ensure the locker allocation and ID cards printing</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person12"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="ensure_locker" value="1;Ensure the locker allocation and ID cards printing;New employees’ HR and IT requirement;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="ensure_locker" value="0;Ensure the locker allocation and ID cards printing;New employees’ HR and IT requirement;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status12"></span> <?php } ?>
								    </td>
								    <td id="date12" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="5">Welcome and office tour</td>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Meet and greet new employee</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person13"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="meet_greet" value="1;Meet and greet new employee;Welcome and office tour;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="meet_greet" value="0;Meet and greet new employee;Welcome and office tour;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status13"></span> <?php } ?>
								    </td>
								    <td id="date13" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Introduce new employee to existing team</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person14"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="intro_to_team" value="1;Introduce new employee to existing team;Welcome and office tour;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="intro_to_team" value="0;Introduce new employee to existing team;Welcome and office tour;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status14"></span> <?php } ?>
								    </td>
								    <td id="date14" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Introduction to HR policy, code of conduct and company profile</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person15"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="hr_policy" value="1;Introduction to HR policy, code of conduct and company profile;Welcome and office tour;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="hr_policy" value="0;Introduction to HR policy, code of conduct and company profile;Welcome and office tour;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status15"></span> <?php } ?>
								    </td>
								    <td id="date15" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">PC allocation/Headset (Voice Team)/Welcome Kit</td>
								    <!-- <td class="tg-c3ow">IT/HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person16"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'IT'){ ?>
								    		<input type="radio" name="pc_allocation" value="1;PC allocation/Headset (Voice Team)/Welcome Kit;Welcome and office tour;IT">
								    		<label for="">Yes</label>
								    		<input type="radio" name="pc_allocation" value="0;PC allocation/Headset (Voice Team)/Welcome Kit;Welcome and office tour;IT">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status16"></span> <?php } ?>
								    </td>
								    <td id="date16" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Fill all HR documents and forms</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person17"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="fill_docs" value="1;Fill all HR documents and forms;Welcome and office tour;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="fill_docs" value="0;Fill all HR documents and forms;Welcome and office tour;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status17"></span> <?php } ?>
								    </td>
								    <td id="date17" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="6">Meeting with manager - First Day</td>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Introduce new employee to TL</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person18"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="intro_to_tl" value="1;Introduce new employee to TL;Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="intro_to_tl" value="0;Introduce new employee to TL;Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status18"></span> <?php } ?>
								    </td>
								    <td id="date18" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Go Over Employee Job Description</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person19"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="job_description" value="1;Go Over Employee Job Description;Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="job_description" value="0;Go Over Employee Job Description;Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status19"></span> <?php } ?>
								    </td>
								    <td id="date19" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Set employee's goals for first month</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person20"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="first_month_goals" value="1;Set employee's goals for first month;Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="first_month_goals" value="0;Set employee's goals for first month;Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status20"></span> <?php } ?>
								    </td>
								    <td id="date20" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Explain daily and weekly routine activities</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person21"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="routine_activities" value="1;Explain daily and weekly routine activities;Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="routine_activities" value="0;Explain daily and weekly routine activities;Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status21"></span> <?php } ?>
								    </td>
								    <td id="date21" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Ask employee's expectations</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person22"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="emp_expectations" value="1;Ask employee's expectations;Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="emp_expectations" value="0;Ask employee's expectations;Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status22"></span> <?php } ?>
								    </td>
								    <td id="date22" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">1</td>
								    <td class="tg-c3ow">Request New employee's logins (Software/VPN)</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person23"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="new_emp_login" value="1;Request New employee's logins (Software/VPN);Meeting with manager - First Day;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="new_emp_login" value="0;Request New employee's logins (Software/VPN);Meeting with manager - First Day;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status23"></span> <?php } ?>
								    </td>
								    <td id="date23" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="10">First Month</td>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Introduce the employee to the SOP’s, Project protocols and Team Mentor &amp; Structure</td>
								    <!-- <td class="tg-c3ow">TL</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">TL<span id="person24"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['role'] == 'supervisor' && $_SESSION['department'] != 'MANAGEMENT'){?>
								    		<input type="radio" name="intro_sop" value="1;Introduce the employee to the SOP’s, Project protocols and Team Mentor & Structure;First Month;TL">
								    		<label for="">Yes</label>
								    		<input type="radio" name="intro_sop" value="0;Introduce the employee to the SOP’s, Project protocols and Team Mentor & Structure;First Month;TL">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status24"></span> <?php } ?>
								    </td>
								    <td id="date24" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Organize and Schedule Software Training</td>
								    <!-- <td class="tg-c3ow">TL</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">TL<span id="person25"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['role'] == 'supervisor' && $_SESSION['department'] != 'MANAGEMENT'){?>
								    		<input type="radio" name="software_training" value="1;Organize and Schedule Software Training;First Month;TL">
								    		<label for="">Yes</label>
								    		<input type="radio" name="software_training" value="0;Organize and Schedule Software Training;First Month;TL">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status25"></span> <?php } ?>
								    </td>
								    <td id="date25" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">SoP and Software Knowledge Assessment</td>
								    <!-- <td class="tg-c3ow">TL</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">TL<span id="person26"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['role'] == 'supervisor' && $_SESSION['department'] != 'MANAGEMENT'){?>
								    		<input type="radio" name="sop_assessment" value="1;SoP and Software Knowledge Assessment;First Month;TL">
								    		<label for="">Yes</label>
								    		<input type="radio" name="sop_assessment" value="0;SoP and Software Knowledge Assessment;First Month;TL">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status26"></span> <?php } ?>
								    </td>
								    <td id="date26" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Introduce new employee to QA team</td>
								    <!-- <td class="tg-c3ow">TL</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">TL<span id="person27"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['role'] == 'supervisor' && $_SESSION['department'] != 'MANAGEMENT'){?>
								    		<input type="radio" name="intro_qa_team" value="1;Introduce new employee to QA team;First Month;TL">
								    		<label for="">Yes</label>
								    		<input type="radio" name="intro_qa_team" value="0;Introduce new employee to QA team;First Month;TL">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status27"></span> <?php } ?>
								    </td>
								    <td id="date27" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Daily Team Huddle</td>
								    <!-- <td class="tg-c3ow">TL</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">TL<span id="person28"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['role'] == 'supervisor' && $_SESSION['department'] != 'MANAGEMENT'){?>
								    		<input type="radio" name="daily_huddle" value="1;Daily Team Huddle;First Month;TL">
								    		<label for="">Yes</label>
								    		<input type="radio" name="daily_huddle" value="0;Daily Team Huddle;First Month;TL">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status28"></span> <?php } ?>
								    </td>
								    <td id="date28" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Periodic Interaction with New Employee</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person29"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="periodic_interaction" value="1;Periodic Interaction with New Employee;First Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="periodic_interaction" value="0;Periodic Interaction with New Employee;First Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status29"></span> <?php } ?>
								    </td>
								    <td id="date29" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Weekly QA team feedback</td>
								    <!-- <td class="tg-c3ow">QA Team</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">QA Team<span id="person30"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['client'] == 'QA'){?>
								    		<input type="radio" name="weekly_qa_feedback" value="1;Weekly QA team feedback;First Month;QA Team">
								    		<label for="">Yes</label>
								    		<input type="radio" name="weekly_qa_feedback" value="0;Weekly QA team feedback;First Month;QA Team">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status30"></span> <?php } ?>
								    </td>
								    <td id="date30" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">Monthly 1 on 1 review - 30 days review</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person31"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="monthly_30days_review" value="1;Monthly 1 on 1 review - 30 days review;First Month;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="monthly_30days_review" value="0;Monthly 1 on 1 review - 30 days review;First Month;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status31"></span> <?php } ?>
								    </td>
								    <td id="date31" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">First Month review with Manager/TL/New Employee</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person32"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="first_month_review" value="1;First Month review with Manager/TL/New Employee;First Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="first_month_review" value="0;First Month review with Manager/TL/New Employee;First Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status32"></span> <?php } ?>
								    </td>
								    <td id="date32" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">30</td>
								    <td class="tg-c3ow">30 days completion milestone appreciation</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person33"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="completion_milestone" value="1;30 days completion milestone appreciation;First Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="completion_milestone" value="0;30 days completion milestone appreciation;First Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status33"></span> <?php } ?>
								    </td>
								    <td id="date33" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="3">Second Month</td>
								    <td class="tg-0pky">60</td>
								    <td class="tg-c3ow">Monthly QA team feedback</td>
								    <!-- <td class="tg-c3ow">QA Team</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">QA Team<span id="person34"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['client'] == 'QA'){?>
								    		<input type="radio" name="qa_feedback" value="1;Monthly QA team feedback;Second Month;QA Team">
								    		<label for="">Yes</label>
								    		<input type="radio" name="qa_feedback" value="0;Monthly QA team feedback;Second Month;QA Team">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status34"></span> <?php } ?>
								    </td>
								    <td id="date34" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">60</td>
								    <td class="tg-c3ow">Monthly 1 on 1 review - 60 days review</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person35"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="monthly_60days_review" value="1;Monthly 1 on 1 review - 60 days review;Second Month;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="monthly_60days_review" value="0;Monthly 1 on 1 review - 60 days review;Second Month;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status35"></span> <?php } ?>
								    </td>
								    <td id="date35" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">60</td>
								    <td class="tg-c3ow">Second Month review with Manager/TL/New Employee</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person36"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="second_manager_review" value="1;Second Month review with Manager/TL/New Employee;Second Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="second_manager_review" value="0;Second Month review with Manager/TL/New Employee;Second Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status36"></span> <?php } ?>
								    </td>
								    <td id="date36" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="4">Third Month</td>
								    <td class="tg-0pky">90</td>
								    <td class="tg-c3ow">Monthly QA team feedback</td>
								    <!-- <td class="tg-c3ow">QA Team</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">QA Team<span id="person37"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['client'] == 'QA'){?>
								    		<input type="radio" name="monthly_qa_feeback" value="1;Monthly QA team feedback;Third Month;QA Team;">
								    		<label for="">Yes</label>
								    		<input type="radio" name="monthly_qa_feeback" value="0;Monthly QA team feedback;Third Month;QA Team;">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status37"></span> <?php } ?>
								    </td>
								    <td id="date37" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">90</td>
								    <td class="tg-c3ow">Monthly 1 on 1 review - 90 days review</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person38"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="monthly_90days_review" value="1;Monthly 1 on 1 review - 90 days review;Third Month;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="monthly_90days_review" value="0;Monthly 1 on 1 review - 90 days review;Third Month;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status38"></span> <?php } ?>
								    </td>
								    <td id="date38" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">90</td>
								    <td class="tg-c3ow">90 Days Employee Confirmation</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person39"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="90_days_confirmation" value="1;90 Days Employee Confirmation;Third Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="90_days_confirmation" value="0;90 Days Employee Confirmation;Third Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status39"></span> <?php } ?>
								    </td>
								    <td id="date39" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">90</td>
								    <td class="tg-c3ow">90 days completion milestone appreciation</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person40"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="90_completion_milestone" value="1;90 days completion milestone appreciation;Third Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="90_completion_milestone" value="0;90 days completion milestone appreciation;Third Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status40"></span> <?php } ?>
								    </td>
								    <td id="date40" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-9wq8" rowspan="4">Six Month</td>
								    <td class="tg-0pky">180</td>
								    <td class="tg-c3ow">Monthly QA team feedback</td>
								    <!-- <td class="tg-c3ow">QA Team</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">QA Team<span id="person41"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['client'] == 'QA'){?>
								    		<input type="radio" name="6_monthly_qa_feedback" value="1;Monthly QA team feedback;Six Month;QA Team">
								    		<label for="">Yes</label>
								    		<input type="radio" name="6_monthly_qa_feedback" value="0;Monthly QA team feedback;Six Month;QA Team">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status41"></span> <?php } ?>
								    </td>
								    <td id="date41" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">180</td>
								    <td class="tg-c3ow">Monthly 1 on 1 review</td>
								    <!-- <td class="tg-c3ow">Manager</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">Manager<span id="person42"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'MANAGEMENT'){?>
								    		<input type="radio" name="six_monthly_review" value="1;Monthly 1 on 1 review;Six Month;Manager">
								    		<label for="">Yes</label>
								    		<input type="radio" name="six_monthly_review" value="0;Monthly 1 on 1 review;Six Month;Manager">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status42"></span> <?php } ?>
								    </td>
								    <td id="date42" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">180</td>
								    <td class="tg-c3ow">Monthly review with Manager/TL/New Employee</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person43"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="six_month_review_manager" value="1;Monthly review with Manager/TL/New Employee;Six Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="six_month_review_manager" value="0;Monthly review with Manager/TL/New Employee;Six Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status43"></span> <?php } ?>
								    </td>
								    <td id="date43" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								  <tr>
								    <td class="tg-0pky">180</td>
								    <td class="tg-c3ow">Six months completion milestone appreciation</td>
								    <!-- <td class="tg-c3ow">HR</td> -->
								    <td class="tg-0pky" style="min-width: 150px;">HR<span id="person44"></span></td>
								    <td class="tg-0pky" style="text-align: center;">
								    	<?php if($_SESSION['department'] == 'HR'){?>
								    		<input type="radio" name="six_completion_milestone" value="1;Six months completion milestone appreciation;Six Month;HR">
								    		<label for="">Yes</label>
								    		<input type="radio" name="six_completion_milestone" value="0;Six months completion milestone appreciation;Six Month;HR">
								    		<label for="">No</label>
								    	<?php }else{ ?> <span id="status44"></span> <?php } ?>
								    </td>
								    <td id="date44" class="tg-0pky" style="min-width: 85px;"></td>
								  </tr>
								</tbody>
								</table>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>

<script type="text/javascript">
	$(document).ready(()=>{
		$('.table_div').hide();
	});
	
	var base_url = "<?php echo base_url(); ?>";
	$(document).on("change","input[type=radio]",function(e){
		var name = $(this)[0].name;
		var value = $(this)[0].value;

		var onboard_emp_id = $('#onboard_emp_id').val();
		$.ajax({
			url: base_url+'Candidate_interview/add_onboard_data',
			method: 'POST',
			data: {
				"onboard_emp_id": onboard_emp_id,
				"name":name,
				"value":value
			},success: function(res){
				// alert('Success');
				change_function_emp_id();
			},failed: function(err){
				console.log(err);
			}
		});
		// console.log($(this)[0].name,$(this)[0].value);
	});
	
		$('#onboard_emp_id').change((e) => {
			change_function_emp_id();
		});

		function change_function_emp_id(){

			var onboard_emp_id = $('#onboard_emp_id').val();
			$('input[type="radio"]').prop('checked', false);

			if(onboard_emp_id != ''){
			$('.table_div').show();
			$.ajax({
				url: base_url+'Candidate_interview/get_onboard_data',
				method: 'POST',
				data: {
					"onboard_emp_id" : onboard_emp_id		
				},
				success: function(res){
					// $("#tableDiv").load("#tableDiv");					
					var data = JSON.parse(res);
					console.log(data);
					for(var i=0;i<=44;i++){
						$(`#person${i}`).text('');
						$(`#date${i}`).text('');
					}
					if(data){
						data.forEach((res_data) => {
							// For listing the person name who updated the agent res_data
							if(res_data['action_required'] == 'Welcome Message'){
								$("#date1").text(res_data['date_completed']);
								$("#person1").text('- ' + res_data['person']);
								$("#status1").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Documents to bring'){
								$("#date2").text(res_data['date_completed']);
								$("#person2").text('- ' + res_data['person']);
								$("#status2").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Start date, Shift timings, location and contact person'){
								$("#date3").text(res_data['date_completed']);
								$("#person3").text('- ' + res_data['person']);
								$("#status3").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Inform dress code'){
								$("#date4").text(res_data['date_completed']);
								$("#person4").text('- ' + res_data['person']);
								$("#status4").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Attach HR handbook/company profile'){
								$("#date5").text(res_data['date_completed']);
								$("#person5").text('- ' + res_data['person']);
								$("#status5").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "New employee's title and team"){
								$("#date6").text(res_data['date_completed']);
								$("#person6").text('- ' + res_data['person']);
								$("#status6").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Announce Start date, shift timings and location'){
								$("#date7").text(res_data['date_completed']);
								$("#person7").text('- ' + res_data['person']);
								$("#status7").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "New employee's background with photograph (if available)"){
								$("#date8").text(res_data['date_completed']);
								$("#person8").text('- ' + res_data['person']);
								$("#status8").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Prepare Hardware and Software as required by the process'){
								$("#date9").text(res_data['date_completed']);
								$("#person9").text('- ' + res_data['person']);
								$("#status9").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "Create New employee's logins (GreytHR/HR-HRMS/Biometric)"){
								$("#date10").text(res_data['date_completed']);
								$("#person10").text('- ' + res_data['person']);
								$("#status10").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Create HR documents and forms'){
								$("#date11").text(res_data['date_completed']);
								$("#person11").text('- ' + res_data['person']);
								$("#status11").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Ensure the locker allocation and ID cards printing'){
								$("#date12").text(res_data['date_completed']);
								$("#person12").text('- ' + res_data['person']);
								$("#status12").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Meet and greet new employee'){
								$("#date13").text(res_data['date_completed']);
								$("#person13").text('- ' + res_data['person']);
								$("#status13").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Introduce new employee to existing team'){
								$("#date14").text(res_data['date_completed']);
								$("#person14").text('- ' + res_data['person']);
								$("#status14").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Introduction to HR policy, code of conduct and company profile'){
								$("#date15").text(res_data['date_completed']);
								$("#person15").text('- ' + res_data['person']);
								$("#status15").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'PC allocation/Headset (Voice Team)/Welcome Kit'){
								$("#date16").text(res_data['date_completed']);
								$("#person16").text('- ' + res_data['person']);
								$("#status16").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Fill all HR documents and forms'){
								$("#date17").text(res_data['date_completed']);
								$("#person17").text('- ' + res_data['person']);
								$("#status17").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Introduce new employee to TL'){
								$("#date18").text(res_data['date_completed']);
								$("#person18").text('- ' + res_data['person']);
								$("#status18").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Go Over Employee Job Description'){
								$("#date19").text(res_data['date_completed']);
								$("#person19").text('- ' + res_data['person']);
								$("#status19").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "Set employee's goals for first month"){
								$("#date20").text(res_data['date_completed']);
								$("#person20").text('- ' + res_data['person']);
								$("#status20").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Explain daily and weekly routine activities'){
								$("#date21").text(res_data['date_completed']);
								$("#person21").text('- ' + res_data['person']);
								$("#status21").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "Ask employee's expectations"){
								$("#date22").text(res_data['date_completed']);
								$("#person22").text('- ' + res_data['person']);
								$("#status22").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "Request New employee's logins (Software/VPN)"){
								$("#date23").text(res_data['date_completed']);
								$("#person23").text('- ' + res_data['person']);
								$("#status23").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == "Introduce the employee to the SOP’s, Project protocols and Team Mentor & Structure"){
								$("#date24").text(res_data['date_completed']);
								$("#person24").text('- ' + res_data['person']);
								$("#status24").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Organize and Schedule Software Training'){
								$("#date25").text(res_data['date_completed']);
								$("#person25").text('- ' + res_data['person']);
								$("#status25").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'SoP and Software Knowledge Assessment'){
								$("#date26").text(res_data['date_completed']);
								$("#person26").text('- ' + res_data['person']);
								$("#status26").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Introduce new employee to QA team'){
								$("#date27").text(res_data['date_completed']);
								$("#person27").text('- ' + res_data['person']);
								$("#status27").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Daily Team Huddle'){
								$("#date28").text(res_data['date_completed']);
								$("#person28").text('- ' + res_data['person']);
								$("#status28").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Periodic Interaction with New Employee'){
								$("#date29").text(res_data['date_completed']);
								$("#person29").text('- ' + res_data['person']);
								$("#status29").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Weekly QA team feedback'){
								$("#date30").text(res_data['date_completed']);
								$("#person30").text('- ' + res_data['person']);
								$("#status30").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly 1 on 1 review - 30 days review'){
								$("#date31").text(res_data['date_completed']);
								$("#person31").text('- ' + res_data['person']);
								$("#status31").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'First Month review with Manager/TL/New Employee'){
								$("#date32").text(res_data['date_completed']);
								$("#person32").text('- ' + res_data['person']);
								$("#status32").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == '30 days completion milestone appreciation'){
								$("#date33").text(res_data['date_completed']);
								$("#person33").text('- ' + res_data['person']);
								$("#status33").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly QA team feedback'){
								$("#date34").text(res_data['date_completed']);
								$("#person34").text('- ' + res_data['person']);
								$("#status34").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly 1 on 1 review - 60 days review'){
								$("#date35").text(res_data['date_completed']);
								$("#person35").text('- ' + res_data['person']);
								$("#status35").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Second Month review with Manager/TL/New Employee'){
								$("#date36").text(res_data['date_completed']);
								$("#person36").text('- ' + res_data['person']);
								$("#status36").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly QA team feedback'){
								$("#date37").text(res_data['date_completed']);
								$("#person37").text('- ' + res_data['person']);
								$("#status37").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly 1 on 1 review - 90 days review'){
								$("#date38").text(res_data['date_completed']);
								$("#person38").text('- ' + res_data['person']);
								$("#status38").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == '90 Days Employee Confirmation'){
								$("#date39").text(res_data['date_completed']);
								$("#person39").text('- ' + res_data['person']);
								$("#status39").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == '90 days completion milestone appreciation'){
								$("#date40").text(res_data['date_completed']);
								$("#person40").text('- ' + res_data['person']);
								$("#status40").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly QA team feedback'){
								$("#date41").text(res_data['date_completed']);
								$("#person41").text('- ' + res_data['person']);
								$("#status41").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly 1 on 1 review'){
								$("#date42").text(res_data['date_completed']);
								$("#person42").text('- ' + res_data['person']);
								$("#status42").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Monthly review with Manager/TL/New Employee'){
								$("#date43").text(res_data['date_completed']);
								$("#person43").text('- ' + res_data['person']);
								$("#status43").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else if(res_data['action_required'] == 'Six months completion milestone appreciation'){
								$("#date44").text(res_data['date_completed']);
								$("#person44").text('- ' + res_data['person']);
								$("#status44").text(res_data['status'] == '1' ? 'Yes' : 'No');
							}else{

							}
								// for auto select the radio buttons
								if(res_data['status'] == '0'){
									$(`input[name="${res_data['keyword']}"]:last`).prop('checked', true);
								}else{
									$(`input[name="${res_data['keyword']}"]:first`).prop('checked', true);
								}								
						});
					}else{
						$('input[type="radio"]').prop('checked', false);					
					}
				},failed: function(err){
					console.log(err);
				}
			});
		}else{
			$('.table_div').hide();
		}
		
		}
</script>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-7btt{border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
.tg .tg-fymr{border-color:inherit;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
</style>