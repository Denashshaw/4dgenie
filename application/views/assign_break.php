<body>
<div class="page-wrapper chiller-theme toggled">
<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
        <?php include('page_head.php');?>
					<div class="row activity-row">
						<div class="col-md-12 activity">Assign Break</div>
					</div>	
          <?php echo $this->session->flashdata('msg');?>
					<div class="row emp-table">
						<div class="col-md-3">
              <form method="post" action="<?php echo base_url();?>assign_break/assign">
                <div class="row">
                  <input type="text" class="form-control" placeholder="From Time" name="start_break" id="start_break" required="" value="<?php echo $_POST['start_break'];?>">
                  <input type="text" class="form-control" placeholder="To Time" name="end_break" id="end_break" required="" value="<?php echo $_POST['end_break'];?>">
                  <?php 
                  $sql=$this->db->query("SELECT * FROM users WHERE role='supervisor' ");
                  $res=$sql->result();
                  ?>
          
                  <select class="form-control" name="department" id="department" onChange="getuser(this.value);">
                    <option value="">--Supervisor--</option>
                    <?php for($i=0;$i<count($res);$i++){ ?>
                    <option value="<?php echo $res[$i]->name;?>"><?php echo $res[$i]->name;?></option>
                    <?php } ?>
                  </select><br><br>
                  
                  <!--<select class="form-control" name="agent" id="agent" required=""> -->
                    <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="user[]" id="agent" required="" style="height:200px;">
                    <option value="">Select Agent</option>
                    </select>
                </div>
                <input type="submit" value="submit" name="submit" class="check-in">
                </div>
              </form>
					  </div>
				  </div>
			  </div>
		</div>
	</div>
</main>
</div>
</body>
<script type="text/javascript">
  $(document).ready(function(){
    $('#start_break').datetimepicker();
    $('#end_break').datetimepicker();
  });

function getuser(val){
  $.ajax({
    type: "POST",
    url: "<?php echo base_url();?>home/get_user",
    data:'department='+val,
    success: function(data){
      $("#agent").html(data);
    }
  });
}
</script>
