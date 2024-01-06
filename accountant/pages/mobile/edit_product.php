<?php
session_start();


require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/fetch_master_data.php");

$options_edit = loadCategory();
$options_edit_unit = loadUnits();
$options_edit_firm = loadFirms();

if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4") {
  header("location:/new/oba/common/user_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/header.php"); ?>

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
<br>
   <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/pages/edit_product_content.php") ?>
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/footer.php"); ?>
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/accountant/pages/mobile/layout/footer_links.php"); ?>
  </div>
  <script src="/new/oba/common/js/edit_product.js"></script>
  <script>
     $('#heading').text("Edit Product"); 
  </script>
</body> 

</html>