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

  function viewInvoice(invoice_number) {
    localStorage.setItem('invoice_number', invoice_number);
    window.location.href = './generate_invoice_pdf.php';
  }

  
function viewGSTInvoice(invoice_number) {
    localStorage.setItem('invoice_number', invoice_number);
    window.location.href = './generate_gst_invoice_pdf.php';
  }

  function formatDate(d) {
    var d = new Date(d);
  
    var datestring = d.getDate() + " / " + (d.getMonth() + 1) + " / " + d.getFullYear();
    return datestring;
  }