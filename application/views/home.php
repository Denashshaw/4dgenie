<body>
<style type="text/css">
.brktime td{
line-height:25px;
}
</style>

<div class="page-wrapper chiller-theme toggled">

<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" <?php if($userdata['role']!='admin'){?>style="min-height:780px;"<?php } ?>>
				<?php include('page_head.php');?>
				
					
					<div class="row activity-row">
						<div class="col-md-12 activity">Activity</div>
					</div>

					<div class="row activity-table">
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/checkin.jpg"><br><br>
							<a href="<?php echo base_url();?>Checkin_checkout/CheckIn"><button class="check-in" id="checkin">Check-In</button></a>
							</div>
						</div>
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/start-break.jpg"><br><br>
							<a href="<?php echo base_url();?>Breakin_breakout/BreakIn"><button class="start-break" id="breakin" >Start Break</button></a>
							</div>
						</div>
						<!-- <div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/permission.png"><br><br>
							<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
								<select class="permission start-break">
									<option value="0 mins">Permission</option>
									<option value="30 mins">30 Minutes</option>
									<option value="60 mins">60 Minutes</option>
									<option value="90 mins">90 Minutes</option>
									<option value="120 mins">120 Minutes</option>
								</select>
							</div>
						</div> -->
						<div class="col-6 col-md-3 b-right">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/end-break.jpg"><br><br>
							<a href="<?php echo base_url();?>Breakin_breakout/BreakOut"><button class="start-break" id="breakout">End Break</button></a>
							</div>
						</div>
						<div class="col-6 col-md-3">
							<div class="text-center"><img class="icon" src="<?php echo base_url();?>img/checkout.jpg"><br><br>
							<a onclick="redirectUser()" style="color:#fff;"><button class="check-out" id="checkout" >Check-out</button></a>
							</div>
						</div>
					</div>	
						<div class="row emp-table" id="emp-table">
							<div class="col-md-12 table-responsive">
								<table class="table brktime">
									<thead>
										<tr>
										    <th scope="col">Emp ID</th>
										    <th scope="col">Name</th>
										    <th scope="col">Check-IN</th>
										    <th scope="col">Start Break</th>
										    <th scope="col">End Break</th>
										    <th scope="col">Break Period</th>
										    <th scope="col">Check-Out</th>
										    <th scope="col">Permission</th>
										    <th scope="col">Hours Spent</th>
										</tr>
									</thead>
									<tbody>
									<?php if($login_data!=''){?>
								<tr>
									<?php foreach($login_data as $logdata){?>
									<th scope="row"><span class="emp-id"><?php echo $logdata->emp_id;?></span></th>
									<?php
									$cmnt=$this->db->query("SELECT * FROM checkin_checkout WHERE user_id='".$logdata->user_id."' ORDER BY id desc");
									$cmnt1=$this->db->query("SELECT * FROM breakin_breakout WHERE user_id='".$logdata->user_id."' ORDER BY id desc limit 0,3");
                        			$checkin=$cmnt->result();
                        			$breakin=$cmnt1->result();
                        			?>
									<td><?php echo $logdata->name;?></td>
									<td><span class="emp-break-in"><?php echo $checkin[0]->checkin_time;?></span></td>
									<td><span class="emp-break-in">
									<?php 
										for($i=0;$i<count($breakin);$i++){
										    echo $breakin[$i]->breakin_time.'<br>';
										}
									?>
									</span></td>
									<td><span class="emp-break-out">
										<?php 
										for($i=0;$i<count($breakin);$i++){
										    echo $breakin[$i]->breakout_time.'<br>';
										}
										?>
									</span></td>
									<td><span class="" style="color:#5778dc;">
									<?php 
										for($i=0;$i<count($breakin);$i++){
										    echo $breakin[$i]->break_inout_diff.'<br>';	
											$seconds = explode(":", $breakin[$i]->break_inout_diff);
										    $total_bktime += $breakin[$i]->break_inout_diff;
										    $total_bksecs += $seconds[1];
										}
										$minutes = floor($total_bksecs/60);
									    $secondsleft = $total_bksecs%60;
									?>
									</span>
									<span class="emp-break-out">Total Break: <?php echo $total_bktime+$minutes;?> Mins <?php echo $secondsleft;?> Secs</span>
									</td>
									<td><span class="emp-break-out"><?php echo $checkin[0]->checkout_time;?></span></td>
									<td><span class="permission_val" style="color: #938554;">0 mins</span></td>
								    <td><span class=""><?php echo $checkin[0]->check_inout_diff;?></span></td>
								</tr>
								<?php } } ?>
								</tbody>
								</table>
							</div>
						</div>

						<?php if($userdata['role']=='admin'){?>
							<div class="row activity-row">
								<div class="col-md-3 activity">Employee Login Info</div>
									<div class="col-md-9 activity">
										<div class="form-group has-search">
											<span class="fa fa-search form-control-feedback"></span>
											<input type="text" class="search-input" placeholder="Search" id="search">
										</div>
									</div>
								</div>
								<div class="row emp-table">
									<div class="col-md-12 table-responsive">
										<table class="table" id="tabledata">
										    <thead>
										    	<tr>
										      		<th scope="col">Emp ID</th>
										      		<th scope="col">Agent Name</th>
										      		<th scope="col">Dept</th>
										      		<th scope="col">CheckIn Duration</th>
										      		<th scope="col">Status</th>
										    	</tr>
										  	</thead>
											<tbody>
										  		<?php if($emp_data!=''){?>
										    	<tr>
										      	<?php foreach($emp_data as $agentdata){ ?>
										      	<th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id;?></span></th>
										        <td><?php echo ucfirst($agentdata->name);?></td>
										        <td><?php echo ucfirst($agentdata->department);?></td>
										        <?php
										        $cmnt=$this->db->query("SELECT * FROM checkin_checkout WHERE user_id='".$agentdata->user_id."' ORDER BY id desc");
                        					    $check_in=$cmnt->result();
                        					   ?>
										       <td><span class="emp-hours-spent"><?php echo $check_in[0]->check_inout_diff;?></span></td>
										       <td><span class="<?php if($agentdata->status=='loggedin') echo "available"; else echo "loggedout" ?>"><?php echo ucfirst($agentdata->status);?></span></td>
										    	</tr>
												<?php } } ?>
											</tbody>
										</table>
									</div>
									<input type="button" id="seeMoreRecords" value="Show More" class="check-in">
                  					<input type="button" id="seeLessRecords" value="Show Less" class="check-out">
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</main>
		</div>
	</body>

<script type="text/javascript">

function redirectUser(){
	var per_time = $('.permission').val();
     location.replace('<?php echo base_url();?>Checkin_checkout/CheckOut/'+parseInt(per_time)); 	
}

$(document).ready(function(){
	var base_url = $('#base_url').val();
	$.ajax({	
		url: base_url+'Checkin_checkout/checkPermission',	
		method:'POST',	
		success: function(res){	
			if(res){	
				var per_hr = JSON.parse(res);	
				per_hr == 1 ? per_hr='1 hour' : per_hr=per_hr+' hours';	
				$('.permission_val').html(per_hr);	
			}			
		},	
		failed: function(err){	
			console.log(err)	
		}	
	});
	checkinstatus();
	breakinstatus();
});

/* $('.permission').change(function(){
	var base_url = $('#base_url').val();
	$.ajax({
		url: base_url+'Checkin_checkout/insertPermission',
		method: 'POST',
		data: {
			'per_time': $('.permission').val()
		},
		success: function(res){
			$('.permission_val').html($('.permission').val());
			$('.permission').prop("disabled", true);
		},failed: function(err){
			console.log(err);
		}
	});
}); */

var name = '<?php echo $userdata['name'];?>';
function notification(){
  
  if(!window.Notification){
    console.log('Browser does not support notifications.');
  }
  else{
    //check if permission is already granted
    if(Notification.permission === 'granted'){
        var notify = new Notification('Hi' + " " + name + '...!',{
        body: 'Welcome to HRMS...',
        icon: 'https://www.4dglobalinc.com/wp-content/uploads/2017/09/4D-Global-Logo-01-1-e1507835142952.png',
      });
    }
  }
}

var $rows = $('#tabledata tr');
$('#search').keyup(function(){
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function(){
       var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
       return !~text.indexOf(val);
    }).hide();
});


   	function checkinstatus(){
		var id = '<?php echo $userdata['user_id']; ?>';
		$.ajax({
			type   : 'ajax',
			method : 'post',
			url    : '<?php echo base_url();?>Checkin_checkout/checkStatus',
			data   : {id:id},
			dataType: 'json',
			success : function(data){
				if(data!=false){
					if(data.check_inout_flag==1){ 
						$('#checkin').prop("disabled", true).css('opacity',0.5); 
						$('#checkout').prop("disabled", false);
					}
					else{
						$('#checkin').prop("disabled", false); 
						$('#checkout').prop("disabled", true).css('opacity',0.5);
					}
				}
				else if(data==false){
					$('#checkout').prop("disabled", true).css('opacity',0.5);
					//$('#breakout').prop("disabled", true).css('opacity',0.5);
				}
			},
			error : function(){
				alert('Sorry, Something Went Wrong');
			}
		});
	}


	function breakinstatus(){
		var id = '<?php echo $userdata['user_id']; ?>';  
		$.ajax({
    		type   : 'ajax',
			method : 'post',
    		url    : '<?php echo base_url()?>Breakin_breakout/BreakStatus',
    		data   : {id:id},
    		dataType: 'json',
    		success: function(data){
    			if(data!=false){
					if(data.break_inout_flag==1){ 
						$('#breakin').prop("disabled", true).css('opacity',0.5);
						$('#breakout').prop("disabled", false);
					}
					else{
						$('#breakin').prop("disabled", false);
						$('#breakout').prop("disabled", true).css('opacity',0.5);
					}
				}
				else if(data==false){
					$('#breakout').prop("disabled", true).css('opacity',0.5);
				}
    		},
    		error: function() { alert("Error posting feed."); }
  		});
	}

var trs       = $("#tabledata tr");
var btnMore   = $("#seeMoreRecords");
var btnLess   = $("#seeLessRecords");
var trsLength = trs.length;

var currentIndex = 10;

trs.hide();
trs.slice(0, 10).show(); 
checkButton();

btnMore.click(function(e){ 
  e.preventDefault();
  $("#tabledata tr").slice(currentIndex, currentIndex + 10).show();
  currentIndex += 10;
  checkButton();
});

btnLess.click(function(e){ 
  e.preventDefault();
  $("#tabledata tr").slice(currentIndex - 10, currentIndex).hide();          
  currentIndex -= 10;
  checkButton();
});

function checkButton()
{
	
  var currentLength = $("#tabledata tr:visible").length;

    if(currentLength >= trsLength)
      btnMore.hide();            
    else
      btnMore.show();   
    
    if(trsLength > 10 && currentLength > 10)
      btnLess.show();
    else
      btnLess.hide();
}

window.addEventListener("unload", function(){
  var count = parseInt(sessionStorage.getItem('counter') || 0);
  sessionStorage.setItem('counter', ++count)
}, false);

if(sessionStorage.getItem('counter') == null){
 notification();
}
console.log(sessionStorage.getItem('counter'));

</script>
</html>