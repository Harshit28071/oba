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
                <form id="product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="vname" readonly>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Product Category</label>
                        <select class="form-control" name="pcategory" id="vcat" readonly>
                          <?php echo $options_edit;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punit" id="vunit" readonly>
                          <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-4 form-group">
                 
                    <!-- <input type="text" class="form-control" placeholder="Enter Secondary Unit "    autocomplete="off" required> -->
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunit" readonly id="viewsecondaryunit">
                        <option>no select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplierview" autocomplete="off" readonly>
                    
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowprice" autocomplete="off" id="lowpview" readonly>
                  </div>
                  <div class="col-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxprice" autocomplete="off" id="maxpview" readonly>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrp" autocomplete="off" id="mrpview" readonly>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncode" autocomplete="off" id="hsnview" readonly>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrate" autocomplete="off" id="gstrateview" readonly>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmid" id="firmidview" readonly>
                          <option value="0">No Firm Selected</option>
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstprice" autocomplete="off" id="gstpriceview" readonly>
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-12 form-group">
                  <label for="exampleInputFile">View Product Image</label>
                  <div class="form-group">
                    <img src="" id="view-p-main-img" class="form-control" style="width:200px; height:140px;">
                  </div>    
                </div>
                </div>
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
function checkInput(){
  var secondunit = document.getElementById("secondaryunit");
  var multi = document.getElementById("multiplier");

  if (secondunit.value.trim() === "") {
    multi.disabled = true;
  } else {
    multi.disabled = false;
  }
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   // console.log(id);
    var p_id = id;
    var obj = {p_id : p_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#vname").val(data[0].name);
        $("#vcat").val(data[0].category_id);
        $("#vunit").val(data[0].unit_id);
        $("#viewsecondaryunit").val(data[0].secondary_unit_id);
        $("#multiplierview").val(data[0].multiplier);
        $("#lowpview").val(data[0].low_price);
        $("#maxpview").val(data[0].max_price);
        $("#mrpview").val(data[0].mrp);
        $("#hsnview").val(data[0].hsn_code);
        $("#gstrateview").val(data[0].gst_rate);
        $("#firmidview").val(data[0].firm_id);
        $("#gstpriceview").val(data[0].gst_price);
        $("#hidden-p-img").val(data[0].default_image_url);
        var pimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].default_image_url;
        $('#view-p-main-img').attr("src",pimg);
        
       }
    });
  });
  </script>
</body>
</html>
