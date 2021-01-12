<body>
  <style>

</style>
<div class="page-wrapper chiller-theme toggled">
<?php
 $this->load->view('header');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php $this->load->view('page_head'); ?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Employee Internal Transfer Report</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
    <div class="row emp-table ">
      <div class="col-md-12 table-responsive" ><br>
        <form id="internaltransferid">
        <div class="row">
          <div class="col-md-3">
              <p>From Date</p>
              <input type="text" class="form-control fromdate" id="fromdate" name="fromdate" value='<?php echo date('m/01/Y'); ?>'>
          </div>
          <div class="col-md-3">
              <p>To Date</p>
              <input type="text" class="form-control todate" id="todate" name="todate" value='<?php echo date('m/d/Y'); ?>'>
          </div>
          <div  class="col-md-1"><br>
              <input type="button" class="check-in" value="Repot" onclick="getReportInternal()">
          </div>
          <div  class="col-md-5">
            <button type="submit" class="check-out" formaction="<?php echo base_url(); ?>empinfoControl/InterTrans_excelexport" style="margin-left:50%">Excel</button>
            <button type="submit" class="check-out" style="background:#706FAC;" formaction="<?php echo base_url(); ?>empinfoControl/InterTrans_pdfexport">PDF</button>
          </div>
        </div>

        </form>
      </div>
    </div>
    <div class="row emp-table" >
      <div class="col-md-12 table-responsive">

        <table class="table" id="myTable" style="margin-top:2%">
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
          </tr>
          </thead>
          <tbody id="transfer_table_data">
          </tbody>
      </table>
      <!-- <div class="plinks"> <?= $links; ?></div> -->
    </div>
    </div>
  </div>
</main>
</div>
<script>
function excelreport(){
  $.ajax({
    url : "<?php echo base_url(); ?>empinfoControl/InterTrans_excelexport",
    method : "GET",
    data : $('#internaltransferid').serialize(),
    success : function(datares){
    }
  });
}
getReportInternal();
 function getReportInternal(){
   $.ajax({
     url : "<?php echo base_url(); ?>empinfoControl/getview",
     method : "POST",
     data : $('#internaltransferid').serialize(),
     success : function(datares){
       var data = JSON.parse(datares);
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
              </tr>`;
       });
       $('#transfer_table_data').html(output);
     }
   });
 }
 function date_format(date){
   var d = new Date(date);
   var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
   return months[d.getMonth()]+' '+d.getDate() +', '+ d.getFullYear();

 }

 $(".fromdate").datepicker({
       altField: ".fromdate",
       altFormat: "M d, yy"
 });
 $(".todate").datepicker({
       altField: ".todate",
       altFormat: "M d, yy"
 });
 </script>
