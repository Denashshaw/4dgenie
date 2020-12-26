<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addmanBtn()" style="background-color:#007bff;font-size:12px;"> Add / Edit Management</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addmanagebox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
            <div class="row" style="border-bottom:2px solid #e1e5e6;" >
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <p style="text-align:center">Employee ID</p>
                <select class="form-control useridval" id="userid"  onchange="viewdatamanage(this)" style="width:100%">
                  <option value="">Select Emp ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id).'/'.ucfirst($emp->name); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>
              <form action="<?php echo base_url();?>employee_personal/addmanagement" method="POST" id="addform">
                <input type="hidden" id="empidmana" name="empidmana"> <input type="hidden" id="empnameman" name="empnameman">
            <div  id="empMANAadd" style="background-color:#e9e8ef">
            <br>
              <div class="row" style="margin-left:2%;margin-right:2%">

                <div class="col-md-12" style="text-align:center;padding-top:5%;color:gray"><h3><span  class="fa fa-cog" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Management Details</h3><br></div>
                <div class="col-md-3">
                  <p >Work Email ID:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="email" id="workemail" name="workemail"   required="">
                    <br>
                    <p >First Medical Billing Employer:</p>
                    <input class="col-md-12 col-xs-12 form-control" style="margin-top:16%" type="text" id="firstMBEmployee" name="firstMBEmployee" >
                    <br>

                    <p >Medical Billing Specialties Worked On:</p>
                    <select class="mbSpecialWorked" name="MBSpecial[]"  id="MBSpecial" multiple="multiple"   style="width: 100%">
                    </select>

                </div>
                <div class="col-md-3">
                  <p >Process:<span id="start">*</span></p>
                    <select class="col-md-12 col-xs-12 form-control" id="process" name="process">
                      <option  style="display: none;" value="" selected>Select Process</option>
                      <option value="HR">HR</option>
                      <option value="IT">IT</option>
                      <option value="Software">Software</option>
                      <option value="Management">Management</option>
                      <option value="Demo/Charges">Demo/Charges</option>
                        <option value="Payment Posting">Payment Posting</option>
                      <option value="DATA QA">DATA QA</option>
                      <option value="Medical Coding">Medical Coding</option>
                      <option value="AR Follow-up">AR Follow-up</option>
                      <option value="VOB's">VOB's</option>
                      <option value="AR QA">AR QA</option>
                      <option value="Patient Calling">Patient Calling</option>
                  </select>
                    <br>
                    <p >Start Date With First Medical Billing Employer :</p>
                    <input class="col-md-12 col-xs-12 form-control" type="date" id="StartDate_FirstMB" name="StartDate_FirstMB">
                    <br>
                    <p >Medical Billing Processes Worked On:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="MBProcessWork" name="MBProcessWork"  >
                </div>
                <div class="col-md-3">
                  <p >Designation:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="designation" name="designation"   required="">
                    <br>
                    <p style="padding-top:3%">Other Past Medical Billing Employers:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="OtherPastMB" name="OtherPastMB" >
                    <br>
                    <p >LinkedIn Profile ID:</p>
                    <input class=" col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="Linkedin" name="Linkedin"  >
                    <i class="fa fa-linkedin-square errspan"  style="color:#0e76a8"></i>
                </div>

                <div class="col-md-3">
                  <p >Experience in Medical Billing:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="expinMB" name="expinMB"  required="">
                  <br>
                  <p >Medical Billing Softwares Worked On:</p>
                  <select class="mbSoftwareWorked" name="MBSoftwareon[]"  id="mbsoftware" multiple="multiple"  style="width: 100%">
                  </select>
                  <!-- <input class="col-md-12 col-xs-12 form-control" type="text" id="MBSoftwareon" name="MBSoftwareon" placeholder="Enter Medical Billing Softwares Worked On" > -->
                  <br>	<br>
                  <p >Facebook Profile ID:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="Facebookid" name="Facebookid" >
                  <span class="fa fa-facebook-square  errspan" style="color:#3b5998"></span>
                </div>

                <div align="col-md-12" style="padding-top:5%;padding-left: 40%">
                  <input type="submit" class="check-in"  value="submit" style="margin-left:10px;float:left">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>
			</div>
			</div>
          </form>
          </div>
        </div>
</div>
  <script>
  function addmanBtn(){
  	var x = document.getElementById("addmanagebox");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }

    $('#empMANAadd').hide();
  function viewdatamanage(data){
    $('#empMANAadd').show();
    document.getElementById("addform").reset();
    var selectBox =data;

    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dataset =selectedValue.split("/");
    $('#empidmana').val(dataset[0]);
    $('#empnameman').val(dataset[1]);
    $.ajax({
     method : 'post',
     url    : '<?php echo base_url();?>employee_personal/getmandetials',
     data   : {id:dataset[0]},
     dataType: 'json',
     success : function(data){
       console.log(data);

       if(data.length > 0){
          $('#workemail').val(data[0]['Work_email']);
          $('#process').val(data[0]['Process']);
          $('#designation').val(data[0]['Designation']);
          $('#expinMB').val(data[0]['Exp_in_MB']);
          $('#firstMBEmployee').val(data[0]['First_MB_Employer']);
          $('#StartDate_FirstMB').val(data[0]['Start_Date_WithFirst_MB_Employer']);
          $('#OtherPastMB').val(data[0]['Other_Past_MB_Employers']);
          $('#mbsoftware').val(data[0]['MB_Softwares_Worked_On']);
          $('#MBSpecial').val(data[0]['MB_Specialties_Worked_On']);
          $('#MBProcessWork').val(data[0]['MB_Processed_Worked_On']);
          $('#Linkedin').val(data[0]['LinkedIn']);
          $('#Facebookid').val(data[0]['Facebook']);

       }
     }
   });

  }


  </script>
