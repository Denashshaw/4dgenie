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
            //  print_r($rawdata);
              $Q_head=sizeof($rawdata[2][0])-2;
              echo "<thead>";
              $flag=0;
              foreach ($rawdata as $data) {

                  echo "<tr>";
                  for($i=0;$i<sizeof($data);$i++){
                  ?>
                    <td><?php echo $data[$i]; ?></td>
                  <?php
                  }
                  for($header=0;$header<$Q_head;$header++){
                    echo "<td>-</td>";
                  }
                  echo "<td>-</td>";
                  echo "</tr>";
                  //$flag=false;
                  if($flag == 0){break;}
                  $flag++;

              }
              echo "</thead><tbody>";
              $flagtest =0;
              foreach ($rawdata as $data) {
                if($flagtest == 0){ $flagtest++; continue; }
                  echo "<tr style='background:#dcdcdc'>";
                  for($i=0;$i<sizeof($data);$i++){
                  ?>
                    <td><?php echo $data[$i]; ?></td>
                  <?php
                  }
                  for($header=0;$header < $Q_head;$header++){
                    echo "<td>Q".($header+1)."</td>";
                  }
                  echo "<td>Total</td>";
                  echo "</tr>";
                  //$flag=false;
                  if($flagtest == 1){break;}
                  $flagtest++;

              }
              $flag=0;
              foreach ($rawdata as $data) {

                if($flag < 2){ $flag++; continue; }
              //  if($flag == sizeof($rawdata)-1){ break;}
                  echo "<tr>";

                  for($i=0;$i<sizeof($data);$i++){
                    $Questionanswered=array();

                    for($j=0;$j<sizeof($data[0]);$j++) {
                      $ansval=$data[0][$j];

                      if($j==0 || $j ==1){
                        ?><td><?php echo $ansval; ?></td><?php
                      }else{
                        if($ansval == '-'){
                          echo "<td>-</td>";
                          array_push($Questionanswered,0);
                          continue;
                        }
                        $t=0;
                        foreach ($ansval as $ks) {
                          if($t == 0){

                            ?>
                            <td><?php echo $ks; ?></td>

                            <?php
                            $t++;
                            }else{
                              array_push($Questionanswered,$ks);

                            }
                          }
                      }

                    }
                    //echo "<td>".$Questionanswered."</td>";
                    $totalvalue=0;
                    foreach ($Questionanswered as $res){
                      echo "<td>".$res."</td>";
                      $totalvalue=$totalvalue+$res;
                    }
                    echo "<td>".$totalvalue."</td>";
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
  "bSortCellsTop": true,
  buttons: [
  {
     extend:'excel',
     title: 'Assessment Report',
   },
   {
     extend:'pdf',
     title: 'Assessment Report',
   },
   {
     extend:'print',
     title: 'Assessment Report',
   }
   ],
});

</script>
