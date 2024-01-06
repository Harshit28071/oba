<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Product</h1>
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
              <div class="card-body p-0">
                <table class="table table-striped" id="example1">
                  <thead>
                    <tr>
                       
                      <th> Name</th>
                      <th> Category</th>
                      <th> Low Price</th>
                      <th> High Price</th>
                      <th> Unit</th>
                      <th> Image</th>
                      <th> Availability</th>
                      <th> Action</th>
                      
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
  <!----------------------------------------Remove Model------------------------------------------------>
  <div class="modal fade" id="modal-product-remove">
        <div class="modal-dialog">
          <div class="modal-content">
          <div id="loader-remove-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="remove-product-form">
            <div class="modal-header">
              <h5 class="modal-title">REMOVE PRODUCT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">  
                  <div class="form-group">
                  <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idremove" autocomplete="off" id="removeid" required>
                  <input type="hidden" id="hidden-p-img-remove" class="form-control" name="removeimage">
                   <h5>Are you sure, You want to delete this Product?</h5>
                  </div>             
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" id="remove-product-sub" value="Remove">               
            
            </div>
            </form>
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
          <div id="loader-multi-img" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
          <form id="multi-image-form">
            <div class="modal-header">
              <h5 class="modal-title">Add Product Multiple Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="product-id" name="productidimgem">
                <input type="file" id="imageInput" name="files[]" multiple>
                <div class="col-12 form-group">
                <label for="imageInput" id="upload-button" class="btn btn-warning">Upload Images &nbsp; &nbsp;<i class="fas fa-plus"></i></label>
                </div>
               <div id="imagePreview"></div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" id="addmulti-image-sub" value="Add Images">               
            </div>
            </form>   
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->