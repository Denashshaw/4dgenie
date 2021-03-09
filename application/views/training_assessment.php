<?php
if($userdata['role'] == 'admin'){ ?>
<form action="<?php echo base_url(); ?>Training/assessmentadd" method="POST" enctype="multipart/form-data">
<div class="row" >

    <div class="col-md-3">
    <br>
        <p >Process:</p>
        <select class="col-md-12 col-xs-12 form-control" id="processname" name="processname" onchange="getagentname(this)">
            <option value="">Select Process</option>
            <option value="Voice">Voice</option>
            <option value="Data">Data</option>
            <option value="QA">QA-Team</option>

        </select>
    </div>
    <div class="col-md-3" id="clientlistview" >
    <br>
        <p >Agent:</p>
        <select class="col-md-12 col-xs-12 form-control" id="agentnameagent" name="agentname" required>
      
        </select>
    </div>
    <div class="col-md-3">
    <br>
        <p >Assessment Link:</p>
        <input type="url" name="assessment" id="assessment" class="col-md-12 col-xs-12 form-control" required>
    </div> 
    <div class="col-md-3">
    <br><br>
        <input type="submit" value="Save" class="check-in" onclick="sendmail()">
    </div>
</div>

</form>

<?php } ?>
<br>
<h4>Assessment History</h4><br>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered" id="tabledata">
            <thead>
                <tr>
                <th scope="col">S.No</th>
                    <th scope="col">Process</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date of Update</th>
                    <th scope="col">Assessment Link</th>
                    <th scope="col">Mark</th>
                    <th scope="col">Max Mark</th>
                    <th scope="col">Percentage</th>
                    <th scope="col">Status</th>
                    
                    <?php if($userdata['role'] == 'admin'){ ?>
                        <th scope="col">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                 foreach($assessment as $ass){ ?>
                   <?php 
                   $ass_date = date_format(date_create($ass->created_date),'d-m-Y H:i:s');
                   if($ass->status != 'Completed' && date("d-m-Y H:i:s", strtotime($ass->created_date."+2 days")) < date('d-m-Y H:i:s')){
                     $ja="Background-color:#e89f9f";
                    }else{
                        $ja="Background-color:white";
                    }
                   ?>
                    <tr style="<?php echo $ja; ?>">
                        <td> <?php echo $i ; ?> </td>
                        <td> <?php echo $ass->process; ?> </td>
                        <td> <?php echo $ass->emp_id; ?> </td>
                        <td> <?php echo $ass->name; ?> </td>
                        <td> <?php echo $ass_date; ?> </td>
                        <td> <a href="<?php echo $ass->assessment_url; ?>" target="_blank" onclick="viewedassessment(`<?php echo $ass->id; ?>`,`<?php echo $ass->emp_id; ?>`)"><?php echo substr($ass->assessment_url,0,10); ?></a> </td>
                        <td> <?php echo $ass->score; ?> </td>
                        <td> <?php echo 50; ?> </td>
                        <td style="font-size:18px;font-weight:bold"> <?php echo (((int)$ass->score/50)*100)."%"; ?> </td>
                        <td> <?php if($ass->status == 'Viewed'){
                            echo "<span class='check-out'>".$ass->status."</span>";
                        }else if($ass->status == 'Completed'){
                            echo "<span class='check-in'>".$ass->status."</span>";
                        }
                        else{
                            echo "<span class='initiated' data-toggle='tooltip' data-placement='right' title='".$ass->takenon."'>".$ass->status."</span>";
                        }?> </td>
                        <?php if($userdata['role'] == 'admin'){ ?>
                            <td>
                                <a href="<?php echo base_url() ?>Training/deleteassessment/<?php echo $ass->id; ?>"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
                                <?php if($ass->status == 'Viewed'){ ?>
                                    <a ><i class="fa fa-pencil" onclick="updateassessmentscore(`<?php echo $ass->id; ?>`)" style="font-size:20px;color:#3fc98e"></i></a>
                                    <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php
                $i++;
                } ?>
               
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade scoreupdate" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form action="<?php echo base_url();?>Training/assScoreUpdate" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Assessment Score Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <input type="hidden" class="indexid" name="indexid">
        <p >Score:</p>
        <input type="text" pattern="[0-9]+" class="col-md-12 col-xs-12 form-control" id="agentscore" name="agentscore" required>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>

function getagentname(process){

    if(process.value !=''){
        $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/getprocessemp',
            data   :  {dpt:process.value},
            success : function(data){
                var val =JSON.parse(data);

                var out='';
                for(var i=0;i<val.length;i++){
                    out += '<option value="'+val[i].emp_id+'/'+val[i].name+'">'+val[i].emp_id+'/'+val[i].name+'</option>';
                }
                $('#agentnameagent').html(out);
            }
        });
    }else{
       $('#agentnameagent').html('');
    }
}

function viewedassessment(id,agentid){
    $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/agentassessmenttaken',
            data   :  {id:id,empid:agentid},
            success : function(data){
                console.log(data);
            }
        });
}

function updateassessmentscore(id){
    $('.scoreupdate').modal('toggle');
    $('.indexid').val(id);
}

function sendmail(){
 window.open('mailto:v.jaganathan93@gmail.com?subject=subject&body=body');
 }
</script>