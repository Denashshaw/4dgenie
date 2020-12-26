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
</style>
<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Employee Documents</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
    <!-- <form id="attendfilter"> -->
    <div class="col-md-12">
      <table>
      <tr>
      <td>
      <p>Employee</p>
      <?php if($userdata['role'] != 'agent'){ ?>
      <select class="form-control useridvaldocument" id="useridemp" name="useridemp"  onchange="viewdocument()">
       
        <option style="display: none;" value="" selected>Select Employee ID</option>
          <?php foreach ($emp_data as $emp) { ?>
            <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
          <?php } ?>
      
      </select>
      <?php }else{ ?>
        <input id="useridempagent1" name="useridempagent1" value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" readonly>
            <input id="useridempagent" name="useridempagent" value="<?php echo $userdata['emp_id']; ?>" hidden>
          <?php } ?>
      </td>
      <td>
      <p>Document Type</p>
      <select id="emp_docType" name="emp_docType"  class="form-control"  onchange="viewdocument()">
        <option value="">Select Document</option>
        <option value="Certificates">Certificates</option>
        <option value="Confirmation Letter">Confirmation Letter</option>
        <option value="Promotion Letters">Promotion Letters</option>
        <option value="Warning letters">Warning letters</option>
        <option value="Termination Letter">Termination Letter</option>
        <option value="Aadhar Card">Aadhar Card </option>
        <option value="PAN Card">PAN Card</option>
        <option value="Resume">Resume</option>
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
 <div class="col-sm-7" id="confirmationview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:#3fc98e">
        <h4 style="cursor:pointer" onclick="$('#confirmationletterupload').click();" >Confirmation Letter <span style="padding-left:40%" class="fa fa-upload" ></span></h4>
      </div>
      <div class="card-body">
      <form action="<?php echo base_url(); ?>Documents/confirmationUpload" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="empidname1" name="empidname1">
        <input type="file" id="confirmationletterupload" name="confirmationletterupload" style="display:none" accept=".pdf"/>
        <p id="confFilename">No Document Uploaded</p>
        <p id="confirmationsubmit" style="display:none"><input type="submit" class="check-in" value="Conform"></p>
      </form>
      </div>
    </div><br>
  </div>

  <div class="col-sm-7" id="terminationview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:#ff5c4b">
        <h4 style="cursor:pointer" onclick="$('#terminationletterupload').click();" >Termination Letter <span style="padding-left:40%" class="fa fa-upload" ></span></h4>
      </div>
      <div class="card-body">
      <form action="<?php echo base_url(); ?>Documents/terminationUpload" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="empidname2" name="empidname2">
      <input type="file" id="terminationletterupload" name="terminationletterupload" style="display:none" accept=".pdf"/>
       <p id="terminationFilename">No Document Uploaded</p>
        <p id="terminationsubmit" style="display:none"><input type="submit" class="check-out" value="Conform"></p>
      </form>
      </div>
    
    </div><br>
  </div>
  <div class="col-md-8 bg-white " id="Certificateview" style="display:none;margin-left:15%"><br>
  <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  > 
    <div class="card-header" style="background-color:#536ece">
      <h4 style="cursor:pointer">CERTIFICATES</h4>  
    </div>
      <div class="card-body">
    <h5 align="right" style="font-weight:bold"></h5>
    <form action="<?php echo base_url(); ?>Documents/certificateUpload" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="empidname3" name="empidname3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Certificate Name</th>
            <th>Document</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="certificate1" id="certificate1" placeholder="Certificate1"></td>
            <td><input type="file" name="certificatefile1" id="certificatefile1">
              <p id="cer1view"></p>
            </td>
          </tr>
          <tr>
            <td><input type="text" name="certificate2" id="certificate2" placeholder="Certificate2"></td>
            <td><input type="file" name="certificatefile2" id="certificatefile2">
            <p id="cer2view"></p></td>
          </tr>
          <tr>
            <td><input type="text" name="certificate3" id="certificate3" placeholder="Certificate3"></td>
            <td><input type="file" name="certificatefile3" id="certificatefile3">
            <p id="cer3view"></p>
          </td>
          </tr>
        </tbody>
      </table>
      <input type="submit" class="check-in" value="Submit" style="background: #536ece;margin-left:40%"> 
    </form>
     </div>
      </div>
    </div><br>
  </div>
  
  <div class="col-md-7" id="promotionview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:#86c3f7">
        <h4 >Promotion Letter </h4>
      </div>
      <div class="card-body">
        <div class="row">
        <?php if($userdata['role'] != 'agent'){  ?>
          <div class="col-md-8">
              <p>File</p>
              <input type="file" name="permissionwaringletter1"  accept=".pdf" id="permissionwaringletter1"  class="form-control">
          </div>
          <div class="col-md-2"><br>
            <input type="button" class="check-in" value="Upload" onclick="addperwar1()"  style="color:black;background: #86c3f7;margin-left:40%">
          </div>
        <?php } ?>
          <br>
          <table class="table table-bordered" id="myTable" style="font-size:14px;">
        <thead>
          <tr>
            <td class="colhead">Date of Updated</td>
            <td class="colhead">Document</td>
            <!-- <td class="colhead">Action</td> -->
          </tr>
        </thead>
        <tbody id="permissionwarningdocument1">
          <tr><td colspan=3 style="text-align:center"><b>No Document Uploaded</b></td></tr> 
        </tbody>
    </table>
    <input type="button" class="check-in promotionbtn" onclick="submit_promotion()" value="Conform" style="background:#86c3f7;margin-left:40%;display:none"> 

        </div>
      </div>
    </div><br>
  </div>

  <div class="col-md-7" id="warningview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:#f7ca86">
        <h4 >Warning Letter </h4>
      </div>
      <div class="card-body">
        <div class="row">
        <?php if($userdata['role'] != 'agent'){  ?>
          <div class="col-md-8">
              <p>File</p>
              <input type="file" name="permissionwaringletter2"  accept=".pdf" id="permissionwaringletter2"  class="form-control">
          </div>
          <div class="col-md-2"><br>
            <input type="button" class="check-in" value="Upload" onclick="addperwar2()"  style="color:black;background: #ecaf53;margin-left:40%">
        </div>
        <?php } ?>
        <br>
          <table class="table table-bordered" id="myTable" style="font-size:14px;">
        <thead>
          <tr>
            <td class="colhead">Date of Updated</td>
            <td class="colhead">Document</td>
            <!-- <td class="colhead">Action</td> -->
          </tr>
        </thead>
        <tbody id="permissionwarningdocument2">
          <tr><td colspan=3 style="text-align:center"><b>No Document Uploaded</b></td></tr> 
        </tbody>
    </table>
    <input type="submit" class="check-in warningbtn" value="Conform" style="background:#f7ca86;margin-left:40%;display:none"> 

        </div>
      </div>
    </div>
    <br>
  </div>
<!-- 
  <div class="col-sm-7" id="aadharview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer" onclick="$('#aadharupload').click();" >Aadhar Card <span style="padding-left:40%" class="fa fa-upload" ></span></h4>
      </div>
      <div class="card-body">
      <form action="<?php echo base_url(); ?>Documents/aadharUpload" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="empidname4" name="empidname4">
        <input type="file" id="aadharupload" name="aadharupload" style="display:none" accept=".pdf"/>
        <p id="aadharFilename">No Document Uploaded</p>
        <p id="aadharsubmit" style="display:none"><input type="submit" class="check-in" value="Conform" style="color:black;background:DarkCyan;"></p>
      </form>
      </div>
    </div><br>
  </div> -->
  
  <div class="col-sm-7" id="aadharview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer" >Aadhar Card</h4>
      </div>
      <div class="card-body">
      <!-- <form action="<?php echo base_url(); ?>Documents/aadharUpload" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="empidname4" name="empidname4">
        <input type="file" id="aadharupload" name="aadharupload" style="display:none" accept=".pdf"/> -->
        <p id="aadharFilename">No Document Uploaded</p>
        <!-- <p id="aadharsubmit" style="display:none"><input type="submit" class="check-in" value="Conform" style="color:black;background:DarkCyan;"></p>
      </form> -->
      </div>
    </div><br>
  </div>

  <!-- <div class="col-sm-7" id="panview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer" onclick="$('#panupload').click();" >PAN Card <span style="padding-left:40%" class="fa fa-upload" ></span></h4>
      </div>
      <div class="card-body">
      <form action="<?php echo base_url(); ?>Documents/confirmationUpload" method="POST" enctype="multipart/form-data">
        <input type="file" id="panupload" style="display:none" accept=".pdf"/>
        <p id="panFilename">No Document Uploaded</p>
        <p id="pansubmit" style="display:none"><input type="submit" class="check-in" value="Conform"  style="color:black;background:DarkCyan;"></p>
      </form>
      </div>
    </div><br>
  </div> -->
  <div class="col-sm-7" id="panview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer">PAN Card</h4>
      </div>
      <div class="card-body">
      <!-- <form action="<?php echo base_url(); ?>Documents/confirmationUpload" method="POST" enctype="multipart/form-data">
        <input type="file" id="panupload" style="display:none" accept=".pdf"/> -->
        <p id="panFilename">No Document Uploaded</p>
        <!-- <p id="pansubmit" style="display:none"><input type="submit" class="check-in" value="Conform"  style="color:black;background:DarkCyan;"></p>
      </form> -->
      </div>
    </div><br>
  </div>

  <!-- <div class="col-sm-7" id="resumeview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer" onclick="$('#resumeupload').click();" >Resume<span style="padding-left:40%" class="fa fa-upload" ></span></h4>
      </div>
      <div class="card-body">
      <form action="<?php echo base_url(); ?>Documents/confirmationUpload" method="POST" enctype="multipart/form-data">
        <input type="file" id="resumeupload" style="display:none" accept=".pdf"/>
        <p id="resumeFilename">No Document Uploaded</p>
        <p id="resumesubmit" style="display:none"><input type="submit" class="check-in" value="Conform"  style="color:black;background:DarkCyan;"></p>
      </form>
      </div>
    </div><br>
  </div> -->

  <div class="col-sm-7" id="resumeview" style="display:none;margin-left:20%"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-header" style="background-color:DarkCyan">
        <h4 style="cursor:pointer" >Resume</h4>
      </div>
      <div class="card-body">
      <!-- <form action="<?php echo base_url(); ?>Documents/confirmationUpload" method="POST" enctype="multipart/form-data">
        <input type="file" id="resumeupload" style="display:none" accept=".pdf"/> -->
        <p id="resumeFilename">No Document Uploaded</p>
        <!-- <p id="resumesubmit" style="display:none"><input type="submit" class="check-in" value="Conform"  style="color:black;background:DarkCyan;"></p>
      </form> -->
      </div>
    </div><br>
  </div>

  </div>
</div>
</div>
</div>
</body>

<script>
setInterval(function(){
var confirmation_file = $('#confirmationletterupload')[0].files[0];
if (confirmation_file){
  $('#confFilename').html(confirmation_file.name);
  $('#confirmationsubmit').show();
}
var ter_file=$('#terminationletterupload')[0].files[0];
if (ter_file){
  $('#terminationFilename').html(ter_file.name);
  $('#terminationsubmit').show();
}
//  var resumefile = $('#resumeupload')[0].files[0];
//  if(resumefile){
//    $('#resumeFilename').html(resumefile.name);
//    $('#resumesubmit').show();
//  }
// var aadharfile = $('#aadharupload')[0].files[0];
// if(aadharfile){
//   $('#aadharFilename').html(aadharfile.name);
//   $('#aadharsubmit').show();
// }
// var panfile = $('#panupload')[0].files[0];
// if(panfile){
//   $('#panFilename').html(panfile.name);
//   $('#pansubmit').show();
// }

var cert1 = $('#certificatefile1')[0].files[0];
if(cert1){
  $('#cer1view').html(cert1.name);
}
var cert2 = $('#certificatefile2')[0].files[0];
if(cert2){
  $('#cer2view').html(cert2.name);
}
var cert3 = $('#certificatefile3')[0].files[0];
if(cert3){
  $('#cer3view').html(cert3.name);
}
}
, 1000);


$('.useridvaldocument').select2();
$('#emp_docType').select2();
$("#attendancedatepicker").datepicker( {
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"
});
viewdocument();
function viewdocument(){
  
  $('#confirmationview').hide();
  $('#terminationview').hide();
  $('#Certificateview').hide();
  $('#promotionview').hide();
  $('#warningview').hide();
  $('#aadharview').hide();
  $('#panview').hide();
  $('#resumeview').hide();
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
  var docType = $("#emp_docType").children("option:selected").val();

  if(emp_id != '' && docType !=''){
    
    
    if(docType == 'Confirmation Letter'){
      $('#empidname1').val(emp_id);
      $('#confirmationview').show();
      getconfir(emp_id);
    }
    else if(docType == 'Termination Letter'){
      $('#empidname2').val(emp_id);
      $('#terminationview').show();
      getterm(emp_id);
    }
    else if(docType == 'Certificates'){
      $('#empidname3').val(emp_id);
      $('#Certificateview').show();
      getcertificatedetails(emp_id);
    }
    else if(docType == 'Promotion Letters'){
      getpromotionview();
      $('#promotionview').show();
    }
    else if(docType == 'Warning letters'){
      getwarningview();
      $('#warningview').show();
    }
    else if(docType == 'Aadhar Card'){

      $('#aadharview').show();
      getaadharpan();
    }else if(docType == 'PAN Card'){
      $('#panview').show();
      getaadharpan();
    }
    else if(docType == 'Resume'){
      $('#resumeview').show();
      getaadharpan();
    }
    else{
      
    }
  } 

}

function getconfir(id){
  $.ajax({
    url : "<?php echo base_url(); ?>Documents/getuserdata",
    method : "POST",
    data : {"userid":id},
    success : function(datares){
      var data = JSON.parse(datares);
      if(data.length > 0){
        $('#confFilename').html('<a href="<?php echo base_url(); ?>documents/confirmation_letter/'+data[0].confirmation_letter+'" target="_blanked">'+data[0].confirmation_letter+'</a>');
      }else{
        $('#confFilename').html("<p>No Document Uploaded</p>");
      }
    }
  });
}
function getterm(id){
  $.ajax({
    url : "<?php echo base_url(); ?>Documents/getuserdata",
    method : "POST",
    data : {"userid":id},
    success : function(datares){
      var data = JSON.parse(datares);
      if(data.length > 0){
        $('#terminationFilename').html('<a href="<?php echo base_url(); ?>documents/termination_letter/'+data[0].termination_letter+'" target="_blanked">'+data[0].termination_letter+'</a>');
      }else{
        $('#terminationFilename').html("<p>No Document Uploaded</p>");
      }
    }
  });
}
function getcertificatedetails(id){
  $.ajax({
    url : "<?php echo base_url(); ?>Documents/getuserdata",
    method : "POST",
    data : {"userid":id},
    success : function(datares){
      var data = JSON.parse(datares);
      if(data.length > 0){
        $('#certificate1').val(data[0].certificate1);
        $('#certificate2').val(data[0].certificate2);
        $('#certificate3').val(data[0].certificate3);
        $('#cer1view').html('<a href="<?php echo base_url(); ?>documents/certificates/'+data[0].certificate1_filename+'" target="_blanked">'+data[0].certificate1_filename+'</a>');
        $('#cer2view').html('<a href="<?php echo base_url(); ?>documents/certificates/'+data[0].certificate2_filename+'" target="_blanked">'+data[0].certificate2_filename+'</a>');
        $('#cer3view').html('<a href="<?php echo base_url(); ?>documents/certificates/'+data[0].certificate3_filename+'" target="_blanked">'+data[0].certificate3_filename+'</a>');
      }else{
        $('#certificate1').val('');
        $('#certificate2').val('');
        $('#certificate3').val('');
        $('#cer1view').html('');
        $('#cer2view').html('');
        $('#cer3view').html('');
      }
    }
  });
}

var filenamewarning =[];
var filename = [];
function addperwar1(){
  var certfile = $('#permissionwaringletter1')[0].files[0];
 // var emp_id = $("#useridemp").children("option:selected").val();
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get ==''){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
  var d = new Date();
  var twoDigitMonth = (d.getMonth()+1);
  var todaydate =d.getDate() + "-" + twoDigitMonth + "-" + d.getFullYear();
  var fd = new FormData();
  fd.append("userid",emp_id);
  fd.append("filenamePromotion",certfile);
  fd.append("date",todaydate);

  $.ajax({
    url : "<?php echo base_url(); ?>Documents/uploadpromotion",
    method : "POST",
    data : fd,
    cache: false,
    contentType: false,
    processData: false,
    enctype: 'multipart/form-data',
    success : function(datares){
      var datapromotion = JSON.parse(datares);
      $('#permissionwaringletter1').val('');
      viewPromotion(datapromotion);
    }
  });
}
function getpromotionview(){
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get ==''){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
$.ajax({
    url : "<?php echo base_url(); ?>Documents/getpromotion",
    method : "POST",
    data : {"userid":emp_id},
    success : function(datares){
      var datapromotion = JSON.parse(datares);
      $('#permissionwaringletter1').val('');
      viewPromotion(datapromotion);
    }
  });
}

function viewPromotion(datapromotion){
  if(datapromotion.length > 0){
        var out='';
        for(var i=0;i<datapromotion.length;i++){
          out += '<tr>';
          out += '<td><a href="<?php echo base_url(); ?>documents/promotion_letter/'+datapromotion[i].permissiondoc+'" target="_blanked">'+datapromotion[i].permissiondoc+'</a></td>';
          out += '<td>'+datapromotion[i].per_update_date+'</td>';
        //  out += '<td><i class="fa fa-trash" style="color:red;font-size:15px;" onclick="removeperwar('+i+')"></i></td>';
          out += '<tr>';
        }
      }else{
        var out='<tr><td colspan=2 style="text-align:center"><b>No Document Uploaded</b></td></tr>';
      }
      $('#permissionwarningdocument1').html(out);
    
}


function addperwar2(){
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get ==''){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
  var certfile = $('#permissionwaringletter2')[0].files[0];

  var d = new Date();
  var twoDigitMonth = (d.getMonth()+1);
  var todaydate =d.getDate() + "-" + twoDigitMonth + "-" + d.getFullYear();
  var fd = new FormData();
  fd.append("userid",emp_id);
  fd.append("filenamewaring",certfile);
  fd.append("date",todaydate);

  $.ajax({
    url : "<?php echo base_url(); ?>Documents/uploadwaring",
    method : "POST",
    data : fd,
    cache: false,
    contentType: false,
    processData: false,
    enctype: 'multipart/form-data',
    success : function(datares){
      var datawarning = JSON.parse(datares);
      $('#permissionwaringletter2').val('');
      viewWarning(datawarning);
    }
  });
}
function viewWarning(datawarning){
  if(datawarning.length > 0){
        var out='';
        for(var i=0;i<datawarning.length;i++){
          out += '<tr>';
          out += '<td><a href="<?php echo base_url(); ?>documents/promotion_letter/'+datawarning[i].warningdoc+'" target="_blanked">'+datawarning[i].warningdoc+'</a></td>';
          out += '<td>'+datawarning[i].war_update_date+'</td>';
          out += '<tr>';
        }
      }else{
        var out='<tr><td colspan=2 style="text-align:center"><b>No Document Uploaded</b></td></tr>';
      }
      $('#permissionwarningdocument2').html(out);
}

function getwarningview(){
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get ==''){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
$.ajax({
    url : "<?php echo base_url(); ?>Documents/getwarning",
    method : "POST",
    data : {"userid":emp_id},
    success : function(datares){
      var datawarning = JSON.parse(datares);
      $('#permissionwaringletter1').val('');
      viewWarning(datawarning);
    }
  });
}

function getaadharpan(){
  var emp_id;
  var emp_id_get = $("#useridemp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get ==''){
    emp_id=$('#useridempagent').val();  
  }else{
    emp_id=emp_id_get;
  }
$.ajax({
    url : "<?php echo base_url(); ?>Documents/getpersonaldetails",
    method : "POST",
    data : {"userid":emp_id},
    success : function(datares){
      var data = JSON.parse(datares);
      console.log(data);
      if(data.length > 0){
      if(data[0].aadhar != ''){
        $('#aadharFilename').html('<a href="<?php echo base_url(); ?>img/address_proof/'+data[0].aadhar+'" target="_blanked">'+data[0].aadhar+'</a>');
      }else{
        $('#aadharFilename').html("<p>No Document Uploaded</p>");
      }
      if(data[0].pan != ''){
        $('#panFilename').html('<a href="<?php echo base_url(); ?>img/address_proof/'+data[0].pan+'" target="_blanked">'+data[0].pan+'</a>'); 
      }else{
        $('#panFilename').html("<p>No Document Uploaded</p>");
      }
      if(data[0].resume != ''){
        $('#resumeFilename').html('<a href="<?php echo base_url(); ?>img/resume/'+data[0].resume+'" target="_blanked">'+data[0].resume+'</a>');
      }else{
        $('#resumeFilename').html("<p>No Document Uploaded</p>");
      }
      }else{
        $('#aadharFilename').html("<p>No Document Uploaded</p>");
        $('#panFilename').html("<p>No Document Uploaded</p>");
        $('#resumeFilename').html("<p>No Document Uploaded</p>");
      }
    }
});
}


</script>
