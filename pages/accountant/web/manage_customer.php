<?php
session_start();
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant"){
  header("location:/new/oba/common/user_login.php");
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
  <?php require_once("../../common/web_layout/manage_customer_content.php"); ?>
  <!----------------------------------------Remove Model Close-------------------------------------------------------------->
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

$(document).ready(function(){
    
    //Fetch All Records
    $(function () {
        $("#customertab").DataTable({
          "responsive": true, 
          "lengthChange": false, 
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'/new/oba/apis/select/admin/get_customer.php'
         },
         'columns': [
                   { data: 'name' },
                   { data: 'mobile_number'},
                   { data: 'type' },
                    { data: 'id',
                      render: function (data, type, row, meta){
                       
                        return type === 'display' ?
                        "<a href='./view_customer.php?id="+ data +"' class='View-product' data-productviewid='"+ data +"'><i class='fas fa-eye'></i></a>"
                        :data;
                      }
                     
                    }
                ]
        });
        //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
      });
    });
 

     
    
  </script>
</body>
</html>
