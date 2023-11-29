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
<html lang="en"> <?php require_once("./layout/header.php");?> <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../../theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>
      <!-- Navbar --> <?php 
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
            <div id="customerDetails"></div>
            <div id="tab-view"></div>
            <button type="button" class="btn btn-block btn-danger" onclick="showAddModal()">
              <i class="fa fa-plus"></i> Add More Item </button>
            <br>
            <button type="button" onclick="saveOrder()" class="btn btn-block btn-info">
              <i class="fa fa-tick"></i> Save Order </button>
            <br>
          </div>
        </section>
      </div> <?php require_once("./layout/footer.php"); ?>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <!---- MODALs--->
    <div class="modal fade" id="modal-add-item">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="additemForm">
            <div class="modal-header">
              <h5 class="modal-title">Select Item</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Select Category</label>
                <select class="custom-select" id="mainCategory"></select>
              </div>
              <div id="sub-category"></div>
              <div class="form-group">
                <label for="exampleInputEmail1">Select Item</label>
                <select class="custom-select" id="items"></select>
              </div>
              <div id="units"></div>
            </div>
        
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" onclick="addNewItem()" id="edit-unit-save">ADD</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-----> <?php require_once("./layout/footer_links.php");?> <script>
      $("#heading").text("Edit Order");
      
      $("#loader").show();

      function showAddModal() {
        $('#modal-add-item').modal('show');
      }
    </script>
    <script src="../js/salesman js/edit_order.js"></script>
  </body>
</html>