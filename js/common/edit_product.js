
    $('#productoldimage').on('change',function(){
              //get the file name
              var fileName = $(this).val();
              //replace the "Choose a file" label
              $(this).next('.custom-file-label').html(fileName);
          });
  const urlparams = new URLSearchParams(window.location.search);
  const id = urlparams.get('id');
 // console.log(id);
  var p_id = id;
  var obj = {p_id : p_id};
  var myJson = JSON.stringify(obj);
 // console.log(myJson);
  $.ajax({
     url :"../../apis/select/admin/fetch_single_product.php",
     type : "POST",
     data : myJson,
     dataType : "json",
     success : function(data){
      $("#ide").val(data[0].id);
      $("#name-edit").val(data[0].name);
      $("#catedit").val(data[0].category_id);
      $("#unitedit").val(data[0].unit_id);
      $("#editsecondaryunit").val(data[0].secondary_unit_id);
      $("#multiplieredit").val(data[0].multiplier);
      $("#lowpedit").val(data[0].low_price);
      $("#maxpedit").val(data[0].max_price);
      $("#mrpedit").val(data[0].mrp);
      $("#hsnedit").val(data[0].hsn_code);
      $("#gstrateedit").val(data[0].gst_rate);
      $("#firmidedit").val(data[0].firm_id);
      $("#gstpriceedit").val(data[0].gst_price);
      $("#gst-name-edit").val(data[0].GST_name);
      $("#Qty-step-edit").val(data[0].qty_step);
      $("#hidden-p-img").val(data[0].default_image_url);
      var pimg ="http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+data[0].default_image_url;
      $('#edit-p-main-img').attr("src",pimg);
      
     }
  });

$('#edit-product-form').on('submit',function(e){
$("#loader-edit-product").show();
toastr.options = {
          "positionClass": "toast-top-right",
          "preventDuplicates": true
      };
          $.ajax({
          type: 'POST',
          url: '../../apis/update/admin/update_product.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          success: function(response){
           $("#loader-edit-product").hide();
              if(response.status == 1){
                 $('#edit-product-form')[0].reset();
                 toastr.success('Edit Product Succesfully');
                //  toastr .delay(1000)
                //  toastr .fadeOut(1000);
                 window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_product.php#");
                  loadTableProduct();
                 
              }
          },
          error: function(error) {
          toastr.error('Something went wrong.');
          }
          })

          e.preventDefault();

      });
  

//Update Category Close
