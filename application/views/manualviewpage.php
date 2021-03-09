<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$dir = $page1;
$pagename = $page2;
$pageexten = explode(".",$pagename);
?>
<main class="page-content">
	<div class="container p-5">
        <div class="row">
            <div class="col-md-12"  style="padding-left:25%">
            <?php if(end($pageexten) != 'pdf'){
                ?>
                <!-- <iframe loading="eager" class="doc" src="https://docs.google.com/gview?url=http://4dglobalinc.net/4d_demo_training/training_module/<?php echo $dir."/".$pagename; ?>&embedded=true" width="700" height="550"></iframe> -->
								  <iframe loading="eager" class="doc" src="https://docs.google.com/gview?url=http://localhost/4dgenie/training_module/<?php echo $dir."/".$pagename; ?>&embedded=true" width="700" height="550"></iframe>
                <?php
            }else{
                ?>
                <iframe loading="eager" class="doc" src="http://localhost/4dgenie/training_module/<?php echo  $dir."/".$pagename; ?>" width="700" height="550"></iframe>
                <?php
            }
            ?>

            </div>
        </div>
        <div class="row"><br>
            <div class="col-md-12"  style="background-color:#0080006e;height:100px;"><br>
                <div class="mfooter" style="display:none;margin-left:40%">
                    <input type="checkbox" class="form-check-input" >
                    <label class="form-check-label" style="font-weight:bold">Have read document</label>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
$( document ).ready(function() {
    $('iframe').on('load', function(){
        console.log('Iframe Loaded');
    });
 setTimeout(function(){
        $('.mfooter').show();
      }, 30000);

});
</script>
