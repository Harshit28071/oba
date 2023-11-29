var cities = [];
function loadCities() {
    //Get All Pending Orders 
    $.ajax({
        url: "../../apis/select/salesman/get_all_city.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            cities = data;
            localStorage.setItem('city_data', JSON.stringify(data));
            displayCity(data);
        }
    })
}
//Display city
function displayCity(data) {
    var loadCityData = '<option selected style="text-align: center;" value=1">SELECT CITY </option>';
    $.each(data, function (key, value) {
        loadCityData = loadCityData + ("<option value='" + value.id + "' id='close-modal'>" + value.cname + "</option>"
        );
    });
    $("#select-city").html(loadCityData);
}
//load City in SelectBox 
cities = localStorage.getItem('city_data');
if (cities) {
    cities = JSON.parse(cities)
    displayCity(cities);
} else {
    loadCities();
}
//City Filter

$("#select-city").change(function () {
    $("#modal-city-select-box").modal('hide');
    var city_id = $("#select-city").val();
    loadCustomer(city_id);
});
//Get Customer Data From Server
function loadCustomer(city_id) { 
   // var city_id = $("#select-city").val();
    //console.log(city_id);
    $.ajax({
        url: "../../apis/select/salesman/get_all_customer_with_order_amount.php",
        type: "POST",
        data: {cityId: city_id},
        dataType: "json",
        success: function (data) {
            localStorage.setItem('customer_data', JSON.stringify(data));
            console.log(data);
            displayCustomer(data);
        }
    })
}
//load Customer 
function displayCustomer(data) {
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
        html = html + '<div class="info-box">' +
        '<div class="info-box-content">' +
        ' <span class="info-box-number">' + count++ + '.  ' + value.customer_name + '</span>' +
        '</div>' +
        '<div class="info-box-content align-items-end">' +
        '<span class="info-box-text">₹  ' + value.amount + '</span>' +
        '</div>'+
        '</div>';
    });
    $("#load-customer").html(html);

}
//search by customer name
