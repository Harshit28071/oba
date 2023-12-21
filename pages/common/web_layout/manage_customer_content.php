<div class="content-wrapper">
     
     <!-- Content Header (Page header) -->
     <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1 class="m-0">Manage Customer</h1>
           </div><!-- /.col -->
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item active"><a href="./add_customer.php" id="" class="btn btn-primary">Add Customer</a></li>
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
                 <table class="table table-striped" id="customertab">
                   <thead>
                     <tr>
                       <th>Name</th>
                       <th>Mobile</th>
                       <th>Type</th>
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
   <!----------------------------------------Remove Model------------------------------------------------>
   <div class="modal fade" id="modal-remove-custome">
         <div class="modal-dialog">
           <div class="modal-content">
           <form id="remove-customer-form">
             <div class="modal-header">
               <h5 class="modal-title">REMOVE PRODUCT CATEGORY</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
                   <div class="form-group">
                   <input type="hidden" class="form-control" name="removecustid" id="customer-remove-id">
                  
                    <h5>Are you sure, You want to delete this customer?</h5>
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