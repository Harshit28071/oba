<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Add Product Details</h3>
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
              <div id="loader-add-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="add-product-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="" required>
                    <span id="validation_product" class="text-danger"></span>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" name="pcategory" required>
                          <?php echo $options;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punit">
                          <?php echo $options_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-md-4 form-group">
                 
                    <!-- <input type="text" class="form-control" placeholder="Enter Secondary Unit "    autocomplete="off" required> -->
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunit"  id="secondaryunit">
                        <option value="0">no select</option> 
                        <?php echo $options_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplier" autocomplete="off">
                    
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowprice" autocomplete="off" id="">
                  </div>
                  <div class="col-md-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxprice" autocomplete="off" id="">
                  </div>
                  
                  <div class="col-md-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrp" autocomplete="off" id="">
                  </div>
                  
                  <div class="col-md-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncode" autocomplete="off" id="">
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-md-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrate" autocomplete="off" id="">
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmid" required>
                          <option selected value="" >No Select</option>
                          <?php echo $options_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstprice" autocomplete="off">
                    
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Gst Name</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Name" name="GstName" autocomplete="off">
                    
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Qty_step (Means kitne step se plus ke click pe incremnt hogi qty)</label>
                    <input type="text" class="form-control" placeholder="Enter Qty_step " name="Qty_step" autocomplete="off">
                    
                  </div>
                  <div class="col-md-12 form-group">
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
                <input type="submit"  class="btn btn-primary btn-md float-right" id="add-product-sub" value="Add Product">
              </form>
              </div>
      </div>
      </div>
   </section>
  </div>