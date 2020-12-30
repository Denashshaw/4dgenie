<body>
<div class="page-wrapper chiller-theme toggled">
<style>
.colhead{
  font-weight:bold;
  min-width:100px;
}
#positionview{
  position: absolute;
  top: 5px;
  right: 5px;
}
#resignation_Reason,#revoke_Reason{
    font-size:18px;
}
.dt-button .buttons-excel .buttons-html5{
  border-radius: 15px;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    border-radius: 15px;
}
</style>


<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php') ?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Employee Separation</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
    <!-- <form id="attendfilter"> -->
    <?php if($userdata['role'] == 'agent' && ($userdata['department'] != 'MANAGEMENT' || ($userdata['department'] != 'HR' && $userdata['role'] != 'supervisor'))){ ?>
    <div class="col-md-12">
      <table>
      <tr><td>
      <p>Employee</p>
      <select class="form-control useridSeparation" id="useridemp" name="useridemp" >
        <?php if($userdata['role'] != 'agent'){ ?>
        <option style="display: none;" value="" selected>Select Employee ID</option>
          <?php foreach ($emp_data as $emp) { ?>
            <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
          <?php } ?>
        <?php }else{ ?>
           <option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option>
        <?php } ?>
      </select>
      </td>
    </tr>
    </table>
    </div>

    <!-- </form> -->
<br><br>
<div class="col-md-12">
  <br>
  <div class="row">
<button  onclick="viewSeparation()" style="margin-left:90%" class="check-out">Add</button>
<div class="modal fade" id="emp_Separtation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Resignation Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(); ?>Separation/separation_ResignUpload" method="POST" >
            <input type="hidden" id="emp_id1" name="emp_id1">
            <p>Reason<span  style="padding-left:60%;"><i class="fa fa-calendar"></i> <?php echo "<span id='dtprint_resig'>".date('d-m-Y')."</span>"; ?></span></p>
            <textarea  class="form-control" id="resignation_Reason" rows="3" name="resignation_Reason" required></textarea>
            <br>
            <input type="submit" id="rework_submit" class="check-in" style="margin-left:40%">
        </form>
      </div>
    </div>
  </div>
</div>
  </div>
  </div>
  <?php } ?>
<div class="col-sm-12"><br>
  <table class="table table-bordered table-responsive tableprint">
    <thead>
      <tr>
        <th>Emp ID/Name</th>
        <th>Resignation date</th>
        <th>Reason</th>
        <th>Manager Status</th>
        <th>Manager Remark</th>
        <th>Last Working Date</th>
        <th>HR Status</th>
        <th>HR Remark</th>
        <th>Revoke</th>
        <!-- <th>Revoke Date</th> -->
        <?php if($userdata['role'] =='supervisor' && ($userdata['department'] =='HR' || $userdata['department'] =='MANAGEMENT')){ ?>
        <th>Action</th>
      <?php } ?>
      </tr>
    </thead>
    <tbody style="background-color:white">
      <?php
      $i=0;
      foreach($getdata as $a){ ?>
      <tr>
        <td><?php echo ucfirst($a->emp_id."/".$a->name);?></td>
        <td><?php echo ucfirst($a->Resignation_date);?></td>
        <td><?php echo ucfirst($a->Resignation_reason);?></td>
        <td><?php echo ucfirst($a->Resign_Manager_status);?></td>
        <td><?php echo ucfirst($a->Resign_Manager_remark);?></td>
        <td><?php if($a->Resign_Lastworkdate != '0000-00-00'){ echo $a->Resign_Lastworkdate; }?></td>
        <td><?php echo ucfirst($a->Resign_HR_status);?></td>
        <td><?php echo ucfirst($a->Resign_HR_remark);?></td>
        <td><?php echo ucfirst($a->Revoke_reason);?></td>
        <!-- <td><?php if($a->Revoke_date != '0000-00-00'){echo $a->Revoke_date; } ?></td> -->
        <?php if($userdata['department'] =='MANAGEMENT'){ ?>
        <td  onclick="viewstatusupdate(`<?php echo $a->emp_id; ?>`,`<?php echo $a->name; ?>`,`<?php echo $a->id; ?>`,`<?php echo $a->Resign_Manager_status; ?>`,`<?php echo $a->Resign_Manager_remark; ?>`,`<?php echo $a->Resign_Lastworkdate; ?>`,`<?php echo $a->Revoke_reason; ?>`)" style="cursor:pointer"><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#a91919"></i></td>
      <?php } ?>
      <?php if($userdata['role'] =='supervisor' && $userdata['department'] =='HR'){ ?>
      <td  onclick="viewstatusupdateHR(`<?php echo $a->emp_id; ?>`,`<?php echo $a->name; ?>`,`<?php echo $a->id; ?>`,`<?php echo $a->Resign_HR_status; ?>`,`<?php echo $a->Resign_HR_remark; ?>`)" style="cursor:pointer"><i class="fa fa-pencil" aria-hidden="true" style="font-size:18px;color:#a91919"></i></td>
    <?php } ?>
      </tr>


      <div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="<?php echo base_url(); ?>Separation/updatestatus" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><?php echo ucfirst(strtolower($userdata['department']).' Status'); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="empid1" id="empid1">
                <input type="hidden" name="name1" id="name1">
                <input type="hidden" name="indexid" id="indexid">
                <p>Status</p>

                <div class="inputGroup">
                  <input id="statusvalue" name="statusvalue" type="radio" value='Accepted' checked/>
                  <label for="statusvalue">Accepted</label>
                </div>
                <div class="inputGroup">
                  <input id="statusvalue" name="statusvalue" value="Rejected" type="radio"/>
                  <label for="statusvalue">Rejected</label>
                </div>
                <p><br>Remark</p>
                <textarea  class="form-control" id="statustext" name="statustext"></textarea>
                
                  <br>
                  <div class="row">
                  <?php if($userdata['role'] =='supervisor' && $userdata['department'] =='HR'){?>
                    <div class="col-md-6">
                      <p>Last Working Date</p>
                      <input type="date" id="lasteworkingdate" name="lasteworkingdate"  >
                    </div>
                  <?php }
                  if($userdata['department'] == 'MANAGEMENT'){ ?>
                    <div class="col-md-6">
                      <p>Revoke</p>
                      <textarea  class="form-control" id="revoke_Reason"  name="revoke_Reason"></textarea>
                    </div>


                <?php
                $i++;
                  }
              ?>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div>











    <?php } ?>
    </tbody>
  </table>
</div>
  </div>
</div>
</div>
</div>
</body>

<script>
function viewstatusupdate(emp_id,name,i,manager_accepReject,manager_remark,lastworkingdate,revoke){
  $('#indexid').val(i);
  $('#empid1').val(emp_id);
  $('#name1').val(name);
  $("#updatestatus").trigger("reset");
  if(manager_accepReject == 'Accepted'){
    $('#updatestatus input:radio[name="statusvalue"]').filter('[value="Accepted"]').attr('checked', true);
  }else{
    $('#updatestatus input:radio[name="statusvalue"]').filter('[value="Rejected"]').attr('checked', true);
  }
  $('#statustext').val(manager_remark);
  $('#updatestatus #lasteworkingdate').val(lastworkingdate);
  if(revoke){
    $('#updatestatus #revoke_Reason').val(revoke);
  }
  var ts='#updatestatus';
  $(ts).modal('toggle');
}
function viewstatusupdateHR(emp_id,name,i,hr_accepReject,hr_remark){
  $('#indexid').val(i);
  $('#empid1').val(emp_id);
  $('#name1').val(name);
  if(hr_accepReject == 'Accepted'){
    $('#updatestatus input:radio[name="statusvalue"]').filter('[value="Accepted"]').attr('checked', true);
  }else{
    $('#updatestatus input:radio[name="statusvalue"]').filter('[value="Rejected"]').attr('checked', true);
  }
  $('#statustext').val(hr_remark);
  var ts='#updatestatus';
  $(ts).modal('toggle');
}
$(document).ready( function () {
  var set_role = "<?php echo $userdata['role'] ?>";
  if(set_role != 'agent')
  {
    $('.tableprint').DataTable({
      dom: 'Bfrtip',
       buttons: [{
         extend:'excel',
         title: 'Employee Separation Report',
       },
       {
         extend:'pdf',
         title: 'Employee Separation Report',
       },
       {
         extend:'print',
         title: 'Employee Separation Report',
       }
       ],
    });
  }else{
    $('.tableprint').DataTabl();
  }
});
$('.useridSeparation').select2();

//viewSeparation();
function viewSeparation(){

  //$('#emp_Separtation').hide();
  var emp_id = $("#useridemp").children("option:selected").val();
  if(emp_id != ''){
    $('#emp_id1').val(emp_id);
    $('#emp_id2').val(emp_id);
    $('#emp_Separtation').modal('toggle');

    $.ajax({
      url : "<?php echo base_url(); ?>Separation/getuserdata",
      method : "POST",
      data : {"userid":emp_id},
      success : function(datares){
        var data = JSON.parse(datares);
        console.log(data);
        if(data.length > 0){
          $('#resignation_Reason').val(data[0].Resignation_reason);
          $('#revoke_Reason').val(data[0].Revoke_reason);
          var user_role = "<?php echo $userdata['role']; ?>";
          if(user_role != 'agent'){
            if(data[0].Resignation_reason != ''){
              $('#resignation_Reason').prop('readonly',true);
              $('#resign_btn').prop('disabled', false);
            }
            if(data[0].Revoke_reason != ''){
              $('#revoke_Reason').prop('readonly',true);
              $('#rework_submit').prop('disabled', false);
            }
          }else{

              $('#resignation_Reason').prop('readonly',false);
              $('#resign_btn').prop('disabled', false);

          }

          if(data[0].Resign_Manager_status !=''){
            $('#managerstatus').html('<h4>'+data[0].Resign_Manager_status+'</h4>');
          }else{
            $('#managerstatus').html('<b>No Status Updated</b>');
          }

          if(data[0].Resign_HR_status !=''){
            $('#hrstatus').html('<h4>'+data[0].Resign_HR_status+'</h4>');
          }else{
            $('#hrstatus').html('<b>No Status Updated</b>');
          }

          $('#dtprint_resig').html(data[0].Resignation_date);
          $('#dtprint_revoke').html(data[0].Revoke_date);
          $('#managerstatustext').val(data[0].Resign_Manager_remark);

          var manager_accepReject = data[0].Resign_Manager_status;
          if(manager_accepReject == 'Accepted'){
           // $('#managerstatusvalue').bootstrapToggle('on');
            //$('#managerstatusvalue input[type=radio]:checked').val('on');
            $('input:radio[name="managerstatusvalue"]').filter('[value="on"]').attr('checked', true);
          }else{
            //$('#managerstatusvalue').bootstrapToggle('off');
            //$('#managerstatusvalue input[type=radio]:checked').val('off');
            $('input:radio[name="managerstatusvalue"]').filter('[value="off"]').attr('checked', true);
          }

          $('#hrstatustext').val(data[0].Resign_HR_remark);
          var hrstatusvalue = data[0].Resign_HR_status;

          if(hrstatusvalue == 'Accepted' || hrstatusvalue == ''){
            //$('#hrstatusvalue').bootstrapToggle('on');
            $('input:radio[name="hrstatusvalue"]').filter('[value="on"]').attr('checked', true);
          }else{
           // $('#hrstatusvalue').bootstrapToggle('off');
            $('input:radio[name="hrstatusvalue"]').filter('[value="off"]').attr('checked', true);
          }

          if(data[0].Resign_Lastworkdate != '0000-00-00'){
            var dt=data[0].Resign_Lastworkdate.split("-");
            //var dtview = dt[0]+'/'+dt[1] + '/' + dt[2];
            var day = ("0" + dt[2]).slice(-2);
            var month = ("0" + (dt[1] + 1)).slice(-2);
            var today = dt[0]+"-"+(month)+"-"+(day) ;
            $("#lasteworkingdate").val(today);
          }

          //Revoke Details

        }else{
          $('#revoke_Reason').val('');
          $('#lasteworkingdate').val('');
          // $('#dtprint_resig').html('');
          $('#hrstatustext').val('');
          $('#managerstatustext').val('');
          $('#hrstatusvalue').bootstrapToggle('on');
          $('#managerstatusvalue').bootstrapToggle('on');
          $('#resignation_Reason').val('');
        }
      }
    });
  }
}
</script>
