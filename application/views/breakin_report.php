<body>
<div class="page-wrapper chiller-theme toggled">
  <?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
        <?php include('page_head.php');?>
					<div class="row activity-row">
						<div class="col-md-12 activity">Break In-Out Report</div>
					</div>			
					<div class="row emp-table">
						<div class="col-md-3">
              <form method="post" action="<?php echo base_url();?>Report/break_report">
                <div class="row">
                  <input type="text" class="form-control" placeholder="FromDate" name="fromdate" id="fromdate" required="" value="<?php echo $_POST['fromdate'];?>">
                  <input type="text" class="form-control" placeholder="ToDate" name="todate" id="todate" required="" value="<?php echo $_POST['todate'];?>">
                  <?php 
                    $sql=$this->db->query("SELECT * FROM users WHERE role!='admin' ");
                    $res=$sql->result();
                  ?>
                  <select class="form-control" name="user_id">
                    <option value="">--Select Agent--</option>
                    <?php for($i=0;$i<count($res);$i++){ ?>
                    <option value="<?php echo $res[$i]->user_id;?>" <?php if($_POST['user_id'] == $res[$i]->user_id){ echo 'selected'; }?>><?php echo $res[$i]->name?></option>
                  <?php }?>
                  </select><br><br>
                  <?php 
                    $sql=$this->db->query("SELECT * FROM users WHERE role!='admin' GROUP BY department");
                    $res_dept=$sql->result();
                  ?>
                  <select class="form-control" name="deprt">
                    <option value="">--Select Department--</option>
                    <?php for($i=0;$i<count($res_dept);$i++){ ?>
                    <option value="<?php echo $res_dept[$i]->department;?>" <?php if($_POST['deprt'] == $res_dept[$i]->department){ echo 'selected'; }?>><?php echo $res_dept[$i]->department;?></option>
                  <?php }?>
                  </select><br><br>
                  <input type="submit" value="submit" name="submit" class="check-in">
                </div>
              </form>
					  </div>
				  </div>
          <?php if($brkin_rep!=''){?>
            <div class="row emp-table">
              <div class="col-md-12 table-responsive">
                <input type="button" id="Exportpdf" onclick="javascript:generate();" value="Export As PDF" class="start-break"/>
                <input type="button" id="Export_excel" value="Export As Excel" class="check-out"/>
                <table class="table" id="tbldata">
                  <thead>
                    <tr>
                      <th scope="col">Emp ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Dept</th>
                      <th scope="col">Role</th>
                      <th scope="col">BreakIn</th>
                      <th scope="col">BreakOut</th>
                      <th scope="col">Duration</th>
                      <!-- <th scope="col">Status</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php foreach($brkin_rep as $brkindata){ ?>
                      <th scope="row"><span class="emp-id"><?php echo $brkindata->emp_id;?></span></th>
                      <td><?php echo ucfirst($brkindata->name);?></td>
                      <td><?php echo ucfirst($brkindata->department);?></td>
                      <td><?php echo ucfirst($brkindata->role);?></td>
                      <td><?php echo $brkindata->breakin_time;?></td>
                      <td><?php echo $brkindata->breakout_time;?></td>
                      <td><span class=""><?php echo $brkindata->break_inout_diff;?></span></td>
                    </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
              </div>
			    </div>
		  </div>
	  </div>
  </main>	
</div>
</body>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.table2excel.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jspdf.debug.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jspdf.plugin.autotable.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#fromdate').datetimepicker();
    $('#todate').datetimepicker();
  });
</script>
<script type="text/javascript">
function generate() {
  var doc = new jsPDF('p', 'pt','letter');
  var res = doc.autoTableHtmlToJson(document.getElementById("tbldata"));
  doc.autoTable(res.columns, res.data, {margin: {top: 80}});

  var header = function(data){
    doc.setFontSize(18);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
  };

  doc.save("Break_InOut_Reoprt.pdf");
}


  $('#Export_excel').click(function(){
    $("#tbldata").table2excel({
      exclude: ".noExl",
      name: "Worksheet Name",
      filename: "Break_InOut_Reoprt",
      fileext: ".xls"
    }); 
  });
</script>
</html>