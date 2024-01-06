<div class="content-wrapper">
     
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
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
      <div id="loader-img-mutli-remove" style="display:none;" class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
              </div>
      <form id="multi-image-delete">
      <div class="row">
     <?php while($stmt->fetch()){?>
      
      <div class="col-sm-2">
        <input type="hidden" id="product-multi-id" name="imageid" value="<?php echo $id;?>">
        <input type="hidden" id="product-multi-id" name="imgname" value="<?php echo $image_url;?>">
         <img src="/new/oba/uploads/<?php echo $image_url;  ?>" alt="no"  class="img-fluid mb-2"  >
         <input type="submit" value="remove" name="removeimg" class="btn btn-block btn-danger btn-lg-" >
      </div> 
      
              <?php }?>
              </div>
              </form>
              
      </div>
      </div>
   </section>
  </div>