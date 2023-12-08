<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();

 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:./user_login.php");
    }
    //Quary For State
    $quary ="SELECT id,state FROM state";
    $stmt = $conn->prepare($quary);
    $stmt->execute();
    $stmt->bind_result($id,$state);
    $options = "";
    $options_edit ="";
    $selected = "";
    while($stmt->fetch()){
        $selected = ($state === 'UP') ? 'selected': '' ;
        $options .="<option value='$id' $selected>$state</option>";
     //   $options_edit .="<option value='$id'>$name</option>";

      }
    
    //city select box
    $quarycity ="SELECT id,name FROM city";
    $stmt = $conn->prepare($quarycity);
    $stmt->execute();
    $stmt->bind_result($id,$cityname);
    $options_city = '<option selected style="text-align: center;" value="">Select City</option>';
    
    while($stmt->fetch()){
      
        $options_city .="<option value='$id' >$cityname</option>";
    
      }
      if($stmt)
      $stmt->close();
    if($conn)
      $conn->close();
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
          <div class="col-6">
            <h3 class="m-0">Edit Customer</h3>
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
      <div id="loader-edit-customer" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-customer-form">
                <input type="hidden" class="form-control" placeholder="Customer id" name="Custid" autocomplete="off" id="Cust-id-v" required>
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Customer Name" name="CustName" autocomplete="off" id="Cust-name" required>
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Mobile</label>
                    <input type="number" class="form-control" placeholder="Customer Mobile" name="CustMobile" autocomplete="off" id="Cust-Mobile">
                  </div>
                  <div class="col-md-6 form-group">
                   <div class="col-md-12 form-group">
                        <label>Select State</label>
                        <select class="form-control" name="custstate">
                          <?php 
                          echo $options;
                          ?>
                        </select>
                      </div> 
                      
                      <div class="col-md-12 form-group">
                                       <!-- <input type="text" class="form-control" placeholder="Enter City" name="custcity" autocomplete="off" id="cust-city"> -->
                    <label>Select City</label>
                        <select class="form-control" name="custcity" id="cust-city" required>
                          <?php 
                          echo $options_city;                        
                          ?>
                        </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="col-md-12 ">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="5" placeholder="Enter ..." id="cust-add" name="custAddress"></textarea>
                      </div>
                    </div>
                  </div>
                   
                      <div class="col-md-6 form-group">
                        <label>Type</label>
                        <select class="form-control" name="custType" id="disop">
                          <option value="Retailer" selected>Retailer</option>
                          <option value="Distributor">Distributor</option>
                          <option value="Wholesaler">Wholesaler</option>
                          <option value="Oth">Other</option>
                        </select>
                      </div>
                      <div class="col-md-6 form-group">
                    <label>Distributor (Goods Source)</label>
                    
                    <select class="form-control" name="disName" id="dis-select-box" required>
                    <option selected style="text-align: center;">Select Distributor </option>
                        </select>
                    
                  </div>
                <div class="col-md-6 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Enter Firm " name="firmName" autocomplete="off" id="f-name">
                  </div>
                  <div class="col-md-6 form-group">
                    <label>GSTIN</label>
                    <input type="text" class="form-control" placeholder="Enter GSTIN" name="custgstin" autocomplete="off" id="c-gstin">
                  </div>

                </div>
                <input type="submit"  class="btn btn-primary btn-lg float-right" id="edit-customer" value="Update"> 
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
 var distributors = [];
 $.ajax({
            type: 'POST',
            url: '../../apis/select/admin/get_distributors.php',
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){               
              distributors = response;
              var html = '';
              for(var i=0;i<distributors.length;i++){
                  html = html + '<option value="'+distributors[i].id+'">'+distributors[i].name+'</option>';
              }
              $("#dis-select-box").append(html);
              fetchCustomerDetails();
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            });


$("#cust-city").change(function(){
  alert('sdv');

    var city = $(this).val();
    for(var i=0;i<distributors.length;i++){
                  if(distributors[i].city == city){
                    $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                    break;
                  }else{
                    if(distributors[i].name == "APS"){
                    $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                  }
                  }
              }

});
 //Check User Type 
 $("#disop").change(function(){
  var select = $(this).val();
  //console.log(select);
  if(select == 'Retailer' || select == 'Wholesaler' || select == 'Oth'){
   $("#dis-select-box").prop("disabled",false);
  }else{
    $("#dis-select-box").prop("disabled",true);
    for(var i=0;i<distributors.length;i++){
                  
                    if(distributors[i].name == "APS"){
                    $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                  
                  }
              }
  }
 })
  //Check User Type close
</script>
<script type="text/javascript">
//Fetch Single Record : Show Model
//view model open
function fetchCustomerDetails(){
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
        $("#Cust-id-v").val(cust_id);
        $("#Cust-name").val(data[0].id);
        $("#Cust-name").val(data[0].name);
        $("#Cust-Mobile").val(data[0].mobile_number);
        $("#cust-state").val(data[0].state_id);
        $("#cust-city").val(data[0].city_id);
        $("#cust-add").val(data[0].address);
        $("#f-name").val(data[0].firm_name);
        $("#c-gstin").val(data[0].GSTIN);
        //$("#disop-v").val(data[0].type);
        $("#dis-select-box").val(data[0].distributor_id);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
       
    }  
       // validation();
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
                  
                }else{
                  toastr.error('Something went wrong. Please try again');
                  
                }
                toastr.delay(3000)
                    toastr.fadeOut(3000);
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        e.preventDefault();
   });
 

    
</script>
</body>
</html>
