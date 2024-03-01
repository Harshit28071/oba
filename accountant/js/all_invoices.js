if (localStorage.getItem('city')) {

  $("#city option").filter(function () {
    //may want to use $.trim in here
    return $(this).text() == localStorage.getItem('city');
  }).prop('selected', true);

  loadCustomer();

}

$('#customer').change(function (event) {
  localStorage.setItem('customer_id', $('#customer').val());
  loadInvoices();
  event.preventDefault();
});

$('#city').change(function () {
  loadCustomer();
  loadInvoices();
});
$('#status').change(function () {
  loadInvoices();
});
$('#min').change(function () {
  loadInvoices();
});

$('#max').change(function () {
  loadInvoices();
});


loadInvoices();

function loadCustomer() {
  var cityId = $('#city').val();
  var cityName = $('#city').find(":selected").text();

  $.ajax({
    type: 'POST',
    url: '/new/oba/common/apis/select/get_city_customer.php',
    data: { id: cityId },
    success: function (data) {
      var html = '<option selected style="text-align: center;" value="">SELECT CUSTOMER </option>';
      $.each(data, function (index, value) {
        // APPEND OR INSERT DATA TO SELECT ELEMENT.
        html = html + ('<option value="' + value.id + '">' + value.cname + ' (' + value.address + ')' + '</option>');
      });
      $('#customer').html(html);
      if (localStorage.getItem('customer_id')) {
        $('#customer').val(localStorage.getItem('customer_id'));
      }
      // localStorage.setItem('customerList',data);
      localStorage.setItem('city_id', cityId);
      localStorage.setItem('city', cityName);

    }
  });
}

function loadInvoices() {

  if ($.fn.DataTable.isDataTable('#invoices')) {
    $('#invoices').DataTable().ajax.reload();
    return;
  }
  // debugger;
  $("#invoices").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'url': "/new/oba/accountant/apis/select/get_all_invoices.php",
      "data": function (d) {
        d.city = $('#city').val();
        d.customer = $('#customer').val();
        d.status = $("#status").val();
        d.min = $("#min").val();
        d.max = $("#max").val();
      }
    },
    'columns': [
      {
        data: 'invoice_number',


      },
      {
        data: 'date',
        render: function (data, type, row, meta) {

          return formatDate(row.date);
        }
      },
      {
        data: 'name',
        render: function (data, type, row, meta) {

          return row.name + " (" + row.city + ")";
        }
      },
      { data: 'amount' },
      {
        data: 'status',
        render: function (data, type, row, meta) {

          switch (row.status) {
            case 'UnPaid': return ('<p>' + row.status + '</p>');
            case 'Cancelled': return ('<p style="color:red">' + row.status + '</p>');
            case 'Paid': return ('<p style="color:green">' + row.status + '</p>');
            case 'Partial': return ('<p style="color:blue">' + row.status + '</p>');
          }
        }
      },
      {
        data: 'id',
        render: function (data, type, row, meta) {

          return '<button class="btn btn-sm btn-danger" onClick="viewInvoice(\'' + row.invoice_number + '\')">View Invoice</button>';
        }
      }

    ]
  });
}

function viewInvoice(invoice_number) {
  localStorage.setItem('invoice_number', invoice_number);
  window.location.href = './generate_invoice_pdf.php';
}

function Orders(status) {
  debugger;
  if (!$.fn.DataTable.isDataTable('#' + status.toLowerCase() + "-table")) {
    loadOrders(status);
  }

}


//Load orders


function formatDate(d) {
  var d = new Date(d);

  var datestring = d.getDate() + " / " + (d.getMonth() + 1) + " / " + d.getFullYear();
  return datestring;
}

function getAction(value) {
  debugger;
  var html = '<span class="info-box-text"><a data-id="' + value.id + '" onclick="viewOrder(' + value.customer_id + ',' + value.id + ',\'' + value.date + '\',\'' + value.name + '\',\'' + value.city + '\')"><i class="fa fa-eye padding-10" aria-hidden="true"></i></a>  ';
  if (value.invoice_id == 0 && (value.order_status == 'New')) {
    html = html + '<a data-id="' + value.id + '" onclick="editOrder(' + value.customer_id + ',' + value.id + ',\'' + value.date + '\',\'' + value.name + '\',\'' + value.city + '\')"><i class="fas fa-edit padding-10"></i></a>  ' +
      '<a data-id="' + value.id + '" onclick="deleteOrder(' + value.id + ')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
  }
  html = html + '</span>';
  if (value.invoice_id == 0 && (value.order_status == 'New')) {
    html = html + '<span class="info-box-text"><button type="button" onclick="sendForBilling(' + value.id + ')" class="btn btn-block btn-danger btn-xs">Send for Billing</button></span>';
  }
  if (value.invoice_id != 0 && (value.order_status == 'Completed')) {
    html = html + '<span class="info-box-text"><strong>Bill No. </strong>#' + value.invoice_id + '</span>';
  }

  return html;
}



