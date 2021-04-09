
<div class="page-wrapper chiller-theme toggled">
<style>

    .transfer-demo {
            width: 640px;
            height: 400px;
            margin: 0 auto;
        }
</style>
<head>

</head>

<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>

<main class="page-content">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('multiplesectplugin/css/jquery.transfer.css?v=0.0.3') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('multiplesectplugin/icon_font/css/icon_font.css') ?>" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   <script src="<?php echo base_url('multiplesectplugin/js/jquery.transfer.js?v=0.0.6');?>"></script>
   <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


   <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css">
   	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.jqueryui.min.css">

   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.jqueryui.min.js"></script>
 	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

  <div class="container-fluid p-0">
    <?php include('page_head.php');?>

    <div class="row activity-row">
			<div class="col-md-12 activity">Assessment</div>
		</div>
    <div class="row activity-row">
			<div class="col-md-12 activity">
    <button class="check-in viewadddiv">Add Question</button>
    <div class="addquestionview" style="display:none">
     <div class="row emp-table ">
      <div class="col-md-7 table-responsive" >
        <p>Add Agents</p>
          <div id="transfer1" class="transfer-demo" style="font-size:12px"></div>

      </div>
      <div class="col-md-5" >
        <div class="row" style="background:#f1f3f1">
          <div class="col-md-6">
            <p>Title/Assessment ID<span style="color:red">*</span></p>
            <input type="text" id="title" name="title" class="form-control">
          </div>
          <div class="col-md-6" style="text-align:right">
            <p> Test Timing</p>
            <input type="number" min="1" max="120" id="timing" name="timing" >
          </div>
        </div>
        <br>
        <p>Add Questions</p>
        <!-- <button class="btn btn-success" onclick="addquestion()">Add Question</button> -->
        <i class="fa fa-plus" style="font-size:60px;margin-top:10%;margin-left:45%;color:green;cursor:pointer;" onclick="addquestion()"></i>
      </div><br>
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Question</th>
              <th>Option A</th>
              <th>Option B</th>
              <th>Option C</th>
              <th>Option D</th>
              <th>Correct Answer</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="questionprint">

          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <input type="button" value="Submit" onclick="getdata()" class="btn btn-primary submitbtn">
      </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row emp-table">
      <div class="col-md-12  table-responsive">
        <table class="table table-bordered dt">
          <thead>
            <tr>
              <td>Title/Assessment ID</td>
              <td>No of Questions</td>
              <td>No of Employees</td>
              <td>Date of Creation</td>
              <!-- <td></td> -->
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
             foreach ($getdata as $a) { ?>
              <tr>
                <td> <?php echo $a->title; ?></td>
                <td>
                  <p style="background:#3f76c9;padding:2%;border-radius:50%;width:20%;text-align:center;color:white" onclick="viewquestions(`<?php echo $a->questions; ?>`)">
                     <?php echo $a->noof_questions; ?>
                  </p>
                </td>
                <td>
                  <p style="background:#c93f58;padding:2%;border-radius:50%;width:20%;text-align:center;color:white"  onclick="viewagent(`<?php echo $a->title; ?>`,`<?php echo $a->emp_id; ?>`)">
                    <?php echo $a->noof_emp_id; ?>
                  </p>
                  <i class="fa fa-plus" style="float:right;font-size:15px;color:#579ef7;cursor:pointer" title="Add Agents" onclick="assignsametest(`<?php echo $i; ?>`,`<?php echo $a->title; ?>`,`<?php echo $a->emp_id; ?>`)"></i>
                </td>
              <td> <?php echo date_format(date_create($a->created_date),"F d-Y"); ?></td>
            </tr>

              <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



</main>

<?php include('sweetalert.php'); ?>

<script>
$('.dt').DataTable({
//  dom: 'lrtip',
  "orderFixed": [ 3, 'desc' ],
  "searching": true
});

$('#transfer1 .param-item').html('Agents');
$( ".viewadddiv" ).click(function() {
  $( ".addquestionview" ).toggle();
});
</script>
<script type="text/javascript">

var data = [];
var selectedagent;

  $.ajax({
    'async': false,
    url : "<?php echo base_url(); ?>leaderAssessment/getagentlist",
    method : "POST",
    success : function(datares){
      res = datares;
    }
  });
  var re = JSON.parse(res);
  var settings1 = {
    "dataArray": re,
    "itemName": "name",
    "valueName": "emp_id",
    "callable": function (items) {
      console.dir(items);
      selectedagent=items;
    }
  };
  $("#transfer1").transfer(settings1);


  var questions=[];
  var a=[];
  var b=[];
  var c=[];
  var d=[];
  var correc=[];

  function addquestion(){
    if($('#title').val() !=''){
      $.ajax({
        url : "<?php echo base_url(); ?>leaderAssessment/checktitle",
        method : "POST",
        data:{"titleval":$('#title').val()},
        success : function(datares){
          if(JSON.parse(datares).length > 0){
             swal("Error", "Title Already Exists", "error");
          }else{

              $('.addquestionModal').modal('show');
          }
        }
      });

    }else{
       swal("Error", "Title Field Required", "error");
    }

  }

  function addandclose(res){

    if($('#addingquestion #question').val() !='' && $('#addingquestion #a').val() != '' && $('#addingquestion #b').val() != '' && $('#addingquestion #c').val() != '' && $('#addingquestion #d').val() != '' && $('#addingquestion #correctans').val() != null){
    questions.push($('#addingquestion #question').val());
      a.push($('#addingquestion #a').val());
      b.push($('#addingquestion #b').val());
      c.push($('#addingquestion #c').val());
      d.push($('#addingquestion #d').val());
      correc.push($('#addingquestion #correctans').val());

      $('#addingquestion #question').val('');
      $('#addingquestion #a').val('');
      $('#addingquestion #b').val('');
      $('#addingquestion #c').val('');
      $('#addingquestion #d').val('');
      $('#addingquestion #correctans').val('');
      printtable();
    }else{
       swal("Error", "All fields are required!", "error");
    }

    if(res == 1){

    }else{
      $('.addquestionModal').modal('hide');
    }
  }

  printtable();
  function printtable(){
    var output='';
    if(questions.length > 0){
    for(var i=0;i<questions.length;i++){
      output +='<tr>';
      output +='<td>'+questions[i]+'</td>';
      output +='<td>'+a[i]+'</td>';
      output +='<td>'+b[i]+'</td>';
      output +='<td>'+c[i]+'</td>';
      output +='<td>'+d[i]+'</td>';
      output +='<td>'+correc[i]+'</td>';
      output +='<td onclick="removefromtable('+i+')"><i class="fa fa-trash" style="color:red"></i></td>';
      output +='</tr>';
    }
    $('.submitbtn').show();
  }else{
    $('.submitbtn').hide();

    output +='<tr><td colspan="7">No Question Found</td></tr>';
  }
    $('#questionprint').html(output);
}

function removefromtable(indexplace){
 if (questions.length > 0) {
    questions.splice(indexplace,1);
    a.splice(indexplace,1);
    b.splice(indexplace,1);
    c.splice(indexplace,1);
    d.splice(indexplace,1);
    correc.splice(indexplace,1);
}
  printtable();
}
function getdata(){
  if(!$('#timing').val()){
    swal("Error","Please set test timing");
    return;
  }
  $('.submitbtn').prop('disabled', true);
  var emp=[];
  selectedagent.forEach((item, i) => {
    //emp.push(item['emp_id']);
    emp.push(item['name']);
  });
  empids=emp.toString();
  $.ajax({
    url : "<?php echo base_url(); ?>leaderAssessment/addquestions",
    method : "POST",
    data:{"empid":empids,"title":$('#title').val(),"questions":questions,"correct":correc,"a":a,"b":b,"c":c,"d":d,"timing":$('#timing').val()},
    success : function(datares){
      console.log(datares);
      if(datares == '"Success"'){
          swal("Success", "Question Added Successfully", "success");
      }else{
        swal("Error", "Question Not Added!!!", "error");
      }
      window.location.reload();
      questions.length = 0;
      correc.length = 0;
      a.length = 0;
      b.length = 0;
      c.length = 0;
      d.length = 0;
      $('#title').val('');
      printtable();
      // window.location.reload();
    }
  });

}

function viewquestions(question){
  $('.questionview').modal('show');
  $.ajax({
    url : "<?php echo base_url(); ?>leaderAssessment/getquestion",
    method : "POST",
    data:{"questions":question},
    success : function(datares){
      console.log(datares);
      var data = JSON.parse(datares);
      var out='';
      for(var i=0;i<data.length;i++){
        out +='<div class="card">';
        out +='<div class="card-body">';
        out += (i+1)+'). '+data[i]['question'];
        out +='<table class="table table-responsive">';
        out +='<tr><td>A)'+data[i]['a']+'</td>';
        out +='<td>B)'+data[i]['b']+'</td>';
        out +='<td>C)'+data[i]['c']+'</td>';
        out +='<td>D)'+data[i]['d']+'</td></tr>';
        out +='</table>';
        out +='<p style="text-align:right">Correct Answer: <span style="color:green;font-size:18px"> '+data[i]['correct'].toUpperCase()+'</span></p>';
        out +='</div>';
        out +='</div>';
      }
      $('.questionview #mainview').html(out);
    }
  });
}

</script>
</div>
<div class="modal fade bd-example-modal-lg questionview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Questions</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="mainview"></div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg agentview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Agents</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="searchagent" style="float:right" placeholder="Search..">
        <table class="table table-bordered agentviewdt" id="agentviewdt">
          <thead>
            <tr>
              <th>Emp ID</th>
              <th>Emp Name</th>
              <th>Status</th>
              <th>Mark</th>
              <th>Date of Complete</th>
            </tr>
          </thead>
          <tbody id="agentviewtable">
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script>

function viewagent(title,emp){
  $('.agentview').modal('show');
  var getagent= emp.split(",");

  $.ajax({
    url : "<?php echo base_url(); ?>leaderAssessment/getagentview",
    method : "POST",
    data:{"empids":getagent,"title":title},
    success : function(datares){
      var getdata= JSON.parse(datares);
      var agentview='';

      for(var i=0;i<getdata.length;i++){
        var status=getdata[i].status;
        if(status == 'Completed'){
          var st='style="margin:5%;padding:5%;border-radius:50%;background:#3fc98e;color:white;text-align:center"';
        }else{
          var st='style="margin:5%;padding:5%;border-radius:50%;background:#3f89c9;color:white;text-align:center"';
        }
        agentview +='<tr>';
        agentview +='<td>'+getdata[i].empid+'</td>';
        agentview +='<td>'+getdata[i].name+'</td>';
        agentview +='<td >'+status+'</td>';
        agentview +='<td>'+getdata[i].mark+'</td>';
        agentview +='<td>'+getdata[i].date+'</td>';
        agentview +='</tr>';
      }

      $('#agentviewtable').html(agentview);

    }
  });

}


$('#searchagent').keyup(function(){
  var search = $(this).val();
  $('#agentviewdt tbody tr').hide();
  var len = $('#agentviewdt tbody tr:not(.notfound) td:contains("'+search+'")').length;
  if(len > 0){
    $('#agentviewdt tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
      $(this).closest('tr').show();
    });
  }else{
    $('.notfound').show();
  }
});
</script>
<div class="modal fade addquestionModal" id="addquestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Questions</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addingquestion">
        <div>
          <p>Question</p>
          <textarea id="question" name="question" class="form-control" rows="5"></textarea>
        </div>
        <br>
        <table class="table table-bordered">
          <tr>
              <td>A <input type="text" name="a" id="a"></td>
              <td>B <input type="text" name="b" id="b"></td>
          </tr>
          <tr>
               <td>C <input type="text" name="c" id="c"></td>
              <td>D <input type="text" name="d" id="d"></td>
          </tr>
        </table>

      <div>
        <p>Correct Answer</p>
        <select id="correctans" name="correctans" class="form-control">
          <option value="a">A</option>
          <option value="b">B</option>
          <option value="c">C</option>
          <option value="d">D</option>
        </select>
      </div>
    </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="addandclose(1)">Save & Add New</button>
        <button type="button" class="btn btn-primary" onclick="addandclose(2)">Save & Close</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function assignsametest(i,title,emp) {
    emplist=emp.split(",");
    var emplist_ar=[];
    emplist.forEach((empdetails) => {
      var emp_list=empdetails.split("/");
      emplist_ar.push(emp_list[0]);
    });
    console.log(emplist_ar);
    var selectedagent_v;
      $.ajax({
        'async': false,
        url : "<?php echo base_url(); ?>leaderAssessment/getagentlist_newadd",
        method : "POST",
        data:{"emp_name":emplist_ar.toString()},
        success : function(datares){
          res = datares;
          $('#addnewagents').modal('show');

          var re = JSON.parse(res);
          var out='';
          for (var i = 0; i < re.length; i++) {
            out +='<option>'+re[i]['name']+'</option>';

          }

           $(".addnewagents #transfer2").html(out);
           $(".addnewagents #transfer2").select2();
          $('.addnewagents #assessmentid').html('<b>'+title+'</b>');
        }
      });
  }
</script>
<div class="modal fade addnewagents" id="addnewagents" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Agent's</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addnewingquestion">
          <p>Assessment ID : <span id="assessmentid"></span></p><br>
          <!-- <div id="transfer2" class="transfer-demo" style="font-size:12px"></div> -->
          <p>Select New Agent</p>
          <select  id="transfer2" name="" class="form-control" multiple style="width:300px;min-height:350px;">

          </select>

    </form>
    </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-success" onclick="addandclose(1)">Save & Add New</button>-->
        <button type="button" class="btn btn-primary" onclick="assignsamequestion()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"  data-target="#addnewagents">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function assignsamequestion() {
    var agents=$('#transfer2').val();
    $.ajax({
      'async': false,
      url : "<?php echo base_url(); ?>leaderAssessment/assign_agentsnew",
      method : "POST",
      data:{"title":$('#assessmentid').text(),"agents":agents.toString()},
      success : function(datares){
        location.reload();
      }
    });
  }
</script>
