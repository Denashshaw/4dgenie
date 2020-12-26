<div class="page-wrapper chiller-theme toggled">
<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
				<?php include('page_head.php');?>
					<?php echo $this->session->flashdata('msg');?>
					<div class="row emp-table">
						<div class="col-md-12 table-responsive">
						<table id="product-list" class="table table-bordered">
					    <thead>
					      <tr>
					        <th>ID</th>
					        <th>Name</th>					        
					        <th>Current Address 1</th>			        
					        <th>Current Address 2</th>		
					        <th>Current Landmark</th>
							<th>Current City</th>
							<th>Current Pincode</th>
							<th>Permanent Address1</th>
							<th>Permanent Address2</th>
							<th>Permanent Landmark</th>
							<th>Permanent City</th>
							<th>Permanent Pincode</th>
							<th>Contact Phone</th>
							<th>Personal Email</th>
							<th>DOB</th>
							<th>Marital Status</th>
							<th>No of Child</th>
							<th>Anniversary</th>
							<th>Emergency Contact Number</th>
							<th>Blood Group</th>
							<th>Transportation</th>
							<th>Route</th>
							<th>Current Team</th>
							<th>Designation</th>
							<th>Probation Period</th>
							<th>Probation End</th>
							<th>Joining Date</th>
							<th>Term Date</th>
							<th>Resume</th>
							<th>Insurance</th>
							<th>Aadhar</th>
							<th>PAN</th>	        
					      </tr>
					    </thead>
					    <tbody>
					    </tbody>
					  </table>
					  </div>	 
					</div>          			          					
			  </div>
		  </div>
	  </div>
  </main>
</div>

<script>

$(document).ready(function() {
    $('#product-list').DataTable({
    	dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns:':visible'
                },
                orientation : 'landscape',
                pageSize : 'A0',
            },{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                orientation : 'landscape',
                pageSize : 'A0'
            },
            'colvis'
        ],
        "ajax": {
            url : "<?php echo base_url(); ?>Report/get_emp_reports",
            type : 'GET',
        },
    });
});

</script>

<style type="text/css">	
	.dt-button-collection{
		width:auto !important;
	}
</style>