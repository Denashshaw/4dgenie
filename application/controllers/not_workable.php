<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
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
.page-active {    
    background: #2a316a;
    padding: 1px 7px 1px 7px;
    border-radius: 4px;
    color: #ffF;
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
</style>

<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>

					<div class="row activity-row">
						<div class="col-md-9 activity">Not Workable Claims : 
							<?php echo ucfirst($_SESSION['loggedin_client']); ?>
						</div>

						<?php if($_SESSION['role'] == 'admin' && $_SESSION['loggedin_client'] != ''){ ?>
			            <div class="col-md-2 activity" style="padding-bottom: 20px;font-family: 'Montserrat', sans-serif;float: right;">
			            <form action="<?php echo base_url('home/changeNotWorkable');?>" method="POST">
			            <select class="form-control"   name="client_name"  id="client_name" onchange="this.form.submit()">
			              <?php foreach ($clientlist as $client) { ?>
			                <option value='<?php echo $client->keyword ?>'  <?php if($_SESSION['loggedin_client'] == $client->client){ ?> selected <?php } ?>><?php echo ucfirst($client->client); ?> </option>
			            <?php } ?>
			            </select>
			            </form>
			            </div>
			            <?php } ?>
					</div>
				
					<?php echo $this->session->flashdata('msg');?>

					<?php if($not_workable!=''){?>

					<div class="row emp-table">
						<div class="col-md-12 table-responsive">              
							<table class="table" id="mytable">
								<thead>
									<tr>
										<!-- <th scope="col">Emp Id</th> -->
										<!-- <th scope="col" class="heading">Action</th> -->
										<th scope="col" class="heading">Emp Id</th>
										<th scope="col" class="heading">Emp Name</th>
										<th scope="col" class="heading">Date Assigned (MM/DD)</th>
										<th scope="col" class="heading">Insurance</th>
										<th scope="col" class="heading">Facility</th>
										<th scope="col" class="heading">Claim Id</th>
										<th scope="col" class="heading">Patient Name</th>
										<th scope="col" class="heading">Status</th>
										<th scope="col" class="heading">Service</th>
										<th scope="col" class="heading">DOS Start</th>
										<th scope="col" class="heading">DOS End</th>
										<th scope="col" class="heading">Charges</th>
										<th scope="col" class="heading">Follow Up</th>
										<th scope="col" class="heading">Last Action Date</th>
										<th scope="col" class="heading">Days Outstanding</th>
										<th scope="col" class="heading">Queue</th>
										<th scope="col" class="heading">Assngned to Client</th>
								</thead>
								<tbody>   
								
							<?php foreach($not_workable as $sj_data){ 
							//$sj_complete=$this->db->query("SELECT * FROM sjhealth_call_entry WHERE unique_id='".$sj_data->unique_id."' ");
							//$sjcom = $sj_complete->result();
							//if(!in_array($sjcom[0]->call_status, array("completed"),true)){?>
							<tr>

								<!-- <th scope="row"><span class="emp-id"><?php echo $sj_data->emp_id;?></span></th> -->
								<!-- <td><span class="emp-break-in"><a href="<?php echo base_url();?>start_call/index/<?php echo $sj_data->unique_id;?>" class="" target="_blank" ><button class="check-in" id="checkin">Start</button></a></span>	
								</td> -->
								<td><?php echo ucfirst($sj_data->emp_id);?></td>
								<td><?php echo ucfirst($sj_data->created_by);?></td>
								<td><?php $assign_date=substr($sj_data->created_date,5);
								echo substr($assign_date,0,-3);?></td>
								<td><?php echo ucfirst($sj_data->insurance);?></td>
								<td><?php echo ucfirst($sj_data->facility);?></td>
								<td><?php echo ucfirst($sj_data->claim_id);?></td>
								<td><?php echo ucfirst($sj_data->patient);?></td>
								<td><?php echo ucfirst($sj_data->status);?></td>
								<td><?php echo ucfirst($sj_data->service);?></td>
								<td><?php $dos_start=substr($sj_data->dos_start,0,-8);
								echo $dos_start;?></td>
								<td><?php $dos_end=substr($sj_data->dos_end,0,-8);
								echo $dos_end;?></td>
								<td><?php echo ucfirst($sj_data->charges);?></td>								
								<td><?php $follow_up=substr($sj_data->follow_up,0,-8);
								echo $follow_up;?></td>
								<td><?php echo ucfirst($sj_data->last_action_date);?></td>
								<td><?php echo ucfirst($sj_data->days_outstanding);?></td>
								<td><?php echo ucfirst($sj_data->queue);?></td>
								<td><?php echo ucfirst($sj_data->assigned_to_client);?></td>

								
								</tr>

						<?php }}//} ?> 
				</tbody>

					</table>
						<div class="plinks"><?php echo $links;?></div>

						</div>
					</div>
				</div>

			</main>
		</div>
	</body>

<script type="text/javascript">
	
</script>
</html>