
 var distributors = [];
 $.ajax({
            type: 'POST',
            url: '/new/oba/apis/select/admin/get_distributors.php',
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
              fetchCustomerDetails();
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            });


$("#cust-city").change(function(){
  alert('sdv');

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

//Fetch Single Record : Show Model
//view model open
function fetchCustomerDetails(){
const urlparams = new URLSearchParams(window.location.search);
const id = urlparams.get('id');
var cust_id = id;
var obj = {cust_id : cust_id};
 var myJson = JSON.stringify(obj); 
$.ajax({
       url :"/new/oba/apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        $("#Cust-id-v").val(cust_id);
        $("#Cust-name").val(data[0].id);
        $("#Cust-name").val(data[0].name);
        $("#Cust-Mobile").val(data[0].mobile_number);
        $("#cust-state").val(data[0].state_id);
        $("#cust-city").val(data[0].city_id);
        $("#cust-add").val(data[0].address);
        $("#f-name").val(data[0].firm_name);
        $("#c-gstin").val(data[0].GSTIN);
        //$("#disop-v").val(data[0].type);
        $("#dis-select-box").val(data[0].distributor_id);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
       
    }  
       // validation();
       $("#edit-customer-form").on("submit",function(e){
    $("#loader-customer-edit").show();
    toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true
        };
    $.ajax({
            type: 'POST',
            url: '/new/oba/apis/update/admin/update_customer.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
              $("#loader-customer-edit").hide();
                if(response.status == 1){
                   $('#edit-customer-form')[0].reset();
                   window.location.replace("./manage_customer.php");
                   toastr.success('Customer Updated Succesfully');
                  
                }else{
                  toastr.error('Something went wrong. Please try again');
                  
                }
                toastr.delay(3000)
                    toastr.fadeOut(3000);
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        e.preventDefault();
   });
 

    