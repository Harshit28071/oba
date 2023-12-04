<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
  if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4"){
   header("location:../admin/user_login.php");
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
 

  <!-- Content Wrapper. Contains page content -->
  <?php require_once("./layout/content.php");?>
  <!-- /.content-wrapper -->
 <?php require_once("./layout/footer.php"); ?>
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
$("#heading").text("Dashboard");
$("#back-button").css("display", "none");
$("#logout").append('<li class="nav-item">'+
      '<a href="./view_salesman_profile.php"><button class="btn btn-info"><i class="fas fa-user"></i></button>  </a>'+
      '<a href="./../../common/logout.php"><button class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>  </a>'+
      '</li>');
function createOrder(){
  localStorage.clear();
  window.location.href = "./create_order.php";
}

function showProducts(){
  localStorage.clear();
  window.location.href = "./show_products.php";
}

function myOrders(){
  localStorage.clear();
  window.location.href = "./my_order.php";
}
function allCustomers(){
  localStorage.clear();
  window.location.href = "./all_customers.php";
}
function distributorOrder(){
  localStorage.clear();
  window.location.href = "./distributor_order.php";
}
  </script>
</body>
</html>
