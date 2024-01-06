<?php
session_start();
 require_once($_SERVER['DOCUMENT_ROOT']."/new/oba/common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:/new/oba/common/user_login.php");
    }
    $query ="SELECT id,name FROM category";
    $stmt = $conn->prepare($query);
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
            <h3 class="m-0">View Firm Details</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active" id="edit-firm-details"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      <div id="loader-view-user" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
              <div class="row">
          <div class="col-12">
            <div class="card">
             
                <table class="table table-striped table table-bordered table-hover">
                <tbody>
                    <tr>
                      <td class="font-weight-bold">Firm Name</td>
                      <td id="f-name-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">GSTIN</td>
                      <td id="f-gst-v"></td>

                      
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Address</td>
                      <td id="f-add-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">FSSAI</td>
                     <td id="f-fssai-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Mobile</td>
                      <td id="f-mobile-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Email</td>
                      <td id="v-email"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Bank Name</td>
                      <td id="f-bankname-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Account Number</td>
                      <td  id="f-acc-no-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">IFSC</td>
                      <td id="f-ifsc-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Bank Address</td>
                      <td  id="f-bank-add-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">State</td>
                      <td id="f-state-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">State Code</td>
                      <td  id="f-state-code-v"></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Firm Logo</td>
                      <td>  <img src=""  id="logo-img-view" style="width: 60px; height:60px"/></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Signture</td>
                      <td> <img src=""  id="signture-img-view" style="width: 60px; height:60px"/></td> 
                    </tr>
                  </tbody>
                </table>
             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
  $("#loader-view-user").show();
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   // console.log(id);
    var firm_id = id;
    var obj = {firmviewid : firm_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../admin/apis/select/fetch_single_firm.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#loader-view-user").hide();
        $("#f-name-v").text(data[0].name);
        $("#f-gst-v").text(data[0].gstin);
        $("#f-add-v").text(data[0].address);
        $("#f-fssai-v").text(data[0].fssai);
        $("#f-mobile-v").text(data[0].mobile);
        $("#v-email").text(data[0].email);
        $("#f-bankname-v").text(data[0].bank_name);
        $("#f-acc-no-v").text(data[0].account_number);
        $("#f-ifsc-v").text(data[0].ifsc);
        $("#f-bank-add-v").text(data[0].bank_address);
        $("#f-state-v").text(data[0].state);
        $("#f-state-code-v").text(data[0].state_code);
        $("#logo-img-view").text(data[0].logo);
        $("#signture-img-view").text(data[0].signature_image);
        var logoimg ="http://localhost/oba/oba/oba/apis/admin/pages/uploads/"+data[0].logo;
        $('#logo-img-view').attr("src",logoimg);
        var signimg ="http://localhost/oba/oba/oba/apis/admin/pages/uploads/"+data[0].signature_image;
        $('#signture-img-view').attr("src",signimg);      
       }
    });
  //view model close
  function loadeditbtn(){
    $("#edit-firm-details").html("");
    var html ='';
    html = html +('<a href="edit_firm.php?id= '+ id +'" class="btn btn-warning">Edit</a>');
    $("#edit-firm-details").html(html);
  }
  loadeditbtn();
    });
    
</script>
</body>
</html>
