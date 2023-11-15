<?php
session_start();
 require_once("../../common/database.php");
 $db = new Database();
 $conn = $db->connect();
    if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "1"){
    header("location:./user_login.php");
    }
    $quary ="SELECT id,name FROM category WHERE parent_id ='0'";
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
            <h1 class="m-0">Manage Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#" id="add-new-category" class="btn btn-primary">Add Category</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->
    <section class="content">
     
      <div class="container-fluid">
             
    <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Category </th>
                      <th>Image</th>
                      <th>Parent ID</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody id="load-table-category">
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
  <!----------------------------------------Edit Model------------------------------------------------>
  <div class="modal fade" id="modal-Edit-category">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loaderedit" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="edit-category-form">
            <div class="modal-header">
              <h5 class="modal-title">EDIT PRODUCT CATEGORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Category</label>
                    <input type="text" class="form-control" name="editcatname" id="edit-cat-name" placeholder="Enter Category" required>
                    <input type="hidden" class="form-control" name="editidcat" id="edit-id-cat" >
                    <span id="validatione_edit" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="input-group">
                      <input type="hidden"  class="form-control" id="cat-file-old" name="editoldcatfile" >
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="cat-file" name="editcatfile" >
                        <label class="custom-file-label" for="cat-file">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>-->
                    </div>
                    <span id="validation_cat_edit" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                        <label>Select Parent Category</label>
                        <select class="form-control" name="parentcatedit" id="pid">
                          <option value="0">Default</option>
                          <?php
                          echo $options_edit;
                          ?>
                        </select>
                      </div>
            </div>
           
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-warning" id="edit-category-sub" value="Save Changes">              
                 
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
       
       
      </div>
      <!-- /.modal -->
  <!----------------------------------------Edit Model Close------------------------------------------------>
  <!----------------------------------------Add Model------------------------------------------------>
  <div class="modal fade" id="modal-add-category">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loaderadd" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="add-category-form">
            <div class="modal-header">
              <h5 class="modal-title">ADD PRODUCT CATEGORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <input type="text" class="form-control" name="c_name" id="Add-role" placeholder="Enter Category" required>
                    <span id="validation_cat_name" class="text-danger"></span>
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile"> Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <span id="validation_cat" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                        <label>Select Parent Category</label>
                        <select class="form-control" name="parent_cat">
                          <option id="option-id-edit" value="0">Default</option>
                          <?php
                          echo $options;
                          $stmt->close();
                          $conn->close();
                          ?>
                        </select>
                      </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <input type="submit" class="btn btn-primary" id="add-category-sub" value="Add">              
                </div>
                </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Add Model Close------------------------------------------------>
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-remove-cat">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="remove-category-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE PRODUCT CATEGORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" class="form-control" name="removecatid" id="category-remove-id">
                  <input type="hidden"  class="form-control" id="cat-file-remove" name="removeofile" >
                   <h5>Are you sure, You want to delete this category?</h5>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-danger" id="remove-role-sub" value="Remove">
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!----------------------------------------Remove Model Close-------------------------------------------------------------->
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
    //Add Category
    $(document).on("click","#add-new-category",function(){
        $('#modal-add-category').modal('show');
        $('#add-category-form').on('submit',function(e){
          $("#loaderadd").show();
          toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/admin/add_category.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                 $("#loaderadd").hide();
                if(response.status == 1){
                    $('#add-category-form')[0].reset();
                    $('#modal-add-category').modal('hide');
                    loadTableCategory()
                    toastr.success('Category Added Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                }
               
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
    });
//Fetch All Records
function loadTableCategory(){
    $("#load-table-category").html("");
    $.ajax({
        url : "../../apis/select/admin/get_category.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          var html ='';
            console.log(data);
            $.each(data,function(key,value){
              imgurl =value.image_url;
              html = html +("<tr>"+
                                   "<td>" + value.name +"</td>"+
                                   "<td><img src='http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+imgurl+"' width='30px' height='30px'></td>"+
                                   "<td>" + value.parent_id +"</td>"+
                                  "<td><a href='#' class='edit-category' data-categoryeid='"+ value.id +"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-category'  data-categoryremoveid='"+ value.id +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                  "</tr>");
            });
            $("#load-table-category").html(html);  
        }
    });
}
loadTableCategory();
// //Fetch All Records Close
//Fetch Single Record : Show Model
$(document).on("click",".edit-category",function(){
    $('#modal-Edit-category').modal('show');
    var cat_id = $(this).data("categoryeid");
    var obj = {categoryeid : cat_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_category.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#edit-id-cat").val(data[0].id);
        $("#edit-cat-name").val(data[0].cname);
        $("#cat-file-old").val(data[0].cimage);
        $("#pid").val(data[0].cparentid);
     
       }
    });
    //Fetch Single Record : Show Model
  //Update Category
$('#edit-category-form').on('submit',function(e){
    $("#loaderedit").show();
    toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/update/admin/update_category.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                 $("#loaderedit").hide();
                if(response.status == 1){
                   $('#edit-category-form')[0].reset();
                    $('#modal-Edit-category').modal('hide');
                    loadTableCategory();
                    toastr.success('Category Updated Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                } 
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
    });

//Update Category Close
// fetch singlr record for remove product category
$(document).on("click",".remove-category",function(){
  $('#modal-remove-cat').modal('show');
    var cat_r_id = $(this).data("categoryremoveid");
    var obj = {categoryeid: cat_r_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"../../apis/select/admin/fetch_single_category.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#category-remove-id").val(data[0].id);
        $("#cat-file-remove").val(data[0].cimage);
       
       }
    });

   });
//
//Delete Role
$('#remove-category-form').on('submit',function(e){
            $("#loader-remove").show();
            toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/delete/admin/delete_category.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
              $("#loader-remove").hide();
                if(response == 1){
                  //  $('#edit-category-form')[0].reset();
                    $('#modal-remove-cat').modal('hide');
                    loadTableCategory();
                    toastr.success('Category Deleted Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                      }   
                  },
                  error: function(error) {
                  $('#modal-remove-cat').modal('hide');
                  $('#remove-category-form')[0].reset();
                  toastr.error('You can not delete this item');
            }
            })
        });
    });
     //Delete Role Close
      $('#cat-file').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
</script>
</body>
</html>