<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
  <div class="row activity-row">
      <div class="col-md-12 activity"><button class="add_button start-break" onclick="emp_transfer_popup()" style="background-color:#007bff;font-size:12px;"> Transfer Employee</button></div>
  </div>
<?php } ?>

    <div class="row emp-table" style="max-width: 1000px;">
      <div class="col-md-12 table-responsive">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col" onclick="sortTable(0)">Employee Id</th>
              <th scope="col" onclick="sortTable(1)">Employee Name</th>
              <th scope="col" onclick="sortTable(2)">Current Process</th>
              <th scope="col" onclick="sortTable(3)">Current Client</th>
              <th scope="col" onclick="sortTable(4)">Transfer to Process</th>
              <th scope="col" onclick="sortTable(5)">Transfer to Client</th>
              <th scope="col" onclick="sortTable(6)">Date of Transfer</th>
              <th scope="col" onclick="sortTable(7)">Reason for Transfer</th>
              <th scope="col" onclick="sortTable(8)">Approved By</th>
              <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <th scope="col">Action</th>
            <?php } ?>
          </thead>
          <tbody id="transfer_table_data">          	
          </tbody>
      </table>
      <!-- <div class="plinks"> <?= $links; ?></div> -->
    </div>
    </div>

    <!-- Modal HTML -->
	<div id="transfer_modal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Internal Employee Transfer</h5>
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	            </div>
	            <form method="POST" id="transfer_emp_form">
	            <div class="modal-body">
	                <div class="form-group col-md-12 mb-3">
	                	<label for="">Employee Name</label>
	                	<select class="col-md-12 col-xs-12 form-control" id="transfer_emp" required onchange="changeTransferData()">
		                  <option style="display: none;" value="" selected>Select Employee Name</option>
		                  <?php foreach ($emp_data as $emp) { ?>
		                      <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->name); ?></option>
		                  <?php } ?>
		                </select>
		                <input type="hidden" id="formType" name="formType" value="">
		                <input type="hidden" id="trans_id" name="trans_id" value="">
	                </div>

	                <div class="form-group col-md-12">
	                	<label>Employee Current Process:</label>
	                	<input name="current_process" id="current_process" class="col-md-12 col-xs-12 form-control" required readonly>
	                </div>

	                <div class="form-group col-md-12">
	                	<label>Employee Current Client:</label>
	                	<input type="text" name="current_client" id="current_client" class="col-md-12 col-xs-12 form-control" required readonly>
	                </div>

					<div class="form-group col-md-12">
	                	<label>Transfer To Process:</label>
	                	<select name="transfer_process" id="transfer_process" class="col-md-12 col-xs-12 form-control">
	                		<option style="display: none;" value="" selected>Select Process</option>
	                	</select>
	                </div><br>

					<div class="form-group col-md-12">
	                	<label>Transfer To Client:</label>
	                	<select name="transfer_client" id="transfer_client" class="col-md-12 col-xs-12 form-control">
	                		<option style="display: none;" value="" selected>Select Client</option>
	                	</select>
	                </div>

					<div class="form-group col-md-12">
	                	<label>Reason For Transfer:</label>
	                	<textarea class="col-md-12 col-xs-12 form-control" name="reason" id="reason"></textarea>
	                	<input type="hidden" id="approved_by" name="approved_by" value="<?php echo $_SESSION['emp_id']; ?>">
	                	<input type="hidden" id="approver_name" name="approver_name" value="<?php echo $_SESSION['name']; ?>">
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary">Transfer</button>
	            </div>
	            </form>	            
	        </div>
	    </div>
	</div>

  <script>
  	var base_url = $('#base_url').val();
  	$('#transfer_modal').on('hidden.bs.modal', function(){
	    $('.modal-backdrop').remove();
	    $('#transfer_emp,#transfer_process,#transfer_client,#current_process,#current_client,#reason').val('');
	  });

  	$('#transfer-tab').click(() => {
  		generate_transfer_table();
  	});

  	const generate_transfer_table = () => {
  		var base_url = $('#base_url').val();
  		$.ajax({
  			url: base_url+'empinfoControl/transfer_emp_list',
			method: 'GET',
			success: function(res1){			
				var data = JSON.parse(res1);
				var output='';
				data.forEach(res => {
				output += `<tr>
							<td>`+res.emp_id+`</td>													
							<td> `+res.emp_name+`</td>
							<td>`+res.current_process+`</td>
							<td>`+res.current_client+`</td>
							<td>`+res.transfer_to_process+`</td>
							<td>`+res.transfer_to_client+`</td>
							<td>`+date_format(res.date_of_transfer)+`</td>
							<td>`+res.reason_for_transfer+`</td>
							<td>`+res.approver_name+`</td>
							 <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
							<td style='display:flex;'><button type='button' onclick='editTransData("`+res.id+`")' class='btn btn-info btn-sm'>Edit</button><button type='button' class='btn btn-danger btn-sm' onclick='delTransData(`+res.id+`)'>Delete</button></td>
						<?php } ?>
						   </tr>`;
				});
				$('#transfer_table_data').html(output);
			}, failed: function(err){
				console.log(err);
			}
  		});
  	}
	
	function date_format(date){
		var d = new Date(date);
		var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
		return months[d.getMonth()]+' '+d.getDate() +', '+ d.getFullYear();

	}  	

  	// open emp transfer popup
  	function emp_transfer_popup(){
		var base_url = $('#base_url').val();
		$.ajax({
			url: base_url+'empinfoControl/get_all_clients',
			method: "GET",
			success: function(res){
				get_all_departs();
				var data = JSON.parse(res);
				var option = '';
				data.forEach(res => {
					option += '<option value="'+res.client+'">'+res.client+'</option>';
				});
				$('#transfer_client').html(option);
				$('#formType').val('add');
			}, failed: function(err){
				console.log(err);
			}
		});
		$('#transfer_modal').modal('show');
	}

  	function editTransData(trans_id){
  		$('#trans_id').val(trans_id);
  		emp_transfer_popup();
		get_all_departs();		
  		var base_url = $('#base_url').val();
  		$('#transfer_modal').modal('show');
  		setTimeout(()=>{
  			$('#formType').val('update');
  		$.ajax({
  			url: base_url+'empinfoControl/get_trans_emp',
  			method: 'POST',
  			data: {
  				trans_id : trans_id
  			}, success: function(res){
  				var data = JSON.parse(res);
  				$('#transfer_emp').val(data.emp_id);
  				$('#current_process').val(data.current_process);
  				$('#current_client').val(data.current_client);
  				$('#transfer_process').val(data.transfer_to_process);
  				$('#transfer_client').val(data.transfer_to_client);
  				$('#reason').val(data.reason_for_transfer);  				
  			}, failed: function(err){
  				console.log(err)
  			}
  		});  			
  		},300);
  	}

  	function delTransData(trans_id){
  		var btn_status = confirm('Are you sure to delete?');
  		if(btn_status){
  			$.ajax({
  			url: base_url+'empinfoControl/del_trans_emp',
  			method: 'POST',
  			data: {
  				trans_id : trans_id
  			}, success: function(res){
  				generate_transfer_table();	
  			}, failed: function(err){
  				console.log(err)
  			}
  		});
  		}	
  	}


	// Popup form submit
	$('#transfer_emp_form').submit((e)=>{
		var base_url = $('#base_url').val();
		var transfer_emp = $('#transfer_emp').val();
		var emp_name = $("#transfer_emp option:selected").text();
		var current_process = $('#current_process').val();
		var current_client = $('#current_client').val();
		var transfer_process = $('#transfer_process').val();
		var transfer_client = $('#transfer_client').val();
		var reason = $('#reason').val();
		var approved_by = $('#approved_by').val();
		var approver_name = $('#approver_name').val();
		var formType = $('#formType').val();
		var trans_id = $('#trans_id').val();
		e.preventDefault();
		
		$.ajax({
			url: base_url+'empinfoControl/add_transfer_data',
			method: 'POST',
			data: {
				transfer_emp : transfer_emp,
				emp_name : emp_name,
				current_process : current_process,
				current_client : current_client,
				transfer_process : transfer_process,
				transfer_client : transfer_client,
				reason : reason,
				approved_by : approved_by,				
				approver_name : approver_name,
				formType : formType,
				trans_id : trans_id
			}, success:function(res){
				if(res){
					generate_transfer_table();
					$('#transfer_modal').modal('hide');
				}
			}, failed: function(err){
				console.log(err);
			}
		});
	});	

	function get_all_departs(){
		var base_url = $('#base_url').val();
		$.ajax({
			url: base_url+'empinfoControl/get_all_departs',
			method: "GET",
			success: function(res){
				var data = JSON.parse(res);
				var option = '';
				data.forEach(res => {
					option += '<option value="'+res.department+'">'+res.department+'</option>';
				});
				$('#transfer_process').html(option);
			}, failed: function(err){
				console.log(err);
			}
		});
	}

	function changeTransferData(){
		var base_url = $('#base_url').val();
		var emp_id = $('#transfer_emp').val();
		$.ajax({
			url: base_url+'empinfoControl/get_emp_department',
			method: 'POST',
			data: {
				emp_id : emp_id
			}, success: function(res){
				var data = JSON.parse(res);				
				$('#current_process').val(data.department);
				$('#current_client').val(data.client);
			}, failed: function(err){
				console.log(err);
			}
		});
	}

  </script>
