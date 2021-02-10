<body>
<div class="page-wrapper chiller-theme toggled">
<?php include('header.php');
  $userdata=$this->session->all_userdata();
	?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>
					<div class="row activity-row">
						<div class="col-md-12 activity">Add Client</div>
					</div>
          <?php echo $this->session->flashdata('msg');?>
					<div class="row emp-table">
	          <form action="<?php echo base_url();?>client/add_client" method="post" enctype="multipart/form-data">
              <div class="field_wrapper">
                <div class="row">
                  <div class="col-md-12">
                    <p class="">Enter Client Name:</p>
                    <input type="text" name="client[]" id="clientval" placeholder="Enter Client" class="col-md-12 col-xs-12 form-control" required=""/>
                  </div>
                </div>
              </div>
              <br><input type="submit" name="csubmit" value="submit" class="check-in">
            </form>
              <div class="col-md-3" style="margin-top:4%;">
                <a href="javascript:void(0);" title="Add field">
                  <button class="add_button start-break">Add</button>
                </a>
              </div>
                  <div class="col-md-12 table-responsive">
                    <table class="table" id="tabledata">
                      <thead>
                        <tr>
                          <th scope="col">Client</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if($client_data!='') { ?>
                        <tr>
                          <?php foreach($client_data as $client){ ?>
                          <td><?php echo ucfirst($client->client);?></td>
                          <td>
														<?php if(strtolower($userdata['role']) == 'admin'){ ?>
															<a onclick="Deactivate(`<?php echo $client->client;?>`,`<?php echo $client->keyword; ?>`)" style="color:green;padding-right:5%">Deactivate</a>
														<?php } ?>
                            <a data-toggle="modal" data-id="<?php echo $client->client;?>" title="Add this item" class="open-AddBookDialog" href="#addBookDialog" style="padding-right:5%">Update</a>
                            <?php if($userdata['role'] == "admin"){ ?>
                            <span class="emp-break-out"><a href="<?php echo base_url()?>client/del_client/<?php echo $client->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>
                            <?php } ?>
                         </td>
                        </tr>
                      <?php } } ?>
											<?php if($unlikeclient_data!='' && strtolower($userdata['role']) == 'admin') { ?>
											<tr>
												<?php foreach($unlikeclient_data as $client){ ?>
												<td><?php echo ucfirst($client->client);?></td>
												<td>
													<a onclick="Activate(`<?php echo $client->client;?>`,`<?php echo $client->keyword; ?>`)" style="color:green;padding-right:5%">Activate</a>
											 </td>
											</tr>
										<?php } } ?>

                      </tbody>
                    </table>
                  </div>
				      </div>
			  </div>
		  </div>
	  </div>
  </main>
</div>
<div style="padding-top:1px;" class="modal fade" role="dialog" id="addBookDialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Update Client</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
				<form action="<?php echo base_url();?>client/update_client" method="post">
        <p>Client:</p>
        <input type="text" name="clientnameold" id="clientnameold" value="" style="display:none"/>
				<input type="text" name="clientnamenew" id="clientnamenew" value="" pattern="[a-zA-Z0-9\s]+"/>
				<br>
				<input type="submit" class="btn btn-success" value="Update">
			</form>

		</div>
		  </div>
			  </div>
</div>
<script>
$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #clientnameold").val( myBookId );
		  $(".modal-body #clientnamenew").val( myBookId );
     // As pointed out in comments,
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
<script>

$(document).ready(function(){
  var maxField  = 100;
  var addButton = $('.add_button');
  var wrapper   = $('.field_wrapper');
  var fieldHTML = '<br><div class="row"><div class="col-md-12"><input type="text" name="client[]" id="clientval" placeholder="Enter Client" class="col-md-12 col-xs-12 form-control" required=""/><a href="javascript:void(0);" class="remove_button"><button class="check-out" style="">Remove</button></a></div></div>'; //New input field html
  var x = 1;

  $(addButton).click(function(){
    if(x < maxField){
      x++;
      $(wrapper).append(fieldHTML);
    }
  });

  $(wrapper).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });

});

function doconfirm()
{
  let del=confirm("Are you sure to delete permanently?");
  if(del!=true){
    return false;
  }
}
</script>
<script>
function Deactivate(client,key){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Client/Deactivate',
		data   : {client:client,key:key},
		dataType: 'json',
		success : function(data){
			console.log(data);
			window.location.reload();
		}
	});
}

function Activate(client,key){
	$.ajax({
		method : 'post',
		url    : '<?php echo base_url();?>Client/Activate',
		data   : {client:client,key:key},
		dataType: 'json',
		success : function(data){
			console.log(data);
		 window.location.reload();
		}
	});
}
</script>
</body>
</html>
