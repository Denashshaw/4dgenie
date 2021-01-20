<?php $userdata=$this->session->all_userdata();
error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRMS</title>
  <meta name="theme-color" content="#ffffff">
  <meta name="description" content="HRMS" />
  <meta name="keywords" content="" />
  <meta name="robots" content="index, follow">
  <!--<link rel="canonical" href="#"/>-->
  <meta property="og:title" content="HRMS"/>
  <meta property="og:type" content="website"/>
  <!--<meta property="og:url" content="#" /> -->
  <meta property="og:image" content="og.png"/>
  <!--<link rel="icon" href="img/favicon.ico" type="image/x-icon" />-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url();?>css/theme.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/jquery.datetimepicker.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('css/datepicker.css') ?>" />

  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('js/jquery.datetimepicker.full.js')?>"></script>
  <script src="<?php echo base_url('js/datepicker.js') ?>"></script>
  <!-- <script type="text/javascript" src="<?php echo base_url();?>js/js.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

 -->

  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

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
 <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
  	<!-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.jqueryui.min.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script> -->
<style type="text/css">
p{
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
}

.menu li{
  padding-left: 30px !important;
  line-height: 30px !important;
}

.mons{
  font-family: 'Montserrat', sans-serif;
}

::-webkit-input-placeholder {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

:-ms-input-placeholder {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

input{
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  background: white;
  border: 1px solid #dbdbdb;
  padding: 8px;
  margin: 10px 0px 10px 0px;
}

.apply{
  background: #337ab7;
  color: #fff;
  padding: 10px 22px 10px 22px;
  margin: 0px 0px 0px !important;
  width: 25%;
}

/*.apply:hover,.apply:focus {
  background: #337ab7;
  color:#fff;
  padding:10px 22px 10px 22px;
  margin:0px 0px 0px !important;
  text-decoration:none;
}
*/
/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #fff;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none !important;
  font-size: 12px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
/*.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}*/

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
/*.active {
  background-color: green;
  color: white;
}*/

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container, .dropdown_rep {
  display: none;
  background-color: #f5f3f3;
  padding-left: 30px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-top: 10px;
}

.dropdown-options{
    line-height: 30px;
    font-weight: 700;
    color: #6d6d6d;
    font-family: 'Montserrat', sans-serif;
    font-size: 12px;
    padding-left: 48px;
}
a:hover,.dropdown-options:hover, li.active, a.active {
  color: #0056b3;
  text-decoration: none !important;
}
.img-reponsive{
  width: 100px !important;
}
.profile-pic{
  margin-top: 5px !important;
}
.menu{
  margin-top: 30px !important;
}
.viewhover:hover + .viewmegamenu{
  display: block;
}
</style>
</head>
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>

<!-- nav comes here -->
<div class="sidenav">
  <div class="profile-pic">
    <?php $photoget = $this->db->query("Select emp_photo from emp_personal_details where Emp_id='".$userdata['emp_id']."'");
    $res=$photoget->result();
    if($res){
      ?>
     <img src="<?php echo base_url().'img/emp_images/'.$res[0]->emp_photo;?>" class="img-reponsive" onerror="this.onerror=null;this.src='<?php echo base_url();?>img/profile-pic.jpg'">
   <?php
    }else{ ?>
    <img src="<?php echo base_url();?>img/profile-pic.jpg" class="img-reponsive">
  <?php } ?>
  </div>
  <div class="agent-name">
    <?php echo ucfirst($userdata['name']);?>
  </div>
  <div class="agent-type">
    <?php
    if($userdata['role'] == 'agent' || ($userdata['role']=='supervisor' && $userdata['department'] != 'MANAGEMENT')){
      echo ucfirst($userdata['role']);
    }else{
        echo ucfirst($userdata['department']);
    }?>
  </div>

  <ul class="menu">
      <?php $actlinks=$this->uri->segment(1);?>
      <li class="<?php if($actlinks == "home") echo "active";?>">
        <a class="<?php if($actlinks == "home") echo "active";?>" href="<?php echo base_url();?>home"><i class="fa fa-dashboard  fa-lg" aria-hidden="true"></i> Dashboard</a>
      </li>
        <span class="dropdown-btn dropdown-options">Registration or Setup
          <i class="fa fa-caret-down fa-lg"></i>
        </span>

        <div class="dropdown-container">

          <li class="<?php if($actlinks == "empinfoControl") echo "active";?> dropMenu">
          <a class="<?php  if($actlinks == "empinfoControl") echo "active";?>" href="<?php echo base_url();?>empinfoControl"><i class="fa fa-arrow-right" aria-hidden="true"></i> Employee Information</a></li>

        <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){ ?>

          <li class="<?php if($actlinks == "add_department") echo "active";?> dropMenu">
          <a class="<?php  if($actlinks == "add_department") echo "active";?>" href="<?php echo base_url();?>add_department"><i class="fa fa-arrow-right" aria-hidden="true"></i> Department</a></li>


          <li class="<?php if($actlinks == "add_client") echo "active";?> dropMenu">
          <a class="<?php  if($actlinks == "add_client") echo "active";?>" href="<?php echo base_url();?>add_client"><i class="fa fa-arrow-right" aria-hidden="true"></i> Client</a></li>

          <li class="<?php if($actlinks  == "agentlist") echo "active";?> dropMenu">
            <a class="<?php if($actlinks == "agentlist") echo "active";?>" href="<?php echo base_url();?>agentlist"><i class="fa fa-arrow-right" aria-hidden="true"></i>
            Agent List</a>
          </li>

          <li>
            <a href="#" class="" data-toggle="modal" data-target="#resetPassword"><i class="fa fa-arrow-right" aria-hidden="true"></i>Reset Agent Password</a>
          </li>

        <?php }
        if($userdata['department'] == 'MANAGEMENT' || $userdata['role'] == 'admin'){ ?>
          <li class="<?php if($actlinks  == "reportingPerson") echo "active";?> dropMenu">
            <a class="<?php if($actlinks == "reportingPerson") echo "active";?>" href="<?php echo base_url();?>reportingPerson"><i class="fa fa-arrow-right" aria-hidden="true"></i>
            Team Mapping</a>
          </li>
        <?php } ?>

        <li><a href="#" class="show-modal" data-toggle="modal" data-target="#changePassword" data-backdrop="static"><i class="fa fa-arrow-right" aria-hidden="true"></i> Change Password</a></li>
        </div>

        <li>
        <a  class="<?php  if($actlinks == "attendance") echo "active";?>" href="<?php echo base_url();?>attendance"><i class="fa fa-clock fa-lg" aria-hidden="true"></i> Emp Attendance</a>
      </li>

      <li class="<?php if($actlinks == "Emp_leave_permission") echo "active";?>">
        <a class="<?php  if($actlinks == "Emp_leave_permission") echo "active";?>" href="<?php echo base_url();?>Emp_leave_permission">
          <i class="fa fa-fire fa-lg" aria-hidden="true"></i> Emp Leave/Permission &nbsp; <span class="badge badge-danger permission_badge_count">0</span> </a>
      </li>

      <li class="<?php  if($actlinks == "document") echo "active";?>">
        <a class="<?php  if($actlinks == "document") echo "active";?>" href="<?php echo base_url();?>document" >
        <i class="fa fa-file fa-lg" aria-hidden="true"></i> Documents</a>
      </li>
      <li class="<?php if($actlinks == "HrITpolicy") echo "active";?>">
        <a class="<?php if($actlinks == "HrITpolicy") echo "active";?>" href="<?php echo base_url();?>HrITpolicy"><i class="fa fa-cog fa-lg" aria-hidden="true"></i> 4D HR/IT Policy</a>
      </li>

      <?php if($userdata['role'] != 'agent'){ ?>
        <li class="<?php if($actlinks == "Onboarding_emp_view") echo "active";?>"><a class="<?php if($actlinks == "Onboarding_emp_view") echo "active";?>" href="<?php echo base_url();?>Candidate_interview/Onboarding_emp_view"><i class="fa fa-arrow-circle-right fa-lg" aria-hidden="true"></i> Onboarding New Emp</a></li>

        <li class="<?php if($actlinks == "Candidate_interview") echo "active";?>">
        <a class="<?php if($actlinks == "Candidate_interview") echo "active";?>" href="<?php echo base_url();?>Candidate_interview/index"><i class="fa fa-arrow-circle-right fa-lg" aria-hidden="true"></i> Candidates Interview</a>
      </li>




      <li><a href=""><i class="fa fa-arrow-circle-right fa-lg" aria-hidden="true"></i> Leader Assessment</a></li>


      <li class="<?php if($actlinks == "Notification") echo "active";?>"><a class="<?php if($actlinks == "Notification") echo "active";?>" href="<?php echo base_url();?>Notification"><i class="fa fa-bullhorn fa-lg" aria-hidden="true"></i> Announcement</a></li>

      <?php } ?>

      <li><a class="<?php  if($actlinks == "Separation") echo "active";?>" href="<?php echo base_url();?>Separation"><i class="fa fa-user-times  fa-lg" aria-hidden="true"></i> Employee Separation &nbsp; <span class="badge badge-success separation_count">0</span>
      </a></li>


    <li><a class="<?php  if($actlinks == "Ticket") echo "active";?>" href="<?php echo base_url();?>Ticket"><i class="fa fa-cogs fa-lg" aria-hidden="true"></i> IT Help Desk</a></li>

    <?php
    //if($userdata['role'] != 'agent' && ($userdata['department'] == 'MANAGEMENT' || $userdata['department'] == 'HR' ||  $userdata['role'] == 'admin')){ ?>
        <span class="dropdown-btn dropdown-options">Emp Feedback/Appraisal
          <i class="fa fa-caret-down fa-lg"></i>
        </span>
        <div class="dropdown-container">
          <?php
          if($userdata['department'] == 'HR' || $userdata['department'] == 'MANAGEMENT' || $userdata['role'] == 'admin'){ ?>
            <li class="<?php if($actlinks == "feedbackform") echo "active";?> dropMenu">
            <a class="<?php  if($actlinks == "feedbackform") echo "active";?>" href="<?php echo base_url();?>feedbackform/feedbackhr"><i class="fa fa-arrow-right" aria-hidden="true"></i> HR Feedback </a></li>
            <?php  } ?>
            <li class="<?php if($actlinks == "feedbackform") echo "active";?> dropMenu">
            <a class="<?php  if($actlinks == "feedbackform") echo "active";?>" href="<?php echo base_url();?>feedbackform/feedbackmanager"><i class="fa fa-arrow-right" aria-hidden="true"></i>One on One Feedback</a></li>

        </div>

      <?php //} ?>

    <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <span class="viewhover dropdown-btn dropdown-options" onclick="viewreport()">Reports
        <i class="fa fa-caret-right fa-lg" style="float: right;"></i>
      </span>

      <?php } ?>
    </ul>

</div>
<div class="viewmegamenu" style="min-width: 250px;
    min-height: 550px;
    background: #eceef1;
    position: absolute;
    left: 255px;
    top: 75px;
    box-shadow:5px 5px 17px 0px;
    z-index: 1;display:none;">
  <?php include 'Reportmenu.php'; ?>
</div>
<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="myModal" role="dialog">
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
          <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
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
            <select class="form-control" name="department" required="">
              <option value="">--Select--</option>
              <?php for($i=0;$i<count($dep);$i++){ ?>
                <option value="<?php echo $dep[$i]->department;?>"><?php echo $dep[$i]->department?></option>
              <?php } ?>
            </select>
          <br>
          <?php
            $clisql=$this->db->query("SELECT * FROM client");
            $cli=$clisql->result();
          ?>
          <p class="">Client:</p>
          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="client[]" required="">
            <option value=""></option>
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
<div style="padding-top:1px;" class="modal fade" id="notificationview" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <img src="<?php echo base_url('infor/Slide1.jpg'); ?>" width="500" height="550"/>
    </div>
  </div>
</div>
<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="changePassword" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/chpass">
          <input type="hidden" name="userid" value="<?php echo $userdata['user_id'];?>" id="user_id">
          <p class="">New Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="new_password" name="new_password" placeholder="Password" required="">

          <p class="">Confirm Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Password" required="" onChange="checkPasswordMatch();">

          <p class="divCheckPasswordMatch">.</p>

          <input type="submit" name="password" class="apply formSubmit" value="Submit" id="apply">
          <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>
 <div id='loading' style="width: 100%;height: 100%;position: fixed;z-index: 9999;background: white;display: none;">
    <img src='<?php echo base_url('img/loader.gif'); ?>' width="200" height="200" style="margin-top: 150px;"/>
  </div>

  <div style="padding-top:1px;" class="modal fade" id="resetPassword" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Reset Agent Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>Adduser/reset_password">
          <!-- <input type="hidden" name="userid" value="<?php echo $userdata['user_id'];?>" id="user_id"> -->
          <?php
              $userdata=$this->session->all_userdata();

              $sql=$this->db->query("SELECT * FROM users WHERE role='agent'");
              $usr_data=$sql->result();

          ?>
          <p class="">Select Agent</p>
          <select class="form-control" name="userid" id="" required="">
            <option value="">--Select Agent--</option>
            <?php foreach($usr_data as $usr){ ?>
            <option value="<?php echo $usr->user_id;?>"><?php echo $usr->emp_id.'/'.$usr->name;?></option>
          <?php }?>
          </select><br>
          <p class="">New Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="reset_new_password" name="reset_new_password" placeholder="Password" required="">

          <p class="">Confirm Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="reset_confirm_password" name="reset_confirm_password" placeholder="Password" required="" onkeyup="ResetPasswordMatch();">

        <input type="submit" name="reset_password" class="apply formSubmit" value="Submit" id="reset_apply">
          <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function viewreport(){
  $('.viewmegamenu').toggle();
}
$(document).ready(function() {
    var isshow = localStorage.getItem('isshow');
    if (isshow== null) {

        localStorage.setItem('isshow', 1);

        // Show popup here
        $('#notificationview').modal('show');
    }
});
 // $('#notificationview').modal('show');

  $('.dropdown-options').click(function(){
    $('li a').removeClass('active');
    $('li').removeClass('active');
    $('.dropdown-options:not(li)').removeClass('active');
    $('.dropdown-options:not(li a)').removeClass('active');
  });

  $(".menu li:not(.dropMenu)").click(function(){
      localStorage.setItem('clicked', 'no');
    });
  $(".menu li:not(.dropMenu_rep)").click(function(){
      localStorage.setItem('clicked_report', 'no');
    });

  $('.dropdown-container > .dropMenu').click(function(){
    localStorage.setItem('clicked', 'yes');
  });

  $('.dropdown_rep > .dropMenu_rep').click(function(){
    localStorage.setItem('clicked_report', 'yes');
  });


$(document).ready(function(){
  get_badge_count();
  getseparation_count();
    var clicked = localStorage.getItem('clicked');
    if(clicked == 'yes') {
      $('.dropdown-container').show();
    }else{
      $('.dropdown-container').hide();
    }

    var clicked_rep = localStorage.getItem('clicked_report');
    if(clicked_rep == 'yes') {
      $('.dropdown_rep').show();
    }else{
      $('.dropdown_rep').hide();
    }
  $("#confirm_password").keyup(checkPasswordMatch);
});
function getseparation_count(){
  var base_url = $('#base_url').val();
  var check_logged_role = "<?php echo $_SESSION['department']; ?>";
    $.ajax({
    url : "<?php echo base_url(); ?>Separation/getmanagerdata",
    method : "POST",
    success : function(res){
      var dataset = JSON.parse(res);
      var managercount =0;
      var hrcount =0;
      for(var i=0;i<dataset.length;i++){
        if(dataset[i].Resign_Manager_status == ''){
          managercount++;
        }
        if(dataset[i].Resign_HR_status == ''){
          hrcount++;
        }
      }
      if(check_logged_role == 'MANAGEMENT'){
        $('.separation_count').html(managercount);
      }else if(check_logged_role == 'HR'){
        $('.separation_count').html(hrcount);
      }else{
          $('.separation_count').html(0);
      }

    }
  });
}
function get_badge_count(){
  var base_url = $('#base_url').val();
  var logged_manager_id = "<?php echo $_SESSION['emp_id']; ?>";
  var check_logged_role = "<?php echo $_SESSION['department']; ?>";

  if(check_logged_role == 'MANAGEMENT' || check_logged_role == 'ADMIN'){
    $.ajax({
    url: base_url+'Emp_leave_permission/get_permission_count',
    method: 'POST',
    data: {
      "logged_manager_id" : logged_manager_id
    }, success: function(res){
      $('.permission_badge_count').html(res);
//console.log(res);
    }
  });
  }
}


if($(window).width() <= 767){
  $(".page-wrapper").removeClass("toggled");
}

$('#password').blur(function(){
var pass=$('#password').val();
var pass_len=pass.length;
if(pass_len<6){
  $('#err').text("Enter atleast 6 Characters");
  return false;
}
});


function checkPasswordMatch(){
  var password        = $("#new_password").val();
  var confirmPassword = $("#confirm_password").val();

  if(password != confirmPassword){
    $(".divCheckPasswordMatch").html("Password did't match!");
    $(".divCheckPasswordMatch").css({"color":"red"});
    $('#apply').hide();
  }
  else{
    $(".divCheckPasswordMatch").html("Password Match.");
    $(".divCheckPasswordMatch").css({"color":"green"});
    $('#apply').show();
  }
}


jQuery(function($){
  $(".sidebar-dropdown > a").click(function(){
    $(".sidebar-submenu").slideUp(200);
      if($(this).parent().hasClass("active"))
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      }
      else
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });

  $("#close-sidebar").click(function(){
    $(".page-wrapper").removeClass("toggled");
  });

  $("#show-sidebar").click(function(){
    $(".page-wrapper").addClass("toggled");
  });

});

//notify_break();
var name = '<?php echo $userdata['name'];?>';
function notify_break(){
  if(!window.Notification){
    console.log('Browser does not support notifications.');
  }
  else{
    //check if permission is already granted
    if(Notification.permission === 'granted'){
      //show notification here
      var notify = new Notification('Hi' + " " + name + '...!',{
        body: 'You are assigned for a Break ',
        icon: 'https://www.4dglobalinc.com/wp-content/uploads/2017/09/4D-Global-Logo-01-1-e1507835142952.png',
      });
    }
  }
}

  function check_bk_status(){
    var id = '<?php echo $userdata['user_id']; ?>';
    $.ajax({
      type   : 'ajax',
      method : 'post',
      url    : '<?php echo base_url();?>home/bk_assign_status',
      data   : {id:id},
      dataType: 'json',
      success : function(data){
        if(data!=false){
          if(data.break_request_flag==1){
            notify_break();
            $.ajax({
              type   : 'ajax',
              method : 'post',
              url    : '<?php echo base_url();?>home/bk_modify_status',
              data   : {id:id},
              dataType: 'json',
              success: function(data){
                //$("#emp-table").load(location.href + "#emp-table");
                  setTimeout(function(){
                  location.reload();
                },10000)
              },
              //error: function() { alert("Error..."); }
            });
          }
        }
      },
      error : function(){
        alert('Sorry, Something Went Wrong');
      }
    });
  }


setInterval(function(){
  check_bk_status();
}, 60000);

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

</script>
