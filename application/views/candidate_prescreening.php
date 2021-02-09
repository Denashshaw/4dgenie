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
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
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
                <!-- <td>Temp ID</td> -->
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
									$status_view='<p onclick="getdetails(`'.$a->id.'`)">Applied</p>';
								}else if($a->status == 2){
									$status_view='<p>Profile Approved</p>';
								}else if($a->status == 3){
									$status_view='<p>Profile Rejected</p>';
								}else if($a->status == 4){
									$status_view='<p onclick="viewtestdetails(`'.$a->temp_id.'`)">Online Test Completed</p>';
								}else if($a->status == 5){
									$status_view='<p onclick="viewtestdetails(`'.$a->temp_id.'`)">Online Test - Aproved</p>';
								}else if($a->status == 6){
									$status_view='<p onclick="viewtestdetails(`'.$a->temp_id.'`)">Online Test - Rejected</p>';
								}else{
									$status_view='<p>Rejected</p>';
								}
								$id=$id+1;
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td ><?php echo ucfirst($a->name); ?></td>
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
<?php include('sweetalert.php'); ?>

<div class="modal fade bd-example-modal-xl viewemp" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"  style="background:white;min-width:1500px">
    <div class="modal-content">
		<div class="modal-header">
			<h3 class="modal-title"></h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
		</div>
    <div class="modal-body" >
      <div class="row">
				<!-- First -->
				<div class="col-md-3">
				<fieldset class="scheduler-border"  style="float:left">
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
					</div>
			</fieldset>
				</div>
				<!-- Second -->
				<div class="col-md-3">
					<div class="card card-body">
	    			<h4> Work Experience</h4>
						<ul class="list-group list-group-flush" >
							<li class="list-group-item overallexp1" style="background-color:#f5f2f2">
								Overall Experience:
								<span id="overallexp"></span>
							</li>
							<li class="list-group-item currentcompany1"  style="background-color:#f5f2f2">
							Current Company:
								<span id="currentcompany"></span>
							</li>
							<li class="list-group-item currendesign1"  style="background-color:#f5f2f2">
								Current Designation:
								<span id="currendesign"></span>

							<li class="list-group-item currentctc1"  style="background-color:#f5f2f2">
								Current CTC:
								<span id="currentctc"></span>
							</li>
							<li class="list-group-item expctc1"  style="background-color:#f5f2f2">
								Expected CTC:
								<span id="expctc"></span>
							</li>
							<li class="list-group-item noticeperiod1"  style="background-color:#f5f2f2">
								Notice period:
								<span id="noticeperiod"></span>
							</li>
							<li class="list-group-item dtofjoing1"  style="background-color:#f5f2f2">
								Expected Date of Joining:
								<span id="dtofjoing"></span>
							</li>
						</ul>
						<ul class="list-group list-group-flush" >
							<li class="list-group-item" style="background-color:#f5f2f2">
								Position Applied:
								<p id="positionapply"></p>
							</li>
							<li class="list-group-item"  style="background-color:#f5f2f2">
								Have you taken up interview with us in the last 6 months ?
								<p id="previousinter"></p>
							</li>
							<li class="list-group-item"  style="background-color:#f5f2f2">
								How did you hear about this opening?
								<p id="knowopening"></p></li>
						</ul>
					</div>
				</div>
				<!-- third -->
				<div class="col-md-6">
          <div class="card card-body">
	    			<h4 id="exptable_title"> Past Work Experience</h4>
            <table class="table table-bordered exptable" >
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Designation</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Reason For Leaving</th>
                </tr>
              </thead>
              <tbody id="workexp">
              </tbody>
            </table>
            <br>
            <h4> Education Details</h4>
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th>Institute Name</th>
                  <th>Course</th>
                  <th>Passed Out</th>
                  <th>Percentage</th>
                </tr>
              </thead>
              <tbody id="educationview">
              </tbody>
            </table>
          </div>
				</div>
			</div>
    </div>
    <div class="modal-footer">
      <input type="button" id="accepted" onclick="statusupdate(2)" value="Accepted & Move forwared" class="btn  btn-success">
        <input type="button" id="rejected" onclick="statusupdate(3)" value="Rejected" class="btn btn-danger">
		</div>
  </div>
  </div>
</div>



<div class="modal fade bd-example-modal-xl testresult" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"  style="background:white;min-width:1500px">
    <div class="modal-content">
		<div class="modal-header">
			<h3 class="modal-title"></h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
		</div>
    <div class="modal-body" >
      <table class="table">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Question</th>
            <th>Correct Answer</th>
            <th>Candidate Answered</th>
            <th>Mark</th>
          </tr>
        </thead>
        <tbody id="viewtestresult">
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <input type="button" id="accepted" onclick="statusupdatefor_test(5)" value="Accepted & Move forwared" class="btn  btn-success">
        <input type="button" id="rejected" onclick="statusupdatefor_test(6)" value="Rejected" class="btn btn-danger">
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

     if(res[0]['exp_type'] != 'Fresher'){
       $('.viewemp .exptable').show();
       $('.viewemp #exptable_title').show();
       $('.viewemp .overallexp1').show();
       $('.viewemp .currentcompany1').show();
       $('.viewemp .currendesign1').show();
       $('.viewemp .currentctc1').show();
       $('.viewemp .noticeperiod1').show();
       $('.viewemp #overallexp').html(res[0]['overall_exp']);
       $('.viewemp #currentcompany').html(res[0]['current_company']);
       $('.viewemp #currendesign').html(res[0]['current_designation']);
       $('.viewemp #currentctc').html(res[0]['current_ctc']);
       $('.viewemp #noticeperiod').html(res[0]['notice_period']);


     }else{
       $('.viewemp #exptable_title').hide();
       $('.viewemp .exptable').hide();
       $('.viewemp .overallexp1').hide();
       $('.viewemp .currentcompany1').hide();
       $('.viewemp .currendesign1').hide();
       $('.viewemp .currentctc1').hide();
       $('.viewemp .noticeperiod1').hide();

     }
     $('.viewemp #expctc').html(res[0]['expected_ctc']);
     $('.viewemp #dtofjoing').html(res[0]['expected_date_joining']);


     $.ajax({
   		url : "<?php echo base_url(); ?>Candidate_interview/getworkexpeience",
   		method : "GET",
   		data : {"temp_id":res[0]['temp_id']},
   		success : function(datares){
        var res =JSON.parse(datares);
   		//  console.log(res);
      if(res.length > 0){
        out='';
        res.forEach((item,i)=>{
          if(moment(item['can_period_from']).format('LL') =='Invalid date'){
            var fromdt = '';
          }else{
            var fromdt = moment(item['can_period_from']).format('LL');
          }
          if(moment(item['can_period_to']).format('LL') =='Invalid date'){
            var todt = '';
          }else{
            var todt = moment(item['can_period_to']).format('LL');
          }
          out += '<tr>';

          out += '<td style="font-size:11px;">'+item['can_company']+'</td>';
          out += '<td style="font-size:11px;">'+item['can_past_designation']+'</td>';
          out += '<td style="font-size:11px;">'+fromdt+'</td>';
          out += '<td style="font-size:11px;">'+todt+'</td>';
          out += '<td style="font-size:11px;">'+item['can_reason_for_leaving']+'</td>';
          out += '</tr>';
        });
      }else{
        var out ='<tr><td colspan="5">No Data Found</td></tr>';
      }
      $('#workexp').html(out);
     }
   });


   $.ajax({
    url : "<?php echo base_url(); ?>Candidate_interview/geteducation",
    method : "GET",
    data : {"temp_id":res[0]['temp_id']},
    success : function(datares){
      var res =JSON.parse(datares);
    if(res.length > 0){
      out='';
      res.forEach((item,i)=>{
        out += '<tr>';
        out += '<td style="font-size:11px;">'+item['institute_name']+'</td>';
        out += '<td style="font-size:11px;">'+item['course_name']+'</td>';
        out += '<td style="font-size:11px;">'+item['passed_out']+'</td>';
        out += '<td style="font-size:11px;">'+item['percentage']+'</td>';
        out += '</tr>';
      });
    }else{
      var out ='<tr><td colspan="5">No Data Found</td></tr>';
    }
    $('#educationview').html(out);
   }
 });

	}
});

}


function viewtestdetails(id){

  $.ajax({
   url : "<?php echo base_url(); ?>Candidate_interview/gettestview",
   method : "GET",
   data : {"tempid":id},
   success : function(datares){
     var res=JSON.parse(datares);
     console.log(res);
     var out='';
     var countanw=0;
     $('.testresult').modal('show');
     $('.testresult .modal-title').html('Temp ID:'+id);
     for(var i=0;i<res.length;i++){
       if(res[i].correst == 1){
         out +='<tr style="background:#a1e4a1;">';
       }else{
         out +='<tr style="background:#f1a6a6;">';
       }
       countanw = parseInt(res[i].correst)+parseInt(countanw);
       out +='<td>'+(i+1)+'</td>';
       out +='<td>'+res[i].question+'</td>';
       out +='<td>'+res[i].correct_answer+'</td>';
       out +='<td>'+res[i].candidate_answer+'</td>';
       out +='<td>'+res[i].correst+'</td>';
       out +='</tr>';
     }
     out += '<tr><td colspan="4" style="text-align:right;font-weight:bold;">Total Mark:</td><td style="font-weight:bold;">'+countanw+'</td></tr>';
     $('.testresult #viewtestresult').html(out);
   }
 });
}

function statusupdatefor_test(status){
    var tmpid = $('.testresult .modal-title').text();
    statusupdatemainfunction(tmpid,status)
}

function statusupdate(status){
    var tmpid = $('.viewemp .modal-title').text();
    statusupdatemainfunction(tmpid,status)
}
function statusupdatemainfunction(tmpid,status){

    var spt = tmpid.split(":");
    var id =spt[1];
    $('.viewemp').modal('hide');
    $.ajax({
     url : "<?php echo base_url(); ?>Candidate_interview/acceptedorrejected",
     method : "GET",
     data : {"temp_id":id,"status":status},
     success : function(datares){
       //if()
       swal("Success", "Status Updated", "success");
       location.reload();
     }
   });

}
</script>
