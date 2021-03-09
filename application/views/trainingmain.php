
<body>
<div class="page-wrapper chiller-theme toggled">
<style>
.plinks{
  margin-left:30%;
  font-size: 20px;
  font-family: 'Montserrat', sans-serif !important;
}
.heading{
  color:#2a316a !important;
}
.plinks a {
margin-left: 10px;
font-size: 15px;
font-family: 'Montserrat', sans-serif !important;
text-decoration: none !important;
color: #212529 !important;
}
.plinks strong {
    background: #2a316a;
    padding: 1px 7px 1px 7px;
    border-radius: 4px;
    color: #ffF;
    font-weight:500;
    font-size:15px;
    margin-left:10px;
}
.errspan {
			 float: right;
			 margin-right: 10px;
			 margin-top: -38px;
			 position: relative;
			 z-index: 2;
			 color: black;
	 }
	 #start{
		 color:red;
		 font-size:15px;
	 }
	 p{
		 font-size: 12px;
	 }

	 #addform p{
		font-size:12px;
	}
	.search-input{
		width:50% !important;
	}
	.search-btn{
		margin-top:-11%;
		margin-left:55%;
	}
	.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
    font-size: 15px;
    padding-left: 8px;
    padding-top: 0px;
}
input{
  text-transform:capitalize;
}
input[type="date"]{
  text-transform:uppercase;
}
p{
  font-weight: bold;
}
input::placeholder { /* Chrome/Opera/Safari */
  font-size: 12px;
}
fieldset {
    border: 5px solid green;
}
	 </style>
  <style>
  table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
.initiated {
    background: #007bff;
    padding: 2px 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 11px;
}
.top3{
  background: #3fc98e;
    padding: 2px 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 12px;
}
.bottom3{
  background: #ff5c4b;
    padding: 2px 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 12px;
}

</style>
<?php
$this->load->helper('cookie');
$activetab=get_cookie('tabview');
 include('header.php');
$userdata=$this->session->all_userdata();
 ?>
 <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<script>
    if (!window.moment) { 
        document.write('<script src="assets/plugins/moment/moment.min.js"><\/script>');
    }
</script>
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>  -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row ">
				<div class="col-12 col-md-12 content">
					<div class="row  activity-row">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-12 activity">Training</div>
					</div>
          <div class="emp-table">
          <?php echo $this->session->flashdata('msg');
       
          ?>

         
              <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size:15px;text-decoration:none;">
                <li class="nav-item">
                  <a class="nav-link active tablink"  data-toggle="tab" onclick="openPage('home', this, 'white')" data-tab-index="0" id="defaultOpen">Dashboard</a>
                </li>
                <li class="nav-item">
                          <a class="nav-link tablink" id="profile-tab" data-toggle="tab" data-tab-index="1" onclick="openPage('manual', this, 'white')">Manual</a>
                        </li>
                <li class="nav-item">
                          <a class="nav-link tablink" id="profile-tab" data-toggle="tab" data-tab-index="2" onclick="openPage('education', this, 'white')">General Material</a>
                        </li>
                <li class="nav-item">
                  <a class="nav-link tablink" id="profile-tab" data-toggle="tab" data-tab-index="2" onclick="openPage('family', this, 'white')">Assessment</a>
                </li>
				 
              </ul>
              <div class=" tabcontent"  id="home" style="text-decoration:none;">
                <?php include('training_dashboard.php'); ?>
              </div>
              <div class=" tabcontent"  id="manual" style="text-decoration:none;">
                <?php include('training_manualup.php'); ?>
              </div>
              <div class="tabcontent" id="education" style="display: none;">
                <?php include('training_material.php'); ?>
              </div>
              <div class="tabcontent" id="family" style="display: none;">
                  <?php include('training_assessment.php'); ?>
              </div>
            </div>
          </div>

       
</div>

<script>
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
document.getElementById("defaultOpen").click();




</script>

<script>
function reportpreview(){
  $('.preview').modal('toggle');
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>empinfoControl/exportpreview',
    data   :  $("#empExport").serialize(),
    success : function(data){
      $('#previewlist').html(data);
    }
  });
}

function printpreview(){
  var printContents = document.getElementById('previewlist').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
</body>
</html>
