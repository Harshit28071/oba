<?php
session_start();
  if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant"){
   header("location:../common/user_login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/header.php");?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php 
  require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/navbar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 

  <!-- Content Wrapper. Contains page content -->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/content.php");?>
  <!-- /.content-wrapper -->
 <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/footer_links.php");?>
<script>
$("#heading").text("Dashboard");
$("#back-button").css("display", "none");
$("#logout").append('<li class="nav-item">'+
      '<a href="#"><button class="btn btn-info"><i class="fas fa-user"></i></button>  </a>'+
      '<a href="/new/oba/common/user_login.php"><button class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>  </a>'+
      '</li>');
function allCustomers(){
  localStorage.clear();
  window.location.href = "/new/oba/accountant/pages/mobile/all_customer.php";
}
function showProducts(){
  localStorage.clear();
  window.location.href = "/new/oba/accountant/pages/mobile/all_product.php";
}
  </script>
</body>
</html>
