const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);


var id = urlParams.get('id');
var firmName = urlParams.get('name');;
$("#heading").html(firmName+" GST Invoices");
loadInvoices();

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
      'url': "/new/oba/accountant/apis/select/get_all_gst_invoices.php",
      "data": function (d) {
        d.city = $('#city').val();
        d.customer = $('#customer').val();
        d.status = $("#status").val();
        d.min = $("#min").val();
        d.max = $("#max").val();
        d.id = id;
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
      { data: 'gstin' },
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

          return '<p><button class="btn btn-sm btn-danger" onClick="viewGSTInvoice(\'' + row.invoice_number + '\')">View Invoice</button></p>';
        }
      }

    ]
  });
}


//Load orders









