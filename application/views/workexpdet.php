<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<style>
.fa-pencil{
  font-size:18px;
  color:red;
  padding-top:10%
}
.fa-eye{
  font-size:18px;
  padding-left:10%;
  color:#3fc98e;
  padding-top:10%
}
select{
  height:50px;
}
</style>
      <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row" >
          <div class="col-md-12 activity">
            <button class="btn btn-sm btn-primary" onclick="addexpeniceBtn()"> Show / Hide Expeience Details</button>
            <br><br><br>
          </div>
          <br>
      <?php } ?>
      <?php $years = range(1960, strftime("%Y", time())); ?>

    <!-- <div class="row activity-row"> -->
      <div class=" col-md-12 addexpbox" style="display: none;">
        <!-- display:none; -->        
        <form action="<?php echo base_url(); ?>Employee_personal/addworkexpenice" method="POST" id="addform" enctype="multipart/form-data">
        <!-- <input type="hidden" id="empid" name="empid"> -->
          <div  id="empdetailadd">
            <div class="card card-body shadow-lg p-3 mb-5 bg-white rounded">
              <div class="row">
              <div class="col-md-3">
                <p >Emp ID</p>
                <!-- <select class="form-control useridval" id="userid"  onchange="viewdata(this)" > -->
                <!-- <select class="form-control useridval" id="userid" name="userid" required onchange="viewempdataexp(this)">
                  <?php if($userdata['role'] != 'agent'){ ?>
                    <option style="display: none;" value="" selected>Select Employee ID</option>
                    <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                    <?php } ?>
                  <?php }else{ ?>
                    <option value="">Select Employee ID</option>
                    <option value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option>
                  <?php } ?>
                </select> -->
                <?php if($userdata['role'] != 'agent'){ ?>
                <select class="form-control useridvalexp" id="userid" required name="userid"  onchange="viewempdataexp()">
                  <option style="display: none;" value="" selected>Select Employee ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                  <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>"><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <input id="useridempagent" name="useridempagent" value="<?php echo $userdata['emp_id'].'/'.$userdata['name']; ?>" readonly>
              <?php } ?>
              </div>
 
              <div class="col-md-3" style="display:none">
                <p >Name</p>
                <input type="text" id="empnameexp" name="empnameexp" class="form-control" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12  table-responsive"><br>
              <!-- <h3>Educational Certifications</h3><br> -->
                <table class="table table-bordered" >
                    <thead>
                      <tr>
                        <th>Previous Organization</th>
                        <th>Process</th>
                        <th>Joining Date</th>
                        <th>Term Date</th>
                        <th>Document</th>
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" id="preCompany1" name="preCompany1" class="form-control"></td>
                        <td><input type="text" id="process1" name="process1" class="form-control"></td>
                        <td><input type="text" id="joiningdate1" name="joiningdate1" class="form-control dtformate1"></td>
                        <td><input type="text" id="termdate1" name="termdate1" class="form-control dtformate2"></td>
                        <td><input type="file" id="expcertificate1" name="expcertificate1"><p id="expDoc1"><p></td>
                      </tr>
                      <tr>
                        <td><input type="text" id="preCompany2" name="preCompany2" class="form-control"></td>
                        <td><input type="text" id="process2" name="process2" class="form-control"></td>
                        <td><input type="text" id="joiningdate2" name="joiningdate2" class="form-control dtformate3"></td>
                        <td><input type="text" id="termdate2" name="termdate2" class="form-control dtformate4"></td>
                        <td><input type="file" id="expcertificate2" name="expcertificate2"><p id="expDoc2"><p></td>
                      </tr>
                      <tr>
                        <td><input type="text" id="preCompany3" name="preCompany3" class="form-control"></td>
                        <td><input type="text" id="process3" name="process3" class="form-control"></td>
                        <td><input type="text" id="joiningdate3" name="joiningdate3" class="form-control dtformate5"></td>
                        <td><input type="text" id="termdate3" name="termdate3" class="form-control dtformate6"></td>
                        <td><input type="file" id="expcertificate3" name="expcertificate3"><p id="expDoc3"><p></td>
                      </tr>
                    </tbody>
                </table>   
                <br>
              
              </div>
              </div>
            </div>
        
            <div class="col-md-12 viewforadmin" style="padding-left: 40%">
                <input type="submit" class="check-in" style="margin-left:10px;float:left">
                <input type="reset" class="check-in" style="background-color: red">
              </div>
            </div>
          </form>
          </div>
        </div>

<script>  
function addexpeniceBtn(){
 $('.addexpbox').toggle();
}

$(".dtformate1").datepicker({
      altField: ".dtformate1",
      altFormat: "M d, yy"
});
$(".dtformate2").datepicker({
      altField: ".dtformate2",
      altFormat: "M d, yy"
});
$(".dtformate3").datepicker({
      altField: ".dtformate3",
      altFormat: "M d, yy"
});
$(".dtformate4").datepicker({
      altField: ".dtformate4",
      altFormat: "M d, yy"
});
$(".dtformate5").datepicker({
      altField: ".dtformate5",
      altFormat: "M d, yy"
});
$(".dtformate6").datepicker({
      altField: ".dtformate6",
      altFormat: "M d, yy"
});

$(document).ready(function() {
  $('.addexpbox,#empdetailadd').show();
  $('#userid').select2({width: 'resolve'});
});
viewempdataexp();
function viewempdataexp(){

  var emp_id_get = $(".useridvalexp").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get == ''){
    selectedValue=$('#useridempagent').val();  
  }else{
    selectedValue=emp_id_get;
  }
  var dataset =selectedValue.split("/");

  $('#empnameexp').val(dataset[1]);
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>employee_personal/getexpdetials',
    data   : {id:dataset[0]},
    dataType: 'json',
    success : function(data){
      if(data.length > 0){
      console.log(data);
        $('#preCompany1').val(data[0]['organization1']);
        $('#preCompany2').val(data[0]['organization2']);
        $('#preCompany3').val(data[0]['organization3']);

        $('#process1').val(data[0]['process1']);
        $('#process2').val(data[0]['process2']);
        $('#process3').val(data[0]['process3']);

        $('#joiningdate1').datepicker('setDate', formatDate(data[0]['doj1']));
        $('#joiningdate2').datepicker('setDate', formatDate(data[0]['doj2']));
        $('#joiningdate3').datepicker('setDate', formatDate(data[0]['doj3']));

        $('#termdate1').datepicker('setDate', formatDate(data[0]['termdate1']));
        $('#termdate2').datepicker('setDate', formatDate(data[0]['termdate2']));
        $('#termdate3').datepicker('setDate', formatDate(data[0]['termdate3']));

      if(data[0]['Doc1'] !=''){
        var docname=data[0]["Doc1"];
        var doc1 = '<a href="<?php echo base_url();?>documents/educatprofessional_experienceion/'+docname+'" target="_blank">'+docname+'</a>';
        $('#expDoc1').html(doc1);
      }else{
        $('#expDoc1').html('');
      }
      if(data[0]['Doc2'] !=''){
        var docname=data[0]["Doc2"];
        var doc1 = '<a href="<?php echo base_url();?>documents/professional_experience/'+docname+'" target="_blank">'+docname+'</a>';
        $('#expDoc2').html(doc1);
      }else{
        $('#expDoc2').html('');
      }
      if(data[0]['Doc3'] !=''){
        var docname=data[0]["Doc3"];
        var doc1 = '<a href="<?php echo base_url();?>documents/professional_experience/'+docname+'" target="_blank">'+docname+'</a>';
        $('#expDoc3').html(doc1);
      }else{
        $('#expDoc3').html('');
      }
      }else{
        $('#preCompany1').val('');
        $('#preCompany2').val('');
        $('#preCompany3').val('');

        $('#process1').val('');
        $('#process2').val('');
        $('#process3').val('');

        $('#joiningdate1').val('');
        $('#joiningdate2').val('');
        $('#joiningdate3').val('');

        $('#termdate1').val('');
        $('#termdate2').val('');
        $('#termdate3').val('');

        $('#expDoc1').html('');
    
        $('#expDoc2').html('');
     
        $('#expDoc3').html('');
     
      }
        
    }
  });
}
</script>



