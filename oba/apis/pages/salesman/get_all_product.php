<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "4"){
    header("location:./user_login.php");
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
          <div class="col-sm-6">
            <h1 class="m-0">View All Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#"  class="btn btn-primary" id="tab-view-btn">Table </a></li>
            <li class="breadcrumb-item active"><a href="#"  class="btn btn-primary" id="li-view">List  </a></li>
            <li class="breadcrumb-item active"><a href="#"  class="btn btn-primary" id="third-view-btn">Example </a></li>


            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
       <div id="tab-view">
    <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped" id="example1">
                  <thead>
                    <tr> 
                      <th> Name</th>
                      <th> Category</th>
                      <th> Max Price</th>
                      <th> Gst Rate</th>
                      <th> Image</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
       </div>
  <!--List view Div -->
  
       <div id="collalaps-view" class="container-fluid">
       <div class="row">
        
       </div>
       </div>
  <!--list View Close-->
  <!--Third view Div -->
  <div id="third-view" >
       <h1>hello</h1>
      </div>
  <!--Third View Close-->
      </div>
   </section>
  </div> 
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
<script src="../js/salesman js/viewproduct.js"></script>

</body>
</html>
