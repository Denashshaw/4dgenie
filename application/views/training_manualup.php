<!-- -->
<?php 
$uid =uniqid();
if($userdata['role'] == 'admin'){ ?>
<form action="<?php echo base_url(); ?>Training/manualup" method="POST" enctype="multipart/form-data">
<div class="row" >

    <div class="col-md-3">
    <br>
        <p >Process:</p>
        <select class="col-md-12 col-xs-12 form-control" id="processname" name="processname" >
            <option value="">Select Process</option>
            <option value="Voice">Voice</option>
            <option value="Data">Data</option>
            <option value="QA-Team">QA-Team</option>

        </select>
    </div>
    <!-- <div class="col-md-3">
    <br>
        <p >Type of Training Material:</p>
        <select class="col-md-12 col-xs-12 form-control" id="typeoftraining" name="typeoftraining" onchange="viewclientval()">
            <option value="">Select ...</option>
            <option value="Client">Client</option>
            <option value="General Training Materials">General Training Materials</option>
         </select>
    </div> -->
    <div class="col-md-3" id="clientlistview" >
    <br>
        <p >Client:</p>
        <select class="col-md-12 col-xs-12 form-control" id="clientname" name="clientname" >
        <?php
       
                foreach($clientval as $a){
                  
                    ?>
                    <option value="<?php echo $a->keyword; ?>" >
                        <?php echo $a->client; ?>
                    </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
    <br>
        <p >Standard Operating Procedures:</p>
        <input type="file" name="standardoperation" id="standardoperation" accept=".pdf, .docx" class="col-md-12 col-xs-12 form-control">
    </div>
    <div class="col-md-3">
    <br>
        <p > Client Software Manual:</p>
        <input type="file" name="clientSwmanual" id="clientSwmanual" accept=".pdf, .docx" class="col-md-12 col-xs-12 form-control">
    </div>
    <div class="col-md-3">
    <br>
        <p >Special Instructions:</p>
        <input type="file" name="speInstruction" id="speInstruction" accept=".pdf, .docx" class="col-md-12 col-xs-12 form-control">
    </div>
    <div class="col-md-3">
    <br><br>
        <input type="submit" value="Save" class="check-in" >
    </div>
</div>

</form>

<?php } ?>
<br>
<h4>Manual Upload History</h4><br>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered" id="tabledata">
            <thead>
                <tr>
                    
                    <th scope="col">Process</th>
                    <th scope="col">Client</th>
                    <th scope="col">Date of Update</th>
                    <th scope="col">Status</th>
                    <th scope="col">Standard Operating Procedures</th>
                    <th scope="col">Client Software Manual</th>
                    <th scope="col">Special Instructions</th>
                    <?php if($userdata['role'] == 'admin'){ ?>
                        <th scope="col">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($manualview as $a){ ?>
                <tr>
                    <td> <?php echo $a->process; ?> </td>
                    <td> <?php echo $a->client; ?> </td>
                    <td> <?php echo date_format(date_create($a->created_date),'d-m-Y H:i:s'); ?> </td>
                    <td> <?php
                            if($a->status == 'Initiated'){
                                echo "<span class='initiated'>".$a->status."</span>"; 
                            }
                    
                   ?> </td>
                    <td> 
                    <a href="<?php echo base_url()."Training/viewmanual?page1=StandardOperatingProcedures&page2=".$a->standardoperation; ?>" target="_blank"><?php echo $a->standardoperation; ?></a>
                 
                        <!-- <a href="<?php echo base_url()."training_module/StandardOperatingProcedures/".$a->standardoperation; ?>" target="_blank"><?php echo $a->standardoperation; ?></a>  -->
                    </td>
                    <td> 

                    <a href="<?php echo base_url()."Training/viewmanual?page1=ClientSoftwareManual&page2=".$a->clientSwmanual; ?>" target="_blank"><?php echo $a->clientSwmanual; ?></a>
     
                    </td>
                    <td> 
                        <a href="<?php echo base_url()."Training/viewmanual?page1=SpecialInstructions&page2=".$a->speInstruction; ?>" target="_blank"><?php echo $a->speInstruction; ?></a>

                    </td>
                    <?php if($userdata['role'] == 'admin'){ ?>
                        <td><a href="<?php echo base_url() ?>Training/deletemanualid/<?php echo $a->id; ?>"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- </div> -->



<script>



function viewclientval(){
    if($('#typeoftraining').val() == 'Client'){
        $('#clientlistview').show();
    }
}
function setemp(){
    var agentinput=$('#agentname').val();
    var datasplit = agentinput.split("/");
    var id = datasplit[0];
    if(agentinput !=''){
        $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/getemp',
            data   :  {id:id},
            success : function(data){
            var val =JSON.parse(data);
            $('#dept').val(val[0].department);
            var clientdata = val[0].client;
            var splitclient = clientdata.split(",");
            var out='';
            splitclient.forEach(
                function(data){
                    out += '<option>'+data+'</option>';
                    
                }
            );
            $('#clientname').html(out);
            
            }
        });
    }else{
        $('#dept').val('');
        $('#clientname').html('');
    }
}
</script>