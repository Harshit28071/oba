var distributors = [];
 $.ajax({
            type: 'POST',
            url: '/new/oba/admin/apis/select/get_distributors.php',
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){               
              distributors = response;
              var html = '';
              for(var i=0;i<distributors.length;i++){
                  html = html + '<option value="'+distributors[i].id+'">'+distributors[i].name+'</option>';
              }
              $("#dis-select-box").append(html);
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            });

$("#cust-city").change(function(){

              var city = $(this).val();
              for(var i=0;i<distributors.length;i++){
                            if(distributors[i].city == city){
                              $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                              break;
                            }else{
                              if(distributors[i].name == "APS"){
                              $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                            }
                            }
                        }
          
});

//Check User Type 
$("#disop").change(function(){
  var select = $(this).val();
  //console.log(select);
  if(select == 'Retailer' || select == 'Wholesaler' || select == 'Oth'){
   $("#dis-select-box").prop("disabled",false);
  }else{
    $("#dis-select-box").prop("disabled",true);
    for(var i=0;i<distributors.length;i++){
                  
                    if(distributors[i].name == "APS"){
                    $('#dis-select-box  option[value="'+distributors[i].id+'"]').prop("selected", "selected");
                  
                  }
              }
  }
 });
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
        url: '/new/oba/admin/apis/add/add_customer_api.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(response){
           $("#loader-add-customer").hide();
            debugger;
            if(response.status == 1){
              $('#add-customer-form')[0].reset();
              toastr.success('Customer Added Succesfully');
                var newCustomerId= response.customerId;
                localStorage.setItem('customer_id',newCustomerId);
                localStorage.setItem('customer_name',newCustomerName);
                localStorage.setItem('city_id',cityId );
                localStorage.setItem('city',cityName);  
                history.back();
            }else{
              toastr.error(response.message);
            }
        },
        error: function(error) {
        toastr.error('Something went wrong.');
        }
        })  
    });

 //Ajax Call to add customer close
