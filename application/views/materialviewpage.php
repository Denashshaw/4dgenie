<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$pagename = $this->uri->segment(3);
$pageexten = explode(".",$pagename);
$userdata=$this->session->all_userdata();
$emp_id=$userdata['emp_id'];
?>
<main class="page-content">
	<div class="container p-5">
        <div class="row">
            <div class="col-md-12"  style="padding-left:25%">
            <?php if(end($pageexten) != 'pdf'){
                ?>
                <iframe loading="eager" class="doc" src="https://docs.google.com/gview?url=http://4dglobalinc.net/4d_demo_training/training_module/Generalmaterial/<?php echo $pagename; ?>&embedded=true" width="700" height="550"></iframe>
                <?php
            }else{
                ?>
                <iframe loading="eager" class="doc" src="http://4dglobalinc.net/4d_demo_training/training_module/Generalmaterial/<?php echo $pagename; ?>" width="700" height="550"></iframe>
                <?php
            }
            ?>    
                    
            </div>
        </div>
        <div class="row"><br>
            <div class="col-md-12"  style="background-color:#0080006e;height:100px;"><br>
            <?php
                $checkmanual=$this->db->query("SELECT * FROM trainingemp WHERE type='Manual' and emp_id='".$emp_id."' and page='".$pagename."'");
                $val = $checkmanual->result();
                if(sizeof($val) == 0){
            ?>
                <div class="mfooter" style="display:none;margin-left:40%">
                    <input type="checkbox" class="form-check-input" onchange="materialagent(`<?php echo $pagename; ?>`)">
                    <label class="form-check-label" style="font-weight:bold">Have read document</label>
                </div>
                <?php }else{ ?>
                <div style="margin-left:40%">
                    <h4  style="font-weight:bold;color:red;">Already Read Document!!!</h4>
                </div>
                <?php } ?>
                <div class="mfootermsg" style="display:none;margin-left:50%">
                  
                    <h4  style="font-weight:bold;color:blue;">Thanks!!!</h4>
                </div>
            </div>
            
        </div>
    </div>
</main>
<script>
function materialagent(page){
    $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/materialReaded',
            data   :  {materialname:page},
            success : function(data){
                var res = JSON.parse(data);
                if(res.msg == 'Status Updated'){
                    $('.mfooter').hide();
                    $('.mfootermsg').show();
                }
            }
    });
}

$( document ).ready(function() {
 setTimeout(function(){ 
        $('.mfooter').show();
      }, 30000);

});


</script>