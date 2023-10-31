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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="./add_product.php"  class="btn btn-primary">Add Product </a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Product </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product Low Price</th>
                      <th>Product High Price</th>
                      <th>Product Image</th>
                      <th>Action</th>
                      <th>Add And View Product Image</th>
                      

                    </tr>
                  </thead>
                  <tbody id="load-table-product">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
   <!-- /.content -->
      </div>
   </section>
  </div>
  <!-----------------------------------View Modal Details-------------------------------------------------------------------->
  <div class="modal fade" id="modal-view-product">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">VIEW PRODUCT DETAILS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                
                <div class="card-body">
                <form id="product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="vname" required>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Product Category</label>
                        <select class="form-control" name="pcategory" id="vcat" required>
                          <?php echo $options_edit;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punit" id="vunit">
                          <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-4 form-group">
                 
                    <!-- <input type="text" class="form-control" placeholder="Enter Secondary Unit "    autocomplete="off" required> -->
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunit" oninput="checkInput()" id="viewsecondaryunit">
                        <option>no select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplierview" autocomplete="off" disabled>
                    
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowprice" autocomplete="off" id="lowpview">
                  </div>
                  <div class="col-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxprice" autocomplete="off" id="maxpview">
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrp" autocomplete="off" id="mrpview">
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncode" autocomplete="off" id="hsnview" required>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrate" autocomplete="off" id="gstrateview" required>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmid" id="firmidview">
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstprice" autocomplete="off" id="gstpriceview">
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
                <div class="card-footer justify-content-between">            
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
              </form>
              </div>
            </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!--------------------------------------View Modal Close---------------------------------------------------------------------->
  <!----------------------------------------------Edit Model------------------------------------------------------>
  <div class="modal fade" id="modal-Edit-Details">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDIT PRODUCT DETAILS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
               <div class="card-body">
                <form id="edit-product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pnameedit" autocomplete="off" id="name-edit" required>
                    <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idedit" autocomplete="off" id="ide" required>

                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Product Category</label>
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
                        <select class="form-control" name="secunitedit" oninput="checkInputEdit()" id="editsecondaryunit">
                        <option>no select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplieredit"  id="multiplieredit" autocomplete="off" disabled>
                    
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
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstpriceedit" autocomplete="off" id="gstpriceedit">
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-12 form-group">
                    <label for="exampleInputFile">Change Product Image</label>
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
                  <label for="exampleInputFile">View Product Image</label>
                  <div class="form-group">
                    <img src="" id="edit-p-main-img" class="form-control" style="width:200px; height:140px;">
                    <input type="hidden" id="hidden-p-img" class="form-control" name="oldimageproduct">
                  </div>    
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">    
                <input type="submit"  class="btn btn-warning btn-lg" id="edit-product-sub" value="Save Changes">               
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Edit Model Close------------------------------------------------>
  <!----------------------------------------Add Model------------------------------------------------>
  <div class="modal fade" id="modal-add-product">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ADD PRODUCT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                
                <div class="card-body">
                <form id="add-product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="" required>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Product Category</label>
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
                        <select class="form-control" name="secunit" oninput="checkInput()" id="secondaryunit">
                        <option>no select</option> 
                        <?php echo $options_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplier" autocomplete="off" disabled>
                    
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
                <div class="card-footer justify-content-between">
                <input type="submit"  class="btn btn-primary btn-lg" id="add-product-sub" value="Add Product">               
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
                
              </form>
              </div>
            </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Add Model Close------------------------------------------------>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-product-remove">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REMOVE PRODUCT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
                <form id="remove-product-form">
                <div class="card-body">
                  <div class="form-group">
                  
                  <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idremove" autocomplete="off" id="removeid" required>
                  <input type="hidden" id="hidden-p-img-remove" class="form-control" name="removeimage">
                   <h3>Are you sure, You want to delete this Product?</h3>
                    
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-between">
                <input type="submit" class="btn btn-danger" id="remove-product-sub" value="Remove">               
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Remove Model Close-------------------------------------------------------------->
  <!----------------------------------------- Multiple Image Add Modal-------------------------------------------------------------------------------->
  <div class="modal fade" id="modal-add-multiple-img">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Product Multiple Image</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <!-- form start -->
                <!-- form start -->
               
                <form id="multi-image-form">
                <input type="hidden" id="product-id" name="productidimgem">
                <input type="file" id="imageInput" name="files[]" multiple>
                <div class="col-12 form-group">
                <label for="imageInput" id="upload-button" class="btn btn-warning">Upload Images &nbsp; &nbsp;<i class="fas fa-plus"></i></label>
                </div>
               <div id="imagePreview"></div>

               
                <div class="card-footer justify-content-between">
                <input type="submit" class="btn btn-primary" id="addmulti-image-sub" value="Add Images">               
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>    
                </form>       
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------- Multiple Image Colse Modal-------------------------------------------------------------------------------->

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
    $(document).ready(function(){
//Add Multiple Images Of Product
$(document).on("click",".addimgmulti",function(){
    $("#modal-add-multiple-img").modal("show");
    var p_id = $(this).data("productviewid");
    var obj = {p_id: p_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#product-id").val(data[0].id);
       }

    });
    $('#multi-image-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/add_multiple_images.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response.status == 1){
                    $("#multi-image-form").trigger("reset");
                    $('#modal-add-multiple-img').modal('hide');
                    location.reload();
                    loadTableProduct();
                   
                }else{
                  var error = response.message;
                 // $("#validation_cat").html(error);
                }
                
            }
            })
        });
    
})
//Add Multiple Images Of Product


//Fetch All Records
function loadTableProduct(){
    $("#load-table-product").html("");
    $.ajax({
        url : "../../apis/select/get_product.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              imgurl =value.default_image_url;
              html = html +("<tr>"+
                                   "<td>" + value.name +"</td>"+
                                   "<td>" + value.low_price +"</td>"+ 
                                   "<td>" + value.max_price +"</td>"+ 
                                   "<td><img src='http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+ imgurl +"' width='160px' height='90px'></td>"+ 
                                   "<td><a href='./view_product.php?id= "+ value.id +"' class='View-product' data-productviewid='"+ value.id +"'><i class='fas fa-eye'></i></a>  &nbsp; &nbsp;<a href='./edit_product.php?id= "+ value.id +"' class='edit-product' data-productviewid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-product'  data-productviewid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>"+
                                   "<td><a href='#' class='addimgmulti' data-productviewid='"+ value.id +"'><i class='fas fa-image'></i></a>&nbsp; &nbsp; &nbsp; &nbsp;<a href='#' class='View-im' data-firmviewid='"+ value.id +"'><i class='fas fa-eye'></i></a> "+ 
                                  "</tr>");
            });
            $("#load-table-product").html(html);  
        }
    });
}
loadTableProduct();
//Fetch Single Record For Remove Product
$(document).on("click",".remove-product",function(){
  $('#modal-product-remove').modal('show');
    var p_id = $(this).data("productviewid");
    var obj = {p_id: p_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#removeid").val(data[0].id);
        $("#hidden-p-img-remove").val(data[0].default_image_url);
        
       }
    });

   });
//Delete Product 
$('#remove-product-form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/delete/delete_product.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response == 1){
                  //  $('#edit-category-form')[0].reset();
                    $('#modal-product-remove').modal('hide');
                    loadTableProduct();
                }
                
            }
            })
//Delete Product
        });
      });
</script>
    <script>
        $(document).ready(function () {
            $('#imageInput').on('change', function (e) {
                var files = e.target.files;

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var image = $('<div class="image-container"><img src="' + e.target.result + '"><span class="remove-image">Remove</span></div>');

                        // Add a click event to the "Remove" button
                        image.find('.remove-image').click(function () {
                            $(this).parent().remove(); // Remove the image container
                        });

                        $('#imagePreview').append(image);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>
</html>
