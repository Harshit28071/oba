function loadCities() { 
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

function displayCity(data) {
    debugger;
    var loadCityData = '<option selected style="text-align: center;" value="">SELECT CITY </option>';
    $.each(data, function (key, value) {
        loadCityData = loadCityData + ("<option value='" + value.cname + "'>" + value.cname + "</option>"
        );
    });
    $("#select-city").html(loadCityData);
}