const limit = 2;
let start = 0;
var orderStatus = 'Pending';
// Initally Function Call
$(document).ready(function () {

/*  if (sessionStorage.getItem('orderStatus')) {
    orderStatus = sessionStorage.getItem('orderStatus');
  }
*/
 // load_data_ajax(limit, start, orderStatus);


});
// Load Data
function load_data_ajax(limit, start, orderStatus) {

  $.ajax({
    url: "/new/oba/accountant/apis/select/get_all_orders.php",
    type: 'POST',
    data: { limit: limit, start: start, status: orderStatus },
    dataType: "json",
    success: function (result) {
      
      if (result && result.length > 0) {
        var html = '';
        $.each(result, function (key, value) {
          html = html + "<tr>" +
            "<td>" + value.order_id + "</td>" +
            "<td>" + formatDate(value.order_date) + "</td>" +
            "<td>" + value.customer_name + "</td>" +
            "<td>" + value.order_amount + "</td>" +
            "<td>" + value.salesmanname + "</td>";
          switch (orderStatus) {
            case 'Completed':
              html = html + '<td><button class="btn btn-danger btn-sm" onclick="viewPdf(\'' + value.invoice_id + '\')" >' + value.invoice_id + '</button></td>';
              html = html + '<td><button class="btn btn-danger btn-sm" onclick="viewCompletedOrder(' + value.customer_id + ',' + value.order_id + ',\'' + value.order_date + '\',\'' + value.customer_name + '\',\'' + value.city + '\',' + value.city_id + ')" >View Order</button></td>';
              break;
            case 'Cancel':
              html = html + '<td><button class="btn btn-danger btn-sm" onclick="viewCompletedOrder(' + value.customer_id + ',' + value.order_id + ',\'' + value.order_date + '\',\'' + value.customer_name + '\',\'' + value.city + '\',' + value.city_id + ')" >View Order</button></td>';
              break;
            default:
              html = html + '<td><button class="btn btn-danger btn-sm" onclick="viewOrder(' + value.customer_id + ',' + value.order_id + ',\'' + value.order_date + '\',\'' + value.customer_name + '\',\'' + value.city + '\',' + value.city_id + ')" >View Order</button>' +
                '<br><button class="btn btn-danger btn-sm margin-5" onclick="generateInvoice(' + value.customer_id + ',' + value.order_id + ',\'' + value.order_date + '\',\'' + value.customer_name + '\',\'' + value.city + '\',' + value.city_id + ')" >Generate Invoice</button></td>';
              break;
          }


          html = html + "</tr>";
        });
        if (start == 0) {
          $("#load-" + orderStatus + "-orders").html(html);
          
        } else {
          $("#load-" + orderStatus + "-orders").append(html);
        }
        $("#btn-load-more-" + orderStatus + "").show();
      }
      else {
        $("#btn-load-more-" + orderStatus + "").hide();
      }
      if (result.length < limit) {
        $("#btn-load-more-" + orderStatus + "").hide();
      } else {
        $("#btn-load-more-" + orderStatus + "").show();
      }
    }

  });
}
//Load orders
function Orders(status) {
  sessionStorage.setItem('orderStatus', status);
  start = 0;
  load_data_ajax(limit, start, status);
}
// Load More Data Btn 
function loadMoreOrders(orderStatus) {
  start = start + limit;
  load_data_ajax(limit, start, orderStatus);
}

function formatDate(d) {
  var d = new Date(d);

  var datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " +
    d.getHours() + ":" + d.getMinutes();
  return datestring;
}

function viewOrder(customerId, orderId, date, customerName, city, city_id) {
  debugger;
  localStorage.clear();
  localStorage.setItem('order_id', orderId);
  localStorage.setItem('date', date);
  localStorage.setItem('customerName', customerName);
  localStorage.setItem('city', city);
  localStorage.setItem('city_id', city_id);
  localStorage.setItem('customer_id', customerId);
  localStorage.setItem('generate_invoice', true);
  localStorage.setItem('can_edit', false);
  window.location.href = './view_order.php';

}

function viewCompletedOrder(customerId, orderId, date, customerName, city, city_id) {
  debugger;
  localStorage.clear();
  localStorage.setItem('order_id', orderId);
  localStorage.setItem('date', date);
  localStorage.setItem('customerName', customerName);
  localStorage.setItem('city', city);
  localStorage.setItem('city_id', city_id);
  localStorage.setItem('customer_id', customerId);
  localStorage.setItem('generate_invoice', false);
  localStorage.setItem('can_edit', false);
  window.location.href = './view_order.php';

}

function generateInvoice(customerId, orderId, date, customerName, city, city_id) {
  debugger;
  localStorage.clear();
  localStorage.setItem('order_id', orderId);
  localStorage.setItem('date', date);
  localStorage.setItem('customerName', customerName);
  localStorage.setItem('city', city);
  localStorage.setItem('city_id', city_id);
  localStorage.setItem('customer_id', customerId);
  localStorage.setItem('generate_invoice', true);
  $.ajax({
    url: "/new/oba/accountant/apis/select/get_selected_products_for_invoice.php",
    type: "POST",
    data: {
      orderId: localStorage.getItem('order_id'),
      customerId: localStorage.getItem('customer_id')
    },
    dataType: "json",
    success: function (data) {
      if (data.length > 0) {
        selectedProducts = data;
        localStorage.setItem('selectedProducts', JSON.stringify(data));
        window.location.href = './create_invoice.php';

      } else {
        alert('You can not generate invoice for this order.');
        history.back();
      }
    }
  });

}

function viewPdf(invoice_id) {
  localStorage.setItem('invoice_number', invoice_id);
  window.location.href = './generate_invoice_pdf.php';
}