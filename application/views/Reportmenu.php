<div class="row" style="font-family: 'Montserrat', sans-serif;font-size:12px;">


  <div class="col-md-12">  <br>
    <div class="card  shadow" style="margin-left:1%;margin-right:1%">
      <div class="card-body">
        <ul class="list-group list-group-flush">

          <li class="list-group-item <?php if($actlinks == "emp_information_report") echo "active";?> dropMenu_rep">
          <a class="<?php  if($actlinks == "emp_information_report") echo "active";?>" href="<?php echo base_url();?>Report/employee_details">Employee Information</a></li>
          <?php if($userdata['department'] == 'ADMIN' || $userdata['department'] == 'MANAGEMENT'){ ?>
          <li class="list-group-item"><a class=" <?php  if($actlinks == "TicketReport") echo "active";?>" href="<?php echo base_url();?>TicketReport"> IT Help Desk</a></li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['role'] == 'supervisor'){ ?>
            <li class="list-group-item <?php if($actlinks == "checkin_report") echo "active";?> dropMenu_rep">
              <a class="<?php  if($actlinks == "checkin_report") echo "active";?>" href="<?php echo base_url();?>checkin_report"> Check In-Out Report</a>
            </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['role'] == 'supervisor'){ ?>
          <li class="list-group-item <?php if($actlinks == "breakin_report") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "breakin_report") echo "active";?>" href="<?php echo base_url();?>breakin_report"> Break In-Out Report</a>
          </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['role'] == 'supervisor'){ ?>
          <li class="list-group-item <?php if($actlinks == "leave_report") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "leave_report") echo "active";?>" href="<?php echo base_url();?>Emp_leave_permission/leavereport">Leave/Permission Report</a>
          </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['department'] == 'MANAGEMENT'){ ?>
          <li class="list-group-item <?php if($actlinks == "Internal_transfer") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "Internal_transfer") echo "active";?>" href="<?php echo base_url();?>empinfoControl/Internal_transfer">Emp Internal Transfer Report</a>
          </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['department'] == 'MANAGEMENT'){ ?>
          <li class="list-group-item <?php if($actlinks == "Separation_report") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "Separation_report") echo "active";?>" href="<?php echo base_url();?>Separation/Separation_report">Emp Separation Report</a>
          </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['role'] == 'supervisor' || $userdata['emp_id'] =='M348'){ ?>
          <li class="list-group-item <?php if($actlinks == "Accessment_report") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "Accessment_report") echo "active";?>" href="<?php echo base_url();?>leaderAssessment/Accessment_report">Assessment Report</a>
          </li>
          <?php } ?>

          <?php if($userdata['department'] == 'ADMIN' || $userdata['role'] == 'supervisor' ){ ?>
          <li class="list-group-item <?php if($actlinks == "TimesheetReport") echo "active";?> dropMenu_rep">
            <a class="<?php  if($actlinks == "TimesheetReport") echo "active";?>" href="<?php echo base_url();?>Timesheet/TimesheetReport">Timesheet Report</a>
          </li>
          <?php } ?>

           <!-- <li class="list-group-item">Attendance Report</li> -->
         </ul>
      </div>
    </div>
  </div>
</div>
