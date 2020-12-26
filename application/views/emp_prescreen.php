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
    <button class="btn btn-sm btn-primary" onclick="addprescreening()"> Show / Hide Pre-Screening Details</button>
    <br><br><br>
  </div>
  <br>
  <?php } ?>
  <div class=" col-md-12 addprescreenview" style="display: none;">
    <form action="<?php echo base_url(); ?>Employee_personal/addprescreening" method="POST" id="addform" enctype="multipart/form-data">
      <div  id="empdetailadd">
        <div class="card card-body shadow-lg p-3 mb-5 bg-white rounded">
          <div class="row">
            <div class="col-md-3">
              <p >Name</p>
              <input type="text" id="interviewempname" name="interviewempname" class="form-control"><br>
              <p >Phone Number</p>
              <input type="text" id="interPhone" name="interPhone" class="form-control"><br>
              <p >Source</p>
              <input type="text" id="interSource" name="interSource" class="form-control">
            </div>
            <div class="col-md-3">
              <p style="padding-top:45%" >Email</p>
              <input type="email" id="emailid" name="emailid" class="form-control"><br>
              <p >Reffered By</p>
              <select class="form-control useridval" id="userid" name="userid" style="width:250px">
                <option value="">Select Employee ID</option>
                <?php foreach ($emp_data as $emp) { ?>
                  <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <ul class="list-group shadow-lg  bg-white rounded">
                <li class="list-group-item emp_img_div">
                  <b>Image: &nbsp; </b>
                  <label class="btn btn-sm btn-info col-4 mt-2">
                  <span class="update_text">Upload</span>
                  <input type='file' id="emp_photo" name="emp_photo" accept=".jpeg,.jpg,.png" hidden/>
                  </label>
                  <button type="button" class="btn btn-sm btn-danger view_img col-4" aria-hidden="true" data-toggle="modal" data-target="#emp_photo_modal" style="display: none;">
                  View</button><br>
                </li>
                <li class="list-group-item resume_div">
                  <b>Resume: </b>
                  <label class="btn btn-sm btn-info col-4 mt-2">
                  <span class="update_text">Upload</span>
                  <input type='file' id="resume" name="resume" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                  </label>
                  <button type="button" class="btn btn-sm btn-danger view_resume col-4" aria-hidden="true" data-toggle="modal" data-target="#resume_view_modal" style="display: none;">
                  View</button><br>
                </li>
                <li class="list-group-item aadhar_div">
                  <b>Aadhar: </b>
                  <label class="btn btn-sm btn-info col-4 mt-2">
                  <span class="update_text">Upload</span>
                  <input type='file' id="aadhar" name="aadhar" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                  </label>
                  <button type="button" class="btn btn-sm btn-danger col-4 view_aadhar" aria-hidden="true" data-toggle="modal" data-target="#aadhar_view_modal" style="display: none;">
                  View</button><br>
                </li>
                <li class="list-group-item pan_div">
                  <b>PAN: &nbsp; &nbsp; &nbsp;</b>
                  <label class="btn btn-sm btn-info col-4 mt-2">
                  <span class="update_text">Upload</span>
                  <input type='file' id="pan" name="pan" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                  </label>
                  <button type="button" class="btn btn-sm btn-danger col-4 view_pan" aria-hidden="true" data-toggle="modal" data-target="#pan_view_modal" style="display: none;">
                  View</button><br>
                </li>
              </ul>
            </div>
          </div>
        <div class="row">
          <div class="col-md-12  table-responsive"><br>
            <h3>Interview Status</h3><br>
            <table class="table table-bordered" >
              <tbody>
                <tr>
                  <td>
                    <p>Interviewed for Process</p>
                    <input type="text" id="interviewedforprocess" name="interviewedforprocess" class="form-control">
                  </td>
                  <td>
                    <p>Interviewed by (HR)</p>
                    <select class="form-control useridval" id="useridinterviewedHR" name="useridinterviewedHR" style="width:250px">
                      <option value="">Select Employee ID</option>
                      <?php foreach ($emp_data as $emp) { ?>
                        <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                  <p>Interview Date</p>
                    <input type="date" id="interdate" name="interdate" class="form-control">
                  </td>
                  <td>
                    <p>Status</p>
                    <select class="form-control useridval" id="selecthrstatus" name="selecthrstatus" style="width:250px">
                      <option value="">Select Status</option>
                      <option value="Selected">Selected</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Interviewed by</p>
                    <select class="form-control useridval" id="useridinterviewed1" name="useridinterviewed1" style="width:250px">
                      <option value="">Select Employee ID</option>
                      <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <p>Status</p>
                    <select class="form-control useridval" id="selecthrstatus1" name="selecthrstatus1" style="width:250px">
                      <option value="">Select Status</option>
                      <option value="Selected">Selected</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                  </td>
                  <td>
                    <p>Interview Date</p>
                    <input type="date" id="interdate1" name="interdate1" class="form-control">
                  </td>
                  <td>
                    <p>Feedback</p>
                    <textarea id="feedback1" name="feedback1" class="form-control"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Interviewed by</p>
                    <select class="form-control useridval" id="useridinterviewed2" name="useridinterviewed2" style="width:250px">
                      <option value="">Select Employee ID</option>
                      <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <p>Status</p>
                    <select class="form-control useridval" id="selecthrstatus2" name="selecthrstatus2" style="width:250px">
                      <option value="">Select Status</option>
                      <option value="Selected">Selected</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                  </td>
                  <td>
                    <p>Interview Date</p>
                    <input type="date" id="interdate2" name="interdate2" class="form-control">
                  </td>
                  <td>
                    <p>Feedback</p>
                    <textarea id="feedback2" name="feedback2" class="form-control"></textarea>
                  </td>
                  </tr>
                </tbody>
              </table>   
              <br>
            </div>
          </div>
        </div>
        <div class="col-md-12" style="padding-left: 40%">
          <input type="submit" class="check-in" style="margin-left:10px;float:left">
          <input type="reset" class="check-in" style="background-color: red">
        </div>
      </div>
    </form>
    <h3>Pre-Screening History</h3>
    <div class="col-md-12 table-responsive" >
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th>S.No</th>
            <th>ID </th>
            <th>Name</th>
            <th>Status</th>
            <th>Phone No</th>
            <th>Email ID</th>
            <th>Source</th>
            <th>Referred By</th>
            <th>Interviewed For Process</th>
            <th>Interviewed By HR</th>
            <th>Interview Date</th>
            <th>Interviewed By - I</th>
            <th>Interview Status - I</th>
            <th>Interview Date - I</th>
            <th>Feedback - I</th>
            <th>Interviewed By - II</th>
            <th>Interview Status - II</th>
            <th>Interview Date - II</th>
            <th>Feedback - II</th>
            <th>Photo</th>
            <th>Resume</th>
            <th>Aadhar</th>
            <th>Pan</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i=0;
            foreach($prescreening as $a){ ?>
            <tr>
              <td><?php echo $i+1; ?></td>
              <td><?php echo $a->Temp_id; ?></td>
              <td><?php echo $a->Name; ?></td>
              <td><?php echo $a->HRStatus; ?></td>
              <td><?php echo $a->Phone; ?></td>
              <td><?php echo $a->Emailid; ?></td>
              <td><?php echo $a->Source; ?></td>
              <td><?php echo $a->Ref_id."/".$a->Ref_name; ?></td>
              <td><?php echo $a->Interviewed_for_Process; ?></td>
              <td><?php echo $a->Interviewed_byHR; ?></td>
              <td><?php echo $a->Interdate; ?></td>
              <td><?php echo $a->Interviewed1; ?></td>
              <td><?php echo $a->Status1; ?></td>
              <td><?php echo $a->InterviewDate1; ?></td>
              <td><?php echo $a->Feedback1; ?></td>
              <td><?php echo $a->Interviewed2; ?></td>
              <td><?php echo $a->Status2; ?></td>
              <td><?php echo $a->InterviewDate2; ?></td>
              <td><?php echo $a->Feedback2; ?></td>
              <td><a href="<?php echo base_url(); ?>/documents/prescreening/<?php echo $a->emp_photo; ?>"  target="_blank"><?php echo $a->emp_photo; ?></td>
              <td><a href="<?php echo base_url(); ?>/documents/prescreening/<?php echo $a->resume; ?>"  target="_blank"><?php echo $a->resume; ?></td>
              <td><a href="<?php echo base_url(); ?>/documents/prescreening/<?php echo $a->aadhar; ?>"  target="_blank"><?php echo $a->aadhar; ?></td>
              <td><a href="<?php echo base_url(); ?>/documents/prescreening/<?php echo $a->pan; ?>" target="_blank"><?php echo $a->pan; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

   
<script>  
function addprescreening(){
 $('.addprescreenview').toggle();
}

$(document).ready(function() {
  $('.addprescreenview,#empdetailadd').show();
  $('#userid').select2({width: 'resolve'});
  $('#useridinterviewedHR').select2({width: 'resolve'});
  $('#useridinterviewed1').select2({width: 'resolve'});
  $('#useridinterviewed2').select2({width: 'resolve'});
});

function viewempdataprescreen(data){

  var selectBox =data;

  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var dataset =selectedValue.split("/");

  $('#empnamepre').val(dataset[1]);
  $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>employee_personal/getempEducationdetails',
    data   : {id:dataset[0]},
    dataType: 'json',
    success : function(data){
      console.log(data);
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
        
    }
  });
}
</script>

