<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:./user_login.php");
    }
    $quary ="SELECT id,name FROM category";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$name);
    $options = "";
    $options_edit ="";
    while($stmt->fetch()){
        $options .="<option value='$id'>$name</option>";
        $options_edit .="<option value='$id' selected>$name</option>";

      }
    $quary_unit ="SELECT id,name FROM units";
    $stmt = $conn->prepare($quary_unit);
    $stmt->execute();
    $stmt->bind_result($id,$name);
    $options_unit = "";
    $options_edit_unit ="";
    while($stmt->fetch()){
        $options_unit .="<option value='$id'>$name</option>";
        $options_edit_unit .="<option value='$id' selected>$name</option>";

      }
    $quary_firm ="SELECT id,name FROM firm";
    $stmt = $conn->prepare($quary_firm);
    $stmt->execute();
    $stmt->bind_result($id,$name);
    $options_firm = "";
    $options_edit_firm ="";
    while($stmt->fetch()){
        $options_firm .="<option value='$id'>$name</option>";
        $options_edit_firm .="<option value='$id' selected>$name</option>";

      }
 ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./layout/haeder.php");?>
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
            <h1 class="m-0">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./add_product.php"  class="btn btn-primary">Add Product </a></li>
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
                <table class="table table-striped" id="example1">
                  <thead>
                    <tr>
                       
                      <th> Name</th>
                      <th> Category</th>
                      <th> Low Price</th>
                      <th> High Price</th>
                      <th> Unit</th>
                      <th> Image</th>
                      <th> Availability</th>
                      <th> Action</th>
                      
                    </tr>
                  </thead>
                  <tbody id="load-table-product">
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
  <div class="modal fade" id="modal-product-remove">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="remove-product-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE PRODUCT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">  
                  <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idremove" autocomplete="off" id="removeid" required>
                  <input type="hidden" id="hidden-p-img-remove" class="form-control" name="removeimage">
                   <h5>Are you sure, You want to delete this Product?</h5>
                  </div>             
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" id="remove-product-sub" value="Remove">               
            
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Remove Model Close-------------------------------------------------------------->
  <!----------------------------------------- Multiple Image Add Modal-------------------------------------------------------------------------------->
  <div class="modal fade" id="modal-add-multiple-img">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div id="loader-multi-img" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="multi-image-form">
            <div class="modal-header">
              <h5 class="modal-title">Add Product Multiple Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="product-id" name="productidimgem">
                <input type="file" id="imageInput" name="files[]" multiple>
                <div class="col-12 form-group">
                <label for="imageInput" id="upload-button" class="btn btn-warning">Upload Images &nbsp; &nbsp;<i class="fas fa-plus"></i></label>
                </div>
               <div id="imagePreview"></div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" id="addmulti-image-sub" value="Add Images">               
            </div>
            </form>   
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------- Multiple Image Colse Modal-------------------------------------------------------------------------------->
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
//Add Multiple Images Of Product
$(document).on("click",".addimgmulti",function(){
    $("#modal-add-multiple-img").modal("show");
    var p_id = $(this).data("productviewid");
    var obj = {p_id: p_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#product-id").val(data[0].id);
       }

    });
    $('#multi-image-form').on('submit',function(e){
      $("#loader-multi-img").show();
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            $.ajax({
            type: 'POST',
            url: '../../apis/add/admin/add_multiple_images.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
               $("#loader-multi-img").hide();
                
                if(response.status == 1){
                    $("#multi-image-form").trigger("reset");
                    $('#modal-add-multiple-img').modal('hide');
                    //location.reload();
                    toastr.success('Images Added Succesfully');
                  //   toastr .delay(1000)
                     toastr .fadeOut(1000);
                   
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
            e.preventDefault();
        });
    
})
loadTableProduct();
//Add Multiple Images Of Product


//Fetch All Records
function loadTableProduct(){
    $("#load-table-product").html("");
    $.ajax({
        url : "../../apis/select/admin/get_product.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              imgurl =value.default_image_url;
              var available = 'checked';
              if(!value.available){
                available = 'unchecked';
              }
              html = html +("<tr>"+
                                   "<td>" + value.name +"</td>"+
                                   "<td>" + value.low_price +"</td>"+ 
                                   "<td>" + value.max_price +"</td>"+ 
                                   "<td>" + value.unit_name +"</td>"+ 
                                   "<td><img src='http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+ imgurl +"' width='90px' height='60px'></td>"+ 
                                   "<td><a href='./view_product.php?id= "+ value.id +"' class='View-product' data-productviewid='"+ value.id +"'><i class='fas fa-eye'></i></a>  &nbsp; &nbsp;<a href='./edit_product.php?id= "+ value.id +"' class='edit-product' data-productviewid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-product'  data-productviewid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>"+
                                   "<td><a href='#' class='addimgmulti' data-productviewid='"+ value.id +"'><i class='fas fa-image'></i></a>&nbsp; &nbsp; &nbsp; &nbsp;<a href='#' class='View-im' data-firmviewid='"+ value.id +"'><i class='fas fa-eye'></i></a> "+ 
                                   "<td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' "+ available +" id='customSwitch3'><label class='custom-control-label' for='customSwitch3'></label></div></td></tr>");
            });
            $("#load-table-product").html(html);  
        }
    });
}
//loadTableProduct();
 //Data Table Script
 $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      'processing': true,
	'serverSide': true,
	'serverMethod': 'post',
	'ajax': {
		  'url':'../../apis/select/admin/get_product.php'
		 },
		 'columns': [
		         	{ data: 'name' },
		         	{ data: 'category'},
		         	{ data: 'low_price' },
		         	{ data: 'max_price' },
		         	{ data: 'unit' },
		            { data: 'default_image_url', 
                  render: function (data, type, row, meta){
                    return type === 'display' ?
                    "<img src='http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+ data +"' width='30px' height='30px'>"
                    : data;
                  }
                },
		            {
                  data: 'available',
                  render: function (data, type, row, meta){
                    return type === 'display' ?
                    "<div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' "+ data +" id='customSwitch3'><label class='custom-control-label' for='customSwitch3'></label></div>"
                    : data;
                  }
                },
		            { data: 'id',
                  render: function (data, type, row, meta){
                    return type === 'display' ?
                    "<a href='./view_product.php?id= "+ data +"' class='View-product' data-productviewid='"+ data +"'><i class='fas fa-eye'></i></a> &nbsp; &nbsp; &nbsp;<a href='./edit_product.php?id= "+ data +"' class='edit-product' data-productviewid='"+ data +"'><i class='fas fa-edit'></i></a>&nbsp; &nbsp; &nbsp;<a href='#' class='remove-product'  data-productviewid='"+ data +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a>&nbsp;&nbsp;&nbsp; <a href='#' class='addimgmulti' data-productviewid='"+ data +"'><i class='fas fa-camera'></i></a>&nbsp; &nbsp; &nbsp; &nbsp;<a href='remove_multiimg_product.php?id="+ data +"' class='multi-view-img' data-productid='"+ data +"'><i class='fas fa-images'></i></a> "
                    :data;
                  }
                 
                }
		      	]
    });
    //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
//Fetch Single Record For Remove Product
$(document).on("click",".remove-product",function(){
  $('#modal-product-remove').modal('show');
    var p_id = $(this).data("productviewid");
    var obj = {p_id: p_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#removeid").val(data[0].id);
        $("#hidden-p-img-remove").val(data[0].default_image_url);
        
       }
    });

   });
//Delete Product 
$('#remove-product-form').on('submit',function(e){
            $("#loader-remove-product").show();
            toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/delete/admin/delete_product.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                $("#loader-remove-product").hide();
                if(response == 1){
                
                  $('#remove-product-form')[0].reset();
                    $('#modal-product-remove').modal('hide');
                    toastr.success('Product Deleted Succesfully');
                   toastr .delay(1000)
                   toastr .fadeOut(1000);
                  
                }
                
            },
            error: function(error) { 
            $('#modal-product-remove').modal('hide');
            toastr.error('Can not delete this item');
            //toastr .delay(1000)
            toastr .fadeOut(1000);
            location.reload();
            
            }
            })
//Delete Product

        });
        
      });
</script>
    <script>
        $(document).ready(function () {
            $('#imageInput').on('change', function (e) {
                var files = e.target.files;

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var image = $('<div class="image-container"><img src="' + e.target.result + '"><span class="remove-image">Remove</span></div>');

                        // Add a click event to the "Remove" button
                        image.find('.remove-image').click(function () {
                            $(this).parent().remove(); // Remove the image container
                        });

                        $('#imagePreview').append(image);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
   
</body>
</html>
