<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
    header("location:./user_login.php");
    }
    $product_id = $_GET['id'];
    $stmt =$conn->prepare("SELECT hd_images.id,hd_images.product_id,hd_images.image_url FROM product RIGHT JOIN  hd_images ON product.id = hd_images.product_id WHERE product.id = ?");
    $stmt->bind_param("i",$product_id);
    $stmt->bind_result($id,$product_id,$image_url);
    $stmt->execute();
    // while($stmt->fetch()){
    //     echo $product_id;
    //     echo $image_url;
    // }
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
            <h3 class="m-0">View Product Details</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="http://localhost/oba/oba/oba/apis/pages/admin/manage_product.php#" id="back-view-product" class="btn btn-primary">Back</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
      <div class="card-body">
      <div id="loader-img-mutli-remove" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
      <form id="multi-image-delete">
      <div class="row">
     <?php while($stmt->fetch()){?>
      
      <div class="col-sm-2">
        <input type="hidden" id="product-multi-id" name="imageid" value="<?php echo $id;?>">
        <input type="hidden" id="product-multi-id" name="imgname" value="<?php echo $image_url;?>">
         <img src="./uploads/<?php echo $image_url;  ?>" alt="no"  class="img-fluid mb-2"  >
         <input type="submit" value="remove" name="removeimg" class="btn btn-block btn-danger btn-lg-" >
      </div> 
      
              <?php }?>
              </div>
              </form>
              
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
<script type="text/javascript">
$("#multi-image-delete").on("submit",function(e){
  $("#loader-img-mutli-remove").show();

  toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
  $.ajax({
            type: 'POST',
            url: '../../apis/delete/admin/delete_product_imges.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
             $("#loader-img-mutli-remove").hide();
                if(response == 1){
                  toastr.success('Image Deleted Succesfully');
                //  toastr .delay(1000)
                  toastr .fadeOut(1000);
                  location.reload();
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
            e.preventDefault();
})
  </script>
</body>
</html>
