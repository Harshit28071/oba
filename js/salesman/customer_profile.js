var currentCustomer = '';
var orders = [];
function loadSingleCustomer(){
    const urlparams = new URLSearchParams(window.location.search);
    $.ajax({
        url: "/new/oba/apis/select/common/get_single_customer.php",
        type: "POST",
        data: {id : urlparams.get('id')},
        dataType: "json",
        success: function (data) {
            currentCustomer = data;
            displaySingleCustomer(data);
            displayAllDetailsCustomer(data);
            loadCustomerOders();
        }
    });
}

function displaySingleCustomer(data){
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
      html = html +"<div class='info-box'>"+
      "<div class='info-box-content'>"+
      "<table class='table'>"+
     "<tbody class='customer-table'>"+
      "<tr><td><strong>Name</strong></td><td>"+ value.cname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ value.cmobile +"</td></tr>"+
     "<tr><td><strong>City</strong></td><td>"+ value.ccity +"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "<div class='info-box-content align-items-end'>" +
      "<span class='info-box-text'><i class='fas fa-eye' onclick='customerAllDetails("+ value.cid +")'></i></span>" +
      "</div>"+
      "</div>"+
     "</div>";
    });
    $("#singleCustomerDetails").html(html);
}
loadSingleCustomer();
//View All Details Of Customer
function customerAllDetails(customer_id){
    //localStorage.clear();
    window.location.href = "./view_customer_all_details.php?id="+customer_id ;
  }
  //View All Details Of Customer
 function  displayAllDetailsCustomer(data){
    var html = '';
    $.each(data, function (key, value) {
    html = html +"<div class='info-box'>"+
      "<div class='info-box-content'>"+
      "<table class='table'>"+
     "<tbody class='customer-table'>"+
      "<tr><td><strong>Name</strong></td><td>"+ value.cname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ value.cmobile +"</td></tr>"+
     "<tr><td><strong>City</strong></td><td>"+ value.ccity +"</td></tr>"+
     "<tr><td><strong>Address</strong></td><td>"+ value.caddress +"</td></tr>"+
     "<tr><td><strong>Firm</strong></td><td>"+ value.cfirm +"</td></tr>"+
     "<tr><td><strong>GSTIN</strong></td><td>"+ value.cGSTIN +"</td></tr>"+
     "<tr><td><strong>Type</strong></td><td>"+ value.ctype +"</td></tr>"+
     "<tr><td><strong>Distributor(Goods Source)</strong></td><td>"+ value.distributor_name+"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "</div>"+
     "</div>";
    });
    $("#singleCustomerAllDetails").html(html);
  }
  function loadCustomerOders(){
    const urlparams = new URLSearchParams(window.location.search);
    $.ajax({
        url: "/new/oba/apis/select/common/get_customer_orders.php",
        type: "POST",
        data: {customerId : urlparams.get('id')},
        dataType: "json",
        success: function (data) {
            orders = data
            localStorage.setItem('customer_orders', JSON.stringify(data));
            displayCustomerOders(data);
        }
    });
  }

  function displayCustomerOders(data){
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
        var datetimeValue = new Date(value.order_date).toLocaleDateString("en-GB");
        
        var cust = currentCustomer[0].cname + '  ('+currentCustomer[0].ccity+')';
        html = html + '<div class="info-box">' +
        '<div class="info-box-content">' ;
        if(value.order_status == 'New'){
            html = html + ' <span class="info-box-number text-default">' + count++ + '.  ' + value.order_status + '</span>' ;
        }
        if(value.order_status == 'Pending'){
            html = html + ' <span class="info-box-number text-warning">' + count++ + '.  ' + value.order_status + '</span>' ;
        }
        if(value.order_status == 'Cancel'){
            html = html + ' <span class="info-box-number text-danger">' + count++ + '.  ' + value.order_status + '</span>' ;
        }
        if(value.order_status == 'Completed'){
            html = html + ' <span class="info-box-number text-success">' + count++ + '.  ' + value.order_status + '</span>' ;
        }
        html = html + '<span class="info-box-text">Amount</span>' +
        '<span class="info-box-number">₹&nbsp;&nbsp;&nbsp;' + value.order_amount + '</span>' +
        '</div>' +
        '<div class="info-box-content align-items-end">' +
        '<span class="info-box-text">#  ' + value.order_id + '</span>' +
        '<span class="info-box-text">' + datetimeValue + '</span>' +
        '<span class="info-box-text"><a data-id="' + value.order_id + '" onclick="viewOrder(' + value.order_id + ',\''+cust+'\',\''+datetimeValue+'\')"><i class="fa fa-eye padding-10" aria-hidden="true"></i></a>  ' ;
       
    if (value.order_invoice_id == 0 && (value.order_status == 'New')) {
        html = html +  '<a data-id="' + value.order_id + '" onclick="editOrder(' + value.order_id + ',\''+cust+'\',\''+datetimeValue+'\','+ currentCustomer[0].cid+')"><i class="fas fa-edit padding-10"></i></a>  '+
        '<a data-id="' + value.order_id + '" onclick="deleteOrder(' + value.order_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    }
    html = html + '</span>';
    if (value.order_invoice_id == 0 && (value.order_status == 'New')) {
        html = html + '<span class="info-box-text"><button type="button" onclick="sendForBilling(' + value.order_id + ')" class="btn btn-block btn-danger btn-xs">Send for Billing</button></span>';
    }
    if (value.order_invoice_id != 0 && (value.order_status == 'Completed')) {
        html = html + '<span class="info-box-text"><strong>Bill No. </strong>#'+value.order_invoice_id+'</span>';
    }
    html = html + '</div>' +
        '</div>';
    });
    $("#customerOrder").html(html);

}

function sendForBilling(orderId){
    // Show here confirm box first then on condfirm use ajax call to delete order using delete_order.php file 
    
        var obj = {orderId :orderId};
        var myJson = JSON.stringify(obj);
        $.ajax({
            url: "/new/oba/apis/update/salesman/send_for_billing.php",
            data : myJson,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if(data > 0){
                    loadCustomerOders();
                }
            }
        });
  
    
   

}

//Show Order Fillter Modal
function filterModal(){
$("#modal-status-select-box").modal('show');
}
orders = localStorage.getItem('customer_orders');
orders = JSON.parse(orders);
function filterorder(selectOrderStatus){
    
    if(selectOrderStatus == 'All'){
        displayCustomerOders(orders);
    }else{
    var filterOders = [];
    for (i = 0; i < orders.length; i++) {
         if(selectOrderStatus == orders[i].order_status){
            filterOders.push(orders[i]);
         }
    }
    displayCustomerOders(filterOders);
    }
}
  
$("#select-order-s").change(function () {
    $("#modal-status-select-box").modal('hide');
    filterorder($("#select-order-s").find(":selected").val());

});

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
            url: "/new/oba/apis/delete/salesman/delete_order.php",
            data : myJson,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if(data > 0){
                    $("#modal-danger-alert").modal('hide');
                    loadCustomerOders();
                }
            }
        });
    });
    
   

}
