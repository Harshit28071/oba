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
<?php require_once("./../common/mobile_layout/header.php");?>
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
   <br>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid sticky">
        <div class="row">
     <div class="col-md-12">
<div >
<p class="text-center font-20" id="totalAmount"></p>
</div>

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
<button type="button" class="btn btn-block btn-danger" id="backbutton" >Back</button>
  </div>
  </div>
  </div>
  </div>


<div id="tab-view">

</div>
       
  
      </div>
   </section>
  </div> 
 <?php require_once("./../common/mobile_layout/footer.php"); ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->

<?php require_once("./../common/mobile_layout/footer_links.php");?>
<script>
   $("#heading").text("Select Order Items");
  
  
  $('.custom-button').append('<li class="nav-item">'+
'<a class="nav-link" onclick="loadCart()" role="button">'+
'<i class="fas fa-cart-plus"></i>'+
'</a>'+
'</li>'+
  '<li class="nav-item dropdown">'+
        '<a class="nav-link" data-toggle="dropdown" href="#">'+
          '<i class="fas fa-th-large"></i>'+
        '</a>'+
        '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'+
          
          '<a onclick="loadBoxView()" class="dropdown-item">'+
            '<i class="fas fa-box mr-2"></i> Box View'+
          '</a>'+
          '<div class="dropdown-divider"></div>'+
          '<a onclick="loadCollapseView()" class="dropdown-item">'+
            '<i class="fas fa-list mr-2"></i> Combobox View'+
          '</a>'+
          
        '</div>'+
      '</li>');
$("#loader").show();
  </script>
<script src="../../js/salesman/select_order_items.js"></script>

</body>
</html>
