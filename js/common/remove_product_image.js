
$("#multi-image-delete").on("submit",function(e){
  $("#loader-img-mutli-remove").show();

  toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
  $.ajax({
            type: 'POST',
            url: '/new/oba/apis/delete/admin/delete_product_imges.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
             $("#loader-img-mutli-remove").hide();
                if(response == 1){
                  toastr.success('Image Deleted Succesfully');
                //  toastr .delay(1000)
                  toastr .fadeOut(1000);
                  location.reload();
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
            e.preventDefault();
})
