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
									<td onclick="getdetails(<?php echo $id; ?>)"><?php echo ucfirst($a->name); ?></td>
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
			console.log(datares);
		}
	});
}
</script>
