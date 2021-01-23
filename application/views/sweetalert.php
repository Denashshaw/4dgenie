<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if(isset($_COOKIE['success'])) {
  ?><script>
  swal("Success", "<?php echo $_COOKIE['success'] ?>", "success");</script>
  <?php
}else if(isset($_COOKIE['error'])){
  ?><script>
  swal("Error", "<?php echo $_COOKIE['error'] ?>", "error");</script>
  <?php
}else{
}
?>
