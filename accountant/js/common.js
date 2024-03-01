/*** Code to Select Items Start */
function loadCategories() {
    $.ajax({
        url: "/new/oba/salesman/apis/select/get_all_category.php",
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
    debugger; 
    ///////
    fillCategories();
    var temp = localStorage.getItem('InvoiceData');
    if (temp) {
        products = JSON.parse(temp);
        currentProducts = products;
    } else {
        if (localStorage.getItem('customer_id')) {
            loadProducts();
        }
    }
}

function fillCategories() {
    parentCategories = [];
    childCategories = [];
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

function printItemOptions() {
    var data = JSON.parse(localStorage.getItem('InvoiceData'));
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

$("#items").change(function (event) {
    var index = $("#items option:selected").val();
    var data = JSON.parse(localStorage.getItem('InvoiceData'));
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



/*** Code to Select Items End */

function addNewItem() {

    var index = $("#items option:selected").val();
    if (index && index != 'SELECT ITEM') {

        var data = JSON.parse(localStorage.getItem('InvoiceData'));
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
            let x = 0;
            if (data[i].itemPrice != 0 && data[i].quantity != 0) {
                x = parseFloat((data[i].discount * 100) / (data[i].itemPrice * data[i].quantity)).toFixed(2);
            }

            html = html + '<tr>' +
                '<td >' + (i + 1) + '.</td>' +
                '<td >' + data[i].name + '</td>' +
                '<td >' + getInput("qty", data[i].quantity, data[i].id, i) + '</td>' +
                '<td >' + getUnitDropDown(data[i].unit, data[i].punit, data[i].sunit, data[i].id, i) + '</td>' +
                '<td >' + getInput("rate", data[i].itemPrice, data[i].id, i) + '<table class="table-sm" style="margin-top:5px"><tr><td><strong>Min </strong></td><td>&#x20B9;&nbsp;&nbsp;' + data[i].minPrice + '</td><td><strong>Max </strong></td><td>&#x20B9;&nbsp;&nbsp;' + data[i].maxPrice + '</td></tr><tr><td><strong>Last </strong></td><td>&#x20B9;&nbsp;&nbsp;' + data[i].customerPrice + '</td></tr></table></td>' +
                '<td >' + getInput("discount", data[i].discount, data[i].id, i) + '</td>' +
                '<td ><span class="flex">' + getInput("discountper", x, data[i].id, i) + '%</span></td>' +
                '<td  id="' + data[i].id + '_amount_' + i + '">' + parseFloat(data[i].itemPrice * data[i].quantity).toFixed(2) + '</td>' +
                '<td ><a onclick="deleteItem(' + i + ')" style="color:red"><i class="fa fa-trash"></i></a></td>'
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
        '<td></td>' +
        '<td></td>' +
        '</tr>';
    $("#invoiceItems").html(html);
    displayTotalAmount();
}

function getInput(type, value, id, index) {

    return '<input type="number" style="max-width:100px" class="form-control-sm" value="' + value + '" id="' + id + '_' + type + '_' + index + '" onkeyup="updateItemTotal(' + id + ',\'' + type + '\',' + index + ')" onchange="updateItemTotal(' + id + ',\'' + type + '\',' + index + ')" />';

}

function deleteItem(index) {

    var data = JSON.parse(localStorage.getItem('selectedProducts'));
    data.splice(index, 1);

    selectedProducts = data;

    localStorage.setItem('selectedProducts', JSON.stringify(data));
    showselectedProducts();
}

function updateItemTotal(id, type, index) {

    var qty = parseFloat($("#" + id + "_qty_" + index).val()).toFixed(2);
    var rate = parseFloat($("#" + id + "_rate_" + index).val()).toFixed(2);
    var discount = parseFloat($("#" + id + "_discount_" + index).val()).toFixed(2);
    var dis_per = parseFloat($("#" + id + "_discountper_" + index).val()).toFixed(2);
    debugger;
    if (qty == 'NaN') {
        qty = 0;
    }
    if (rate == 'NaN') {
        rate = 0;
    }
    if (discount == 'NaN') {
        discount = 0;
    }
    if (dis_per == 'NaN') {
        dis_per = 0;
    }
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);

        if (type == "qty") {
            data[index].quantity = qty;
            discount = parseFloat((dis_per * (qty * rate)) / 100).toFixed(2);
            data[index].discount = discount;
            $("#" + id + "_discount_" + index).val(discount);
        }

        if (type == "rate") {
            data[index].itemPrice = rate
            discount = parseFloat((dis_per * (qty * rate)) / 100).toFixed(2);
            data[index].discount = discount;
            $("#" + id + "_discount_" + index).val(discount);
        }

        if (type == "discount") {

            let d = 0;
            if (rate != 0 && qty != 0) {
                d = parseFloat((discount * 100) / (rate * qty)).toFixed(2);
            } else {
                d = 0;
            }
            dis_per = d;
            $("#" + id + "_discountper_" + index).val(d);
            data[index].discount = discount;
        }

        if (type == "discountper") {
            discount = parseFloat((dis_per * (qty * rate)) / 100).toFixed(2);
            data[index].discount = discount;
            $("#" + id + "_discount_" + index).val(discount);
        }

    }


    selectedProducts = data;
    localStorage.setItem('selectedProducts', JSON.stringify(data));

    $("#" + id + "_amount_" + index).text(parseFloat((qty * rate) - discount).toFixed(2));
    displayTotalAmount();
}

function updateUnit(self, id, index) {
    $("#" + id + "_unit_" + index + "p").html($("#" + id + "_unit_" + index).val());
}

function getUnitDropDown(unit, punit, sunit, id, index) {

    if (!unit) {
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
    html = html + '</select><p id="' + id + '_unit_' + index + 'p">' + unit + '</p>';

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
            $("#totalAmount").html("&#8377;&nbsp;&nbsp;" + total);
        } else {
            $("#invoiceItems").append('<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><strong>Total</strong></td><td id="totalAmount">&#8377;&nbsp;&nbsp;' + total + '</td><td></td></tr>');
        }

    }
}

function loadCustomer() {
    var cityId = $('#city-value').val();
    var cityName = $('#city-value').find(":selected").text();

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
            $('#show-customer').html(html);
            if (localStorage.getItem('customer_id')) {
                $('#show-customer').val(localStorage.getItem('customer_id'));
            }
            // localStorage.setItem('customerList',data);
            localStorage.setItem('city_id', cityId);
            localStorage.setItem('city', cityName);

        }
    });
}

$('#show-customer').change(function (event) {
    debugger;
    localStorage.setItem('customer_id', $('#show-customer').val());
    loadProducts();
    event.preventDefault();
});

$('#city-value').change(function () {
    loadCustomer();
});


function selectItem() {
    if ($('#show-customer').val() != "" && $('#show-customer').val()) {
        $('#modal-add-item').modal('show');
    } else {
        alert('Please select a customer first');
    }
}

function getTotalAmount() {
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);
        var total = 0;
        for (var i = 0; i < data.length; i++) {
            total = total + (data[i].quantity * data[i].itemPrice - data[i].discount);
        }
        return parseFloat(total).toFixed(2);
    } else {
        return 0;
    }
}

function cancelInvoice() {

    bootbox.confirm({
        message: '<h4>Are you sure you want to cancel the invoice? All unsaved changes will be lost.</h4>',
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
                window.history.back();
            }
        }
    });
}