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
            <h3 class="m-0">Edit Product Details</h3>
          </div><!-- /.col -->
         <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-primary">
              <div class="card-body">
              <div id="loader-edit-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pnameedit" autocomplete="off" id="name-edit" required>
                    <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idedit" autocomplete="off" id="ide" required>

                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select  Category</label>
                        <select class="form-control" name="pcategoryedit" id="catedit" required>
                          <?php echo $options_edit;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punitedit" id="unitedit">
                          <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-4 form-group">
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunitedit" id="editsecondaryunit">
                        <option value="0">No Select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplieredit"  id="multiplieredit" autocomplete="off">
                    
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowpriceedit" autocomplete="off" id="lowpedit">
                  </div>
                  <div class="col-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxpriceedit" autocomplete="off" id="maxpedit">
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrpedit" autocomplete="off" id="mrpedit">
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncodeedit" autocomplete="off" id="hsnedit" required>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrateedit" autocomplete="off" id="gstrateedit" required>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmidedit" id="firmidedit">
                        <option value="0">No Firm Selected</option>
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstpriceedit" autocomplete="off" id="gstpriceedit">
                   
                  </div>
                  <div class="col-6 form-group">
                  <label>Gst Name</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstnameedit" autocomplete="off" id="gst-name-edit"> 
                  </div>
                  <div class="col-6 form-group">
                  <label>Qty_step</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="Qty_step_edit" autocomplete="off" id="Qty-step-edit"> 
                  </div>
                  <div class="col-12 form-group">
                    <label for="exampleInputFile">Change Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="productoldimage" name="productimagenew" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                   
                  </div>
                  <div class="col-12 form-group">
                  <label for="exampleInputFile">View Image</label>
                  <div class="form-group">
                    <img src="" id="edit-p-main-img" class="form-control" style="width:200px; height:140px;">
                    <input type="hidden" id="hidden-p-img" class="form-control" name="oldimageproduct">
                  </div>    
                </div>
                </div>
                <input type="submit"  class="btn btn-warning btn-lg  float-right" id="edit-product-sub" value="Save Changes">               
                <!-- /.card-body -->
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
//     function checkInputEdit(){
//   var secondunit = document.getElementById("editsecondaryunit");
//   var multi = document.getElementById("multiplieredit");

//   if (secondunit.value.trim() === "") {
//     multi.hidden =true;
//   } else {
//     multi.hidden = false;
//   }
 

// }
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#productoldimage').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   // console.log(id);
    var p_id = id;
    var obj = {p_id : p_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#ide").val(data[0].id);
        $("#name-edit").val(data[0].name);
        $("#catedit").val(data[0].category_id);
        $("#unitedit").val(data[0].unit_id);
        $("#editsecondaryunit").val(data[0].secondary_unit_id);
        $("#multiplieredit").val(data[0].multiplier);
        $("#lowpedit").val(data[0].low_price);
        $("#maxpedit").val(data[0].max_price);
        $("#mrpedit").val(data[0].mrp);
        $("#hsnedit").val(data[0].hsn_code);
        $("#gstrateedit").val(data[0].gst_rate);
        $("#firmidedit").val(data[0].firm_id);
        $("#gstpriceedit").val(data[0].gst_price);
        $("#gst-name-edit").val(data[0].GST_name);
        $("#Qty-step-edit").val(data[0].qty_step);
        $("#hidden-p-img").val(data[0].default_image_url);
        var pimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].default_image_url;
        $('#edit-p-main-img').attr("src",pimg);
        
       }
    });
  
$('#edit-product-form').on('submit',function(e){
  $("#loader-edit-product").show();
  toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            $.ajax({
            type: 'POST',
            url: '../../apis/update/admin/update_product.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
             $("#loader-edit-product").hide();
                if(response.status == 1){
                   $('#edit-product-form')[0].reset();
                   toastr.success('Edit Product Succesfully');
                  //  toastr .delay(1000)
                  //  toastr .fadeOut(1000);
                   window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_product.php#");
                    loadTableProduct();
                   
                }
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })

            e.preventDefault();

        });
    

//Update Category Close
});
  </script>
</body>
</html>
