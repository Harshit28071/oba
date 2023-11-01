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
            <h3 class="m-0">View Firm Details</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./manage_firm.php" id="back-firm" class="btn btn-primary">Back</a></li>
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
                <form id="view-firm-form">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmname" readonly id="f-name-v">
                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstin" readonly id="f-gst-v">
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="address" readonly id="f-add-v">
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssai" readonly id="f-fssai-v">
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" readonly id="f-mobile-v">
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" readonly id="v-email">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="bankname" readonly id="f-bankname-v">
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumber" readonly id="f-acc-no-v">
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc" readonly id="f-ifsc-v">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddress" readonly id="f-bank-add-v">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="state" readonly id="f-state-v">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecode" readonly id="f-state-code-v">
                    <span id="state-val-code" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Firm Logo</label>
                    <div class="input-group">
                      <img src=""  id="logo-img-view" style="width: 120px; height:90px"/>
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label>Signture</label>
                    <div class="input-group">
                    <img src=""  id="signture-img-view" style="width: 120px; height:90px"/>
                    </div>
                  </div>
                </div>                
              </form>
              </div>
      </div>
   <!-- /.content -->
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
//Fetch Single Record : Show Model
//view model open
$(document).ready(function(){
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   // console.log(id);
    var firm_id = id;
    var obj = {firmviewid : firm_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/fetch_single_firm.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#f-name-v").val(data[0].name);
        $("#f-gst-v").val(data[0].gstin);
        $("#f-add-v").val(data[0].address);
        $("#f-fssai-v").val(data[0].fssai);
        $("#f-mobile-v").val(data[0].mobile);
        $("#v-email").val(data[0].email);
        $("#f-bankname-v").val(data[0].bank_name);
        $("#f-acc-no-v").val(data[0].account_number);
        $("#f-ifsc-v").val(data[0].ifsc);
        $("#f-bank-add-v").val(data[0].bank_address);
        $("#f-state-v").val(data[0].state);
        $("#f-state-code-v").val(data[0].state_code);
        $("#logo-img-view").val(data[0].logo);
        $("#signture-img-view").val(data[0].signature_image);
        var logoimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].logo;
        $('#logo-img-view').attr("src",logoimg);
        var signimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].signature_image;
        $('#signture-img-view').attr("src",signimg);      
       }
    });
  //view model close
    });
    
</script>
</body>
</html>
