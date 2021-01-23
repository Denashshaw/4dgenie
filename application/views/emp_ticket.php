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
#Startworking{
      background-color:#b8174b;
      border-radius: 25px;
      color:white;
      text-align: center;
}
#completed{
      background-color:#168c71;
      border-radius: 25px;
      color:white;
      text-align: center;
}
#pendingid{
  background-color:#39678e;
  border-radius: 25px;
  color:white;
  text-align: center;
}
#initiated{
      background-color:#0c527b;
      border-radius: 25px;
      color:white;
      text-align: center;
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
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">IT Help Desk</div>
		</div>
    <!-- <?php echo $this->session->flashdata('msg');?> -->

<div class="row emp-table ">
  <div class="col-md-12 table-responsive" ><br>

  <br><br>
  <table>
        <tr>
        <td>
        <p>Employee</p>
        <?php if($userdata['role'] != 'agent' ){ ?>
        <select class="form-control useridname" id="useridemp" name="useridemp"  onchange="viewTicket()">
          <option style="display: none;" value="" selected>Select Employee ID</option>
          <option value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>"><?php echo $userdata['emp_id'].'/'.$userdata['name']; ?></option>
            <?php foreach ($emp_data as $emp) { ?>
              <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
            <?php } ?>

        </select>
        <?php }else{ ?>
            <input id="useridempagent" name="useridempagent" value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" readonly>
          <?php } ?>
        </td>
        <td><br><br>
          <button class="check-in showhide" style="margin-left:700%">Add</button>
        </td>
        </tr>
        </table>
    <div class="row viewcont"  style="display:none">

      <div class="col-md-12">
      <br>
        <div class="row">
          <div class="col-sm-12"><br>
            <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
              <div class="card-body">
                <form id="tickerise">
                  <input type="hidden" id="uid" name="uid">
                  <div class="row">

                      <div class="col-md-3">
                          <p>Desk No</p>
                          <input type="text"  class="form-control number" max="250" id="deskno" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="deskno">
                      </div>
                      <div class="col-md-3">
                          <p>Reporting Team</p>
                          <input type="text" value="IT Team" id="report_team" name="report_team" class="form-control" readonly>
                      </div>
                      <div class="col-md-3">
                          <p>Issue Type</p>
                         <select class="form-control" id="issuetype" name="issuetype">
                          <option value="">Select Issue Type</option>
                          <option value="Network Issue">Network Issue</option>
                          <option value="CPU Issue">CPU Issue</option>
                          <option value="Desktop Issue">Desktop Issue</option>
                          <option value="Keyboard/Mouse Issue">Keyboard/Mouse Issue</option>
                          <option value="Others">Others</option>
                         </select>
                      </div>
                  </div>
                  <br>
                  <p>Issue Details</p>
                  <textarea  id="issueprb"  class="form-control" name="issueprb"></textarea>
                  <br>
                </form>
                <input type="submit" class="check-in" onclick="nodesubmit()"  style="margin-left:40%">
              </div><br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>

          <table class="table">
          <thead>
            <tr>
              <!-- <th>S.no</th> -->
              <th>Emp ID</th>
              <th>Name</th>
              <th>Desk No</th>
              <th>Issue Type</th>
              <th>Issue Details</th>
              <th>Status</th>
              <th>Complain Date</th>
              <th>Completed Date</th>
              <th>Duration</th>
              <th>IT Attender</th>
            <th>
          </thead>
          <tbody id="getissuelist">
          </tbody>
          </table>

  </div>
</div>
</body>
<?php include('sweetalert.php'); ?>

<script>


$(".showhide").click(function(){
  $(".viewcont").toggle();
});

$('.useridname').select2();

function nodesubmit(){
  $(".viewcont").toggle();
 if($('#uid').val() !='' && $('#deskno').val() !=''  && $('#report_team').val() !=''  && $('#issuetype').val() !=''  && $('#issueprb').val() !=''){

  $.ajax({
    url : "<?php echo base_url(); ?>Ticket/addticket",
    method : "POST",
    data : $('#tickerise').serialize(),
    success : function(datares){
      var res = JSON.parse(datares);
      if(res.status == 'Success'){
        swal("Success", "Ticket raised successfully", "success");
      }else{

      }
      viewTicket();
    }
  });
 }else{
  // alert('All fields are required');
  swal("Warning", "All fields are required", "warning");
 }
}
viewTicket();
function viewTicket(){

  //$('#emp_Separtation').hide();
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined){
    emp_id=$('#useridempagent').val();
  }else{
    emp_id=emp_id_get;
  }
  if(emp_id != ''){
    $('#uid').val(emp_id);
    $.ajax({
    url : "<?php echo base_url(); ?>Ticket/getticket_agent",
    method : "POST",
    data : {"uid":emp_id},
    success : function(datares){
      var res = JSON.parse(datares);
      console.log(res);
      var out ='';
     if(res.length > 0){
      for(var i=0;i<res.length;i++){
        if(res[i].status == 0){
          var st_print='<p id="initiated">Pending</p>';
        }else if(res[i].status == 1){
          var st_print='<p id="Startworking">Processing</p>';
        }else{
          var st_print='<p id="completed">Completed</p>';
        }
        out +='<tr>';
       // out +='<td>'+(i+1)+'</td>';
        out +='<td>'+res[i].emp_id+'</td>';
        out +='<td>'+res[i].name+'</td>';
        out +='<td>'+res[i].desk_no+'</td>';
        out +='<td>'+res[i].issue_type+'</td>';
        out +='<td>'+res[i].issue_details+'</td>';
        out +='<td>'+st_print+'</td>';
        out +='<td>'+res[i].complaint_date+'</td>';
        if(res[i].issuecompleted_date != '0000-00-00 00:00:00'){
              out +='<td>'+res[i].issuecompleted_date+'</td>';
        }else{ out +='<td>-</td>'; }
        out +='<td>'+res[i].duriation+'</td>';
        if(res[i].it_person == undefined || res[i].it_person ==''){
          out +='<td></td>';
        }else{
          out +='<td>'+res[i].it_person+'</td>';
        }
        out +='</tr>';
      }
     }else{
       out +='<tr><td colspan=9>No Details Available</td></tr>';
     }
     $('#getissuelist').html(out);
    }
    });
  }else{
    $('#uid').val('');
  }
}
</script>
