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
     
<div class="row activity-row" >
  <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
    <div class="col-md-12 activity">
      <button class="btn btn-sm btn-primary" onclick="addeducationBtn()"> Show / Hide Education Details</button>
      <br><br><br>
    </div>
    <br>
  <?php } ?>
  <?php $years = range(1960, strftime("%Y", time())); ?>
  <div class=" col-md-12 addeducationbox" style="display: none;">
    <form action="<?php echo base_url(); ?>Employee_personal/addeducation" method="POST" id="addformeduc" enctype="multipart/form-data">
      <div  id="empdetailadd">
        <div class="card card-body shadow-lg p-3 mb-5 bg-white rounded">
          <div class="row">
            <div class="col-md-3">
              <p >Emp ID</p>
              <?php if($userdata['role'] != 'agent'){ ?>
                <select class="form-control useridvaledu" id="userid" required name="userid"  onchange="viewempdataedu()">
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
              <input type="text" id="empnameedu" name="empnameedu" class="form-control" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12  table-responsive"><br>
              <h3>Educational Certifications</h3><br>
              <table class="table table-bordered table-hover " >
                <thead>
                  <tr>
                    <th>School/University</th>
                    <th>Course</th>
                    <th>Percentage</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                    <th>Document</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" id="empSchooluniver1" name="empSchooluniver1" class="form-control"></td>
                    <td><input type="text" id="empCourse1" name="empCourse1" class="form-control"></td>
                    <td><input type="text"  pattern="[0-9%]+" id="empPercen1" name="empPercen1" class="form-control"></td>
                    <td>
                      <select class="dis_readonly" id="empstartdate1" name="empstartdate1">
                        <option value="">Select Year</option>
                        <?php foreach($years as $year) : ?>
                          <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                        <?php endforeach; ?>
                      </select>  
                    </td>
                    <td>
                    <select  class="dis_readonly" id="empenddate1" name="empenddate1">
                      <option value="">Select Year</option>
                        <?php foreach($years as $year) : ?>
                          <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                        <?php endforeach; ?>
                      </select>  
                    </td>
                    <td>
                      <input type="file" id="empDocument1" name="empDocument1"><p id="eduDoc1" accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p></td>
                  </tr>
                  <tr>
                    <td><input type="text" id="empSchooluniver2" name="empSchooluniver2" class="form-control"></td>
                    <td><input type="text" id="empCourse2" name="empCourse2" class="form-control"></td>
                    <td><input type="text"  pattern="[0-9%]+" id="empPercen2" name="empPercen2" class="form-control"></td>
                    <td>
                      <select  class="dis_readonly" id="empstartdate2" name="empstartdate2">
                        <option value="">Select Year</option>
                        <?php foreach($years as $year) : ?>
                          <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                        <?php endforeach; ?>
                      </select>  
                    </td>
                    <td>
                      <select  class="dis_readonly" id="empenddate2" name="empenddate2">
                        <option value="">Select Year</option>
                        <?php foreach($years as $year) : ?>
                        <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                        <?php endforeach; ?>
                      </select>  
                      </td>
                      <td><input type="file" id="empDocument2" name="empDocument2"><p id="eduDoc2" accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p></td>
                    </tr>
                    <tr>
                      <td><input type="text" id="empSchooluniver3" name="empSchooluniver3" class="form-control"></td>
                      <td><input type="text" id="empCourse3" name="empCourse3" class="form-control"></td>
                      <td><input type="text"  pattern="[0-9%]+" id="empPercen3" name="empPercen3" class="form-control"></td>
                      <td>
                        <select  class="dis_readonly" id="empstartdate3" name="empstartdate3" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td>
                        <select  class="dis_readonly" id="empenddate3" name="empenddate3" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select>  
                      </td>
                      <td><input type="file" id="empDocument3" name="empDocument3"><p id="eduDoc3"><p></td>
                    </tr>
                    <tr>
                      <td><input type="text" id="empSchooluniver4" name="empSchooluniver4" class="form-control"></td>
                      <td><input type="text" id="empCourse4" name="empCourse4" class="form-control"></td>
                      <td><input type="text"  pattern="[0-9%]+" id="empPercen4" name="empPercen4" class="form-control"></td>
                      <td>
                        <select  class="dis_readonly" id="empstartdate4" name="empstartdate4" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td>
                        <select  class="dis_readonly" id="empenddate4" name="empenddate4" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td><input type="file" id="empDocument4" name="empDocument4"><p id="eduDoc4" accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p></td>
                    </tr>
                    <tr>
                      <td><input type="text" id="empSchooluniver5" name="empSchooluniver5" class="form-control"></td>
                      <td><input type="text" id="empCourse5" name="empCourse5" class="form-control"></td>
                      <td><input type="text"  pattern="[0-9%]+" id="empPercen5" name="empPercen5" class="form-control"></td>
                      <td>
                        <select  class="dis_readonly" id="empstartdate5" name="empstartdate5" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td>
                        <select  class="dis_readonly" id="empenddate5" name="empenddate5" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td><input type="file" id="empDocument5" name="empDocument5"><p id="eduDoc5" accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p></td>
                    </tr>
                  </tbody>
                </table>   
                <br>
                <h3>Other Professional Certifications</h3>
                <table class="table table-bordered" >
                  <thead>
                    <tr>
                      <th>Institute</th>
                      <th>Course</th>
                      <th>Percentage</th>
                      <th>Start Year</th>
                      <th>End Year</th>
                      <th>Document</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" id="empSchooluniverOther1" name="empSchooluniverOther1" class="form-control"></td>
                      <td><input type="text" id="empCourseOther1" name="empCourseOther1" class="form-control"></td>
                      <td><input type="text"  pattern="[0-9%]+" id="empPercenOther1" name="empPercenOther1" class="form-control"></td>
                      <td>
                        <select  class="dis_readonly" id="empstartdateOther1" name="empstartdateOther1" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td>
                        <select  class="dis_readonly"  id="empenddateOther1" name="empenddateOther1" >
                          <option value="">Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td><input type="file" id="empDocumentOther1" name="empDocumentOther1"><p id="othereduDoc1"  accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p></td>
                    </tr>
                    <tr>
                      <td><input type="text" id="empSchooluniverOther2" name="empSchooluniverOther2" class="form-control"></td>
                      <td><input type="text" id="empCourseOther2" name="empCourseOther2" class="form-control"></td>
                      <td><input type="text"  pattern="[0-9%]+" id="empPercenOther2" name="empPercenOther2" class="form-control"></td>
                      <td>
                        <select class="dis_readonly" id="empstartdateOther2" name="empstartdateOther2">
                        <option>Select Year</option>
                          <?php foreach($years as $year) : ?>
                           <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td>
                        <select  class="dis_readonly" id="empenddateOther2" name="empenddateOther2" >
                          <option>Select Year</option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>" ><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select> 
                      </td>
                      <td><input type="file" id="empDocumentOther2" name="empDocumentOther2"  accept=".jpg, .jpeg, .png, .gif, .pdf, .doc"><p id="othereduDoc2"><p></td>
                    </tr>
                  </tbody>
                </table>         
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
</div>


<script>  
function addeducationBtn(){
 $('.addeducationbox').toggle();
}

$(document).ready(function() {
  $('.addeducationbox,#empdetailadd').show();
  $('.useridvaledu').select2({width: 'resolve'});
});
viewempdataedu()
function viewempdataedu(){
  
  var selectedValue;
  var emp_id_get = $(".useridvaledu").children("option:selected").val();
  if(emp_id_get == undefined || emp_id_get == ''){
    selectedValue=$('#useridempagent').val();  
  }else{
    selectedValue=emp_id_get;
  }
  
  var dataset =selectedValue.split("/");

  $('#empnameedu').val(dataset[1]);
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>employee_personal/getempEducationdetails',
    data   : {id:dataset[0]},
    dataType: 'json',
    success : function(data){
      if(data.length > 0){
       $('#empSchooluniver1').val(data[0]['University1']);
       $('#empSchooluniver2').val(data[0]['University2']);
       $('#empSchooluniver3').val(data[0]['University3']);
       $('#empSchooluniver4').val(data[0]['University4']);
       $('#empSchooluniver5').val(data[0]['University5']);

       $('#empSchooluniverOther1').val(data[0]['Institute']);
       $('#empSchooluniverOther2').val(data[0]['Other_Institute2']);

       $('#empCourse1').val(data[0]['Course1']);
       $('#empCourse2').val(data[0]['Course2']);
       $('#empCourse3').val(data[0]['Course3']);
       $('#empCourse4').val(data[0]['Course4']);
       $('#empCourse5').val(data[0]['Course5']);

       $('#empCourseOther1').val(data[0]['Other_Course1']);
       $('#empCourseOther2').val(data[0]['Other_Course2']);

       $('#empPercen1').val(data[0]['Percentage1']);
       $('#empPercen2').val(data[0]['Percentage2']);
       $('#empPercen3').val(data[0]['Percentage3']);
       $('#empPercen4').val(data[0]['Percentage4']);
       $('#empPercen5').val(data[0]['Percentage5']);
       
       $('#empPercenOther1').val(data[0]['Other_Percentage1']);
       $('#empPercenOther2').val(data[0]['Other_Percentage2']);

       $('#empstartdate1').val(data[0]['StartYear1']);
       $('#empstartdate2').val(data[0]['StartYear2']);
       $('#empstartdate3').val(data[0]['StartYear3']);
       $('#empstartdate4').val(data[0]['StartYear4']);
       $('#empstartdate5').val(data[0]['StartYear5']);

       $('#empstartdateOther1').val(data[0]['Other_startyr1']);
       $('#empstartdateOther2').val(data[0]['Other_startyr2']);

       $('#empenddate1').val(data[0]['EndYear1']);
       $('#empenddate2').val(data[0]['EndYear2']);
       $('#empenddate3').val(data[0]['EndYear3']);
       $('#empenddate4').val(data[0]['EndYear4']);
       $('#empenddate5').val(data[0]['EndYear5']);

       $('#empenddateOther1').val(data[0]['Other_endyr1']);
       $('#empenddateOther2').val(data[0]['Other_endyr2']);

      if(data[0]['Doc1'] !=''){
        var docname=data[0]["Doc1"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc1').html(doc1);
      }else{
        $('#eduDoc1').html('');
      }
      if(data[0]['Doc2'] !=''){
        var docname=data[0]["Doc2"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc2').html(doc1);
      }else{
        $('#eduDoc2').html('');
      }
      if(data[0]['Doc3'] !=''){
        var docname=data[0]["Doc3"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc3').html(doc1);
      }else{
        $('#eduDoc3').html('');
      }
      if(data[0]['Doc4'] !=''){
        var docname=data[0]["Doc4"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc4').html(doc1);
      }else{
        $('#eduDoc4').html('');
      }
      if(data[0]['Doc5'] !=''){
        var docname=data[0]["Doc5"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc5').html(doc1);
      }else{
        $('#eduDoc5').html('');
      }

      if(data[0]['Doc5'] !=''){
        var docname=data[0]["Doc5"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#eduDoc5').html(doc1);
      }else{
        $('#eduDoc5').html('');
      }

      if(data[0]['Other_doc1'] !=''){
        var docname=data[0]["Other_doc1"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#othereduDoc1').html(doc1);
      }else{
        $('#othereduDoc1').html('');
      }
      if(data[0]['Other_doc2'] !=''){
        var docname=data[0]["Other_doc2"];
        var doc1 = '<a href="<?php echo base_url();?>documents/education/'+docname+'" target="_blank">'+docname+'</a>';
        $('#othereduDoc2').html(doc1);
      }else{
        $('#othereduDoc2').html('');
      }
      }else{
        $('#empSchooluniver1').val('');
       $('#empSchooluniver2').val('');
       $('#empSchooluniver3').val('');
       $('#empSchooluniver4').val('');
       $('#empSchooluniver5').val('');

       $('#empSchooluniverOther1').val('');
       $('#empSchooluniverOther2').val('');

       $('#empCourse1').val('');
       $('#empCourse2').val('');
       $('#empCourse3').val('');
       $('#empCourse4').val('');
       $('#empCourse5').val('');

       $('#empCourseOther1').val('');
       $('#empCourseOther2').val('');

       $('#empPercen1').val('');
       $('#empPercen2').val('');
       $('#empPercen3').val('');
       $('#empPercen4').val('');
       $('#empPercen5').val('');
       
       $('#empPercenOther1').val('');
       $('#empPercenOther2').val('');

       $('#empstartdate1').val('');
       $('#empstartdate2').val('');
       $('#empstartdate3').val('');
       $('#empstartdate4').val('');
       $('#empstartdate5').val('');

       $('#empstartdateOther1').val('');
       $('#empstartdateOther2').val('');

       $('#empenddate1').val('');
       $('#empenddate2').val('');
       $('#empenddate3').val('');
       $('#empenddate4').val('');
       $('#empenddate5').val('');

       $('#empenddateOther1').val('');
       $('#empenddateOther2').val('');

      
        $('#eduDoc1').html('');
        $('#eduDoc2').html('');
        $('#eduDoc3').html('');
        $('#eduDoc4').html('');
        $('#eduDoc5').html('');
        $('#eduDoc5').html('');
        $('#othereduDoc1').html('');
        $('#othereduDoc2').html('');
      }
        
    }
  });
}
</script>

