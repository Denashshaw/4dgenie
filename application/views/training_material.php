
<?php 
$uid =uniqid();
if($userdata['role'] == 'admin'){ ?>
<form action="<?php echo base_url(); ?>Training/mediauload" method="POST" enctype="multipart/form-data">
<div class="row" >

    <div class="col-md-3">
    <br>
        <p >Process:</p>
        <select class="col-md-12 col-xs-12 form-control" id="process" name="process" >
            <option value="">Select Process</option>
            <option value="Voice">Voice</option>
            <option value="Data">Data</option>
            <option value="QA-Team">QA-Team</option>

        </select>
    </div>

    <div class="col-md-3">
    <br>
        <p >General Training Materials:</p>
        <input type="file" name="gtm" id="gtm" accept=".pdf, .docx" class="col-md-12 col-xs-12 form-control">
    </div>
    <div class="col-md-3">
    <br><br>
    <input type="submit" value="Save" class="check-in" >
    </div>
</div>

</form>

<?php } ?>
<br>
<h4>Material History</h4><br>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered" id="tabledata">
            <thead>
                <tr>
                    <th scope="col">Process</th>
                    <th scope="col">Date of Update</th>
                    <th scope="col">General Training Materials</th>
                    <th scope="col">Status</th>

                    <?php if($userdata['role'] == 'admin'){ ?>
                        <th scope="col">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($materiallist as $a){ ?>
                <tr>
                    <td> <?php echo $a->process; ?> </td>
                    <td> <?php echo date_format(date_create($a->created_date),'d-m-Y H:i:s'); ?> </td>
                    
                    <td> 
                    <a target="_blank" href="<?php base_url() ?>Training/viewmaterial/<?php echo $a->materialfilename; ?>"><?php echo $a->materialfilename; ?></a> 
                        <!-- <a onclick="viewmodel(`<?php echo $a->id; ?>`,`<?php echo $a->materialfilename; ?>`)"><?php echo $a->materialfilename; ?></a> -->
                    </td>
                    <td> <?php
                            if($a->noperson > 0 && $userdata['role'] == 'admin'){
                                echo "No of views:<span style='cursor:pointer' class='check-in' onclick='getpersons(`".$a->materialfilename."`)'>".$a->noperson."</span>"; 
                            }
                            else if($a->noperson > 0 && $userdata['role'] != 'admin')
                            {
                                echo "<span class='check-in'>Complete</span>"; 
                            }
                            else{
                                echo "<span class='initiated'>".$a->status."</span>"; 
                            }
                    
                    
                   ?> </td>
                    <?php if($userdata['role'] == 'admin'){ ?>
                        <td>
                            <a href="<?php echo base_url() ?>Training/deleteid/<?php echo $a->id; ?>"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
                        </td>
                    <?php } ?>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="modal fade modalmaterialview" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="materialviewedtable"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
      
    </div>
</div>

<script>



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

function getpersons(bookname){
    $('.modalmaterialview').modal('toggle');
    $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/getviewempMaterial',
            data   :  {bookname:bookname},
            success : function(dataval){
                var data = JSON.parse(dataval);
                $('#exampleModalLongTitle').html(bookname);
                var out='';
                out += '<table class="table table-bordered" id="tabledata"><thead><tr>';
                out += '<td>Emploee ID</td><td>Name</td><td>Look at<span class="fa fa-eye" style="padding-left:10%;color:green"></span></td>';
                out += '</tr></thead><tbody>';
                for(var i=0;i<data.length;i++){
                    out += '<tr>';
                    out += '<td>'+data[i].emp_id+'</td><td>'+data[i].name+'</td><td>'+moment(data[i].created_date).format("DD-MM-YYYY HH:mm:ss");;+'</td>';
                    out += '</tr>';

                }
                out += '</tbody></table>';
                $('#materialviewedtable').html(out);
            
            }
    });

}
</script>