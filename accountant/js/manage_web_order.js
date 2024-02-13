
// Initally Function Call
$(document).ready(function () {
 debugger;
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    debugger;
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });
  
  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  if(hash == ''){
    loadOrders('Pending');
  }else{
    loadOrders((hash.replace('#','')).replace('-tab',''));
  }
  $('#order-tabs a[href="' + hash + '"]').tab('show');
});

function loadOrders(status) {
  debugger;
  $("#" + status).DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'url': "/new/oba/accountant/apis/select/get_all_orders.php",
      "data": function (d) {
        d.status = status;

      }
    },
    'columns': [
      {
        data: 'id',
        render: function (data, type, row, meta) {

          return row.id;
        }

      },
      { data: 'date' },
      {
        data: 'name',
        render: function (data, type, row, meta) {

          return row.name + " (" + row.city + ")";
        }
      },
      { data: 'amount' },
      { data: 'username' },
      {
        data: 'id',
        render: function (data, type, row, meta) {

          let html = '';
          switch (status) {
            case 'Completed':
              html = html + '<span class="margin-right"><button class="btn btn-danger btn-sm" onclick="viewPdf(\'' + row.invoice_id + '\')" >' + row.invoice_id + '</button></span>';
              html = html + '<span><button class="btn btn-danger btn-sm" onclick="viewCompletedOrder(' + row.customer_id + ',' + row.id + ',\'' + row.date + '\',\'' + row.name + '\',\'' + row.city + '\',' + row.city_id + ')" >View Order</button></span>';
              break;
            case 'Cancel':
              html = html + '<span><button class="btn btn-danger btn-sm" onclick="viewCompletedOrder(' + row.customer_id + ',' + row.id + ',\'' + row.date + '\',\'' + row.name + '\',\'' + row.city + '\',' + row.city_id + ')" >View Order</button></span>';
              break;
            default:
              html = html + '<span><button class="btn btn-danger btn-sm" onclick="viewOrder(' + row.customer_id + ',' + row.id + ',\'' + row.date + '\',\'' + row.name + '\',\'' + row.city + '\',' + row.city_id + ')" >View Order</button>' +
                '<br><button class="btn btn-danger btn-sm margin-5" onclick="generateInvoice(' + row.customer_id + ',' + row.id + ',\'' + row.date + '\',\'' + row.name + '\',\'' + row.city + '\',' + row.city_id + ')" >Generate Invoice</button></span>';
              break;
          }
          return html;
        }
      }

    ]
  });
}





/////////////////////////////////////////////////////////////

//Load orders
function Orders(status) {
  debugger;
  if (!$.fn.DataTable.isDataTable('#' + status)) {
    loadOrders(status);
  }

}
// Load More Data Btn 


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