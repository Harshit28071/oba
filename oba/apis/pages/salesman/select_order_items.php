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
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
    <!-- Content Header (Page header) -->
   <br>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
     <div class="col-md-12">


     <form id="searchForm">
<div class="input-group">
<input type="search" id="search" class="form-control form-control-lg" placeholder="Type here">
<div class="input-group-append">
<button id="searchButton" class="btn btn-lg btn-default">
<i class="fa fa-search"></i>
</button>
</div>
</div>
</form>
<div id="back" style="display:none;">
<br>
<button type="button" class="btn btn-block btn-primary btn-xs" id="backbutton" >Back</button>
  </div>
  </div>
  </div>
  </div>
<br>

<div id="tab-view">

</div>
       
  
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
<script>
   $("#heading").text("Select Order Items");
   $("#three-dot").css("display", "none");
   $("#back-button").on('click',function(){
      history.back();
    });
  $('.custom-button').append('</li><li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="loadCollapseView()" >          <i class="fa fa-fw fa-th-list"></i>        </a>      </li><li class="nav-item"><a class="nav-link"  href="#" role="button" onclick="loadBoxView()">          <i class="fa fa-fw fa-th-large"></i>        </a>      </li>');
$("#loader").show();
  </script>
<script src="../js/salesman js/select_order_items.js"></script>

</body>
</html>