//Edit Customer Details Rediretion
function editCustomerDetails(customer_id){
    localStorage.clear();
    window.location.href = "./edit_customer_details.php?id="+customer_id ;
}

function loadcity(){
    $.ajax({
        url : "/new/oba/apis/select/admin/get_city.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          displayCity(data);
          loadDistributor();
        }
    });
}
//Display city
function displayCity(data) {
    var loadCityData = '<option selected style="text-align: center;" value="">SELECT CITY </option>';
    $.each(data, function (key, value) {
        loadCityData = loadCityData + ("<option value='" + value.id + "'>" + value.name + "</option>"
        );
    });
    $("#city").append(loadCityData);
}
//Load State Data
function loadState(){
    $.ajax({
        url : "/new/oba/apis/select/admin/get_states.php",
        type : "GET",
        dataType : "json",
        success : function(data){
          displayState(data);
          loadcity();
        }
    });
}
//Display State Data 
function displayState(data) {
    var loadCityData = '<option selected style="text-align: center;" value="">SELECT STATE </option>';
    $.each(data, function (key, value) {
        loadCityData = loadCityData + ("<option value='" + value.sid + "'>" + value.statename + "</option>"
        );
    });
    $("#state").append(loadCityData);
}
//Select Distributor Name 
function loadDistributor(){
    $.ajax({
        url : "/new/oba/apis/select/common/get_distributor.php",
        type : "GET",
        dataType : "json",
        success : function(data){
        displayDistributor(data) ;
        loadSingleCustomer();
        }
    });
}
//Display State Data 
function displayDistributor(data) {
    var loadDistributor = '<option selected style="text-align: center;" value="">SELECT STATE </option>';
    $.each(data, function (key, value) {
        loadDistributor = loadDistributor + ("<option value='" + value.did + "'>" + value.dname + "</option>"
        );
    });
    $("#dis-select-box").append(loadDistributor);
}
function loadSingleCustomer(){
    const urlparams = new URLSearchParams(window.location.search);
    $.ajax({
        url: "/new/oba/apis/select/common/get_single_customer.php",
        type: "POST",
        data: {id : urlparams.get('id')},
        dataType: "json",
        success: function (data) {
        $("#Cust-id-edit").val(data[0].cid);
        $("#Cust-name").val(data[0].cname);
        $("#Cust-Mobile").val(data[0].cmobile);
        $("#cust-add").val(data[0].caddress);
        $("#c-gstin").val(data[0].cGSTIN);
        $("#Firm").val(data[0].cfirm);
        $("#state").val(data[0].state_id);
        $("#city").val(data[0].city_id);
        $("#dis-select-box").val(data[0].cdistributor_id);

        }
    });
}
$("#edit-customer-form").on("submit",function(e){
    $("#loader-customer-edit").show();
    $.ajax({
            type: 'POST',
            url: '/new/oba/apis/update/salesman/edit_customer_details.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
              $("#loader-customer-edit").hide();
                if(response.status == 1){
                   $('#edit-customer-form')[0].reset();
                   history.back("./view_customer_all_details.php");  
                }    
            }
           
            });
        e.preventDefault();
   });
loadState();

