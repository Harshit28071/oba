<?php
session_start();
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:/new/oba/common/user_login.php");
    }
    $quary ="SELECT id,state FROM state";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$state);
    $options = "";
    $options_edit ="";
    $selected = "";
    while($stmt->fetch()){
        $selected = ($state === 'UP') ? 'selected': '' ;
        $options .="<option value='$id' $selected>$state</option>";


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
            <h1 class="m-0">Manage Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./add_customer.php" id="" class="btn btn-primary">Add Customer</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped" id="customertab">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Type</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody id="load-table-category">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
      </div>
   </section>
  </div>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-custome">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="remove-customer-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE PRODUCT CATEGORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" class="form-control" name="removecustid" id="customer-remove-id">
                 
                   <h5>Are you sure, You want to delete this customer?</h5>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-danger" id="remove-role-sub" value="Remove">
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
<script type="text/javascript">
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
		  'url':'../../apis/select/admin/get_customer.php'
		 },
		 'columns': [
		         	{ data: 'name' },
		         	{ data: 'mobile_number'},
		         	{ data: 'type' },
		            { data: 'id',
                  render: function (data, type, row, meta){
                    return type === 'display' ?
                    "<a href='./view_customer.php?id="+ data +"' class='View-product' data-productviewid='"+ data +"'><i class='fas fa-eye'></i></a> &nbsp; &nbsp; &nbsp;<a href='./edit_customer.php?id="+ data +"' class='edit-product' data-productviewid='"+ data +"'><i class='fas fa-edit'></i></a>&nbsp; &nbsp; &nbsp;<a href='#' class='remove-customer'  data-customerremoveid='"+ data +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a>"
                    :data;
                  }
                 
                }
		      	]
    });
    //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
// //Fetch All Records Close
//Fetch Single Record : Show Model

// fetch singlr record for remove product category
$(document).on("click",".remove-customer",function(){
  $('#modal-remove-custome').modal('show');
    var cust_r_id = $(this).data("customerremoveid");
    var obj = {cust_id: cust_r_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#customer-remove-id").val(data[0].id);
       
        
       }
    });

   });
//
//Delete Role 
$('#remove-customer-form').on('submit',function(e){
        toastr.options = {
                          "positionClass": "toast-top-right",
                          "preventDuplicates": true
                         };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/delete/admin/delete_customer.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response == 1){
                  //  $('#edit-category-form')[0].reset();
                    $('#modal-remove-custome').modal('hide');
                    DataTable();
                    toastr.success('Customer Deleted Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                    
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
    });
     //Delete Role Close
</script>
</body>
</html>
