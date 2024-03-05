
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

          return getButtons(row.invoice_number,row.agarwal,row.harihar,row.city_id,row.customer_id);
        }
      }

    ]
  });
}


function getButtons(id,agarwal,harihar,city,customer){
  // Static Code
 
 var html = '<p><button class="btn btn-sm btn-danger" onClick="viewInvoice(\'' + id + '\')">View Invoice</button></p>';

 if(agarwal){
  html = html + '<p><a href="#" onClick="viewGSTInvoice(\'' + agarwal + '\')">'+agarwal+'</a></p>';
 }else{
  html = html + '<p><button class="btn btn-sm btn-primary" onClick="generateGSTInvoice(\'' + id + '\',1,\'' + city + '\',\'' + customer + '\')">Generate Agarwal Invoice</button></p>';
 }

 if(harihar){
  html = html + '<p><a href="#" onClick="viewGSTInvoice(\'' + harihar + '\')">'+harihar+'</a></p>';
 }else{
  html = html + '<p><button class="btn btn-sm btn-primary" onClick="generateGSTInvoice(\'' + id + '\',2,\'' + city + '\',\'' + customer + '\')">Generate Harihar Invoice</button></p>';
 }

 return html;
}


function generateGSTInvoice(invoiceId,firmId,city,customer) {
  
    
    $.ajax({
      type: 'POST',
      url: '/new/oba/accountant/apis/select/get_invoice_selected_products_for_gst_invoice.php',
      data: { firm_id: firmId,id: invoiceId},
      success: function (data) {
        if(data){
          data = JSON.parse(data);
          if(data.length == 0){
            alert('No Item Exist for this firm');
          }else{
            debugger;
            localStorage.clear();
            localStorage.setItem('selectedProducts', JSON.stringify(data));
            localStorage.setItem('firm_id',firmId);
            localStorage.setItem('city_id',city);
            localStorage.setItem('customer_id',customer);
            localStorage.setItem('invoiceId',invoiceId);
            window.location.href = './create_gst_invoice.php';
          }
        }
  
      }
    });
  
}


