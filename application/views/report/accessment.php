<div class="page-wrapper chiller-theme toggled">
<style>

</style>
<?php
 $this->load->view('header');
  $userdata=$this->session->all_userdata();
?>

<main class="page-content">


  <div class="container-fluid p-0">
    <?php $this->load->view('page_head');?>
    <div class="row activity-row">
			<div class="col-md-12 activity">Assessment</div>
		</div>
    <div class="row activity-row">
			<div class="col-md-12 activity">
        <form method="post" action="<?php echo base_url(); ?>leaderAssessment/Accessment_report">
        <div class="row">

            <div class="col-md-3">
              <p>Select Assessment</p>
                <select id="selectassess" name="selectassess" class="form-control" required>
                  <option value="">Select Assessment Test</option>
                  <?php foreach ($title as $a) { ?>
                    <option value="<?php echo $a->title; ?>" <?php if($select_title==$a->title){ echo "selected"; } ?>><?php echo $a->title; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-3">
                <p>Report</p>
                  <select id="selectreport" name="selectreport" class="form-control"  required>
                    <option value="">Select Report</option>
                    <option value="Assessment Score" <?php if($select_report=="Assessment Score"){ echo "selected"; } ?>>Assessment Score</option>
                    <option value="Assessment Raw Data" <?php if($select_report=="Assessment Raw Data"){ echo "selected"; } ?>>Assessment Raw Data</option>
                  </select>
              </div>

              <div class="col-md-3" style="padding-top:3%">
                <input type="submit" class="check-in" value="View Report">
              </div>
          </div>
        </form>
        <div class="row emp-table">
          <div class="col-md-12">
            <table class="table table-bordered dt" id="datatable_score">
            <?php if($scoreview){ ?>

                <thead>
                  <tr>
                    <td>Emp ID</td>
                    <td>Emp Name</td>
                    <td>Status</td>
                    <td>Total Questions</td>
                    <td>Answered</td>
                    <td>Score</td>
                    <td>Date of Complete</td>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($scoreview as $dataset) { ?>
                  <tr>
                    <td><?php echo $dataset['empid']; ?></td>
                    <td><?php echo $dataset['name']; ?></td>
                    <td><?php echo $dataset['status']; ?></td>
                    <?php $mk =$dataset['mark'];
                    $get_mk=explode("/",$mk);
                    //if($get_mk[0] && $get_mk[1]){
                    $score=((int)$get_mk[0]/(int)$get_mk[1])*100;
                     ?>
                    <td><?php echo $get_mk[0]?$get_mk[1]:'-'; ?></td>
                    <td><?php echo $get_mk[1]?$get_mk[0]:"-"; ?></td>
                    <td><?php echo is_nan($score)?number_format(0,2).'%':number_format($score,2).'%'; ?></td>
                    <td><?php echo $dataset['date']?$dataset['date']:'-'; ?></td>
                  </tr>
                  <?php } ?>
            <?php } ?>


            <?php if($rawdata){
              echo "<thead>";
              $flag=0;
              foreach ($rawdata as $data) {

                  echo "<tr>";
                  for($i=0;$i<sizeof($data);$i++){
                  ?>
                    <td><?php echo $data[$i]; ?></td>
                  <?php
                  }
                  echo "</tr>";
                  //$flag=false;
                  if($flag == 1){break;}
                  $flag++;

              }
              echo "</thead><tbody>";
              $flag=0;
              foreach ($rawdata as $data) {
                if($flag < 2){ $flag++; continue; }
                  echo "<tr>";
                  for($i=0;$i<sizeof($data);$i++){
                    for($j=0;$j<sizeof($data[0]);$j++) { ?>
                      <td><?php echo $data[0][$j]; ?></td>
                    <?php  }
                  }
                  echo "</tr>";
                  $flag++;
                }
                echo "</tbody>";
              }
              ?>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
</div>
<script>
$('.dt').DataTable({
  dom: 'Bfrtip',
// /  "bSortCellsTop": true,
  buttons: [
  {
     extend:'excel',
     title: 'Accessment Report',
   },
   {
     extend:'pdf',
     title: 'Accessment Report',
   },
   {
     extend:'print',
     title: 'Accessment Report',
   }
   ],
});

</script>