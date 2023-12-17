var currentOrders = [];
var cities = [];
const urlparams = new URLSearchParams(window.location.search);
var orderStatus = urlparams.get('status');
$("#heading").text(orderStatus+" Orders");

function loadOrders() {
    $.ajax({
        url: "../../apis/select/salesman/get_orders.php",
        type: "POST",
        data: {
            status:orderStatus
        },
        dataType: "json",
        success: function (data) {
            currentOrders = data;
            localStorage.setItem('order_data_set', JSON.stringify(data));
            displayOrders(data);
        }
    })
}
function displayOrders(data) {
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
        var datetimeValue = new Date(value.order_date).toLocaleDateString("en-GB");
        var cust = value.customer_name + '  ('+value.city_name+')';
        html = html + '<div class="info-box">' +
        '<div class="info-box-content">' +
        ' <span class="info-box-number">' + count++ + '.  ' + value.customer_name + ' (' + value.city_name + ')</span>' +
        '<span class="info-box-text">Amount</span>' +
        '<span class="info-box-number">₹&nbsp;&nbsp;&nbsp;' + value.order_amount + '</span>' +
        '</div>' +
        '<div class="info-box-content align-items-end">' +
        '<span class="info-box-text">#  ' + value.order_id + '</span>' +
        '<span class="info-box-text">' + datetimeValue + '</span>' +
        '<span class="info-box-text"><a data-id="' + value.order_id + '" onclick="viewOrder(' + value.order_id + ',\''+cust+'\',\''+datetimeValue+'\')"><i class="fa fa-eye padding-10" aria-hidden="true"></i></a>  ' ;
        if (value.order_invoice_id == 0 && (value.order_status == 'New')) {
            html = html + '<a data-id="' + value.order_id + '" onclick="editOrder(' + value.order_id + ',\''+cust+'\',\''+datetimeValue+'\','+ value.customer_id+')"><i class="fas fa-edit padding-10"></i></a>  '+
        '<a data-id="' + value.order_id + '" onclick="deleteOrder(' + value.order_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    }
    html = html + '</span>';
    if (value.order_invoice_id == 0 && (value.order_status == 'New')) {
        html = html + '<span class="info-box-text"><button type="button" onclick="sendForBilling(' + value.order_id + ')" class="btn btn-block btn-danger btn-xs">Send for Billing</button></span>';
    }
    if (value.order_invoice_id != 0 && (value.order_status == 'Completed')) {
        html = html + '<span class="info-box-text"><strong>Bill No. </strong>#'+value.order_invoice_id+'</span>';
    }
    html = html +'</div>' +
        '</div>';
    });
    $("#load-orders").html(html);

}
 
function editOrder(orderId, customerName, date,customerId) {
    
    localStorage.setItem('order_id',orderId);
    localStorage.setItem('customer_name',customerName);
    localStorage.setItem('order_date',date);
    localStorage.setItem('customer_id',customerId);
    localStorage.removeItem('categories');
    localStorage.removeItem('OrderDetails');
    localStorage.removeItem('selectedProducts');

    window.location.href = './edit_order.php';

}

function viewOrder(orderId, customerName, date) {
        localStorage.setItem('order_id',orderId);
        localStorage.setItem('customer_name',customerName);
        localStorage.setItem('order_date',date);

        localStorage.removeItem('OrderDetails');
        window.location.href = './view_order.php';

}

function deleteOrder(orderId){
    // Show here confirm box first then on condfirm use ajax call to delete order using delete_order.php file 
    $("#modal-danger-alert").modal('show');
    $("#main-heading-danger").html("Remove Order");
    $("#alert-message-danger").html("Are you sure you want to remove this order !");
    $("#warring-done").on("click",function removeOrder() {
        var obj = {orderId :orderId};
        var myJson = JSON.stringify(obj);
        $.ajax({
            url: "../../apis/delete/salesman/delete_order.php",
            data : myJson,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if(data > 0){
                    $("#modal-danger-alert").modal('hide');
                    loadOrders();
                }
            }
        });
    });
    
   

}

function sendForBilling(orderId){
    // Show here confirm box first then on condfirm use ajax call to delete order using delete_order.php file 
    
        var obj = {orderId :orderId};
        var myJson = JSON.stringify(obj);
        $.ajax({
            url: "../../apis/update/salesman/send_for_billing.php",
            data : myJson,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if(data > 0){
                    loadOrders();
                }
            }
        });
  
    
   

} 




currentOrders = localStorage.getItem('order_data_set');
if (currentOrders) {
    currentOrders = JSON.parse(currentOrders);
    displayOrders(currentOrders);
} else {
    loadOrders();
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


