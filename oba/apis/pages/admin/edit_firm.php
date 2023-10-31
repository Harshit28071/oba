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
            <h1 class="m-0">Dashboard</h1>
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
              <div class="card-header">
                <h3 class="card-title">Edit Firm</h3>
              </div>
              <div class="card-body">
                <form id="edit-firm-form">
                <div class="row">
                  <div class="col-4 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Firm Name" name="firmnameedit" autocomplete="off" id="f-name-edit">
                    <input type="hidden" class="form-control" placeholder="Firm Name" name="firmeditid" autocomplete="off" id="f-id-edit">

                    <span id="name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="gstinedit" autocomplete="off" id="f-gst-edit">
                    <span id="G-val" class="text-danger font-weight-bold"></span>
                  </div>
                 
                  <div class="col-4 form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter Address"name="addressedit" autocomplete="off" id="f-add-edit">
                    <span id="add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>FSSAI</label>
                    <input type="text" class="form-control" placeholder="Enter FSSAI " name="fssaiedit" autocomplete="off" id="f-fssai-edit">
                    <span id="fssai-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" name="mobileedit" autocomplete="off" id="f-mobile-edit">
                    <span id="mo-val-al" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="emailedit" autocomplete="off" id="v-email-edit">
                  </div>
                  <div class="col-4 form-group">
                  <label>Bank Name</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Name" name="banknameedit" autocomplete="off" id="f-bankname-edit">
                    <span id="bank-name-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Account Number</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" name="accountnumberedit" autocomplete="off" id="f-acc-no-edit">
                    <span id="acc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>IFSC</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifscedit" autocomplete="off" id="f-ifsc-edit">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-12 form-group">
                  <label>Bank Address</label>
                    <input type="text" class="form-control" placeholder="Enter Bank Address " name="bankaddressedit" autocomplete="off" id="f-bank-add-edit">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State</label>
                    <input type="text" class="form-control" placeholder="Enter State" name="stateedit" autocomplete="off" id="f-state-edit">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>State Code</label>
                    <input type="text" class="form-control" placeholder="Enter State Code" name="statecodeedit" autocomplete="off" id="f-state-code-edit">
                    <span id="state-val-code" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputFile"> Edit Logo Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo-img-edit" name="logoimageedit" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <span id="logo-image-validation" class="text-danger"></span>
                  </div>
                  <div class="col-6 form-group">
                    <label for="exampleInputFile">Edit Signature Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sign-image-edit" name="signimgedit" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-6 form-group">
                  <label>Firm Logo</label>
                    <div class="input-group">
                      <img src=""  id="logo-img-view-edit" style="width: 120px; height:90px"/>
                      <input type="hidden" class="form-control" id="logo-image-h" name="logoimgold" >
                     
                    </div>
                  </div>
                  <div class="col-6 form-group">
                    <label>Signture</label>
                    <div class="input-group">
                    <img src=""  id="signture-img-view-edit" style="width: 120px; height:90px"/>
                    <input type="hidden" class="form-control" id="sign-image-h" name="signimgold" >
                    </div>
                  </div>
                </div>
                <input type="submit"  class="btn btn-warning btn-lg" id="add-firm-sub" value="Save Changes">
                <!-- /.card-body -->                
              </form>
              </div>
     
              </div>
   <!-- /.content -->
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
//Fetch Single Record : Show Model
//view model open

$(document).ready(function(){
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   console.log(id);
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
        $("#f-id-edit").val(data[0].id);
        $("#f-name-edit").val(data[0].name);
        $("#f-gst-edit").val(data[0].gstin);
        $("#f-add-edit").val(data[0].address);
        $("#f-fssai-edit").val(data[0].fssai);
        $("#f-mobile-edit").val(data[0].mobile);
        $("#v-email-edit").val(data[0].email);
        $("#f-bankname-edit").val(data[0].bank_name);
        $("#f-acc-no-edit").val(data[0].account_number);
        $("#f-ifsc-edit").val(data[0].ifsc);
        $("#f-bank-add-edit").val(data[0].bank_address);
        $("#f-state-edit").val(data[0].state);
        $("#f-state-code-edit").val(data[0].state_code);
        $("#logo-image-h").val(data[0].logo);
        $("#sign-image-h").val(data[0].signature_image);
        var logoimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].logo;
        $('#logo-img-view-edit').attr("src",logoimg);
        var signimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].signature_image;
        $('#signture-img-view-edit').attr("src",signimg);      
       }
    });
    $('#edit-firm-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/update/update_firm.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                if(response.status == 1){
                   //$('#edit-category-form')[0].reset();
                    window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_firm.php");
                    loadTableFirm();
                   
                }else{
                  var error = response.message;
                  $("#validation_cat_edit").html(error);
                }
                
            }
            })
        });
   

//Update Category Close
  });

</script>
</body>
</html>
