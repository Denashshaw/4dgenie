<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}
</style>
	<div class="page-wrapper chiller-theme toggled">
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 content">
				<?php include('page_head.php');?>
					<?php echo $this->session->flashdata('msg');?>

					<div class="row activity-row">
						<form action="<?php echo base_url('Candidate_interview/initial_add'); ?>" method="POST" autocomplete="off">
							<div class="row">
								<div class="form-group pl-5">
									<label>Name:</label>
									<input type="text" name="pre_name" id="pre_name" required class="form-control">
								</div>

								<div class="form-group pl-5">
									<label>Phone Number:</label>
									<input type="number" name="pre_mobile" id="pre_mobile" required class="form-control">
								</div>

								<div class="form-group pl-5">
									<label>Email:</label>
									<input type="email" name="pre_email" id="pre_email" required class="form-control">
								</div>
								<div class="form-group pl-5" style="margin-top: 42px;">
									<button class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row emp-table">
				<div class="col-md-12 table-responsive" >

					<table class="dt table table-bordered">
						<thead>
							</tr>
								<td>S.No</td>
								<td>Name</td>
								<td>Phone number</td>
								<td>Email ID</td>
								<td>Status</td>
								<td>Candidate ID</td>
								<!-- <td>Action</td> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($candidate_interviewdata as $a) {
								if($a->status == 0){
									$status_view='<p>Initiated</p>';
								}else if($a->status == 1){
									$status_view='<p>Applied</p>';
								}else if($a->status == 2){
									$status_view='<p>Getting Interivew</p>';
								}else if($a->status == 4){
									$status_view='<p>Selected</p>';
								}else{
									$status_view='<p>Rejected</p>';
								}
								$id=$id+1;
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td onclick="getdetails(<?php echo $a->id; ?>)"><?php echo ucfirst($a->name); ?></td>
									<td><?php echo ucfirst($a->mobile); ?></td>
									<td><?php echo ucfirst($a->email); ?></td>
									<td><?php echo ucfirst(	$status_view); ?></td>
									<td><?php echo ucfirst($a->candid_id?$a->candid_id:''); ?></td>
									<!-- <td><?php echo "Action"; ?></td> -->
								</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
</div>


<div class="modal fade bd-example-modal-xl viewemp" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"  style="background:white;min-width:1500px">
		<div class="modal-header">
			<h3 class="modal-title"></h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
		</div>
    <div class="modal-content" >
      <div class="row">
				<!-- First -->
				<div class="col-md-2">
				<fieldset class="scheduler-border"  style="width:15rem;float:left">
    			<legend class="scheduler-border">  Personal Details</legend>


					<div class="card ">
						<img class="card-img-top" src="..." >
						<ul class="list-group list-group-flush" >
							<li class="list-group-item" style="background-color:#445a6f;color:white"><h3 id="emp"></h3></li>
							<li class="list-group-item"  style="background-color:#dce8df"><p id="dob"></p></li>
							<li class="list-group-item"  style="background-color:#dce8df"><p id="gender_view"></p></li>
							<li class="list-group-item"  style="background-color:#dce8df"><p id="email_view"></p></li>
							<li class="list-group-item"  style="background-color:#dce8df"><p id="mobile_view"></p></li>
							<li class="list-group-item" style="background-color:#dce8df"><p id="highest_qualification"></p></li>
							<li class="list-group-item" style="background-color:#dce8df"><p id="current_address"></p></li>
							<li class="list-group-item" style="background-color:#dce8df"><p id="permanent_address"></p></li>
						</ul>
						<!-- <div class="card-body">
							<a href="#" class="card-link">Card link</a>
							<a href="#" class="card-link">Another link</a>
						</div> -->
					</div>



			</fieldset>
				</div>
				<!-- Second -->
				<div class="col-md-3">
					<fieldset class="scheduler-border">
	    			<legend class="scheduler-border"> WORK EXPERIENCE</legend>
						<ul class="list-group list-group-flush" >
							<li class="list-group-item" style="background-color:#cac8c8">
								Overall Experience:
								<span id="positionapply"></span>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
							Current Company:
								<span id="positionapply"></span>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								Current Designation:
								<span id="positionapply"></span>

							<li class="list-group-item"  style="background-color:#cac8c8">
								Current CTC:
								<span id="positionapply"></span>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								Expected CTC:
								<span id="positionapply"></span>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								Notice period:
								<span id="positionapply"></span>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								Expected Date of Joining:
								<span id="positionapply"></span>
							</li>
						</ul>
						<ul class="list-group list-group-flush" >
							<li class="list-group-item" style="background-color:#cac8c8">
								Position Applied:
								<p id="positionapply"></p>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								Have you taken up interview with us in the last 6 months ?
								<p id="previousinter"></p>
							</li>
							<li class="list-group-item"  style="background-color:#cac8c8">
								How did you hear about this opening?
								<p id="knowopening"></p></li>
						</ul>
					</fieldset>
				</div>
				<!-- third -->
				<div class="col-md-3">
				</div>
			</div>
    </div>
  </div>
</div>


<script>
$('.dt').DataTable({
	dom: 'Bfrtip',
	 buttons: [{
		 extend:'excel',
		 title: 'Candidate Interview Detail',
	 },
	 {
		 extend:'pdf',
		 title: 'Candidate Interview Detail',
	 },
	 {
		 extend:'print',
		 title: 'Candidate Interview Detail',
	 }
	 ],
});
function getdetails(id){

	$.ajax({
		url : "<?php echo base_url(); ?>Candidate_interview/getcandidate",
		method : "GET",
		data : {"indexid":id},
		success : function(datares){
		$('.viewemp').modal('show');
			var res =JSON.parse(datares);
			console.log(res);
			var dt = new Date(res[0]['date_of_birth']);
			$('.viewemp .modal-title').html('Temp ID:'+res[0]['temp_id']);
			$('.viewemp #emp').html(res[0]['name'].toUpperCase());
			$('.viewemp #dob').html(dt.getDate()+'/'+(dt.getMonth()+1)+'/'+dt.getYear());
			$('.viewemp #gender_view').html(res[0]['gender']);
			 $('.viewemp #email_view').html(res[0]['email']);
			 $('.viewemp #mobile_view').html(res[0]['mobile']);
			 $('.viewemp #highest_qualification').html(res[0]['highest_qualification']);
			 if(res[0]['current_address'] != ", , "){
				 			 $('.viewemp #current_address').html(res[0]['current_address']);
				}

			if(res[0]['permanent_address'] != ", , "){
			 $('.viewemp #permanent_address').html(res[0]['permanent_address']);
		 }
		 $('.viewemp #positionapply').html(res[0]['position_applied_for']);
		 $('.viewemp #previousinter').html(res[0]['previous_interview_6']);
		 $('.viewemp #knowopening').html(res[0]['heard_opening_by']);
		}
	});
}
</script>
