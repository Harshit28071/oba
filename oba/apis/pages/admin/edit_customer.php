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
    $quary_s ="SELECT id,name FROM customer WHERE type='Distributor'";
    $stmt = $conn->prepare($quary_s);
    $stmt->execute();
    $stmt->bind_result($dis_id,$dis_name);
    $options_s = "";
    while($stmt->fetch()){
      $options_s .="<option value='$dis_id'>$dis_name</option>";
    }
    $id = $_GET['id'];
    $quary_type ="SELECT type FROM customer WHERE id='$id '";
    $stmt = $conn->prepare($quary_type);
    $stmt->execute();
    $stmt->bind_result($type);
    $options_type = "";
    while($stmt->fetch()){
      $options_type .="<option value='$type' selected>$type</option>";
    }
    
    //city select box
    $quarycity ="SELECT id,name FROM city";
    $stmt = $conn->prepare($quarycity);
    $stmt->execute();
    $stmt->bind_result($id,$cityname);
    $options_city = "";
    
    while($stmt->fetch()){
      
        $options_city .="<option value='$id' selected >$cityname</option>";
    
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
            <h3 class="m-0">Edit Customer</h3>
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
      <div id="loader-customer-edit" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-customer-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Name</label>
                  <input type="hidden" class="form-control" placeholder="Customer id" name="Custid" autocomplete="off" id="Cust-id-v" required>
                    <input type="text" class="form-control" placeholder="Customer Name" name="CustNameEdit" autocomplete="off" id="Cust-name-v" required>
                  </div>
                  <div class="col-6 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Customer Mobile" name="CustMobileEdit" autocomplete="off" id="Cust-Mobile-v">
                  </div>
                  <div class="col-6 form-group">
                   <div class="col-12 form-group">
                        <label>Select State</label>
                        <select class="form-control" name="custstateEdit" id="cust-state-v" >
                          <?php 
                          echo $options_edit;
                          ?>
                        </select>
                      </div> 
                      
                      <div class="col-12 form-group">
                    <!-- <label>City</label>
                    <input type="text" class="form-control" placeholder="Enter City" name="custcityEdit" autocomplete="off" id="cust-city-v"> -->
                    <label>City</label>
                        <select class="form-control" name="custcityEdit" id="cust-city-v" >
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
                        <textarea class="form-control" rows="5" placeholder="Enter ..." name="custAddressEdit" id="cust-add-v"></textarea>
                      </div>
                    </div>
                  </div>
                   
                      <div class="col-6 form-group">
                        <label>Type</label>
                         <select class="form-control" name="custTypeEdit" id="disop" >
                        
                         <option value="Retailer">Retailer</option>
                          <option value="Distributor">Distributor</option>
                          <option value="Wholesaler">Wholesaler</option>
                          <option value="Oth">Other</option>
                          <?php echo $options_type; ?>
                        </select>
                      </div>
                      <div class="col-6 form-group">
                    <label>Distributor Id </label>
                    
                    <select class="form-control" name="disNameEdit" id="dis-select-box" disabled>
                     
                    <?php 
                         echo $options_s;
                          ?>
                        </select>
                    
                  </div>
                <div class="col-6 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Enter Firm " name="firmNameEdit" autocomplete="off" id="f-name-v">
                  </div>
                  <div class="col-6 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="custgstinEdit" autocomplete="off" id="c-gstin-v">
                  </div>

                </div>
                <input type="submit"  class="btn btn-warning btn-lg float-right" id="add-customer" value="Save Changes"> 
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
 $("#disop").change(function(){
  var select = $(this).val();
  console.log(select);
  if(select == 'Retailer' || select == 'Wholesaler' || select == 'Oth'){
   $("#dis-select-box").prop("disabled",false);
   if (select == 'Distributor') {
    $("#dis-select-box").prop("disabled",true);
   }
  }
  else{
    $("#dis-select-box").prop("disabled",true);
  }
 })
  //Check User Type close
</script>

<script type="text/javascript">
 $(document).ready(function(){
  

const urlparams = new URLSearchParams(window.location.search);
const id = urlparams.get('id');
var cust_id = id;
var obj = {cust_id : cust_id};
 var myJson = JSON.stringify(obj); 
 $.ajax({
       url :"../../apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        
        $("#Cust-id-v").val(data[0].id);
        $("#Cust-name-v").val(data[0].name);
        $("#Cust-Mobile-v").val(data[0].mobile_number);
        $("#cust-state-v").val(data[0].state_id);
        $("#cust-city-v").val(data[0].city);
        $("#cust-add-v").val(data[0].address);
        $("#f-name-v").val(data[0].firm_name);
        $("#c-gstin-v").val(data[0].GSTIN);
        //$("#disop-v").val(data[0].type);
        $("#dis-select-box-v").val(data[0].distributor_id);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
      //Update Customer
   $("#edit-customer-form").on("submit",function(e){
    $("#loader-customer-edit").show();
    toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
    $.ajax({
            type: 'POST',
            url: '../../apis/update/admin/update_customer.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
              $("#loader-customer-edit").hide();
                if(response.status == 1){
                   $('#edit-customer-form')[0].reset();
                   window.location.replace("./manage_customer.php");
                   toastr.success('Customer Updated Succesfully');
                   toastr .delay(3000)
                    toastr .fadeOut(3000);
                }
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        e.preventDefault();
   });
      
})
</script>
</body>
</html>
