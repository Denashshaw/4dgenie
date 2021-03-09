
<div class="page-wrapper chiller-theme toggled">
<style>

</style>
<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>

<main class="page-content">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
  <div class="container-fluid p-0">
    <?php include('page_head.php');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Assessment</div>
		</div>
    <div class="row activity-row">
			<div class="col-md-12 activity">
        <?php if(sizeof($getpendingtest) > 0){ ?>
          <div class="row">
            <div class="col-md-8">
              <form method="POST">
                <p>Select Assessment</p>
                <select id="selectassess" name="selectassess" class="form-control" style="width:50%;" onchange="this.form.submit()">
                  <option value="">Select Assessment Test</option>
                  <?php foreach ($getpendingtest as $a) { ?>
                    <option value="<?php echo $a->title; ?>" <?php if($selectassess == $a->title){ echo "selected";} ?>><?php echo $a->title; ?></option>
                  <?php } ?>
                </select>
              </form>
            </div>
            <?php if($selectassess){ ?>
            <div class="col-md-4">
              <label id="timer" style="margin-left:20%;font-size: 22px;margin-top:5%; "></label>
            </div>
          <?php } ?>
          </div>
      <?php }else{
        echo "<h3 style='color:red'>No Assessment Test Found</h3>";
      } ?>
      </div>
    </div>
    <?php if($selectassess){ ?>
    <div class="row emp-table">
      <div class="col-md-12  table-responsive">
        <form method="POST" action="<?php base_url(); ?>leaderAssessment/submittest">
        <?php

        $i=1;
        foreach ($question as $val) { ?>
          <div class="card" style="background:#e6e5e5">
            <div class="card-body">
              <?php echo $i.") ".$val->question; ?>
              <input type="hidden" value="<?php echo $val->id; ?>" id="question<?php echo $i; ?>" name="question<?php echo $i; ?>">
              <table class="table">
                <tr>
                  <td><input type="radio"  value="a" id="q<?php echo $i; ?>" name="q<?php echo $i; ?>"><?php echo $val->a; ?></td>
                  <td><input type="radio"  value="b" id="q<?php echo $i; ?>" name="q<?php echo $i; ?>"><?php echo $val->b; ?></td>
                  <?php if(!in_array(strtoupper($val->a),array('TRUE','FALSE'))) { ?>
                    <td><input type="radio"  value="c" id="q<?php echo $i; ?>" name="q<?php echo $i; ?>"><?php echo $val->c; ?></td>
                    <td><input type="radio"  value="d" id="q<?php echo $i; ?>" name="q<?php echo $i; ?>"><?php echo $val->d; ?></td>
                  <?php } ?>
                </tr>
              </table>
            </div>
          </div>
          <br>
        <?php
        $i++;
        } ?>
        <input type="hidden" value="<?php echo $selectassess; ?>" name="title">
        <input type="hidden" id="timingval" name="timingval">
        <input type="hidden" value="<?php echo $i-1; ?>" name="noof_question">
        <input type="submit" class="check-in">
      </form>

      </div>
    </div>
    <?php } ?>
  </div>
</main>
<script>

 var now = moment(); // get "now"
 var thirty = moment(now).add(<?php echo $question[0]->timing; ?>,"minutes"); // clone "now" object and add 30 minutes, taking into account weirdness like crossing
 localStorage.setItem("30minstime", thirty);

setInterval(function()
{
var now = moment().format('h:mm:ss');

var getloca = moment(new Date(localStorage.getItem("30minstime"))).format('h:mm:ss');

     if(now == getloca){
    	$('#formsubmit').submit();
     }
},500);


var sec         = (parseInt(<?php echo $question[0]->timing; ?>)*60),
    countDiv    = document.getElementById("timer"),
    secpass,
    countDown   = setInterval(function () {
        'use strict';

        secpass();
    }, 1000);

function secpass() {
    'use strict';

    var min     = Math.floor(sec / 60),
        remSec  = sec % 60;

    if (remSec < 10) {

        remSec = '0' + remSec;

    }
    if (min < 10) {

        min = '0' + min;

    }
    countDiv.innerHTML = min + ":" + remSec;
    $('#timingval').val(min + ":" + remSec);
    if (sec > 0) {

        sec = sec - 1;

    } else {

        clearInterval(countDown);

        countDiv.innerHTML = 'Test Completed';

    }
}

</script>
