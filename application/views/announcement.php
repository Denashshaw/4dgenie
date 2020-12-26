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


<main class="page-content">
	<div class="container-fluid p-0">
    <?php include('page_head.php') ?>
        <div class="row activity-row">
    	    <div class="col-md-12 activity">Announcement</div>
		</div>
        <div class="row emp-table">
            <div class="col-md-12 table-responsive" >
                <div class="row">
                    <div class="col-md-12">
                    <br>
                    <?php  if($userdata['department'] =='MANAGEMENT' || $userdata['role'] !='agent'){ ?>
                        <button  onclick="viewannouncement()" style="margin-left:90%" class="check-out">Add</button>
                    <?php } ?>
                        <div class="card card-body" style="display:none" id="viewannouncement">
                            <form action="<?php echo base_url(); ?>Notification/addannouncement" method="POST">
                                <div  class="row" > 
                                    <div class="col-md-4" style="border-right: 2px solid #cec4c4;">
                                        <!-- <p onclick="getval()">Select All</p>  -->
                                        <p>Employee</p>
                                        <select class="useridselectbox" id="useridselectbox" name="useridselectbox[]" multiple>
                                        </select>
                                    </div>
                                    <div class="col-md-8"  style="border-right: 2px solid #cec4c4;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Type</p>
                                                <select name="module_name" id="module_name" class="form-control">
                                                    <option value="General Announcement" selected>General Announcement</option>
                                                    <option value="One on One Feedback">One on One Feedback</option>
                                                    <option value="Employee Leave/Permission">Employee Leave/Permission</option>
                                                    <option value="Employee Attendance">Employee Attendance</option>
                                                    <option value="Employee Information">Employee Information</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Date</p>
                                                <input type="text" id="getdate" name="getdate"  class="form-control" value="<?php echo date('Y-m-d'); ?>" style="margin-top: 1%;" >
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <p>Details</p>
                                                <textarea class="form-control" id="details" rows=5 name="details"></textarea>
                                            </div>
                                        </div>
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
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Creater</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_announcement as $a) { ?>
                            <tr>
                                <td><?php echo $a->emp_id."/".$a->name; ?></td>
                                <td><?php echo $a->module_name; ?></td>
                                <td><?php echo $a->details; ?></td>
                                <td><?php echo $a->creater_id."/".$a->creater_name; ?></td>
                                <td><?php echo $a->created_date; ?></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
        <br>
    </div>
</main>

<?php if($userdata['department'] != 'MANAGEMENT'){ ?>
  <script>
    $('.menu1 input').prop("readonly", true);
    $('#monthdatepicker').attr('disabled', true); 
    $('.menu2 input').prop("readonly", true);
    //$('#monthdatepicker').attr('disabled', true); 
  </script>
<?php } ?>


<script>


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
  if(test == 'MANAGEMENT')
  {
    $('.tableprint').DataTable({
      dom: 'Bfrtip',
       buttons: [{
         extend:'excel',
         title: 'Announcement Report',
       },
       {
         extend:'pdf',
         title: 'Announcement Report',
       },
       {
         extend:'print',
         title: 'Announcement Report',
       }
       ],
    });
  }else{
    $('.tableprint').DataTable();
  }
});

var datares;
viewallset();
function viewallset(){
$.ajax({
    url : "<?php echo base_url(); ?>Notification/getAgentdata",
    method : "GET",
    success : function(datares){
        var dataset = JSON.parse(datares);
        console.log(dataset);
        datares=dataset;
        $('.useridselectbox').select2(
            {
                data:datares,
                multiple: true,
                width: "300px"
            }
        );
       
      //  $('.useridselectbox').select2('destroy').find('option').prop('selected', 'selected').end().select2();
    }
});
}


function unselect() {
    
    $("#useridselectbox").each(function () {
     
        $(this).select2('val', '');
    });
}

//viewSeparation();
function viewannouncement(){

  $('#viewannouncement').toggle();
 
}


</script>
