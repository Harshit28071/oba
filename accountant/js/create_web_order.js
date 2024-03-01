var products = [];//
var categories = []; //
var parentCategories = [];//
var childCategories = [];//
var selectedProducts = [];//


var cat = localStorage.getItem('categories');
if (localStorage.getItem('city_id')) {
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


///Modal Functions end

function dashboardRedirection() {
    window.location.href = './my_orders.php';
}

function saveOrder() {
    if ($("#show-customer").val() != "" && $("#show-customer").val()) {

        var selectedProducts = localStorage.getItem('selectedProducts');
        if (selectedProducts) {
            selectedProducts = JSON.parse(selectedProducts);
        } else {
            alert('Please select at least one item');
            return;
        }
        if (selectedProducts.length > 0) {
            $("#save-order").prop('disabled', true);

            var productData = {
                products: selectedProducts,
                customerId: $("#show-customer").val(),
                totalAmount: getTotalAmount()
            }

            $.ajax({
                type: 'POST',
                url: '/new/oba/salesman/apis/add/add_order.php',
                data: JSON.stringify(productData),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response > 0) {
                        //alert('order has been created successfully');
                        $("#modal-success-alert").modal('show');
                        $("#main-heading").html("Order Created");
                        $("#alert-message").html("order has been created successfully");
                        localStorage.clear();
                        dashboardRedirection();

                    }
                },
                error: function (error) {
                    $("#modal-danger-alert").modal('show');
                    $("#main-heading-danger").html("Order Failed");
                    $("#alert-message-danger").html("Order creation Failed");
                }
            });
        } else {
            // alert('Please add some items');
            $("#modal-info-alert").modal('show');
            $("#main-heading-info").html("Add Items");
            $("#alert-message-info").html("Please add some items");
        }
    } else {
        alert('Please select a customer first');
        return;
    }
}

function cancelOrder() {

    bootbox.confirm({
        message: '<h4>Are you sure you want to cancel the order? All unsaved changes will be lost.</h4>',
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: 'No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
            if (result) {
                localStorage.clear();
                dashboardRedirection();
            }
        }
    });
}

