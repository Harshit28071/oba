var currentOrders = [];
var cities = [];
var selectedOrders = [];
function loadPendingOrders() {
    $.ajax({
        url: "/new/oba/apis/select/salesman/get_pending_distributor_orders.php",
        type: "POST",
        dataType: "json",
        data:{
            id:localStorage.getItem('distributor_id')
        },
        success: function (data) {
            currentOrders = data;
            localStorage.setItem('order_data_set', JSON.stringify(data));
            displayOrders(data);
        }
    })
}

function orderClicked(self,id){
    if(self.checked) {
       selectOrder(id);
    }else{
        unselectOrder(id);
    }
}

function selectOrder(id){
    const index = selectedOrders.indexOf(id);
    if(!(index >-1)){
    selectedOrders.push(id);
    }
    localStorage.setItem('selectedOrders',JSON.stringify(selectedOrders));
}

function unselectOrder(id){
    const index = selectedOrders.indexOf(id);
    if (index > -1) { 
        selectedOrders.splice(index, 1); 
    }
    localStorage.setItem('selectedOrders',JSON.stringify(selectedOrders));
}
function displayOrders(data) {
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
        var datetimeValue = new Date(value.order_date).toLocaleDateString("en-GB");
        var cust = value.customer_name + '  ('+value.city_name+')';
        var index = selectedOrders.indexOf(value.order_id);
        
        html = html + '<div class="info-box">' +
        '<div class="info-box-content">' +
        '<span class="info-box-icon full-space"><div class="icheck-danger d-inline">';
        if(index > -1){
            html = html +'<input type="checkbox" checked id="checkboxDanger_'+value.order_id+'" onchange="orderClicked(this,'+value.order_id+')">';
        }else{
            html = html + '<input type="checkbox" id="checkboxDanger_'+value.order_id+'" onchange="orderClicked(this,'+value.order_id+')">';
        }
        
        html = html + '<label for="checkboxDanger_'+value.order_id+'" class="black-border">' +
        '</label>' +
        '</div></span>'+
        '</div>' +
        '<div class="info-box-content">' +
        ' <span class="info-box-number">' + count++ + '.  ' + value.customer_name + ' (' + value.city_name + ')</span>' +
        '<span class="info-box-text">Amount</span>' +
        '<span class="info-box-number">₹&nbsp;&nbsp;&nbsp;' + value.order_amount + '</span>' +
        '</div>' +
        '<div class="info-box-content align-items-end">' +
        '<span class="info-box-text">#  ' + value.order_id + '</span>' +
        '<span class="info-box-text">' + datetimeValue + '</span>' +
        '<span class="info-box-text"><a data-id="' + value.order_id + '" onclick="viewOrder(' + value.order_id + ',\''+cust+'\',\''+datetimeValue+'\')"><i class="fa fa-eye padding-10" aria-hidden="true"></i></a>  ' +
        
 '</span>' +
        '</div>' +
        '</div>';
    });
    $("#load-orders").html(html);

}
 

function viewOrder(orderId, customerName, date) {
        localStorage.setItem('order_id',orderId);
        localStorage.setItem('customer_name',customerName);
        localStorage.setItem('order_date',date);

        localStorage.removeItem('OrderDetails');
        window.location.href = './view_order.php';

}


var temp = localStorage.getItem('selectedOrders');
if(temp){
    selectedOrders = JSON.parse(temp);
}

currentOrders = localStorage.getItem('order_data_set');
if (currentOrders) {
    currentOrders = JSON.parse(currentOrders);
    displayOrders(currentOrders);
} else {
    loadPendingOrders();
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
    filterOrders($("#select-city").find(":selected").val(), $("#customer-name").val());

});

function filterOrders(selectedCity, customerName) {
   // debugger;
    if (selectedCity == '' && customerName == '') {
        displayOrders(currentOrders);
    } else {
        var filterOrders = [];
        for (i = 0; i < currentOrders.length; i++) {
            if ((selectedCity != '' && currentOrders[i].city_name == selectedCity) || (customerName != '' && currentOrders[i].customer_name.toLowerCase().includes(customerName.toLowerCase()))) {
                filterOrders.push(currentOrders[i]);
            }
        }

        displayOrders(filterOrders);
    }
}

$("#search-customer-by-name").on("submit", function (e) {
    filterOrders($("#select-city").find(":selected").val(), $("#customer-name").val());
    e.preventDefault();
});

function createOrder(){
    if(selectedOrders.length > 0){
    $.ajax({
        url : "/new/oba/apis/select/salesman/prepare_distributor_order.php",
        type : "POST",
        data : {
          orders : selectedOrders.toString(),
          customerId : localStorage.getItem('distributor_id')
        },
        dataType : "json",
        success : function(data){
          localStorage.setItem('selectedProducts',JSON.stringify(data));         
          localStorage.setItem('isDistributor',true);
          window.location.href= './review_order.php';
        }
    });
}else{
    alert('No Order Selected. Please select a order or create order from Create Order option from dashboard.');
}
}


