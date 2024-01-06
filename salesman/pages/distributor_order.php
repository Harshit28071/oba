<?php
session_start();
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
        <div class="card card-primary align-middle">
      <div class="card-body">
      <form role="form">     
<div class="form-group">
<div class="form-group">
<select class="form-control" id="show-customer">
<option selected style="text-align: center;" value="">SELECT DISTRIBUTOR </option>
</select> <br>
<div>
<div class="row">
<div class="col-12">
<button type="button" onclick="selectOrders()" class="btn  btn-danger btn-block">Create Order</button>
</div>
</div>
<br>
<b>OR</b>
</div><br>
<div><a href="./add_customer.php" id="add-cust"><button type="button" class="btn  btn-info btn-block">Add Distributor</button></a></div><br>

</div>
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
<script src="/new/oba/salesman/js/distributor_order.js"></script>
<script>
$("#heading").text("Create Distributor Order");
  </script>
</body>
</html>
