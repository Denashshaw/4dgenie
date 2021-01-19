  <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('css/select2.min.css') ?>" />

  <script src="<?php echo base_url();?>js/select2.min.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>

      <div class="row activity-row" >
        <!-- <div class="col-md-12 activity">
          <button class="btn btn-sm btn-primary" onclick="addinfoBtn()"> Show / Hide Personal Details</button>
          <br><br>
        </div> -->      
    <!-- <div class="row activity-row"> -->
      <div class=" col-md-12 addinfobox" style="display: none;">
        <!-- display:none; -->        
        <form autocomplete="off" method="POST" id="addform" enctype="multipart/form-data" action="<?php echo base_url('EmpDetailsAdd');?>">
          <input type="hidden" id="empid" name="empid" value="" />
          <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
          <div  id="empdetailadd">
            <div class="card card-body shadow-lg p-3 mb-5 bg-white rounded">
              <div class="row first_div">
              <div class="col-md-3">
                <p>Employee ID</p>
                <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
                <select class="form-control useridval" id="userid" required onchange="viewdata(this)">
                  <option style="display: none;" value="" selected>Select Employee ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo $emp->emp_id.'/'.$emp->name; ?></option>
                  <?php } ?>
                </select>
                <?php } else { ?>
                  <input type="text" name="" value="<?php echo $_SESSION['emp_id'] .'/'. $_SESSION['name']; ?>" class="form-control useridval" id="userid">                   
                  <?php } ?>
              </div>
 
              <div class="col-md-3 secret_div">
                <p >Name</p>
                <input type="text" id="empname" name="empname" class="form-control" required>
              </div>
     
              <div class="col-md-3 secret_div">
                <p >DOB</p>
                  <input type="date"  id="dob" name="dob" class="form-control" required>
              </div>
              <div class="col-md-3 secret_div">
                <p >Mobile</p>
                  <input type="text"  id="phno" name="phno" class="form-control" required>
              </div>
              </div>

              <div class="row secret_div">
                <div class="col-md-3">
                  <p >Email</p>
                    <input type="email"  id="personalEmail" name="personalEmail" class="form-control">
                </div>
   
                <div class="col-md-3">
                  <p >Transportation</p>
                  <!-- <input type="text"   id="transOffice" name="transOffice" class="form-control"> -->
                  <select name="transOffice" id="transOffice" class="col-md-12 col-xs-12 form-control">
                    <option style="display: none;" value="" selected>Select Transportation</option>
                    <option value="company">Company Transportation</option>
                    <option value="own">Own Transportation</option>
                    <option value="public">Public Transportation</option>
                  </select>
                </div>
     
              <div class="col-md-3 transRoute">
                <p>Route</p>
                    <input type="text" id="transRoute" name="transRoute" class="form-control">
              </div>

              </div>
            </div>

            <div class="card shadow-lg p-3 mb-5 bg-white rounded secret_div">
              <div class="card-body">
                <div class="row second_div">
                  <div class="col-md-3">
                    <p >Current Team</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="currentTeam" name="currentTeam" >
                      
                  </div>
                  <div class="col-md-3">
                    <p >Designation</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="designation" name="designation" >
                  </div>

                  <div class="col-md-3">
                    <p >Joining Date</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="date"  id="joiningDate" name="joiningDate" >
                  </div>

                  <div class="col-md-3">
                    <p >Probation Period</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="probationPeriod" name="probationPeriod" value="90">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <p >Probation End Date</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="date"  id="probationEnd" name="probationEnd" readonly="">
                  </div>
                  
                  <div class="col-md-3">
                    <p >Term Date:</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="date"  id="termDate" name="termDate" >
                  </div>
                </div>
              </div>
            </div>

            <div class="row secret_div">
              <div class="col-md-4">
                
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header"><b>Current Residential Address</b></div>
                    <div class="card-body">

                    <div class="row">
                      <div class="col-md-12" style="padding-top:12%">
                        <p >Address Line 1:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="address1" name="address1" >
                      </div>
                      <div class="col-md-12">
                        <p >Address Line 2:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="address2" name="address2" >
                      </div>
                      <div class="col-md-12">
                        <p >Landmark:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="landmark" name="landmark" >
                      </div>
                      <div class="col-md-6">
                        <p >City:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="city" name="city" >
                      </div>
                      <div class="col-md-6">
                        <p >Pin Code:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="pincode" name="pincode">
                      </div>
                    </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                  <div class="card-header"><b>Permanent Residential Address</b></div>
                <div class="card-body">
                  <div class="row" >
                    <input type="checkbox" id="sameCuurent" name="sameCuurent" onclick="placevalue()">
                    <label for="sameCuurent" style="font-size:17px;padding-top:1%;"> &nbsp;&nbsp;Same Current Residential Address</label>
                    <div class="col-md-12">
                      <p >Address Line 1:</p>
                      <input class="col-md-12 col-xs-12 form-control"  type="text"  id="PersAddress1" name="PersAddress1" >
                    </div>
                    <div class="col-md-12">
                      <p >Address Line 2:</p>
                      <input class="col-md-12 col-xs-12 form-control"  type="text"  id="PersAddress2" name="PersAddress2" >
                    </div>
                    <div class="col-md-12">
                      <p >Landmark:</p>
                      <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Perslandmark" name="Perslandmark"  >
                    </div>
                    <div class="col-md-6">
                      <p >City:</p>
                      <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Perscity" name="Perscity" >
                    </div>
                    <div class="col-md-6">
                      <p >Pin Code:</p>
                      <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="Perspincode" name="Perspincode" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-md-4 ">
                <table class="table shadow-lg p-3 mb-5 bg-white rounded">
                  <tr>
                    <td><i class="fa fa-whatsapp social" title="Whatsapp" aria-hidden="true" data-toggle="modal" data-target="#social_modal" style="font-size:20px;color:#4FCE5D;cursor: pointer;"></i></td>
                    <td><i class="fa fa-facebook-square social" title="Facebook" aria-hidden="true" data-toggle="modal" data-target="#social_modal" style="font-size:20px;color:#3578E5;cursor: pointer;"></i></td>
                    <td><i class="fa fa-pinterest social" title="Pinterest" aria-hidden="true" data-toggle="modal" data-target="#social_modal" style="font-size:20px;color:c8232c;cursor: pointer;"></i></td>
                    <td><i class="fa fa-twitter social" title="Twitter" aria-hidden="true" data-toggle="modal" data-target="#social_modal" style="font-size:20px;color:#3578E5;cursor: pointer;"></i></td>
                    <td><i class="fa fa-linkedin social" title="Linkedin" aria-hidden="true" data-toggle="modal" data-target="#social_modal" style="font-size:20px;color:#0e76a8;cursor: pointer;"></i></td>
                    <!-- <td><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:black"></i></td> -->
                  </tr>
                </table>
                <ul class="list-group shadow-lg p-4 mb-5 bg-white rounded">
                  <li class="list-group-item emp_img_div">
                    <b>Photo: &nbsp; </b>
                    <label class="btn btn-sm btn-info col-4 mt-2">
                      <span class="update_text">Upload</span>
                      <input type='file' id="emp_photo" name="emp_photo" accept=".jpeg,.jpg,.png" hidden/>
                    </label>
                    <button type="button" class="btn btn-sm btn-danger view_img col-4" aria-hidden="true" data-toggle="modal" data-target="#emp_photo_modal" style="display: none;">
                    View</button><br>
                    <span class="empty_img_err">No document uploaded</span>
                  </li>
                  <li class="list-group-item resume_div">
                    <b>Resume: </b>
                    <label class="btn btn-sm btn-info col-4 mt-2">
                      <span class="update_text">Upload</span>
                      <input type='file' id="resume" name="resume" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                    </label>
                    <button type="button" class="btn btn-sm btn-danger view_resume col-4" aria-hidden="true" data-toggle="modal" data-target="#resume_view_modal" style="display: none;">
                    View</button><br>
                    <span class="empty_img_err">No document uploaded</span>
                  </li>
                  <li class="list-group-item aadhar_div">
                    <b>Aadhar: </b>
                    <label class="btn btn-sm btn-info col-4 mt-2">
                      <span class="update_text">Upload</span>
                      <input type='file' id="aadhar" name="aadhar" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                    </label>
                    <button type="button" class="btn btn-sm btn-danger col-4 view_aadhar" aria-hidden="true" data-toggle="modal" data-target="#aadhar_view_modal" style="display: none;">
                      View</button><br>
                    <span class="empty_img_err">No document selected</span>
                  </li>
                  <li class="list-group-item pan_div">
                    <b>PAN: &nbsp; &nbsp; &nbsp;</b>
                    <label class="btn btn-sm btn-info col-4 mt-2">
                      <span class="update_text">Upload</span>
                      <input type='file' id="pan" name="pan" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                    </label>
                    <button type="button" class="btn btn-sm btn-danger col-4 view_pan" aria-hidden="true" data-toggle="modal" data-target="#pan_view_modal" style="display: none;">
                      View</button><br>
                    <span class="empty_img_err">No document selected</span>
                  </li>
                  <?php //if($_SESSION['role'] == 'agent'){ ?>
                  <!-- <li class="list-group-item">
                    <input type="submit" class="check-in" style="margin-left:10px;float:left">
                    <input type="reset" class="check-in" style="background-color: red">
                  </li>  -->  
                <?php //} ?>
                  <!-- <li class="list-group-item"><b><a href="#" class="show-modal" style="color: black;" data-toggle="modal" data-target="#changePassword" data-backdrop="static"><i class="fa fa-key" ></i>&nbsp;&nbsp;Change Password</a></b></li> -->
                </ul>
              </div>
            </div>

            <div class="card shadow-lg p-3 mb-5 bg-white rounded secret_div">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <p >Blood Group</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="bloodgrp" name="bloodgrp" >
                      
                  </div>
                  <div class="col-md-3">
                    <p >Emergency Contact Person</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="emerPerson" name="emerPerson" >
                  </div>
                  <div class="col-md-3">
                    <p >Relationship</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="relationship" name="relationship" >
                  </div>
                  <div class="col-md-3">
                    <p >Emergency Contact Number</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="emerContact" name="emerContact" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <p >Marital Status</p>
                    <select class="col-md-12 col-xs-12 form-control" id="marriage" name="marriage" >
                      <option style="display: none;" value="" selected>Select Marriage Details </option>
                      <option value="Married">Married</option>
                      <option value="Unmarried">Unmarried</option>
                    </select>
                      
                  </div>

                  <div class="col-md-3 weddingAniver">
                    <p >Anniversary</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="text"  id="weddingAniver" name="weddingAniver" >
                  </div>
                  <div class="col-md-3 noofChild">
                    <p >No of Kids:</p>
                    <input class="col-md-12 col-xs-12 form-control"  type="number" maxlength="10"  id="noofChild" name="noofChild" >
                  </div>
                  <div class="col-md-3 insurance_div">
                    <p >Insurance</p>
                    <label class="btn btn-sm btn-info col-4 mt-2">
                       <span class="update_text">Upload</span>
                        <input type='file' id="insurance" name="insurance" accept=".jpeg,.jpg,.png,.pdf" hidden/>
                    </label>
                    <button type="button" class="btn btn-sm btn-danger col-4 view_insurance" aria-hidden="true" data-toggle="modal" data-target="#insurance_view_modal" style="display: none;">
                      View</button><br>
                      <span class="empty_img_err">No document selected</span>
                  </div>
                </div>
              </div>
            </div>

            <?php// if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <div class="col-md-12 secret_div" style="padding-left: 40%">
                <input type="submit" class="check-in" style="margin-left:10px;float:left">
                <input type="reset" class="check-in" style="background-color: red">
              </div>
            <?php //} ?>
            </div>
          </form>
          </div>
        </div>
          

<!-- Employee Photo Modal -->
      <div class="modal fade" id="emp_photo_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Employee Image</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body text-center">
              <div id="imagePreviewImg"></div>
              <div id="empImgList"></div>
            </div>

            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->

          </div>
        </div>
      </div>  

      <!-- Resume View Modal -->
      <div class="modal fade" id="resume_view_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">
              <i class="fa fa-file-text-o" aria-hidden="true">Resume Document</i>
              </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
              <div id="imagePreview"></div>
              <div id="resumeList"></div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
            </div>

          </div>
        </div>
      </div>  

      <!-- Insurance View Modal -->
      <div class="modal fade" id="insurance_view_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fa fa-file-text-o" aria-hidden="true"> Insurance Document </i>
            </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
              <div id="imagePreviewIns"></div>
              <div id="insuranceList"></div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
            </div>

          </div>
        </div>
      </div>  

      <!-- Aadhar View Modal -->
      <div class="modal fade" id="aadhar_view_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fa fa-file-text-o" aria-hidden="true"> Aadhar Document</i>
                </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
              <div id="imagePreviewAadhar"></div>
              <div id="aadharList"></div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
            </div>

          </div>
        </div>
      </div>  

      <!-- PAN View Modal -->
      <div class="modal fade" id="pan_view_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">
              <i class="fa fa-file-text-o" aria-hidden="true"> Pan Document</i>
              </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
              <div id="imagePreviewPan"></div>
              <div id="panList"></div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
            </div>

          </div>
        </div>
      </div>  

      <!-- Social Links Modal -->
      <div class="modal fade" id="social_modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">
              <i class="fa fa-link" aria-hidden="true"> Social Links </i>
              </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form autocomplete="off" id="social_form_submit">
                <b>Whatsapp: </b>
                <input placeholder="Whatsapp link" type="text" id="whatsapp" name="whatsapp" class="col-md-12 col-xs-12 form-control">
                <b>Facebook: </b>
                <input placeholder="Facebook link" type="text" id="facebook" name="facebook" class="col-md-12 col-xs-12 form-control">
                <b>Pinterest: </b>
                <input placeholder="pinterest link" type="text" id="pinterest" name="pinterest" class="col-md-12 col-xs-12 form-control">
                <b>Twitter: </b>
                <input placeholder="Twitter link" type="text" id="twitter" name="twitter" class="col-md-12 col-xs-12 form-control">
                <b>Linkedin: </b>
                <input placeholder="Linkedin link" type="text" id="linkedin" name="linkedin" class="col-md-12 col-xs-12 form-control">
                <!-- <b>Gmail:</b>
                <input placeholder="Gmail Mail Id" type="email" id="gmail" name="gmail" class="col-md-12 col-xs-12 form-control"> -->

                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
            <!-- Modal footer -->
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
          </div>
        </div>
      </div>    
<script>  


  $(document).ready(function() {  
    /*setTimeout(() => {
      var joiningDate = $('#joiningDate').val();
      if(joiningDate == 'Jan 1, 1970'){
        $('#joiningDate').val('');
      }

      var probationEnd = $('#probationEnd').val();
      if(probationEnd == 'Jan 1, 1970'){
        $('#probationEnd').val('');
      }

      var termDate = $('#termDate').val();
      if(termDate == 'Jan 1, 1970'){
        $('#termDate').val('');
      }
      
      var dob = $('#dob').val();
      if(dob == 'Jan 1, 1970'){
        $('#dob').val('');
      }
    },500);*/


    var roleData = "<?php echo $_SESSION['role']; ?>";
  if(roleData == 'agent'){
    viewdata('');
  }
    $('.addinfobox,#empdetailadd').show();
    // addinfoBtn();
  // $('#social_modal').on('hidden.bs.modal', function(){    
  //   $('.modal-backdrop').remove();
  // });

  // $('.secret_div').hide();

  // $('.transRoute').hide();
  // $('.weddingAniver').hide();
  // $('.noofChild').hide();

  $('#transOffice').change(() => {
    var trans = $('#transOffice').val();
    if(trans == "company"){
      $('.transRoute').show();
    }else{
      $('.transRoute').hide();
    }
  });

  /*$("#dob").datepicker({
      altField: "#dob",
      altFormat: "M d, yy",
      changeYear: true,
      yearRange: "1970:2020"
      // showMonthAfterYear: true
    });

  $("#probationEnd").datepicker({
      altField: "#probationEnd",
      altFormat: "M d, yy"
    });

  $("#weddingAniver").datepicker({
      altField: "#weddingAniver",
      altFormat: "M d, yy"
    });

  $("#joiningDate").datepicker({
      altField: "#joiningDate",
      altFormat: "M d, yy"
    });

  $("#termDate").datepicker({
      altField: "#termDate",
      altFormat: "M d, yy"
    }); */ 
  $('#userid').select2({width: 'resolve'});
});


  $('.social').click(() => {
    var emp_id = $('.social').attr('data-id');
    var base_url = $('#base_url').val();
      $.ajax({
         url: base_url+'empinfoControl/get_social_links_data',
        method: "POST",
        data : {
          emp_id : emp_id
        }, success: function(res){
          var data = JSON.parse(res);
          $('#whatsapp').val(data['whatsapp']);
          $('#facebook').val(data['facebook']);
          $('#pinterest').val(data['pinterest']);
          $('#twitter').val(data['twitter']);
          $('#linkedin').val(data['linkedin']);
        }, failed: function(){
          alert('failed');
        }
    });
  });


  $('#social_form_submit').submit((e) => {
    e.preventDefault();
    var base_url = $('#base_url').val();
    var emp_id = $('.social').attr('data-id');
    var whatsapp = $('#whatsapp').val();
    var facebook = $('#facebook').val();
    var pinterest = $('#pinterest').val();
    var twitter = $('#twitter').val();
    var linkedin = $('#linkedin').val();


    $.ajax({
      url: base_url+'empinfoControl/update_social_links_data',
      method: "POST",
      data : {
        emp_id : emp_id,
        whatsapp : whatsapp,
        facebook : facebook,
        pinterest : pinterest,
        twitter : twitter,
        linkedin : linkedin,
      }, success: function(res){
        if(res){
          $('#social_modal').modal('toggle');
          alert('Updated Successfully');
        }else{
          alert('Something went wrong please try again later!');
        }
      }, failed: function(){
          alert('failed');
      }
    });
  });

  $('#probationEnd').css('pointer-events',' none');  
  $('#joiningDate').change(function(){
    /*if($('#probationPeriod').val() == ''){
      return
    }*/
    $('#probationPeriod').val('90');
    setTimeout(() => {
    var probationPeriod = $('#probationPeriod').val();
    var joiningDate = $('#joiningDate').val(); 
    var today = new Date(joiningDate);
    today.setDate(today.getDate()+parseInt(probationPeriod));
    futureProbationDate = today.toISOString().split('T')[0];
    // $("#probationEnd").datepicker('setDate', formatDate(futureProbationDate));
    $("#probationEnd").val(futureProbationDate);
    },200)
  });

function formatDate(date) {
  
  if(date == '0000-00-00') return '';
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;
    return [month, day, year].join('/');
}

function findTransport(data){
  if(data.toLowerCase().includes("company")){
    $('.transRoute').show();
    return "company";
  }else if(data.toLowerCase().includes("own")){
    $('.transRoute').hide();
    return "own";
  }else{
    $('.transRoute').hide();
    return "public";
  }
}

function checkMaritalStatus(){
var marrgeVal = $("#marriage").val();
  if(marrgeVal == 'Married'){
    $('.weddingAniver').show();
    $('.noofChild').show();
  }else{
    $('.weddingAniver').hide();
    $('.noofChild').hide();
  }
   $('#loading').hide();
}


function viewdata(data){
  var roleData = "<?php echo $_SESSION['role']; ?>";
  if(roleData == 'agent'){
    $('.first_div input,.second_div input').prop('readonly', true);
    $('#transOffice, #transRoute, #personalEmail, #joiningDate, #termDate, #probationEnd, #dob').prop('readonly', true);
    $('#transOffice, #personalEmail, #joiningDate, #termDate, #probationEnd, #dob').css("pointer-events","none");
    $('#transOffice').css('background-color', '#e9ecef');    
    /*$("input").prop("disabled", false);
    $("input[type='text']").prop("readonly", true);
    $("input[type='file']").prop("readonly", false);
    $("input[type='button']").prop("disabled", false);
    $("#new_password, #confirm_password").prop("readonly", false);
    $(".apply").prop("readonly", false);*/
  }
  
  $('#loading').show();

  /*setTimeout(() => {
   
  },1000)*/
  $('.secret_div').show();
  setTimeout(()=>{
    checkMaritalStatus();    
  },500);

  $("#marriage").change(() => {
    checkMaritalStatus();
  });

 // $('#empdetailadd').show();
  // document.getElementById("addform").reset();
  

  var userrole = "<?php echo $_SESSION['role']; ?>";
  if(userrole == 'agent'){
    var ajax_id = "<?php echo $_SESSION['emp_id']; ?>";
    $('#empname').val("<?php echo $_SESSION['name']; ?>");
    $('#empid').val("<?php echo $_SESSION['emp_id']; ?>");
    $('.social').attr('data-id', "<?php echo $_SESSION['emp_id']; ?>");
    $('#empname').val("<?php echo $_SESSION['name']; ?>");
  }else{
    var selectBox =data;
    console.log(selectBox);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dataset =selectedValue.split("/");

    $('#empid').val(dataset[0]);
    var ajax_id = dataset[0];
    $('.social').attr('data-id', dataset[0]);
    $('#empname').val(dataset[1]);
  }

   $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>employee_personal/getuserdetials',
    data   : {id:ajax_id},
    dataType: 'json',
    success : function(data){
      $("#dob").val('');      
      if(data?.[0]){
      $('.empty_img_err').show();
      $('.view_img, .view_resume, .view_insurance, .view_aadhar, .view_pan').hide();
      var imgSrc = "<?php echo base_url('img/'); ?>";
      if(data[0]['emp_photo'] != ''){
        $('.view_img').show();
        $('.emp_img_div .empty_img_err').hide();
      }
      if(data[0]['resume'] != ''){
        $('.view_resume').show();
        $('.resume_div .empty_img_err').hide();
      }
      if(data[0]['insurance'] != ''){
        $('.view_insurance').show();
        $('.insurance_div .empty_img_err').hide();
      }
      if(data[0]['aadhar'] != ''){
        $('.view_aadhar').show();
        $('.aadhar_div .empty_img_err').hide();
      }
      if(data[0]['pan'] != ''){
        $('.view_pan').show();
        $('.pan_div .empty_img_err').hide();
      }

      $('#empImgList').html("<embed src="+imgSrc+'emp_images/'+data[0]['emp_photo']+" width='200' height='200' /><br/><h3 style='word-break: break-word;'><a download href="+imgSrc+ 'emp_images/' +data[0]['emp_photo']+">"+data[0]['emp_photo']+"</a></h3>");
      // $('#imagePreview').html($("<img/>", {src:imgSrc+'emp_images/'+data[0]['emp_photo'], height:200}));
      $('#resumeList').html("<embed src="+imgSrc+'resume/'+data[0]['resume']+" width='200' height='200' /><br/><h3 style='word-break: break-word;'><a download href="+imgSrc+ 'resume/' +data[0]['resume']+">"+data[0]['resume']+"</a></h3>");
      $('#insuranceList').html("<embed src="+imgSrc+'insurance/'+data[0]['insurance']+" width='200' height='200' /><br/><h3 style='word-break: break-word;'><a href="+imgSrc+ 'insurance/' +data[0]['insurance']+">"+data[0]['insurance']+"</a></h3>");
      $('#aadharList').html("<embed src="+imgSrc+'address_proof/'+data[0]['aadhar']+" width='200' height='200' /><br/><h3 style='word-break: break-word;'><a href="+imgSrc+ 'address_proof/' +data[0]['aadhar']+">"+data[0]['aadhar']+"</a></h3>");
      $('#panList').html("<embed src="+imgSrc+'address_proof/'+data[0]['pan']+" width='200' height='200' /><br/><h3 style='word-break: break-word;'><a href="+imgSrc+ 'address_proof/' +data[0]['pan']+">"+data[0]['pan']+"</a></h3>");
      
      /*$("#dob").datepicker('setDate', formatDate(data[0]['DOB']));
      $('#probationEnd').datepicker('setDate', formatDate(data[0]['probationEnd']));
      $('#weddingAniver').datepicker('setDate', formatDate(data[0]['Anniversary']));
      $('#joiningDate').datepicker('setDate', formatDate(data[0]['joiningDate']));
      $('#termDate').datepicker('setDate', formatDate(data[0]['termDate'])); */

      $("#dob").val(data[0]['DOB']);
      $('#probationEnd').val(data[0]['probationEnd']);
      $('#weddingAniver').val(data[0]['Anniversary']);
      $('#joiningDate').val(data[0]['joiningDate']);
      $('#termDate').val(data[0]['termDate']);

      $('#bloodgrp').val(data[0]['Bloodgroup']);
      $('#phno').val(data[0]['Contact_phone']);
      $('#personalEmail').val(data[0]['Personal_Email']);
      $('#emerContact').val(data[0]['Emergency_Contact']);
      $('#relationship').val(data[0]['Relationship']);
      $('#emerPerson').val(data[0]['Emergency_Contact_Person']);
      $('#noofChild').val(data[0]['No_of_Child']);

      $('#transOffice').val(findTransport(data[0]['Transportation']));

      $('#transRoute').val(data[0]['Route']);
      $('#marriage').val(data[0]['MarriedUnMarried']);      
      $('#address1').val(data[0]['Current_Address1']);
      $('#address2').val(data[0]['Current_Address2']);
      $('#landmark').val(data[0]['Current_Landmark']);
      $('#city').val(data[0]['Current_City']);
      $('#pincode').val(data[0]['Current_Pincode']);
      $('#PersAddress1').val(data[0]['Perm_Address1']);
      $('#PersAddress2').val(data[0]['Perm_Address2']);
      $('#Perslandmark').val(data[0]['Perm_Landmark']);
      $('#Perscity').val(data[0]['Perm_City']);
      $('#Perspincode').val(data[0]['Perm_Pincode']);
      $('#currentTeam').val(data[0]['currentTeam']);
      $('#designation').val(data[0]['designation']);
      $('#probationPeriod').val(data[0]['probationPeriod']);            
      $('#linkedin').val(data[0]['linkedin']);
      $('#facebook').val(data[0]['facebook']);
      $('#selectshift').val(data[0]['Shift']);
      }else{
        $('.empty_img_err').show();
      }
    }
  });
}

$('#emp_photo').on("change", function(){
    if($('#emp_photo').val() == ''){ 
      $('.view_img').hide();
      $('.emp_img_div .empty_img_err').show();
    }
     var $preview = $('#imagePreviewImg').empty();
    if (this.files) $.each(this.files, readAndPreviewImg);

    function readAndPreviewImg(i, file) {
      if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
        return alert(file.name +" is not an image");
      }

      $('.view_img').show();
      $('.emp_img_div .empty_img_err').hide();
      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<img/>", {src:this.result, height:200}));
      });
      reader.readAsDataURL(file);
    }

    var emp_photo = document.getElementById('emp_photo');
    var output = document.getElementById('empImgList');
    output.innerHTML = '<br/><h3>'+emp_photo.files.item(0).name+'</h3>';
  });

$('#resume').on("change", function(){
    if($('#resume').val() == ''){ 
      $('.view_resume').hide();
      $('.empty_img_err').show();
    } else {
      $('.view_resume').show();
      $('.resume_div .empty_img_err').hide();
    }

    var $preview = $('#imagePreview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
      if (!/\.(jpe?g|png|gif|pdf)$/i.test(file.name)){
        return alert(file.name +" is not an required format");
      }

      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<embed />", {src:this.result, height:200}));
      });
      reader.readAsDataURL(file);
    }

    var resume = document.getElementById('resume');
    var output = document.getElementById('resumeList');
    output.innerHTML = '<br/><h3>'+resume.files.item(0).name+'</h3>';
  });

$('#insurance').on("change", function(){
    if($('#insurance').val() == ''){ 
      $('.view_insurance').hide();
      $('.empty_img_err').show();
    } else {
      $('.view_insurance').show();
      $('.insurance_div .empty_img_err').hide();
    }

    var $preview = $('#imagePreviewIns').empty();
    if (this.files) $.each(this.files, readAndPreviewIns);

    function readAndPreviewIns(i, file) {
      if (!/\.(jpe?g|png|gif|pdf)$/i.test(file.name)){
        return alert(file.name +" is not an required format");
      }

      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<embed />", {src:this.result, height:200}));
      });
      reader.readAsDataURL(file);
    }

    var insurance = document.getElementById('insurance');
    var output = document.getElementById('insuranceList'); 
    output.innerHTML = '<br/><h3>'+insurance.files.item(0).name+'</h3>';

      // output.innerHTML = '<ul>';
      // for (var i = 0; i < insurance.files.length; ++i) {
      //   output.innerHTML += '<li>' + insurance.files.item(i).name + '</li>';
      // }
      // output.innerHTML += '</ul>';
  });

$('#aadhar').on("change", function(){
    if($('#aadhar').val() == ''){ 
      $('.view_aadhar').hide();
    } else {
      $('.view_aadhar').show();
      $('.aadhar_div .empty_img_err').hide();
    }

    var $preview = $('#imagePreviewAadhar').empty();
    if (this.files) $.each(this.files, readAndPreviewAadhar);

    function readAndPreviewAadhar(i, file) {
      if (!/\.(jpe?g|png|gif|pdf)$/i.test(file.name)){
        return alert(file.name +" is not an required format");
      }

      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<embed />", {src:this.result, height:200}));
      });
      reader.readAsDataURL(file);
    }

    var aadhar = document.getElementById('aadhar');
    var output = document.getElementById('aadharList'); 
    output.innerHTML = '<br/><h3>'+aadhar.files.item(0).name+'</h3>';
      /*output.innerHTML = '<ul>';
      for (var i = 0; i < aadhar.files.length; ++i) {
        output.innerHTML += '<li>' + aadhar.files.item(i).name + '</li>';
      }
      output.innerHTML += '</ul>';*/
  });

$('#pan').on("change", function(){
    if($('#pan').val() == ''){
      $('.view_pan').hide();      
    } else {
      $('.view_pan').show();
      $('.pan_div .empty_img_err').hide();
    }

    var $preview = $('#imagePreviewPan').empty();
    if (this.files) $.each(this.files, readAndPreviewPan);

    function readAndPreviewPan(i, file) {
      if (!/\.(jpe?g|png|gif|pdf)$/i.test(file.name)){
        return alert(file.name +" is not an required format");
      }

      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<embed />", {src:this.result, height:200}));
      });
      reader.readAsDataURL(file);
    }

    var pan = document.getElementById('pan');
    var output = document.getElementById('panList');
    output.innerHTML = '<br/><h3>'+pan.files.item(0).name+'</h3>';
      /*output.innerHTML = '<ul>';
      for (var i = 0; i < pan.files.length; ++i) {
        output.innerHTML += '<li>' + pan.files.item(i).name + '</li>';
      }
      output.innerHTML += '</ul>';*/
  });

/*function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});*/

</script>
<style>

  .empty_img_err{
    color: red;
    font-weight: bold;
  }

  .emp_label{
    font-size: 14px;
  }

  body {
   background: whitesmoke;
   font-family: 'Open Sans', sans-serif;
}
 .avatar-upload {
   position: relative;
   max-width: 205px;
   margin: 0px 90px auto;
}
 .avatar-upload .avatar-edit {
   position: absolute;
   right: 12px;
   z-index: 1;
   top: 10px;
}
 .avatar-upload .avatar-edit input {
   display: none;
}
 .avatar-upload .avatar-edit input + label {
   display: inline-block;
   width: 34px;
   height: 34px;
   margin-bottom: 0;
   border-radius: 100%;
   background: #fff;
   border: 1px solid transparent;
   box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
   cursor: pointer;
   font-weight: normal;
   transition: all 0.2s ease-in-out;
}
 .avatar-upload .avatar-edit input + label:hover {
   background: #f1f1f1;
   border-color: #d6d6d6;
}
 .avatar-upload .avatar-edit input + label:after {
   content: "\f040";
   font-family: 'FontAwesome';
   color: #757575;
   position: absolute;
   top: 5px;
   left: 0;
   right: 0;
   text-align: center;
   margin: auto;
}
 .avatar-upload .avatar-preview {
   width: 192px;
   height: 192px;
   position: relative;
   border-radius: 100%;
   border: 6px solid #f8f8f8;
   box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
 .avatar-upload .avatar-preview > div {
   width: 100%;
   height: 100%;
   border-radius: 100%;
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center;
}

ul.list-group.shadow-lg.p-4.mb-5.bg-white.rounded{
  min-height: 386px;
}
#loading {
  width: 100px;
  height: 100px;  
  position: fixed;
  display: block;  
  text-align: center;
}

#loading-image {
  position: absolute;
}
.ui-datepicker-year{
  width: 34% !important;
  height: 30px !important;
}
</style>
