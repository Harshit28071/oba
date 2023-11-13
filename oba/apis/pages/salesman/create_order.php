<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
  if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4"){
   header("location:../admin/user_login.php");
}

$quary_s ="SELECT id,name,city FROM customer";
$stmt = $conn->prepare($quary_s);
$stmt->execute();
$stmt->bind_result($id,$name,$city);
$options_s = "";
while($stmt->fetch()){
  $options_s .="<option value='$id'>$name($city)</option>";
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php");?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php 
  require_once("./layout/navbar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Harihar</span>
    </a>

    <!-- Sidebar -->
    <?php require_once("./layout/sidebar.php");?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-12 text-center">
            
        </div>
          <!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
    <section class="content text-center ">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card card-primary">
      <div class="card-body">
        <form role="form">
        <div class="form-group">
<label>Select Customer</label>
<select class="form-control">
<?php echo $options_s; ?>
</select>
</div>
        </form>
</div>
</div>
</div>
</section>
</div>


  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php require_once("./layout/footer_links.php");?>

<script>
$("#heading").text("Create Order");
  </script>
</body>
</html>
