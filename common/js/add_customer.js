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
            })


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
 })

$(document).ready(function(){
        $("#loader-add-customer").show();
         
       // validation();
        $('#add-customer-form').on('submit',function(e){
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
                
                if(response.status == 1){
                  $('#add-customer-form')[0].reset();
                  toastr.success('Customer Added Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                    // window.location.replace("./manage_customer.php");
                    // loadTableFirm();
                    
                   
                }else{
              toastr.error(response.message);
            }
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
            
        });
    });

    