var cities = [];
var customers = [];
var defaultCity = 'Bijnor';
var sort = 1;
function loadCities() {
    //Get All Pending Orders 
    $.ajax({
        url: "../../apis/select/salesman/get_all_city.php",
        type: "POST",
        async: "false",
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
    var loadCityData = '';
    var defaultCityId = '';
    var temp = localStorage.getItem('selectedCity');
    if(temp){
        defaultCity = temp;
    }
    $.each(data, function (key, value) {
        if(value.cname == defaultCity){
            localStorage.setItem('selectedCity',defaultCity);
            $("#heading").text("All Customers ("+defaultCity+")");
            loadCityData = loadCityData + "<option value='" + value.id + "' selected>" + value.cname + "</option>";
            defaultCityId = value.id;
        }else{
        loadCityData = loadCityData + "<option value='" + value.id + "'>" + value.cname + "</option>";
        }
        
    });
    $("#select-city").html(loadCityData);
    getCustomers(defaultCityId);
}
//load City in SelectBox 
cities = localStorage.getItem('city_data');
if (cities) {
    cities = JSON.parse(cities)
    displayCity(cities);
} else {
    loadCities();
}

function getCustomers(cityid){
    customers = localStorage.getItem('customer_data');
    if (customers) {
        customers = JSON.parse(customers)
        displayCustomer(customers);
    } else {
       
            loadCustomer(cityid);
       
        
    }
}


//City Filter

$("#select-city").change(function () {
    // debugger;
    $("#modal-city-select-box").modal('hide');
    var city_name = $('#select-city').find(":selected").text();
    localStorage.setItem('selectedCity', city_name);
    $("#heading").text("All Customers ("+city_name+")");
    loadCustomer($('#select-city').find(":selected").val());
    
});
//Get Customer Data From Server
function loadCustomer(city_id) { 
   
    //console.log(city_id);
    $.ajax({
        url: "../../apis/select/salesman/get_all_customer_with_order_amount.php",
        type: "POST",
        data: {cityId: city_id},
        dataType: "json",
        success: function (data) {
            localStorage.setItem('customer_data', JSON.stringify(data));
            displayCustomer(data);
        }
    })
}
//load Customer 
function displayCustomer(data) {
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
        html = html + '<div class="info-box" onclick="customerprofile('+ value.id +')">' +
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
function filterCustomers(customerName) { 
   
    var data = JSON.parse(localStorage.getItem('customer_data'));
     if (customerName == '') {
        displayCustomer(data);
     } else {
         var filteredCustomers = [];
         for (i = 0; i < data.length; i++) {
             if (data[i].customer_name.toLowerCase().includes(customerName.toLowerCase())) {
                filteredCustomers.push(data[i]);
             }
         }
 
         displayCustomer(filteredCustomers);
     }
 }
 
 function sortData(){
    var data = JSON.parse(localStorage.getItem('customer_data'));
    var temp1, temp2 = 0;
    if(sort ==1){
        sort = -1;
        temp1 = -1;
        temp2 = 1;
    } else{
        temp1 = 1;
        temp2 = -1;
        sort = 1;
    }
    data.sort(function(a, b)
    {
        
        // if they are equal, return 0 (no sorting)
        if (a.amount == b.amount) { return 0; }
        if (a.amount > b.amount)
        {
            // if a should come after b, return 1
            return temp1;
        }
        else
        {
            // if b should come after a, return -1
            return temp2;
        }
    });
    displayCustomer(data);
 }


 $("#search-customer-by-name").on("submit", function (e) {
    filterCustomers($("#customer-name").val());
     e.preventDefault();
 });
 function customerprofile(customer_id){
    //localStorage.clear();
    window.location.href = "./customer_profile.php?id="+customer_id ;
  }