var products = [];//
var categories = []; //
var parentCategories = [];//
var childCategories = [];//
var selectedProducts = [];//


var cat = localStorage.getItem('categories');
if(localStorage.getItem('city_id')){
    $('#city-value').val(localStorage.getItem('city_id'));
    loadCustomer();
}
if (cat) {
    categories = JSON.parse(cat);
    afterCategoryLoad();
} else {
    loadCategories();
}
showselectedProducts();

///Modal Functions start

function loadProducts() {
    $.ajax({
        url: "/new/oba/salesman/apis/select/get_products_for_new_order.php",
        type: "POST",
        data: {
            customerId: localStorage.getItem('customer_id')
        },
        dataType: "json",
        success: function (data) {
            products = data;
            localStorage.setItem('InvoiceData', JSON.stringify(data));

        }
    });
}




function saveInvoice() {
    if ($("#show-customer").val() != "" && $("#show-customer").val()) {
        
        var selectedProducts = localStorage.getItem('selectedProducts');
        if (selectedProducts) {
            selectedProducts = JSON.parse(selectedProducts);
        } else {
            alert('Please select at least one item');
            return;
        }
        if (selectedProducts.length > 0 && $("#suffix").val() != '' && $("#suffix").val() != 0) {
            $("#save-invoice").prop('disabled', true);

            var productData = {
                products: selectedProducts,
                customerId: $("#show-customer").val(),
                totalAmount: getTotalAmount(),
                order_id :localStorage.getItem('order_id'),
                invoiceNumber: $("#prefix").html()+$("#suffix").val(),
                date: $("#invoiceDate").val()
            }

            $.ajax({
                type: 'POST',
                url: '/new/oba/accountant/apis/add/add_invoice.php',
                data: JSON.stringify(productData),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        alert('invoice has been created successfully');
                        $("#modal-success-alert").modal('show');
                        $("#main-heading").html("Invoice Created");
                        $("#alert-message").html("invoice has been created successfully");
                        localStorage.clear();
                        //dashboardRedirection();
                        localStorage.setItem('invoice_number',response);
                        window.location.replace("./generate_invoice_pdf.php");
                    }else{
                        alert('Invoice is not created. Please check invoice number or recreate Invoice.');
                    }
                },
                error: function (error) {
                    $("#modal-danger-alert").modal('show');
                    $("#main-heading-danger").html("Invoice Failed");
                    $("#alert-message-danger").html("Please check items or invoice number");
                }
            });
        } else {
            // alert('Please add some items');
            $("#modal-info-alert").modal('show');
            $("#main-heading-info").html("Add Items");
            $("#alert-message-info").html("Please check items or invoice number");
        }
    }else{
        alert('Please select a customer first');
        return;
    } 
}



