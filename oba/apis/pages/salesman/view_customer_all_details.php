<?php
session_start();

//echo  $user_id;
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:../../common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./../common/mobile_layout/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    require_once("./../common/mobile_layout/navbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
       
      </div>
       <!-- Main content -->
    <div class="container" id="load-single-customer">
        
        <div id="singleCustomerAllDetails"> </div>
        
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-header -->
  <!-- /.content-wrapper -->
 
  <?php require_once("./../common/mobile_layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!--  -->
  <?php require_once("./../common/mobile_layout/footer_links.php"); ?>
  <script src="../../js/salesman/customer_profile.js"></script>
  <script src="../../js/salesman/edit_customer_details.js"></script>

  <script>
    const urlparams = new URLSearchParams(window.location.search);
   var  id = urlparams.get('id')
    $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="editCustomerDetails(' + id +')"><i class="fa fa-edit"></i></a></li>');
      $("#heading").text("Customer Details");
  </script>
</body>

</html>