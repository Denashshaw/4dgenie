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
.dataTables_wrapper .ui-toolbar {
    padding: 8px;
    background: white;
}
.table-bordered {
    border: 1px solid #dee2e6;
    background: whitesmoke;
}

.complete{
    display:none;
}

.more{
    background:lightblue;
    color:navy;
    font-size:13px;
    padding:3px;
    cursor:pointer;
}
#agentview {
    background: #647aca;
    width: 150px;
    height: 40px;
    border-radius: 5%;
    float: left;
    font-size: 12px;
    text-align: center;
    padding: 8;
    color: #f5eeee;
    margin: 1%;
}
</style>


<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"> -->

<main class="page-content">
	<div class="container-fluid p-0">
    <?php include('page_head.php') ?>
        <div class="row activity-row">
    	    <div class="col-md-12 activity">Team Mapping</div>
		</div>
        <div class="row emp-table">
            <div class="col-md-12 table-responsive" >
                <div class="row">
                    <div class="col-md-12">
                    <br>
                    <?php  if($userdata['role'] =='supervisor' || $userdata['role'] =='admin'){ ?>
                        <button  onclick="viewannouncement()" style="margin-left:90%" class="check-out">Add</button>
                    <?php } ?>
                        <div class="card card-body" style="display:none" id="viewannouncement">
                            <form action="<?php echo base_url(); ?>ReportingPerson/addreportingPerson" method="POST">
                                <div  class="row" >
                                    <div class="col-md-4" style="border-right: 2px solid #cec4c4;">
                                      <p>Reporting Head</p>
                                      <select class="form-control useridselectbox1" id="managerSuper" name="managerSuper[]" multiple style="width:300px">
                                        <?php foreach ($managerdata as $a) { ?>
                                          <option value="<?php echo $a->emp_id."/".$a->name; ?>"><?php echo $a->emp_id."/".$a->name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-md-8"  style="border-right: 2px solid #cec4c4;">
                                      <p>Employee Name</p>
                                      <select class="form-control useridselectbox" id="useridselectbox" name="useridselectbox[]" multiple style="width:500px">
                                        <?php foreach ($emp_data as $a) { ?>
                                          <option value="<?php echo $a->emp_id."/".$a->name; ?>"><?php echo $a->emp_id."/".$a->name; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>


                                    <div class="col-md-6"  style="margin-left:45%;padding-top:2%;">
                                        <input type="submit" class="check-in" >
                                    </div>

                                </div>
                            </form>
                        </div>

                <br>
                <table class="table table-bordered tableprint">
                    <thead>
                        <tr>
                            <th>Reporting Head</th>
                            <th>Employee Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportingdetails as $dataset) {
                          if(($userdata['emp_id'] == $dataset->manager_id && $userdata['role'] == 'supervisor') || $userdata['department'] == 'MANAGEMENT' || $userdata['department'] == 'ADMIN'){
                            $agentlist=explode(",",$dataset->agent);
                          ?>
                            <tr>
                                <td><?php echo $dataset->manager_id."/".$dataset->reporting_manager; ?><br><?php if(count($agentlist) > 1){
                                  echo "<b>( ".count($agentlist)." Agents )</b>";
                                }else{
                                  echo "<b>( ".count($agentlist)." Agent )</b>";
                                }
                                  ?></td>
                                <td><?php

                                  foreach ($agentlist as $keyvalue) {
                                  ?><p id="agentview">
                                      <?php echo $keyvalue; ?>
                                  </p><?php
                                  }
                                 ?></td>
                                <td  >
                                  <i style="font-size:20px;color:#228416;cursor:pointer" class="fa fa-pencil" aria-hidden="true" onclick="edituserdetails(`<?php echo $dataset->manager_id; ?>`,`<?php echo $dataset->reporting_manager; ?>`,`<?php echo $dataset->agent?>`);"></i>
                                  <?php if($userdata['department'] == 'MANAGEMENT' || $userdata['department'] == 'ADMIN'){ ?>
                                    <i style="font-size:20px;color:#ff5c4b;cursor:pointer" class="fa fa-trash" aria-hidden="true" onclick="deleteuserdetails(`<?php echo $dataset->manager_id; ?>`,`<?php echo $dataset->reporting_manager; ?>`);"></i>
                                  <?php } ?>
                                </td>

                            </tr>
                        <?php
                          }
                        } ?>

                    </tbody>
                </table>

            </div>
        </div>
        <br>
    </div>
</main>
<div class="modal fade bd-example-modal-lg updatereport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">


    <div class="modal-content">
      <form action="<?php echo base_url(); ?>ReportingPerson/updatereportingPerson" method="POST">
      <div class="modal-header">
        <h3>Update Reporting Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
      </div>
       <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <p>Reporting Person</p>
         <input class="form-control useridselectboxupdate" id="updatemanagerSuper" name="updatemanagerSuper" style="width:300px" readonly>

        </div>
        <div class="col-md-6">
          <p>Employee</p>
          <select class="form-control agentselectbox1" id="updateuseridselectbox" name="updateuseridselectbox[]" multiple style="width:500px">
          </select>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="check-in" >
      </div>
    </form>
    </div>
  </div>
</div>
<?php include('sweetalert.php'); ?>
<?php if($userdata['department'] != 'MANAGEMENT'){ ?>
  <script>
    $('.menu1 input').prop("readonly", true);
    $('#monthdatepicker').attr('disabled', true);
    $('.menu2 input').prop("readonly", true);
    //$('#monthdatepicker').attr('disabled', true);
  </script>
<?php } ?>


<script>

function edituserdetails(manager_id,manager_name,agentdetails){

  $('.updatereport').modal('show');
  //$('.useridselectboxupdate').select2();
  $('.agentselectbox1').select2();
  var manager = manager_id+'/'+manager_name;
  //manager
  var out_manager = '';
  out_manager +='<option value="'+manager+'" selected>';
  out_manager +=manager+'</option>';
  $('.useridselectboxupdate').val(manager);
//agent
  var out_agent = '';
  var splitagent=agentdetails.split(",");
  out_agent +='<?php foreach ($emp_data as $a) { ?>';
    out_agent +='<option value="<?php echo $a->emp_id."/".$a->name; ?>"';
    for(var i=0;i<splitagent.length;i++){
      vargetagen_id=splitagent[i].split("/");
      if(vargetagen_id[0] == '<?php echo  $a->emp_id; ?>'){
        out_agent += "selected";
      }
    }
  out_agent +='><?php echo $a->emp_id."/".$a->name; ?></option>';
  out_agent +='<?php } ?>';
  $('.agentselectbox1').html(out_agent);
}


$(".more").click(function(){

}, function(){
  if($(this).text() == 'more...'){

$(this).text("less..").siblings(".complete").show();
}else{
$(this).text("more..").siblings(".complete").hide();
}
});

$(document).ready( function () {
    var test="<?php echo $userdata['department'] ?>";
    var role="<?php echo $userdata['role'] ?>";
  if(test == 'MANAGEMENT' || role == 'admin')
  {
    $('.tableprint').DataTable({
      dom: 'Bfrtip',
       buttons: [{
         extend:'excel',
         title: 'Reporting Person Report',
       },
       {
         extend:'pdf',
         title: 'Reporting Person Report',
       },
       {
         extend:'print',
         title: 'Reporting Person Report',
       }
       ],
    });
  }else{
    $('.tableprint').DataTable();
  }
});
$('.useridselectbox1').select2();
$('.useridselectbox').select2();
var datares;
// viewallset();
// function viewallset(){
// $.ajax({
//     url : "<?php echo base_url(); ?>ReportingPerson/getAgentdata",
//     method : "GET",
//     success : function(datares){
//         var dataset = JSON.parse(datares);
//         console.log(dataset);
//         datares=dataset;
//         $('.useridselectbox').select2(
//             {
//                 data:datares,
//                 multiple: true,
//                 width: "300px"
//             }
//         );
//
//       //  $('.useridselectbox').select2('destroy').find('option').prop('selected', 'selected').end().select2();
//     }
// });
// }


function unselect() {

    $("#useridselectbox").each(function () {

        $(this).select2('val', '');
    });
}

//viewSeparation();
function viewannouncement(){

  $('#viewannouncement').toggle();

}

function deleteuserdetails(manager_id,manager_name) {
  swal({
    title: "Are you sure?",
    text: "Do you want to delete "+manager_id+"/"+manager_name+" agent's mapping details!!!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type : "POST",
        url    : "<?php echo base_url(); ?>ReportingPerson/deleted",
        data   : {"manager_id":manager_id},
        success: function(datares){

        }
      });

      swal("Deleted Successfully!", {
        icon: "success",
      });
      location.reload();
    } else {
      swal("Your mapping details are safe!");
    }
  });
}
</script>
