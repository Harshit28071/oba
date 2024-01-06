<?php
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:/new/oba/common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/pages/accountant/mobile/layout/header.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/pages/accountant/mobile/layout/navbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <br>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
          <div class="container-fluid">
            <div id="product"></div>
            <div id="tab-view"></div>
            
           
          </div>
        </section>
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/pages/accountant/mobile/layout/footer.php"); ?>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/pages/accountant/mobile/layout/footer_links.php"); ?>
  </div>
  <script src="/new/oba/js/accountant/viewproductdetails_mobile.js"></script>
  <script>
     $('#heading').text("Product Details"); 
  </script>
</body> 

</html>