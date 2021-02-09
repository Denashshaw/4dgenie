
<div class="page-wrapper chiller-theme toggled">
<style>

    .transfer-demo {
            width: 640px;
            height: 400px;
            margin: 0 auto;
        }
</style>
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
  <div class="container-fluid p-0">
    <?php include('page_head.php');?>
   
     <div class="row emp-table ">
      <div class="col-md-7 table-responsive" >
        <p>Add Agents</p>
          <div id="transfer1" class="transfer-demo"></div>

      </div>
      <div class="col-md-5" >
        <p>Add Questions</p>
        <!-- <button class="btn btn-success" onclick="addquestion()">Add Question</button> -->
        <i class="fa fa-plus" style="font-size:60px;margin-top:30%;margin-left:45%;color:green;cursor:pointer;" onclick="addquestion()"></i>
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
        <input type="button" value="Submit" class="btn btn-primary submitbtn">
      </div>
    </div>
  </div>


  <div class="modal fade addquestion" id="addquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Quiestions</h3>
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
</main>

<?php include('sweetalert.php'); ?>

<script>
$('#transfer1 .param-item').html('Agents');
</script>
<script type="text/javascript">

var data = [];


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
      console.dir(items)
    }
  };
  $("#transfer1").transfer(settings1);

</script>
<script>
  var questions=[];
  var a=[];
  var b=[];
  var c=[];
  var d=[];
  var correc=[];
  function addquestion(){
    $('.addquestion').modal('show');
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
      $('.addquestion').modal('hide');
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
</script>
</div>
