var products = [];//
var categories = []; //
var parentCategories = [];//
var childCategories = [];//
var selectedProducts = [];//
$("#show-customer").off();

var cat = localStorage.getItem('categories');

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
                if(localStorage.getItem('prefix') && localStorage.getItem('suffix')){
                    $("#prefix").html(localStorage.getItem('prefix'));
                    $("#suffix").val(localStorage.getItem('suffix'));
                }else{
                    getInvoiceNumber();
                }
            }
            // localStorage.setItem('customerList',data);
            localStorage.setItem('city_id', cityId);
            localStorage.setItem('city', cityName);

        }
    });
}

function getInvoiceNumber() {
    $.ajax({
        type: 'POST',
        url: '/new/oba/accountant/apis/select/get_invoice_number.php',
        data: { customerId: $('#show-customer').val() },
        success: function (data) {
            if (data) {
                data = JSON.parse(data);
                debugger;
                localStorage.setItem("prefix", data[0]);
                localStorage.setItem("suffix", data[1]);
                $("#prefix").html(data[0]);
                $("#suffix").val(data[1]);

            }


        }
    });
}

$('#show-customer').change(function (event) {
    debugger;
    getInvoiceNumber();
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


if (localStorage.getItem('city_id')) {
    $('#city-value').val(localStorage.getItem('city_id'));
    loadCustomer();
}
if (localStorage.getItem('firm_id')) {
    $('#show-firm').val(localStorage.getItem('firm_id'));
    if (localStorage.getItem('prefix') && localStorage.getItem('suffix')) {
        $("#prefix").html(localStorage.getItem('prefix'));
        $("#suffix").val(localStorage.getItem('suffix'));
    } else {
        getInvoiceNumber();
    }
    if (cat) {
        categories = JSON.parse(cat);
        fillCategories();
    } else {
        loadCategories();
    }

    showselectedProducts();
}

function getInvoiceNumber() {
    $.ajax({
        type: 'POST',
        url: '/new/oba/accountant/apis/select/get_gst_invoice_number.php',
        data: { firmName: getFirmName() },
        success: function (data) {
            if (data) {
                data = JSON.parse(data);
                localStorage.setItem("prefix", data[0]);
                localStorage.setItem("suffix", data[1]);
                $("#prefix").html(data[0]);
                $("#suffix").val(data[1]);

            }


        }
    });
}

///Modal Functions start

function loadCategories() {
    $.ajax({
        url: "/new/oba/accountant/apis/select/get_firm_category.php",
        type: "POST",
        data: {
            firmId: $("#show-firm").val()
        },
        dataType: "json",
        success: function (data) {
            categories = data;
            localStorage.setItem('categories', JSON.stringify(data));
            fillCategories();
            loadProducts();
        }
    });
}



function loadProducts() {

    $.ajax({
        url: "/new/oba/accountant/apis/select/get_products_for_new_gst_invoice.php",
        type: "POST",
        data: {
            firmId: $("#show-firm").val()
        },
        dataType: "json",
        success: function (data) {
            products = data;
            localStorage.setItem('InvoiceData', JSON.stringify(data));

            showselectedProducts();
        }
    });

}

///Modal Functions end


function showselectedProducts() {

    var data = localStorage.getItem('selectedProducts');
    var html = '';
    var i = 0;
    if (data) {
        data = JSON.parse(data);

        for (i = 0; i < data.length; i++) {

            var taxAmount = data[i].gst * data[i].quantity * data[i].itemPrice * 0.01;
            var totalAmount = (data[i].itemPrice * data[i].quantity);
            totalAmount = totalAmount + taxAmount;
            //totalAmount = (totalAmount);
            debugger;
            html = html + '<tr>' +
                '<td >' + (i + 1) + '.</td>' +
                '<td >' + data[i].name + '</td>' +
                '<td >' + data[i].hsn + '</td>' +
                '<td >' + getInput("qty", data[i].quantity, data[i].id, i) + '</td>' +
                '<td >' + getUnitDropDown(data[i].unit, data[i].punit, data[i].sunit, data[i].id, i) + '</td>' +
                '<td >' + getInput("rate", data[i].itemPrice, data[i].id, i) + '</td>' +
                '<td >' + data[i].gst + '%</td>' +
                '<td id="' + data[i].id + '_taxAmount_' + i + '">' + parseFloat(taxAmount).toFixed(2) + '</td>' +
                '<td  id="' + data[i].id + '_amount_' + i + '">' + parseFloat(totalAmount).toFixed(2) + '</td>' +
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
        '<td></td>' +
        '<td></td>' +
        '</tr>';
    $("#invoiceItems").html(html);
    displayTotalAmount();
}

function updateItemTotal(id, type, index) {

    var qty = parseFloat($("#" + id + "_qty_" + index).val()).toFixed(2);
    var rate = parseFloat($("#" + id + "_rate_" + index).val()).toFixed(2);
    var taxAmount = 0;
    debugger;
    if (qty == 'NaN') {
        qty = 0;
    }
    if (rate == 'NaN') {
        rate = 0;
    }
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);

        if (type == "qty") {
            data[index].quantity = qty;

        }

        if (type == "rate") {
            data[index].itemPrice = rate

        }
        taxAmount = (data[index].quantity * data[index].itemPrice * data[index].gst * 0.01);
        data[index].taxAmount = parseFloat(taxAmount).toFixed(2);
        $("#" + id + "_taxAmount_" + index).html(data[index].taxAmount);



    }


    selectedProducts = data;
    localStorage.setItem('selectedProducts', JSON.stringify(data));
    var totalAmount = (data[index].itemPrice * data[index].quantity * 1);
    totalAmount = totalAmount + taxAmount;

    $("#" + id + "_amount_" + index).text(parseFloat(totalAmount).toFixed(2));
    displayTotalAmount();
}


function displayTotalAmount() {
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);

        var total = 0;
        for (var i = 0; i < data.length; i++) {
            total = total + (data[i].itemPrice * data[i].quantity) + (data[i].quantity * data[i].itemPrice * data[i].gst * 0.01);
        }
        total = total;
        if ($("#totalAmount").length) {
            $("#totalAmount").html("&#8377;&nbsp;" + parseFloat(total).toFixed(2));
        } else {
            $("#invoiceItems").append('<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><strong>Total</strong></td><td id="totalAmount">&#8377;&nbsp;' + parseFloat(total).toFixed(2) + '</td><td></td></tr>');
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
                html = html + ('<option value="' + value.id + '">' + value.cname + ' (' + value.state + ')</option>');
            });
            $('#show-customer').html(html);
            localStorage.setItem('customers', JSON.stringify(data));

            if (localStorage.getItem('customer_id')) {
                $('#show-customer').val(localStorage.getItem('customer_id'));
                $("#customerData").html(getCustomerDetails(localStorage.getItem('customer_id')));
            }

            // localStorage.setItem('customerList',data);
            localStorage.setItem('city_id', cityId);
            localStorage.setItem('city', cityName);

        }
    });
}

function getCustomerDetails(id) {
    var customers = localStorage.getItem('customers');
    if (customers) {
        customers = JSON.parse(customers);
        var html = '<table class="table table-sm table-bordered">';
        for (var i = 0; i < customers.length; i++) {
            if (customers[i].id == id) {
                if (customers[i].gstin != '') {
                    html = html + '<tr><td><b>Name :</b></td><td>' + customers[i].cname + '</td></tr>';
                    html = html + '<tr><td><b>GSTIN :</b></td><td>' + customers[i].gstin + '</td></tr>';
                    if (customers[i].address != '')
                        html = html + '<tr><td><b>Address :</b></td><td>' + customers[i].address + '</td></tr>';
                    if (customers[i].mobile != '')
                        html = html + '<tr><td><b>Mobile :</b></td><td>' + customers[i].mobile + '</td></tr>';
                    if (customers[i].state != '')
                        html = html + '<tr><td><b>State :</b></td><td>' + customers[i].state + ' (' + customers[i].state_code + ')</td></tr>';
                } else {
                    return '';
                }
                break;
            }
        }
        html = html + '</table>';
        return html;
    } else {
        return '';
    }

}

function getTaxType(id) {
    var customers = localStorage.getItem('customers');
    if (customers) {
        customers = JSON.parse(customers);
        for (var i = 0; i < customers.length; i++) {
            if (customers[i].id == id) {
                if (customers[i].state == "Uttar Pradesh") {
                    return 'GST';
                } else {
                    return 'IGST';
                }
            }
        }
    }
    return 'GST';
}




function selectItem() {
    if ($('#show-firm').val() != "" && $('#show-firm').val() && $('#show-customer').val() != "" && $('#show-customer').val()) {
        $('#modal-add-item').modal('show');
    } else {
        alert('Please select a firm & Customer first');
    }

}

function getTotalAmount() {
    var data = localStorage.getItem('selectedProducts');
    if (data) {
        data = JSON.parse(data);
        var total = 0;
        for (var i = 0; i < data.length; i++) {
            debugger;
            total = total + (data[i].quantity * data[i].itemPrice) + (data[i].taxAmount * 1.00);
        }
        return parseFloat(total).toFixed(2);
    } else {
        return 0;
    }
}


function saveInvoice() {
    if ($("#show-firm").val() != "" && $("#show-firm").val() && $("#show-customer").val() != "" && $("#show-customer").val()) {

        var selectedProducts = localStorage.getItem('selectedProducts');
        if (selectedProducts) {
            selectedProducts = JSON.parse(selectedProducts);
        } else {
            alert('Please select at least one item');
            return;
        }
        if (selectedProducts.length > 0 && $("#suffix").val() != '' && $("#suffix").val() != 0 && $("#invoiceDate").val() != '') {
            $("#save-invoice").prop('disabled', true);

            var productData = {
                products: selectedProducts,
                firmId: $("#show-firm").val(),
                firmName: getFirmName(),
                totalAmount: getTotalAmount(),
                customerId: $("#show-customer").val(),
                taxType: getTaxType($("#show-customer").val()),
                invoiceNumber: $("#prefix").html() + $("#suffix").val(),
                date: $("#invoiceDate").val(),
                invoiceId: localStorage.getItem('invoiceId')

            }

            $.ajax({
                type: 'POST',
                url: '/new/oba/accountant/apis/add/add_gst_invoice.php',
                data: JSON.stringify(productData),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        alert('Invoice has been created successfully');
                        $("#modal-success-alert").modal('show');
                        $("#main-heading").html("Invoice Created");
                        $("#alert-message").html("invoice has been created successfully");
                        localStorage.clear();
                        //dashboardRedirection();
                        localStorage.setItem('invoice_number', response);
                        window.location.replace("./generate_gst_invoice_pdf.php");
                    } else {
                        alert('Invoice is not created. Please try again.');
                    }
                },
                error: function (error) {
                    $("#modal-danger-alert").modal('show');
                    $("#main-heading-danger").html("Invoice Failed");
                    $("#alert-message-danger").html("Invoice creation Failed");
                }
            });
        } else {
            // alert('Please add some items');
            $("#modal-danger-alert").modal('show');
            $("#main-heading-danger").html("Invoice Failed");
            $("#alert-message-danger").html("Please add some items, or check invoice number or invoice date");
        }
    } else {
        alert('Please select a firm & Customer first');
        return;
    }
}

$('#show-customer').change(function (event) {
    debugger;
    localStorage.setItem('customer_id', $('#show-customer').val());
    $("#customerData").html(getCustomerDetails($('#show-customer').val()));
    event.preventDefault();
});

$('#show-firm').change(function (event) {
    localStorage.setItem('firm_id', $('#show-firm').val());
    selectedProducts = [];
    localStorage.removeItem('selectedProducts');
    loadCategories();
    getInvoiceNumber();
});

function getFirmName() {
    var name = $("#show-firm option:selected").text();
    return name.split(" ")[0];
}