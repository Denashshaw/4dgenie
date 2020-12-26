<body>
<?php include('header1.php');?>
<style type="text/css">
.available {
  background: #3fc98e !important;
  /*padding: 7px 30px 10px 20px !important;*/
  border-radius: 10px !important;
  color: #fff !important;
  font-size: 20px !important;
  margin:5px !important;
}
.loggedout{
  background: #ff5c4b !important;
  /*padding: 7px 30px 10px 20px !important;*/
  border-radius: 10px !important;
  color: #fff !important;
  font-size: 20px !important;
  margin:5px !important;
}
.row{
	/*display: block !important;*/
}
body{
	/*overflow-y: hidden;*/
	/*background-color:#f5f3f7;*/
}
.profile-pic{
  margin-left:40% !important;
}

@media only screen and (max-width:425px){
  .profile-pic{
    margin-left: 25% !important;
  }
  .available,.loggedout{
    font-size: 18px !important;
    margin:7px !important;
  }
}

@media only screen and (max-width:320px){
  .profile-pic{
    margin-left: 15% !important;
  }
  .available,.loggedout{
    font-size: 16px !important;
    margin:7px !important;
  }
}
</style>
<!--<div class="page-wrapper chiller-theme toggled">-->
	<!--<main class="page-content">-->
		<!-- <div class="container-fluid p-0"> -->
			<!-- <div class="row"> -->
				<div class="col-12 col-md-12" style="">
          <div class="row emp-table">
            <div class="profile-pic" style="">
    					<img src="<?php echo base_url();?>img/logo.jpg" class="img-reponsive">
  					</div>
                <?php 
                	$login_info=$this->db->query("SELECT * FROM users");
                	$login_res=$login_info->result();?>
                	<div class="row activity-row">
							<!--<div class="col-md-12 activity">Logged-In Agents</div> -->
						</div>

						<div class="row activity-table">
                			<?php foreach($login_res as $res){?>
                			<?php if($res->status=='loggedin'){?>
                			<span class="available"><?php 
                      $loggedin=strtolower($res->name);
                      echo ucfirst($loggedin);?></span>
                			<?php } }?>	
                		</div>
		               			
		               	<div class="row activity-row">
							<div class="col-md-12 activity">Logged-Out Agents</div>
						</div>

						<div class="row activity-table">
                			<?php foreach($login_res as $res){?>
                			<?php if($res->status=='loggedout'){?>
                			<span class="loggedout"><?php 
                      $loggedout=strtolower($res->name);
                      echo ucfirst($loggedout);?></span>
                			<?php } } ?>	
                		</div>		
            		</div>
               	</div>
			<!-- </div> -->
		<!-- </div> -->
	<!-- </main> -->
<!-- </div> -->

</body>

<script type="text/javascript">
	setInterval(function(){
    	window.location.reload();
	}, 60000);	
</script>
