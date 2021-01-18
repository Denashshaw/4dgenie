<!DOCTYPE html>
<div class="page-wrapper chiller-theme toggled">
<main class="page-content">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea',
        elements : "mytextarea",
        init_instance_callback : function(editor) {
           var freeTiny = document.querySelector('.tox .tox-notification--in');
          freeTiny.style.display = 'none';
         }
      });

    </script>
  </head>
    <?php
     $this->load->view('header');
      $userdata=$this->session->all_userdata();

    ?>
    <div class="container-fluid p-0">
    <?php $this->load->view('page_head'); ?>
    <div class="row activity-row">
			<div class="col-md-12 activity">4D HR/IT Policy</div>
		</div>
      <div class="row emp-table">
        <div class="col-md-12">
            <form method="post" action="<?php echo base_url(); ?>HrITpolicy/addcontent">
              <p>Policy</p>
              <select class="form-control" id="policytype" name="policytype" style="max-width:300px;font-size:18px;" onchange="getPolicy()">
                <option value="">Select Policy Type</option>
                <option value="Attendance Policy">Attendance Policy</option>
                <option value="Leave Policy">Leave Policy</option>
                <option value="Medical Insurance Policy">Medical Insurance Policy</option>
                <option value="Code of Conduct Policy">Code of Conduct Policy</option>
                <option value="Exit Policy">Exit Policy</option>
              </select>
              <br>
              <?php if($userdata['role'] =='HR' || $userdata['department'] == 'MANAGEMENT'){ ?>
              <textarea id="mytextarea" name="policytextcontent" rows="30" ></textarea>

              <br>
              <input type="submit" class="check-in">
              <?php }?>
            </form>
            <p id="viewpolicy" ></p>
        </div>
      </div>
  </div>
</main>
</div>
<script>
function getPolicy(){
  $.ajax({
    url : "<?php echo base_url(); ?>HrITpolicy/getdatapolicy",
    method : "POST",
    data : {"selectedoption":$('#policytype').val()},
    success : function(datares){
      var res = JSON.parse(datares);
      console.log(res);
      <?php if(($userdata['role'] =='supervisor' && $userdata['department'] == 'HR') || $userdata['department'] == 'MANAGEMENT'){ ?>
      if(res.length > 0){
        if(res[0]['viewcontent']){
          tinyMCE.activeEditor.setContent(res[0]['viewcontent']);
        }
      }else{
          tinyMCE.activeEditor.setContent('');
      }
      <?php }else{ ?>
        if(res.length > 0){
          if(res[0]['viewcontent']){
            $('#viewpolicy').html('<div style="padding-top:2%;padding-left:2%;background-color:#d1d2d1">'+res[0]['viewcontent']+'</div>');
          }
        }else{
          $('#viewpolicy').html('');
        }
      <?php } ?>
    }
  });
}
$(document).ready(function() {
       $('#viewpolicy').bind('cut copy', function(e) {
           e.preventDefault();
         });
         $("#viewpolicy").on("contextmenu", function(e) {
              return false;
            });
     });
</script>
