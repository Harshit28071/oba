var products = [];//
var categories = []; //
var parentCategories = [];//
var childCategories = [];//
var selectedProducts = [];//


var cat = localStorage.getItem('categories');

if (cat) {
    categories = JSON.parse(cat);
    afterCategoryLoad();
} else {
    loadCategories();
}
showselectedProducts();

///Modal Functions start
function loadCategories() {
    $.ajax({
        url: "/new/oba/apis/select/salesman/get_all_category.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            categories = data;
            localStorage.setItem('categories', JSON.stringify(data));
            afterCategoryLoad();
        }
    });
}

function afterCategoryLoad() {
    fillCategories();
    var temp = localStorage.getItem('OrderData');
    if (temp) {
        products = JSON.parse(temp);
        currentProducts = products;

    } else {
        loadProducts();
    }
}

function fillCategories() {

    for (var i = 0; i < categories.length; i++) {
        if (categories[i].parent == '-') {
            parentCategories.push(categories[i]);
        } else {
            childCategories.push(categories[i]);
        }
    }
    printMainCategoriesOptions(parentCategories);
}

function printMainCategoriesOptions(data) {
    var html = '<option selected style="text-align: center;">SELECT CATEGORY</option>';
    for (var i = 0; i < data.length; i++) {
        html = html + '<option value="' + data[i].name + '">' + data[i].name + '</option>';
    }
    $("#mainCategory").html(html);
}

$("#mainCategory").change(function (event) {
    var html = '';
    var data = JSON.parse(localStorage.getItem('categories'));
    for (var i = 0; i < data.length; i++) {
        if (data[i].parent == $("#mainCategory option:selected").val()) {
            html = html + '<option value="' + data[i].name + '">' + data[i].name + '</option>';
        }
    }
    if (html != '') {
        $("#sub-category").html(' <div class="form-group">' +
            '<label for="exampleInputEmail1">Select Sub Category</label>' +
            '<select class="custom-select" id="subCategory" onchange="printItemOptions()"><option selected style="text-align: center;" >SELECT SUB CATEGORY</option>' +
            html +
            '</select>' +
            '</div>');
        $("#items").html('');
    } else {
        $("#sub-category").html('');
        printItemOptions();
    }

});


function printItemOptions() {
    var data = JSON.parse(localStorage.getItem('OrderData'));
    var html = '<option selected style="text-align: center;" >SELECT ITEM</option>';
    var category = $("#mainCategory option:selected").val();
    if (category != '' && category != 'SELECT CATEGORY') {
        if ($("#subCategory option:selected").val() && $("#subCategory option:selected").val() != 'SELECT SUB CATEGORY') {
            category = $("#subCategory option:selected").val();
        }
    }
    for (var i = 0; i < data.length; i++) {
        if (data[i].category == category)
            html = html + '<option value="' + i + '">' + data[i].name + '</option>';
    }
    $("#items").html(html);
}

$("#items").change(function (event) {
    var index = $("#items option:selected").val();
    var data = JSON.parse(localStorage.getItem('OrderData'));
    data = data[index];

    //mycode here
    if (data.punit == data.sunit) {
        $("#units").html('');
    } else {
        $("#units").html('<div class="form-group">' +
            '<label for="exampleInputEmail1">Select Units</label>' +
            '<select class="custom-select" id="unit">' +
            '<option value="' + data.punit + '">' + data.punit + '</option>' +
            '<option value="' + data.sunit + '">' + data.sunit + '</option>' +
            '</select>' +
            '</div>');
    }
});

function loadProducts() {
    $.ajax({
        url: "/new/oba/apis/select/salesman/get_products_for_new_order.php",
        type: "POST",
        data: {
            customerId: localStorage.getItem('customer_id')
        },
        dataType: "json",
        success: function (data) {
            products = data;
            localStorage.setItem('OrderData', JSON.stringify(data));

        }
    });
}

function addNewItem() {

    var index = $("#items option:selected").val();
    if (index && index != 'SELECT ITEM') {

        var data = JSON.parse(localStorage.getItem('OrderData'));
        data = data[index];
        data.quantity = data.qty_step;

        if ($("#unit") && $("#unit option:selected").val()) {
            data.unit = $("#unit option:selected").val();
        } else {
            data.unit = data.punit;
        }
        var sp = localStorage.getItem('selectedProducts');
        if (sp) {
            selectedProducts = JSON.parse(sp);
        }
        selectedProducts.push(data);
        localStorage.setItem("selectedProducts", JSON.stringify(selectedProducts));
        showselectedProducts();
        displayTotalAmount();

        $("#additemForm").trigger("reset")
        $('#modal-add-item').modal('hide');

    } else {
        //alert('Please select item');
        $("#modal-info-alert").modal('show');
        $("#main-heading-info").html("Add Items");
        $("#alert-message-info").html("Please add some items")

    }

}

///Modal Functions end


function showselectedProducts() {

    var data = localStorage.getItem('selectedProducts');
    var html = '';
    var i = 0;
    if (data) {
        data = JSON.parse(data);

        for (i = 0; i < data.length; i++) {
            debugger;
            console.log(data[i]);
            html = html + '<tr>' +
                '<td>' + (i + 1) + '.</td>' +
                '<td>' + data[i].name + '</td>' +
                '<td>' + getInput("qty", data[i].quantity, data[i].id, i) + '</td>' +
                '<td>' + getUnitDropDown(data[i].unit, data[i].punit, data[i].sunit, data[i].id, i) + '</td>' +
                '<td>' + getInput("rate", data[i].itemPrice, data[i].id, i) + '</td>' +
                '<td id="' + data[i].id + '_amount_' + i + '">' + parseFloat(data[i].itemPrice * data[i].quantity).toFixed(2) + '</td>' +
                '<td><a onclick="deleteItem(' + i + ')" style="color:red"><i class="fa fa-trash"></i></a></td>'
            '</tr>';
        }

    }
    html = html + '<tr>' +
        '<td>#</td>' +
        '<td><a onclick="selectItem()" id="add-cust"><button type="button" class="btn btn-info btn-sm">Select Item</button></a></td>' +
        '<td></td>' +
        '<td></td>' +
        '<td></td>' +
        '<td></td>' +
        '</tr>';
    $("#orderItems").html(html);
    displayTotalAmount();
}

function getInput(type, value, id, index) {

    return '<input type="number" class="form-control-sm" value="' + value + '" id="' + id + '_' + type + '_' + index + '" onkeyup="updateItemTotal(' + id + ',\'' + type + '\',' + index + ')" onchange="updateItemTotal(' + id + ',\'' + type + '\',' + index + ')" />';

}

function deleteItem(index) {
    
    var data = JSON.parse(localStorage.getItem('selectedProducts'));
    data.splice(index, 1);

    selectedProducts = data;

    localStorage.setItem('selectedProducts', JSON.stringify(data));
    showselectedProducts();
}

function updateItemTotal(id, type, index) {
    $("#" + id + "_amount_" + index).text(parseFloat($("#" + id + "_qty_" + index).val() * $("#" + id + "_rate_" + index).val()).toFixed(2));
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);

        if (type == "qty") {
            data[index].quantity = parseFloat($("#" + id + "_qty_" + index).val()).toFixed(2);
        }

        if (type == "rate") {
            data[index].itemPrice = parseFloat($("#" + id + "_rate_" + index).val()).toFixed(2);
        }

        selectedProducts = data;
        localStorage.setItem('selectedProducts', JSON.stringify(data));
    }

    displayTotalAmount();
}



function getUnitDropDown(unit, punit, sunit, id, index) {
    
    if(!unit){
        unit = punit;
    }

    var html = '<select class="custom-select rounded-0" id="' + id + '_unit_' + index + '" onchange="updateUnit(this,' + id + ',' + index + ')" >';
    html = html + '<option value="' + unit + '">' + unit + '</option>';
    if (punit != '' && punit != unit) {
        html = html + '<option value="' + punit + '">' + punit + '</option>';
    }
    if (sunit != '' && sunit != punit && sunit != unit) {
        html = html + '<option value="' + sunit + '">' + sunit + '</option>';
    }
    html = html + '</select>';

    return html;
}

function displayTotalAmount() {
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);

        var total = 0;
        for (var i = 0; i < data.length; i++) {
            total = total + parseFloat(data[i].itemPrice * data[i].quantity);
        }
        total = total.toFixed(2);
        if ($("#totalAmount").length) {
            $("#totalAmount").html("&#8377;&nbsp;" + total);
        } else {
            $("#orderItems").append('<tr><td></td><td></td><td></td><td></td><td><strong>Total</strong></td><td id="totalAmount">&#8377;&nbsp;' + total + '</td><td></td></tr>');
        }

    }
}

function loadCustomer() {
    var cityId = $('#city-value').val();
    var cityName = $('#city-value').find(":selected").text();

    $.ajax({
        type: 'POST',
        url: '/new/oba/apis/select/salesman/get_city_customer.php',
        data: { id: cityId },
        success: function (data) {
            var html = '<option selected style="text-align: center;" value="">SELECT CUSTOMER </option>';
            $.each(data, function (index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                html = html + ('<option value="' + value.id + '">' + value.cname + ' (' + value.cityname + ')' + '</option>');
            });
            $('#show-customer').html(html);
            if (localStorage.getItem('customer_id')) {
                $('#show-customer').val(localStorage.getItem('customer_id'));

            }
            // localStorage.setItem('customerList',data);
            localStorage.setItem('city_id', cityId);
            localStorage.setItem('city_name', cityName);

        }
    });
}

$('#city-value').change(function () {
    loadCustomer();
});


function selectItem() {
    $('#modal-add-item').modal('show');
}

function getTotalAmount() {
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);
        var total = 0;
        for (var i = 0; i < data.length; i++) {
            total = total + data[i].quantity * data[i].itemPrice;
        }
        return parseFloat(total).toFixed(2);
    } else {
        return 0;
    }
}
function dashboardRedirection(){
    window.location.href='./dashboard.php';
  }

function saveOrder() {
    if ($("#show-customer").val() == "") {
        alert('Please select a customer first');
        return;
    } else {
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
                url: '/new/oba/apis/add/salesman/add_order.php',
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
    }
}

function cancelOrder(){

    bootbox.confirm({
        message: '<h4>Are you sure you want to cancel the order?</h4>',
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
            if(result){
                localStorage.clear();
                dashboardRedirection();
            }
        }
        });
}

