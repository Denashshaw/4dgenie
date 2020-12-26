<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
  <div class="row activity-row">
      <div class="col-md-12 activity"><button class="add_button start-break" onclick="add_open_popup()" style="background-color:#007bff;font-size:12px;"> Add Meeting</button></div>
  </div>
<?php } ?>

    <div class="row emp-table" style="max-width: 1000px;">
      <div class="col-md-12 table-responsive">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col" onclick="sortTable(0)">Meeting</th>
              <th scope="col" onclick="sortTable(1)">Meeting Date</th>
              <th scope="col" onclick="sortTable(2)">Meeting With</th>
              <th scope="col" onclick="sortTable(3)">Meeting Type</th>
              <th scope="col" onclick="sortTable(4)">Date</th>
              <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <th scope="col">Action</th>
            <?php } ?>
          </thead>
          <tbody>
          <?php foreach($emp_list as $emp) { ?>
          <tr>
            <td scope="row"><span class="emp-id"><?php echo $emp->Emp_id;?></span></td>
            <td><?php echo ucfirst($emp->Emp_name);?></td>
            <td><?php echo ucfirst($emp->Contact_phone);?></td>
            <td><?php echo ucfirst($emp->Work_email);?></td>
            <td><?php echo ucfirst($emp->DOB);?></td>

            <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
            <td><span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $emp->Emp_id;?>`)">Edit</span>
            <?php } ?> 

            <?php if($userdata['role'] == 'admin'){ ?>
            <span class="emp-break-out" style="color:red;font-size:12px;float:right;cursor: pointer;" onclick="setremoveid(`<?php echo $emp->Emp_id;?>`,`<?php echo $emp->Emp_name;?>`)">Delete</span>
            </td>
            <?php } ?>
          </tr>
        <?php } ?>

        </tbody>
      </table>
      <div class="plinks"> <?= $links; ?></div>
    </div>
    </div>

   <!-- Modal HTML -->
<div id="myallModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you want to save changes to this document before closing?</p>
                <p class="text-secondary"><small>If you don't save, your changes will be lost.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

  <script>
  async function add_open_popup(){
    $.ajax({
      type: 'get',
      url: "<?php echo base_url('Employee_one/index') ?>",
      success: await function(data) {
        console.log(data)
          // $("#myallModal").html(data);
          $("#myallModal").html(data).modal('toggle');
          // $('.modal-backdrop').remove();
      },failed: function(){
        alert()
      }
     });
  }

  function addinterBtn(){
  	var x = document.getElementById("addinterview");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }
  </script>
