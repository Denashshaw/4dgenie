<?php
if($userdata['role'] == 'admin'){ ?>
<style>
#chartdiv {
  width: 450px;
  height: 300px;
}
.bg-secondary {
    background-color: #dce0e4!important;
}
</style>
<br>
<div class="card  card-body ">
<div class="row" >

<div class="col-md-3">
    <br>
        <p >Process:</p>
        <select class="col-md-12 col-xs-12 form-control" id="processname" name="processname" onchange="getagentnamedash(this)">
            <option value="All">All</option>
            <option value="Voice">Voice</option>
            <option value="Data">Data</option>
            <option value="QA">QA-Team</option>

        </select>
    </div>
    <div class="col-md-3">
        <div  id="clientlistview">
        <br>
        <p >Agent:</p>
        <select class="col-md-12 col-xs-12 form-control" id="agentname" name="agentname" required>
            <option value="All">All</option>
        </select>
        </div>
    </div>
    <div class="col-md-3">
       
        <br><br>
       <input type="button" value="Search" class="check-out" onclick="getdashboardval()">
    </div>
  
   
</div><br>
<div class="row   card-body bg-Secondary">
<div class="col-md-6">
<div class="col-md-12">
<fieldset class="card" style="border: 1px  solid #3fc98e;">
   <legend  class="w-auto"><b>Top 3</b></legend>
   <br /><div class="top3view"></div><br />
</fieldset>
</div>
<div class="col-md-12">
<fieldset class="card" style="border: 1px  solid #ff5c4b;">
   <legend  class="w-auto"><b>Bottom 3</b></legend>
   <br /><div class="bottom3view"></div><br />
</fieldset>
</div>
</div>


    <div class="col-md-6  bg-Light ">
            <div id="chartdiv"></div>
    </div>
</div>


</div>
<?php }else{ ?>
    <div class="card  card-body bg-Secondary ">
        <div class="row" >
            <div class="col-md-12">
                <div class="card card-body" style="width:150px;height:130px;float:left;margin-left:2%">
                    <p>Pending Assessment</p>
                    <h2><?php echo $agentdash[0]->pending; ?></h5>
                </div>
                <div class="card card-body" style="width:180px;height:130px;float:left;margin-left:2%">
                    <p>Last Assessment Score</p>
                    <h2><?php echo $agentdash[0]->lastassessment?$agentdash[0]->lastassessment:0; ?></h5>
                </div>
                <div class="card card-body" style="width:180px;height:130px;float:left;margin-left:2%">
                    <p>Over-all Assessment Score</p>
                    <h2><?php echo $agentdash[0]->totalassessmentvalue?$agentdash[0]->totalassessmentvalue:0; ?></h5>
                </div>
                <div class="card card-body" style="width:150px;height:130px;float:left;margin-left:2%">
                    <p>% of Score</p><br>
                    <h2><?php echo $agentdash[0]->Scorepercen?round($agentdash[0]->Scorepercen):0; ?></h5>
                </div>
                <div class="card card-body" style="width:150px;height:130px;float:left;margin-left:2%">
                    <p>Rank</p><br>
                    <h2><?php echo $agentRank[0]->rank?$agentRank[0]->rank:0; ?></h5>
                </div>
            </div>
        </div>
    </div>
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
                    <th scope="col">Taken on</th>
                    <th scope="col">Score</th>
                    <th scope="col">Status</th>
                    
                    
                    <!-- <?php if($userdata['role'] == 'admin'){ ?>
                        <th scope="col">Action</th>
                    <?php } ?> -->
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
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $ass->process; ?> </td>
                        <td> <?php echo $ass->emp_id; ?> </td>
                        <td> <?php echo $ass->name; ?> </td>
                        <td> <?php echo $ass_date; ?> </td>
                        <td> <a href="<?php echo $ass->assessment_url; ?>" target="_blank" onclick="viewedassessment(`<?php echo $ass->id; ?>`,`<?php echo $ass->emp_id; ?>`)"><?php echo substr($ass->assessment_url,0,10); ?></a> </td>
                        <td> <?php echo date_format(date_create($ass->takenon),'d-m-Y H:i:s'); ?> </td>
                        <td> <?php echo $ass->score; ?> </td>
                        <td> <?php if($ass->status == 'Viewed'){
                            echo "<span class='check-out'>".$ass->status."</span>";
                        }else if($ass->status == 'Completed'){
                            echo "<span class='check-in'>".$ass->status."</span>";
                        }else{
                            echo "<span class='initiated' data-toggle='tooltip' data-placement='right' title='".$ass->takenon."'>".$ass->status."</span>";
                        }?> </td>
                        <!-- <?php if($userdata['role'] == 'admin'){ ?>
                            <td>
                                <a href="<?php echo base_url() ?>Training/deleteassessment/<?php echo $ass->id; ?>"><i class="fa fa-trash" style="font-size:20px;color:red"></i></a>
                                <?php if($ass->status == 'Viewed'){ ?>
                                    <a ><i class="fa fa-pencil" onclick="updateassessmentscore(`<?php echo $ass->id; ?>`)" style="font-size:20px;color:#3fc98e"></i></a>
                                    <?php } ?>
                            </td>
                        <?php } ?> -->
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
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
//$('#clientlistview').hide();
function getagentnamedash(process){


        //$('#clientlistview').show();
        $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/getprocessemp',
            data   :  {dpt:process.value},
            success : function(data){
                var val =JSON.parse(data);

                var out='';
                out +=' <option value="All">All</option>';
                for(var i=0;i<val.length;i++){

                    out += '<option value="'+val[i].emp_id+'">'+val[i].emp_id+'/'+val[i].name+'</option>';
                }
                $('#agentname').html(out);
            }
        });
   
}


</script>

<script>
getdashboardval();
function getdashboardval(){
    $.ajax({
            method : 'post',
            url    : '<?php echo base_url();?>Training/dashboardval',
            data   :  {process:$('#processname').val(),agent:$('#agentname').val()},
            success : function(data){
                var res = JSON.parse(data);
                if($('#agentname').val() == 'All'){
               var out1='';
               for(var i=0;i<res.top3emp.length;i++){
                    out1 +='<div class="top3" style="width:110px;float:left;margin-left:5%;margin-bottom:2%">'+res.top3emp[i].name+'<h3>'+res.top3emp[i].score+'</h3></div>';
               }
               $('.top3view').html(out1);

               var out2='';
               for(var j=0;j<res.bottom2emp.length;j++){
                    out2 +='<div class="bottom3" style="width:110px;float:left;margin-left:5%;margin-bottom:2%">'+res.bottom2emp[j].name+'<h3>'+res.bottom2emp[j].score+'</h3></div>';
               }
               $('.bottom3view').html(out2);
            }else{
                $('.top3view').html('');
                $('.bottom3view').html('');
            }

                am4core.ready(function() {

                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv", am4charts.PieChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                    chart.data = [
                    {
                        country: "Total Assessment",
                        value: res.drawvalue[0].totalass
                    },
                    {
                        country: "Viewed",
                        value: res.drawvalue[0].viewed
                    },
                    {
                        country: "Completed",
                        value: res.drawvalue[0].completed
                    }
                    ];
                    chart.radius = am4core.percent(70);
                    chart.innerRadius = am4core.percent(40);
                    chart.startAngle = 180;
                    chart.endAngle = 360;  

                    var series = chart.series.push(new am4charts.PieSeries());
                    series.dataFields.value = "value";
                    series.dataFields.category = "country";

                    series.slices.template.cornerRadius = 10;
                    series.slices.template.innerCornerRadius = 7;
                    series.slices.template.draggable = true;
                    series.slices.template.inert = true;
                    series.alignLabels = false;

                    series.hiddenState.properties.startAngle = 90;
                    series.hiddenState.properties.endAngle = 90;

                    chart.legend = new am4charts.Legend();

                    }); // end am4core.ready()

            }
        });
}

</script>
