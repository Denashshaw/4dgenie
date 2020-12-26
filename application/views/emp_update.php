<form action="<?php echo base_url('EmpDetailsUpdate');?>" method="POST" id="addform">
  <div class="row">
    <div class="col-md-3">
      <p >Employee ID: <span id="start">*</span></p>
      <input type="text" id="updateempid" name="updateempid" readonly>
    </div>
    <div class="col-md-3">
      <p >Employee Name: <span id="start">*</span></p>
      <input type="text" id="updateempname" name="updateempname" readonly>
    </div>
  </div>

<div  id="empdetailadd" style="background-color:#e9e8ef">
  <div class="row" style="margin-left:2%;margin-right:2%">
    <div class="col-md-12" style="text-align:center;padding-top:2%;color:#6f8aea;font-weight:bold"><h3><span  class="fa fa-user" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Personal Details</h3><br></div>
    <div class="col-md-3">
        <p >Date of Birth: <span id="start">*</span></p>
          <input class="col-md-12 col-xs-12 form-control" type="date" id="updateDOB" name="updateDOB" placeholder="DD-MM-YYYY" required="">
        <br>
    </div>
    <div class="col-md-3">
          <p >Blood Group:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="updateBG" name="updateBG" placeholder="Enter Blood Group"  style="  text-transform:uppercase;">
          <br>
    </div>
    <div class="col-md-3">
        <p >Phone Number:<span id="start">*</span></p>
        <input class="col-md-12 col-xs-12 form-control" type="text"  pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers"  id="Updatephno" name="Updatephno" placeholder="Enter Phone Number" required>
    </div>
    <div class="col-md-3">
        <p >Personal Email ID:<span id="start">*</span></p>
        <input class="col-md-12 col-xs-12 form-control" type="email" id="UpdatepersonalEmail" name="UpdatepersonalEmail" placeholder="Enter Email ID" required>
    </div>
  </div>
  <div class="row" style="margin-left:2%;margin-right:2%">
  <div class="col-md-3">
      <p >Emergency Contact:<span id="start">*</span></p>
      <input class="col-md-12 col-xs-12 form-control" type="text" pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" id="UpdateemerContact" name="UpdateemerContact" placeholder="Enter Emergency Contact Number" required="">
      <br>
      <div id="MarDetails">
        <p >No Of kids:</p>
        <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdatenoofChild" name="UpdatenoofChild" placeholder="Enter No Of Kids">
      </div>
      <br>
  </div>
<div class="col-md-3">
      <p >Transportaion:<span id="start">*</span></p>
      <select class="col-md-12 col-xs-12 form-control"  id="UpdatetransOffice" name="UpdatetransOffice"  required="">
        <option style="display: none;" value="" selected>Select Transportation</option>
        <option value="Public">Public</option>
        <option value="Own">Own</option>
        <option value="Office Transport">Office Transport</option>
      </select>

  </div>
  <div class="col-md-3">
      <p >Marriage Details:</p>
      <select class="col-md-12 col-xs-12 form-control"  onchange="UpdateviewmarriedDetails()" id="Updatemarriage" name="Updatemarriage" >
        <option  style="display: none;" value="" selected>Select Marriage Details </option>
        <option value="Married">Married</option>
        <option value="Unmarried">Unmarried</option>
      </select>
  </div>
  <div class="col-md-3">
    <div id="MarDetails">
      <p >Wedding Aniversary:</p>
      <input class="col-md-12 col-xs-12 form-control" type="date" id="UpdateweddingAniver" name="UpdateweddingAniver" placeholder="Enter Wedding Aniversary" >
    </div>
  </div>
</div>
<div  class="row" style="margin-left:2%;margin-right:2%">

    <div class="col-md-6">
      <fieldset style="border: 1px 2px solid green;">
        <legend><h5 style="margin-left:1%;">Current Residential Address<span id="start">*</span></h5></legend>
        <div>
        <div class="row">
          <div class="col-md-12">
            <p >Address Line 1:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Updateaddress1" name="Updateaddress1" placeholder="Address 1" required="">
          </div>
          <div class="col-md-12">
            <p >Address Line 2:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Updateaddress2" name="Updateaddress2" placeholder="Address 2" required="">
          </div>
          <div class="col-md-12">
            <p >Landmark:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Updatelandmark" name="Updatelandmark" placeholder="Landmark" required="">
          </div>
          <div class="col-md-6">
            <p >City:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Updatecity" name="Updatecity" placeholder="City" required="">
          </div>
          <div class="col-md-6">
            <p >Pin Code:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="Updatepincode" name="Updatepincode" placeholder="pincode" required="">
          </div>
        </div>
      </div>
      </fieldset>
    </div>


    <div class="col-md-6">
      <fieldset>
        <legend><h5 style="margin-left:2%;">Permanent Residential Address</h5></legend>
        <div style="margin-left:5%;margin-right:5%">
        <div class="row">
          <div class="col-md-12">
            <p >Address Line 1:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="UpdatePersAddress1" name="UpdatePersAddress1" placeholder="Address 1">
          </div>
          <div class="col-md-12">
            <p >Address Line 2:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="UpdatePersAddress2" name="UpdatePersAddress2" placeholder="Address 2" >
          </div>
          <div class="col-md-12">
            <p >Landmark:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="UpdatePerslandmark" name="UpdatePerslandmark" placeholder="Landmark" >
          </div>
          <div class="col-md-6">
            <p >City:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text"  id="UpdatePerscity" name="UpdatePerscity" placeholder="City">
          </div>
          <div class="col-md-6">
            <p >Pin Code:</p>
            <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="UpdatePerspincode" name="UpdatePerspincode" placeholder="pincode">
          </div>
        </div>
      </div>
      </fieldset>
    </div>
  </div>


<br><br><br>
<div class="row"  >
	<div class="col-md-12" style="text-align:center;padding-top:5%;color:#d42626"><h3><span  class="fa fa-users" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Family Details</h3><br></div>
<div class="col-md-3" style="margin-left:10%">
  <p >Relationship:</p>
  <select class="col-md-12 col-xs-12 form-control" type="text" id="updaterelationship" name="updaterelationship">
      <option  style="display: none;" value="" selected>Select Relationship</option>
      <option value="Guardian">Guardian</option>
      <option value="Fathers">Fathers</option>
      <option value="Mother">Mother</option>
      <option value="Son">Son</option>
      <option value="Daughter">Daughter</option>
      <option value="Brother">Brother</option>
      <option value="Sister">Sister</option>
      <option value="Husband">Husband</option>
      <option value="Wife">Wife</option>

  </select>
</div>
<div class="col-md-3">
  <p >Name:</p>
  <input class="col-md-12 col-xs-12 form-control" type="text" id="updatefamilyname" name="updatefamilyname" placeholder="Enter Name">
</div>
<div class="col-md-3">
    <p >Contact Number:</p>
    <input class="col-md-12 col-xs-12 form-control" type="text" id="updatefamilyphno" name="updatefamilyphno" placeholder="Enter Phone Number" pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" >
</div>
<div class="col-md-1"><br><br>
  <input type="hidden" id="UpdateFRelationship" name="UpdateFRelationship">
  <input type="hidden" id="UpdateFName" name="UpdateFName">
  <input type="hidden" id="UpdateFContact" name="UpdateFContact">
    <i class="fa fa-plus" style="color:green;font-size:20px" onclick="Updateaddfamily()"></i>
</div><div class="col-md-1"></div>

<div class="col-md-8 table-responsive emp-table" style="min-width:730px">
  <table class="table" id="tabledata">
    <thead>
      <tr>
        <th scope="col">Relationship</th>
        <th scope="col">Name</th>
        <th scope="col">Contact</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="UpdatetablePrintFamily">

    </tbody>
  </table>
</div>

<br><br><br>

<div class="col-md-12" style="text-align:center;padding-top:5%;color:#3fc98e"><h3><span  class="fa fa-graduation-cap" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Education Details</h3><br></div>
  <div class="col-md-3" style="margin-left:10%">
    <p >Studyed At:</p>
    <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateStudyed" name="UpdateStudyed" placeholder="Eg: 10th/12th/B.Sc">
  </div>
  <div class="col-md-3">
    <p >School/Institute:</p>
    <input class="col-md-12 col-xs-12 form-control" type="text" id="Updateschoolname" name="Updateschoolname" placeholder="Enter School/Institute Name">
  </div>
  <div class="col-md-3">
      <p >Year (From - To):</p>
      <input class="col-md-12 col-xs-12 form-control" type="text" id="Updatemark" name="Updatemark" placeholder="(Eg: 2010-2011)">
  </div>
  <div class="col-md-1"><br><br>
    <input type="hidden" id="UpdateEStudy" name="UpdateEStudy">
    <input type="hidden" id="UpdateESchool" name="UpdateESchool">
    <input type="hidden" id="UpdateEMark" name="UpdateEMark">
    <i class="fa fa-plus" style="color:green;font-size:20px" onclick="UpdateaddEducation()"></i>
  </div><div class="col-md-1"></div>

  <div class="col-md-8 table-responsive emp-table" style="min-width:730px">
    <table class="table" id="tabledata">
      <thead>
        <tr>
          <th scope="col">Studyed At</th>
          <th scope="col">School/Institute</th>
          <th scope="col">Year (From - To)</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="UpdatetablePrintEdu">
      </tbody>
    </table>
  </div>

  <br><br><br>

  	<div class="col-md-12" style="text-align:center;padding-top:5%;color:gray"><h3><span  class="fa fa-cog"   style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Management Details</h3><br></div>
  <div class="col-md-3">
      <p >Date of Join:<span id="start">*</span></p>
      <input class="col-md-12 col-xs-12 form-control" type="text" id="Updatedoj" name="Updatedoj" placeholder="DD-MM-YYYY" readonly>
      <br>
      <p >First Medical Billing Employer:</p>
      <input class="col-md-12 col-xs-12 form-control" style="margin-top:5%" type="text" id="UpdatefirstMBEmployee" name="UpdatefirstMBEmployee" placeholder="Enter First Medical Billing Employer">
      <br>
      <p >Medical Billing Specialties Worked On:</p>
      <select class="mbSpecialWorked" name="UpdateMBSpecial[]"  id="UpdateMBSpecial" multiple="multiple"  placeholder="Medical Billing Specialties Worked On" style="width: 100%">
      </select>
      <!-- <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateMBSpecial" name="UpdateMBSpecial" placeholder="Medical Billing Specialties Worked On"> -->

  </div>
  <div class="col-md-3">
      <p >Work Email ID:<span id="start">*</span></p>
      <input class="col-md-12 col-xs-12 form-control" type="email" id="Updateworkemail" name="Updateworkemail" placeholder="Enter Work Email ID"  required="">
      <br>
      <p >Start Date With First Medical Billing Employer :</p>
      <input class="col-md-12 col-xs-12 form-control" type="date" id="UpdateStartDate_FirstMB" name="UpdateStartDate_FirstMB" placeholder="Enter Start Date With First Medical Billing Employer">
      <br>
      <p >Medical Billing Processed Worked On:</p>
      <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateMBProcessWork" name="UpdateMBProcessWork" placeholder="Medical Billing Processed Worked On" >
  </div>
  <div class="col-md-3">
    <p >Process:<span id="start">*</span></p>
    <select class="col-md-12 col-xs-12 form-control" id="Updateprocess" name="Updateprocess" required>
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
      <p style="padding-top:5%">Other Past Medical Billing Employers:</p>
      <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateOtherPastMB" name="UpdateOtherPastMB" placeholder="Enter Other Past Medical Billing Employers" >
      <br>
      <p >LinkedIn Profile ID:</p>
      <input class=" col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="UpdateLinkedin" name="UpdateLinkedin" placeholder="Enter LinkedIn Profile ID" >
      <i class="fa fa-linkedin-square errspan"  style="color:#0e76a8"></i>

  </div>
  <div class="col-md-3">
    <p >Expe in Medical Billing:<span id="start">*</span></p>
    <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateexpinMB" name="UpdateexpinMB" placeholder="Enter Experience in Medical Billing" required="">
    <br>
    <p >Medical Billing Softwares Worked On:</p>
    <select class="mbSoftwareWorked" name="UpdateMBSoftwareon[]"  id="UpdateMBSoftwareon" multiple="multiple"  placeholder="Enter Medical Billing Softwares Worked On" style="width: 100%">
    </select>
    <!-- <input class="col-md-12 col-xs-12 form-control" type="text" id="UpdateMBSoftwareon" name="UpdateMBSoftwareon" placeholder="Enter Medical Billing Softwares Worked On" > -->
    <br>
    <p >Facebook Profile ID:</p>
    <input class="col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="UpdateFacebookid" name="UpdateFacebookid" placeholder="Enter Facebook Profile ID">
    <span class="fa fa-facebook-square  errspan" style="color:#3b5998"></span>
  </div>

  <div align="col-md-12" style="padding-top:5%;padding-left:40%">
      <input type="submit" class="check-in" style="margin-left:10px;float:right">
      <input type="reset" class="check-in" style="background-color:red;">
  </div>
</div>
</form>
<script>
$('.updatemodal #MarDetails').hide();
$('.updatemodal #MarDetails1').hide();
function UpdateviewmarriedDetails(){
    var mar = $('#Updatemarriage').val();
    if(mar == 'Married'){
        $('.updatemodal #MarDetails').show();
        $('.updatemodal #MarDetails1').show();
    }else{
      $('.updatemodal #MarDetails').hide();
      $('.updatemodal #MarDetails1').hide();
    }
}
</script>
