function loadcity(){
    $.ajax({
        url : "../../apis/select/admin/get_city.php",
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
        url : "../../apis/select/admin/get_states.php",
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
        url : "../../apis/select/common/get_distributor.php",
        type : "GET",
        dataType : "json",
        success : function(data){
        displayDistributor(data) ;
        loadSingleSalesman();
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
function loadSingleSalesman(){
    $.ajax({
        url: "../../apis/select/common/get_single_salesman.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
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
            url: '../../apis/update/salesman/edit_salesman_details.php',
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

