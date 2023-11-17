//Check User Type 
$("#disop").change(function(){
    var select = $(this).val();
    //console.log(select);
    if(select == 'Retailer' || select == 'Wholesaler' || select == 'Oth'){
     $("#dis-select-box").prop("disabled",false);
    }else{
      $("#dis-select-box").prop("disabled",true);
  
    }
   })
 //Check User Type close


 //Ajax Call to add customer
    $("#loader-add-customer").show();
    $('#add-customer-form').on('submit',function(e){
      var newCustomerName =$('#Cust-name').val();
      var cityId = $('#cust-city').val();
      var cityName = $('#cust-city option:selected').text();

      toastr.options = {
        "positionClass": "toast-top-right",
        "preventDuplicates": true
      };
    
      e.preventDefault();
        $.ajax({
        type: 'POST',
        url: '../../apis/add/admin/add_customer_api.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(response){
           $("#loader-add-customer").hide();
            
            if(response.status == 1){
              $('#add-customer-form')[0].reset();
              toastr.success('Customer Added Succesfully');
                var newCustomerId= response.customerId;
                localStorage.setItem('customer_id',newCustomerId);
                localStorage.setItem('customer_name',newCustomerName);
                localStorage.setItem('city_id',cityId );
                localStorage.setItem('city_name',cityName);  
                history.back();
            }
        },
        error: function(error) {
        toastr.error('Something went wrong.');
        }
        })  
    });

 //Ajax Call to add customer close
