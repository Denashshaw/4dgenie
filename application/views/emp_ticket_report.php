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
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">IT Help Desk Report</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
    <form id="getvalfilter">  
<div class="row emp-table ">
  <div class="col-md-12 table-responsive" ><br>
 
  <div class="row">
  
  <div class="col-md-2">
        <p>Employee</p>
         <select class="form-control useridnameReport2" id="useridemp" name="useridemp" >
          <option value="All" selected>All</option>
            <?php foreach ($emp_data as $emp) { ?>
              <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="col-md-2">
        <p>Issue Type</p>
            <select class="form-control" id="issuetype" name="issuetype">
                <option value="All">All</option>
                <option value="Network Issue">Network Issue</option>
                <option value="CPU Issue">CPU Issue</option>
                <option value="Desktop Issue">Desktop Issue</option>
                <option value="Keyboard/Mouse Issue">Keyboard/Mouse Issue</option>
                <option value="Others">Others</option>
            </select>
            
        </div>
        <div class="col-md-2">
        <p>Status</p>
            <select class="form-control" id="status" name="status">
                <option value="All">All</option>
                <option value="0">Pending</option>
                <option value="1">Processing</option>
                <option value="2">Completed</option>
            </select>
        </div>
        <div class="col-md-2">
            <p>From Date</p>
            <input type="text" class="form-control fromdate" id="fromdate" name="fromdate" value='<?php echo date('m/01/Y'); ?>'>     
        </div>
        <div class="col-md-2">
            <p>To Date</p>
            <input type="text" class="form-control todate" id="todate" name="todate" value='<?php echo date('m/d/Y'); ?>'>
        </div>
        <div  class="col-md-2"><br>
            <input type="button" class="check-in" value="Repot" onclick="getReport()">
        </div>
      
    </div>
  
        <!-- <td><br><br>
          <button class="check-in showhide" style="margin-left:700%">Add</button>
        </td> -->
        <br>
      <div class="row">
        <div class="col-md-12">
        <table class="table table-bordered">
          <tr>
            <td id="totalcount"></td>
            <td id="pendingcount"></td>
            <td id="processingcount"></td>
            <td id="completedcount"></td>
          
      
        <!-- <form action="<?php echo base_url(); ?>TicketReport/excelexport" method="POST"> -->
          <!-- <input type="submit" class="check-in" value="Excel" style="margin-left:40%"> -->
          <td>
          <button type="submit" class="check-out" formaction="<?php echo base_url(); ?>TicketReport/excelexport">Excel</button>
          <!-- </td><td> --><br>
          <button type="submit" class="check-out" style="background:#706FAC;margin-top:10%" formaction="<?php echo base_url(); ?>TicketReport/pdfexport">PDF</button>
          </td>
          <!-- </form> -->
        <!-- <i class="fa fa-download" onclick="previewdata()" aria-hidden="true" style="font-size:100px;cursor:pointer" title="Download"></i> -->
        </tr>
        </table>
      </div>
      </form>

    <br>
   
          <table class="table entireview">
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
<div class="modal fade preview" id="previewtoprint">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Download Report</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" >
        <form action="<?php echo base_url(); ?>TicketReport/excelexport">
          <input type="submit" class="check-in" value="Excel" style="margin-left:40%">
          </form>
        <button class="check-out">PDF</button>
        <div  style="overflow-x:auto;"><br>
        <table class="table preview1 table-bordered">
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
            </tr>
          </thead>
          <tbody id="getissuelist">
            </tbody>
          </table>
          </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
<script>
function previewdata(){
  $('#previewtoprint').modal('toggle');
}
$(".fromdate").datepicker({
      altField: ".fromdate",
      altFormat: "M d, yy"
});
$(".todate").datepicker({
      altField: ".todate",
      altFormat: "M d, yy"
});

$(".showhide").click(function(){
  $(".viewcont").toggle();
});

$('.useridnameReport').select2({height: 'resolve'});


function getexcelval(){
  $.ajax({
    url : "<?php echo base_url(); ?>TicketReport/excelexport",
    method : "POST",
    data : $('#getvalfilter').serialize(),
    success : function(datares){
    //   var res = JSON.parse(datares);
    //   if(res.status == 'Success'){
    //     $(".viewcont").toggle();
    //   }else{

    //   }
    //   //viewTicket();
     }
  });

}
//viewTicket();
getReport();
function getReport(){
  
  //$('#emp_Separtation').hide();
  var emp_id = $("#useridemp").children("option:selected").val();
    $.ajax({
      url : "<?php echo base_url(); ?>TicketReport/getreport",
      method : "POST",
      data : $('#getvalfilter').serialize(),
    success : function(datares){
      var res = JSON.parse(datares);
      console.log(res);
      var out ='';
      var pendingcount =0;
      var processcount =0;
      var completedcount=0;
      var i=0;
     if(res.length > 0){
      for(i;i<res.length;i++){
        if(res[i].status == 0){
          var st_print='<p id="initiated">Pending</p>';
          pendingcount++;
        }else if(res[i].status == 1){
          var st_print='<p id="Startworking">Processing</p>';
          processcount++;
        }else{
          var st_print='<p id="completed">Completed</p>';
          completedcount++;
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
     $('#totalcount').html('<p>Total</p><h3>'+i);
     if(i == 0){
       $('.fa-download').hide();
     }else{
      $('.fa-download').show();
     }
      $('#pendingcount').html('<p>Pending</p><h3>'+pendingcount);
      $('#processingcount').html('<p>Process</p><h3>'+processcount);
      $('#completedcount').html('<p>Completed</p><h3>'+completedcount);
     $('#getissuelist').html(out);
     $('.preview .preview1 #getissuelist').html(out);
    }
    });
  
}

</script>
