
<style>
.fa-stack[data-count]:after{
  position:absolute;
  right:0%;
  top:1%;
  content: attr(data-count);
  font-size:45%;
  padding:.6em;
  border-radius:80px;
  line-height:.75em;
  color: white;
  background:rgba(255,0,0,.85);
  text-align:center;
  min-width:2em;
  font-weight:bold;
}
#timerview{
  font-family: 'Montserrat', sans-serif;
    background: #5caddc;
    box-shadow: none !important;
    border: none;
    border-radius: 20px;
    padding: 5px 25px;
    color: #fff;
    font-size: 15px;
}
.fa-pencil-alt{
  color:#24cb5b;
  font-size:15px;
  cursor:pointer;
  padding:15%;
}
.fa-trash{
  color:#ff5c4b;
  font-size:18px;
  cursor:pointer;
}
</style>

<div class="row head-content">
	<div class="col-8 col-md-4 logo"><img src="<?php echo base_url(); ?>img/logo.jpg"></div>
  <div class="col-md-4">
    <p id="timer" style="padding-top:5%;padding-left:10%;"></p>
  </div>
	<div class="col-1 col-md-3  text-right logout">

    <span class="fa-stack fa-2x has-badge" data-count="0" onclick="viewnotification()">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
        </span>
    </div>
    <div class="col-2 col-md-1 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
</div>
<div class="viewnotification_part" style="display:none;">
    <div class="card" style="margin-left: 800px;position: absolute;width:360px;z-index: 1;    margin-top: -21px;max-height:400px; overflow-y: scroll;">
    <ul class="list-group list-group-flush viewnotification_hrms_text">
        <!-- <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item" id="testview"></li> -->
    </ul>
    </div>
</div>
<script>
$(document).ready(function(){
setInterval(function(){
  var base_url = "<?php echo base_url(); ?>";
  $.ajax({
    url : base_url+"Notification/viewcheckinduriation",
    method : "POST",
    success : function(datares){
      var res=JSON.parse(datares);
      localStorage.setItem('checkid',res[0]['id']);
      localStorage.setItem('timing',res[0]['timedifferent']);
      if(parseInt(res[0]['timedifferent'].split(":")[0]) > 24){}else{
        $('#timer').html('<b id="timerview"><i class="fa fa-clock" aria-hidden="true"></i><span class="runingtime">'+res[0]['timedifferent']+'</span></b>');
      }
    }
  });
}, 1000);
});

function viewnotification(){
    $('.viewnotification_part').toggle();
}
getnoficiation_hrmsView();
function getnoficiation_hrmsView(){
    var emp_id = "<?php echo $userdata['emp_id']; ?>";
    var base_url = "<?php echo base_url(); ?>";
    $.ajax({
        url : base_url+"Notification/getnofi",
        method : "POST",
        data:{"emp_id":emp_id},
        success : function(datares){
        var res = JSON.parse(datares);
        console.log(res);
        var out='';
        var count=0;
        for(var i=0;i<res.length;i++){
            var postedtime = diffDateAndToString(res[i]["created_date"]);
            console.log(postedtime);
            var days = parseInt(postedtime['Days']);
            var hours = parseInt(postedtime['Hours']);
            var minsget = parseInt(postedtime['Mins']);
            if(days != 0){
                if(days > 1){
                    var differentDuration = days+' Days';
                }else{
                    var differentDuration = days+' Day';
                }

            }else{
                if(hours != 0){
                    var differentDuration = hours+' Hours '+minsget+' Mins';
                }else{
                    var differentDuration = minsget+' Mins';
                }

            }
            var hreflink;
            var linkhref_notification;
            if(res[i]["module_name"] == 'One on One Feedback'){
                hreflink = '<a href="<?php echo base_url(); ?>feedbackform/feedbackmanager" onclick="updatethestatus('+res[i]["id"]+')">';
                linkhref_notification = "<?php echo base_url(); ?>feedbackform/feedbackmanager";
            }
            else if(res[i]["module_name"] == 'IT Help Desk'){
                hreflink = '<a href="<?php echo base_url(); ?>Ticket" onclick="updatethestatus('+res[i]["id"]+')">';
                linkhref_notification = "<?php echo base_url(); ?>Ticket";
            }
            else if(res[i]["module_name"] == 'Emp Separation'){
                hreflink = '<a href="<?php echo base_url(); ?>Separation" onclick="updatethestatus('+res[i]["id"]+')">';
                linkhref_notification = "<?php echo base_url(); ?>Separation";
            }else if(res[i]["module_name"] == 'Assessment'){
                hreflink = '<a href="<?php echo base_url(); ?>leaderAssessment" onclick="updatethestatus('+res[i]["id"]+')">';
                linkhref_notification = "<?php echo base_url(); ?>leaderAssessment";
            }
            else{
                hreflink = '<a href="#">';
                linkhref_notification = "http://192.168.2.193/4dgenie";
            }

            if(res[i]["status"] != 0){

                var bg = "style='background:#e0e2ea;border-bottom:2px solid lightgray;color:#104c91'";
                var secondbg = "";

            }else{
                var bg = "style='background:white;border-bottom:2px solid lightgray;color:#104c91;'";
                var secondbg = "style='font-weight:bold;font-size:20px;'";
                count++;

                if(sessionStorage.getItem('counter') == null){
                    if (Notification.permission !== "granted") {
                    Notification.requestPermission();
                    }
                    else{
                        var notification = new Notification('Hi' + " " + name + '...!',{
                        body: res[i]["details"],
                        icon: 'https://www.4dglobalinc.com/wp-content/uploads/2017/09/4D-Global-Logo-01-1-e1507835142952.png',
                    });
                    notification.onclick = function () {
                    window.open(linkhref_notification);
                    };
                    }
                }
            }
            out += hreflink+'<li class="list-group-item " '+bg+'><span '+secondbg+'>'+res[i]["module_name"]+'</span><span style="font-size:11px;color: transparent;text-shadow: 0 0 1px rgba(0,0,0,0.5);float:right">'+differentDuration+'</span><br>'+res[i]["details"]+'</li></a>';

        }
        $('.viewnotification_hrms_text').html(out);
        $('.has-badge').attr('data-count',count);

        //$('#testview').html(datares);
        }
    })
}

function updatethestatus(indexval){
    var base_url = "<?php echo base_url(); ?>";
    $.ajax({
        url : base_url+"Notification/updatenotification",
        method : "POST",
        data:{"indexid":indexval},
        success : function(datares){
            getnoficiation_hrmsView();
        }
    });
}
function diffDateAndToString(smalldate) {
var small = new Date(smalldate);
var big = new Date();
// To calculate the time difference of two dates
const Difference_In_Time = big.getTime() - small.getTime()

// To calculate the no. of days between two dates
const Days = Difference_In_Time / (1000 * 3600 * 24)
const Mins = Difference_In_Time / (60 * 1000)
const Hours = Mins / 60

const diffDate = new Date(Difference_In_Time)

//console.log({ date: small, now: big, diffDate, Difference_In_Days: Days, Difference_In_Mins: Mins, Difference_In_Hours: Hours })

var result = ''

if (Mins < 60) {
    result = Mins + 'm'
} else if (Hours < 24) result = diffDate.getMinutes() + 'h'
else result = Days + 'd'
return { result, Days, Mins, Hours }
}



</script>
