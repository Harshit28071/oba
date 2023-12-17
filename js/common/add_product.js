    $('#add-product-form').on('submit',function(e){
      $("#loader-add-product").show();
      toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '../../apis/add/admin/add_product.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
             $("#loader-add-product").hide();
                
                if(response.status == 1){
                    $('#add-product-form')[0].reset();
                    //$('#modal-add-product').modal('hide');
                    toastr.success('Product Added Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                    // window.location.replace("http://localhost/oba/oba/oba/apis/pages/admin/manage_product.php#");
                    // loadTableProduct();  
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
  

        $('#p-img').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
