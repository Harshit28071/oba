<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
    header("location:./user_login.php");
    }
    //Quary For State
    $quary ="SELECT id,state FROM state";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$state);
    $options = "";
    $options_edit ="";
    //$selected = "";
    while($stmt->fetch()){
       
        //$options .="<option value='$id' $selected>$state</option>";
        $options_edit .="<option value='$id' selected> $state</option>";

      }
    //Quary For Distributor Select Box
    $quary_s ="SELECT id,name,distributor_id FROM customer WHERE id=distributor_id";
    $stmt = $conn->prepare($quary_s);
    $stmt->execute();
    $stmt->bind_result($dis_id,$dis_name,$distributor_id);
    $options_s_v = "";
    while($stmt->fetch()){
      $options_s_v .="<option value='$dis_id' selected>$dis_name</option>";
    }
    //city select box
    $quarycity ="SELECT id,name FROM city";
    $stmt = $conn->prepare($quarycity);
    $stmt->execute();
    $stmt->bind_result($id,$cityname);
    $options_city = "";
    
    while($stmt->fetch()){
      
        $options_city .="<option value='$id' >$cityname</option>";
    
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
            <h3 class="m-0">View Customer</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./manage_customer.php" id="back-firm" class="btn btn-primary">Back</a></li>
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
      <div id="loader-view-customer" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="add-customer-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Customer Name" name="CustName" autocomplete="off" id="Cust-name-v" readonly>
                  </div>
                  <div class="col-6 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Customer Mobile" name="CustMobile" autocomplete="off" id="Cust-Mobile-v" readonly>
                  </div>
                  <div class="col-6 form-group">
                   <div class="col-12 form-group">
                        <label> State</label>
                        <select class="form-control" name="custstate" id="cust-state-v" disabled >
                          <?php 
                          echo $options_edit;
                          ?>
                        </select>
                      </div> 
                      
                      <div class="col-12 form-group">
                    <label>City</label>
                        <select class="form-control" name="custcity" id="cust-city" disabled>
                          <?php 
                          echo $options_city;                        
                          ?>
                        </select>
                  </div>
                  </div>
                  <div class="col-6">
                  <div class="col-sm-12 ">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="5" placeholder="Enter ..." name="custAddress" id="cust-add-v" readonly></textarea>
                      </div>
                    </div>
                  </div>
                   
                      <div class="col-6 form-group">
                        <label>Type</label>
                    <input type="text" class="form-control" name="typev" autocomplete="off" id="disop-v" readonly>
                      </div>
                      <div class="col-6 form-group">
                    <label>Distributor Id </label>
                    
                    <select class="form-control" name="disName" id="dis-select-box-v" disabled >
                    <option value="0" selected>Not Selected</option>
                    <?php 
                         echo $options_s_v;
                          ?>
                        </select>
                    
                  </div>
                <div class="col-6 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Enter Firm " name="firmName" autocomplete="off" id="f-name-v" readonly>
                  </div>
                  <div class="col-6 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="custgstin" autocomplete="off" id="c-gstin-v" readonly>
                  </div>

                </div>
              </form>
              </div>
               <!-- /.card-body -->
              </div>
   <!-- /.content -->
      </div>
      </section>
      </div>
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
 //Check User Type 

  //Check User Type close
</script>
<script type="text/javascript">
$(document).ready(function(){
 

const urlparams = new URLSearchParams(window.location.search);
const id = urlparams.get('id');
var cust_id = id;
var obj = {cust_id : cust_id};
 var myJson = JSON.stringify(obj); 
 $("#loader-view-customer").show();

 $.ajax({
       url :"../../apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
         $("#loader-view-customer").hide();

        $("#Cust-name-v").val(data[0].name);
        $("#Cust-Mobile-v").val(data[0].mobile_number);
        $("#cust-state-v").val(data[0].state_id);
        $("#cust-city-v").val(data[0].city);
        $("#cust-add-v").val(data[0].address);
        $("#f-name-v").val(data[0].firm_name);
        $("#c-gstin-v").val(data[0].GSTIN);
        $("#disop-v").val(data[0].type);
        $("#dis-select-box-v").val(data[0].distributor_id);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
    });
</script>
</body>
</html>
