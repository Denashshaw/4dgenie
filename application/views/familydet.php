<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addfamilyBtn()" style="background-color:#007bff;font-size:12px;"> Add / Edit Family</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addfambox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
            <div class="row" style="border-bottom:2px solid #e1e5e6;" >
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <p style="text-align:center">Employee ID</p>
                <select class="form-control useridval" id="userid"  onchange="viewfamv(this)" style="width:100%">
                  <option value="">Select Emp ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id).'/'.ucfirst($emp->name); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>
              <form action="<?php echo base_url('EmpDetailsAdd');?>" method="POST" id="addform">
                <input type="hidden" id="empid" name="empid"> <input type="hidden" id="empname" name="empname">
            <div  id="empfamilyadd" style="background-color:#e9e8ef">
            <br>

              <div class="row" style="margin-left:2%;margin-right:2%">
              <div class="col-md-12" style="text-align:center;padding-top:5%;color:#d42626"><h3><span  class="fa fa-users" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Family Details</h3><br></div>
              <div class="col-md-3" style="margin-left:10%">
                <p >Relationship:</p>
                <select class="col-md-12 col-xs-12 form-control" type="text" id="relationship" name="relationship">
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
                <input class="col-md-12 col-xs-12 form-control" type="text" id="familyname" name="familyname" >
              </div>
              <div class="col-md-3">
                  <p >Contact Number:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="familyphno" name="familyphno"  pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" >
              </div>
              <div class="col-md-1"><br><br>
                  <i class="fa fa-plus" style="color:green;font-size:20px" onclick="addfamily()"></i>
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
                  <tbody id="tablePrintFamily">

                  </tbody>
                </table>
              </div>
              <div align="col-md-12" style="padding-top:5%;padding-left: 40%">
                  <input type="button" class="check-in" onclick="submiteduform()" value="submit" style="margin-left:10px;float:left">
                  <input type="reset" class="check-in" style="background-color:red;">
              </div>

              </div>
          </form>
          </div>
        </div>


    </div>
  <script>

    var famRel=[];
    var famName=[];
    var famCont=[];
    var Eduempid=[];
    var Eduempname=[];

  function addfamilyBtn(){
  	var x = document.getElementById("addfambox");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }

  $('#empfamilyadd').hide();
  function viewfamv(data){
    $('#empfamilyadd').show();
    document.getElementById("addform").reset();
    var selectBox =data;

    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dataset =selectedValue.split("/");
    $('#empid').val(dataset[0]);
    $('#empname').val(dataset[1]);
     $.ajax({
      method : 'post',
      url    : '<?php echo base_url();?>employee_personal/getfamilydetials',
      data   : {id:dataset[0]},
      dataType: 'json',
      success : function(data){
        console.log(data);

        if(data.length > 0){
        var out;
        for(var i=0;i<data.length;i++){
            if(data[i]['Relationship'] != ''){
          famRel.push(data[i]['Relationship']);
          famName.push(data[i]['Name']);
          famCont.push(data[i]['Contact']);
          Eduempid.push(data[i]['Emp_id']);
          Eduempname.push(data[i]['Emp_name']);

          out += '<tr>';
          out += '<td>'+data[i]['Relationship']+'</td><td>'+data[i]['Name']+'</td><td>'+data[i]['Contact']+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeFamily('+i+')"></i></td>';
          out += '</tr>';
        }
        $('#tablePrintFamily').html(out);
      }
      }else{
        var out;
          out += '<tr>';
          out += '<td colspan="5" style="text-align:center">No Record Found</td>';
          out += '</tr>';

        $('#tablePrintFamily').html(out);
      }

      }
    });
  }


  function addfamily(){
    var ph=$('#familyphno').val();
    var name=$('#familyname').val();
    if(name.length != 0){
    if(ph.length == 10 || ph.length ==0){
      famRel.push($('#relationship').val());
      famName.push($('#familyname').val());
      famCont.push($('#familyphno').val());
      Eduempid.push( $('#empid').val());
      Eduempname.push(  $('#empname').val());
      viewFamTable(famRel,famName,famCont);
      $('#relationship').val('');
      $('#familyname').val('');
      $('#familyphno').val('');
    }else{
      alert("Please enter 10 degit contact number");
    }
  }else{
    alert("Please enter Family member name");
  }

  }



  function viewFamTable(Rel,Name,Con){
  	if(Rel.length > 0){
  	var out;
  	for(var i=0;i<Rel.length;i++){
  		out += '<tr>';
  		out += '<td>'+Rel[i]+'</td><td>'+Name[i]+'</td><td>'+Con[i]+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeFamily('+i+')"></i></td>';
  		out += '</tr>';
  	}
  	$('#tablePrintFamily').html(out);
  }else{
  	var out;
  		out += '<tr>';
  		out += '<td colspan="4" style="text-align:center">No Record Found</td>';
  		out += '</tr>';

  	$('#tablePrintFamily').html(out);
  }
  }
  function removeFamily(index){
  	if (index > -1) {
  		famRel.splice(index, 1);
  		famName.splice(index, 1);
  		famCont.splice(index, 1);
      Eduempid.splice(index, 1);
      Eduempname.splice(index, 1);
  	}
  	viewFamTable(famRel,famName,famCont);
  }

  function submiteduform(){

    $.ajax({
     method : 'post',
     url    : '<?php echo base_url();?>employee_personal/addfamily',
     data   : {Emp_id:Eduempid,Emp_name:Eduempname,relation:famRel,name:famName,contact:famCont},
      dataType: 'JSON',
     success : function(data){
       console.log(data);
       location.reload(true);
     }
   });

  }
  </script>
