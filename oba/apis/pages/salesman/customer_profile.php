<?php
session_start();

//echo  $user_id;
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:../../common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/header.php"); ?>

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
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
       
      </div>
       <!-- Main content -->
    <div class="container" id="load-single-customer">
        <div id="singleCustomerDetails"> </div>
        
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-header -->
  <!-- /.content-wrapper -->
  <!--View Customer All Details-->
  <div class="modal fade" id="modal-view-details">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="main-heading">Customer Details</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="pop-body">
<p></p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-outline-dark btn-sm" id="done-btn">Edit</button>
</div>
</div>
</div>
</div>
<!--Customer All Details Pop Up-->
  <?php require_once("./layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!--  -->
  <?php require_once("./layout/footer_links.php"); ?>
  <script src="../js/salesman js/customer_profile.js"></script>
  <script>
    //  $('.custom-button').append('<li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="sortData()">          <i class="fa fa-sort" aria-hidden="true"></i>        </a>      </li>');
      $("#heading").text("Customer Details");
  </script>
</body>

</html>