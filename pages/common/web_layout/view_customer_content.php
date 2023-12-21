<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">View Customer</h3>
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
                  <div class="col-md-6 form-group">
                  <label>Name</label>
                    <input type="text" class="form-control" placeholder="Customer Name" name="CustName" autocomplete="off" id="Cust-name-v" readonly>
                  </div>
                  <div class="col-md-6 form-group">
                  <label>Mobile</label>
                    <input type="text" class="form-control" placeholder="Customer Mobile" name="CustMobile" autocomplete="off" id="Cust-Mobile-v" readonly>
                  </div>
                  <div class="col-md-6 form-group">
                   <div class="col-12 form-group">
                        <label> State</label>
                        <input type="text" class="form-control" id="state" readonly>
                      </div> 
                      
                      <div class="col-12 form-group">
                    <label>City</label>
                    <input type="text" class="form-control" id="city" readonly>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="col-sm-12 ">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="5" placeholder="Enter ..." name="custAddress" id="cust-add-v" readonly></textarea>
                      </div>
                    </div>
                  </div>
                   
                      <div class="col-md-6 form-group">
                        <label>Type</label>
                    <input type="text" class="form-control" name="typev" autocomplete="off" id="disop-v" readonly>
                      </div>
                      <div class="col-md-6 form-group">
                    <label>Distributor (Goods Source) </label>
                    
                    <input type="text" class="form-control" id="distributor" readonly>
                    
                  </div>
                <div class="col-md-6 form-group">
                  <label>Firm Name</label>
                    <input type="text" class="form-control" placeholder="Enter Firm " name="firmName" autocomplete="off" id="f-name-v" readonly>
                  </div>
                  <div class="col-md-6 form-group">
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