<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Edit Product Details</h3>
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
              <div id="loader-edit-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="edit-product-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pnameedit" autocomplete="off" id="name-edit" required>
                    <input type="hidden" class="form-control" placeholder="Enter Product Name" name="idedit" autocomplete="off" id="ide" required>

                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Select  Category</label>
                        <select class="form-control" name="pcategoryedit" id="catedit" required>
                          <?php echo $options_edit;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punitedit" id="unitedit">
                          <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-md-4 form-group">
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunitedit" id="editsecondaryunit">
                        <option value="0">No Select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplieredit"  id="multiplieredit" autocomplete="off">
                    
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowpriceedit" autocomplete="off" id="lowpedit">
                  </div>
                  <div class="col-md-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxpriceedit" autocomplete="off" id="maxpedit">
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrpedit" autocomplete="off" id="mrpedit">
                  </div>
                  
                  <div class="col-md-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncodeedit" autocomplete="off" id="hsnedit" required>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-md-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrateedit" autocomplete="off" id="gstrateedit" required>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmidedit" id="firmidedit">
                        <option value="0">No Firm Selected</option>
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstpriceedit" autocomplete="off" id="gstpriceedit">
                   
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Gst Name</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstnameedit" autocomplete="off" id="gst-name-edit"> 
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Qty_step</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="Qty_step_edit" autocomplete="off" id="Qty-step-edit"> 
                  </div>
                  <div class="col-12 form-group">
                    <label for="exampleInputFile">Change Image</label>
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
                  <label for="exampleInputFile">View Image</label>
                  <div class="form-group">
                    <img src="" id="edit-p-main-img" class="form-control" style="width:200px; height:140px;">
                    <input type="hidden" id="hidden-p-img" class="form-control" name="oldimageproduct">
                  </div>    
                </div>
                </div>
                <input type="submit"  class="btn btn-warning btn-lg  float-right" id="edit-product-sub" value="Save Changes">               
                <!-- /.card-body -->
              </form>
              </div>
      </div>
      </div>
   </section>
  </div>