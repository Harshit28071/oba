<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">View Product Details</h3>
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
      <div id="loader-view-product" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
                <form id="product-form">
                <div class="row">
                  <div class="col-6 form-group">
                  <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" name="pname" autocomplete="off" id="vname" readonly>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Product Category</label>
                        <select class="form-control" name="pcategory" id="vcat" readonly>
                          <?php echo $options_edit;?>
                        </select>
                      </div>
                    </div>
                 
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Unit</label>
                        <select class="form-control" name="punit" id="vunit" readonly>
                          <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-4 form-group">
                 
                    <!-- <input type="text" class="form-control" placeholder="Enter Secondary Unit "    autocomplete="off" required> -->
                    <div class="form-group">
                    <label>Secondary Unit</label>
                        <select class="form-control" name="secunit" readonly id="viewsecondaryunit">
                        <option>no select</option> 
                        <?php echo $options_edit_unit; ?>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Multiplier</label>
                    <input type="text" class="form-control" placeholder="Enter Multiplier" name="multiplier"  id="multiplierview" autocomplete="off" readonly>
                    
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>Low Price</label>
                    <input type="text" class="form-control" placeholder="Enter Low Price" name="lowprice" autocomplete="off" id="lowpview" readonly>
                  </div>
                  <div class="col-4 form-group">
                  <label>Max Price</label>
                    <input type="text" class="form-control" placeholder="Enter Max Price" name="maxprice" autocomplete="off" id="maxpview" readonly>
                  </div>
                  
                  <div class="col-4 form-group">
                  <label>MRP</label>
                    <input type="text" class="form-control" placeholder="Enter MRP" name="pmrp" autocomplete="off" id="mrpview" readonly>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Hsn Code</label>
                    <input type="text" class="form-control" placeholder="Enter Hsn Code" name="phsncode" autocomplete="off" id="hsnview" readonly>
                    <span id="ifsc-val" class="text-danger font-weight-bold"></span>
                  </div>
                  
                  <div class="col-6 form-group">
                  <label>Gst Rate</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Rate " name="gstrate" autocomplete="off" id="gstrateview" readonly>
                    <span id="bank-add-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Firm</label>
                        <select class="form-control" name="firmid" id="firmidview" readonly>
                          <option value="0">No Firm Selected</option>
                          <?php echo $options_edit_firm; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6 form-group">
                  <label>Gst Price</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstprice" autocomplete="off" id="gstpriceview" readonly>
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                  <label>Gst Name</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="gstname" autocomplete="off" id="gstnameview" readonly>
                    <span id="state-val" class="text-danger font-weight-bold"></span>
                  </div>
                  <div class="col-6 form-group">
                  <label>Qty_step</label>
                    <input type="text" class="form-control" placeholder="Enter Gst Price" name="Qty_step" autocomplete="off" id="Qty-step-view" readonly>
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
              </form>
              </div>
      </div>
      </div>
   </section>
  </div>