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
		</div>
	</main>
</div>