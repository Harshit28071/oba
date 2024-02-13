
// Initally Function Call
$(document).ready(function(){
  //debugger;
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    debugger;
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });
  
  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  if(hash == ''){
    loadOrders('New');
  }else{
    loadOrders((hash.replace('#','')).replace('-tab',''));
  }
  $('#my-orders-tab a[href="' + hash + '"]').tab('show');
});
// Load Data

function loadOrders(status) {
 // debugger;
  $("#" + status.toLowerCase()+"-table").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'url': "/new/oba/common/apis/select/get_my_orders.php",
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
      { data: 'city' },
      { data: 'amount' },
      {
        data: 'id',
        render: function (data, type, row, meta) {

          return getAction(row)
        }
      }

    ]
  });
}

function Orders(status) {
  debugger;
  if (!$.fn.DataTable.isDataTable('#' + status.toLowerCase()+"-table")) {
    loadOrders(status);
  }

}


//Load orders


function formatDate(d){
  var d = new Date(d);

var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " " +
d.getHours() + ":" + d.getMinutes();
return datestring;
}

function getAction(value){
  debugger;
  var html = '<span class="info-box-text"><a data-id="' + value.id + '" onclick="viewOrder('+value.customer_id +','+ value.id + ',\''+value.date+'\',\''+value.name+'\',\''+value.city+'\')"><i class="fa fa-eye padding-10" aria-hidden="true"></i></a>  ' ;
        if (value.invoice_id == 0 && (value.order_status == 'New')) {
            html = html + '<a data-id="' + value.id + '" onclick="editOrder('+value.customer_id +','+ value.id + ',\''+value.date+'\',\''+value.name+'\',\''+value.city+'\')"><i class="fas fa-edit padding-10"></i></a>  '+
        '<a data-id="' + value.id + '" onclick="deleteOrder(' + value.id + ')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    }
    html = html + '</span>';
    if (value.invoice_id == 0 && (value.order_status == 'New')) {
        html = html + '<span class="info-box-text"><button type="button" onclick="sendForBilling(' + value.id + ')" class="btn btn-block btn-danger btn-xs">Send for Billing</button></span>';
    }
    if (value.invoice_id != 0 && (value.order_status == 'Completed')) {
        html = html + '<span class="info-box-text"><strong>Bill No. </strong>#'+value.invoice_id+'</span>';
    }

    return html;
}

function viewOrder(customerId,orderId,date,customerName,city) {
  localStorage.clear();
  localStorage.setItem('order_id',orderId);
  localStorage.setItem('date',date);
  localStorage.setItem('customerName',customerName);
  localStorage.setItem('city',city);
  localStorage.setItem('customer_id',customerId);
  window.location.href = './view_order.php';

}

function editOrder(customerId,orderId,date,customerName,city) {
  localStorage.clear();
  localStorage.setItem('order_id',orderId);
  localStorage.setItem('date',date);
  localStorage.setItem('customerName',customerName);
  localStorage.setItem('city',city);
  localStorage.setItem('customer_id',customerId);
  window.location.href = './edit_order.php';

}

function sendForBilling(orderId){
 
  
      var obj = {orderId :orderId};
      var myJson = JSON.stringify(obj);
      $.ajax({
          url: "/new/oba/common/apis/update/send_for_billing.php",
          data : myJson,
          type: "POST",
          dataType: "json",
          success: function (data) {
              if(data > 0){
                Orders(orderStatus);
              }
          }
      });

  
 


}

function deleteOrder(orderId){
  
  $("#modal-danger-alert").modal('show');
  $("#main-heading-danger").html("Remove Order");
  $("#alert-message-danger").html("Are you sure you want to remove this order !");
  $("#warning-done").on("click",function removeOrder() {
      var obj = {orderId :orderId};
      var myJson = JSON.stringify(obj);
      $.ajax({
          url: "/new/oba/common/apis/delete/delete_order.php",
          data : myJson,
          type: "POST",
          dataType: "json",
          success: function (data) {
              if(data > 0){
                  $("#modal-danger-alert").modal('hide');
                  Orders(orderStatus);
              }
          }
      });
  });
  
}