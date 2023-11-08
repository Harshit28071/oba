<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
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
            <h3 class="m-0">Add Product Details</h3>
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
                <form id="add-product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="" required>
                    <span id="validation_product" class="text-danger"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" name="pcategory" required>
                          <?php echo $options;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punit">
                          <?php echo $options_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-4 form-group">
                 
                    <!-- <input type="text" class="form-control" placeholder="Enter Secondary Unit "    autocomplete="off" required> -->
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunit"  id="secondaryunit">
                        <option value="0">no select</option> 
                        <?php echo $options_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplier" autocomplete="off">
                    
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowprice" autocomplete="off" id="">
                  </div>
                  <div class="col-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxprice" autocomplete="off" id="">
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrp" autocomplete="off" id="">
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncode" autocomplete="off" id="" required>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrate" autocomplete="off" id="" required>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmid">
                          <option value="0" selected >No Select</option>
                          <?php echo $options_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstprice" autocomplete="off" id="f-state">
                    
                  </div>
                  <div class="col-12 form-group">
                    <label for="exampleInputFile">Upload Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="p-img" name="productimage" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <input type="submit"  class="btn btn-primary btn-lg float-right" id="add-product-sub" value="Add Product">
              </form>
              </div>
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
   //Script For Multipler Eanble Disable
//function checkInput(){
//   var secondunit = document.getElementById("secondaryunit");
//   var multi = document.getElementById("multiplier");

//   if (secondunit.value.trim() === "") {
//     //multi.disabled = true;
//     multi.hidden =true;
//   } else {
//     multi.hidden = false;
//   }
// }
$("#secondaryunit").change(function(){
  var select = $(this).val();
  //console.log(select);
  if(select == 0){
   $("#multiplier").prop("disabled",false);
  }else{
    $("#multiplier").prop("disabled",true);

  }
 })
</script>
<script type="text/javascript">
 $(document).ready(function(){
    $('#add-product-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/add_product.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response.status == 1){
                    $('#add-product-form')[0].reset();
                    //$('#modal-add-product').modal('hide');
                    window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_product.php#");
                    loadTableProduct();  
                }
                
            }
            })
        });

  });
  </script>
</body>
</html>
