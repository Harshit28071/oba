var details = {}
var products = [];

function getInvoiceData(invoiceId) {

    $.ajax({
        type: 'POST',
        url: '/new/oba/accountant/apis/select/get_gst_invoice_details.php',
        data: {
            id: invoiceId
        },
        dataType: "json",
        success: function (data) {
            if (data && data.length > 0) {
                details = data[0];
                console.log(details);
                getInvoiceProducts(invoiceId);
            }
        }
    });

}

function getInvoiceProducts(invoiceId) {
    $.ajax({
        type: 'POST',
        url: '/new/oba/accountant/apis/select/get_gst_invoice_products.php',
        data: {
            id: invoiceId
        },
        dataType: "json",
        success: function (data) {
            products = data;
            console.log(products);
            createPdf(invoiceId);
        }
    });
}

function formatDate(dateString) {
    debugger;
    var dateParts = dateString.split("-");
    return dateParts[2] + "/" + dateParts[1] + "/" + dateParts[0];
}

function createPdf(invoiceId) {
    var newDate = new Date();
    //var datetime = "LastSync: " + newDate.today() + " @ " + newDate.timeNow();
    var add = details.address + ", " + details.city + "(" + details.state + ")"
    var firmDetails = "<h3>" + details.firm_name + "</h3><div class='line-height-25'><p>" + details.myaddress + "</p><p>FSSAI: " + details.fssai + "</p><p>Phone No.: " + details.mymobile + "</p><p>GSTIN: " + details.mygstin + "</p><p>State: " + details.mystatecode + "-" + details.mystate + "</p></div>";
    var html = "<table><tr><td >" + firmDetails + "</td><td class='vertical-base'>Invoice No. <br><strong>" + invoiceId + "</strong></td><td class='vertical-base'>Date <br><strong>" + formatDate(details.date) + "</strong></td></tr>";
    var tqty = 0;
    var tTaxAmount = 0;
    var tGst = 0;
    var total = 0;
    html = html + "<tr><td class='line-height-25'>Bill To</br><strong>" + details.name + "</strong><p>" + add + "</p><p>" + details.mobile + "</p><p><strong>GSTIN:</strong> " + details.gstin + "</p><p><strong>State Name:</strong> " + details.state + ", Code: " + details.statecode + "</p></td></tr></table>";

    html = html + "<table><tr style='font-weight:bold;text-align:center'><td class='left-text'>#</td><td class='left-text'>Item Name</td><td class='right-text'>HSN</td><td class='right-text'>Quantity</td><td class='right-text'>Unit</td><td class='right-text'>Price/Unit</td><td class='dis right-text'>Taxable Amount</td><td class='right-text'>" + details.tax_type + "</td><td class='right-text'>Amount with Tax</td></tr>";
    for (var i = 0; i < products.length; i++) {
        tqty = tqty + products[i].quantity;
        var currentTaxAmount = products[i].quantity * products[i].price;
        var currentTax = products[i].quantity * products[i].price * products[i].gst * 0.01;

        tTaxAmount = tTaxAmount + currentTaxAmount;
        tGst = tGst + currentTax;

        var productSum = currentTaxAmount + currentTax;

        total = total + productSum;

        html = html + "<tr style='text-align:center'><td class='left-text'>" + (i + 1) + "</td><td class='left-text'>" + products[i].name + "</td><td class='left-text'>" + products[i].hsn + "</td><td class='right-text'>" + parseFloat(products[i].quantity).toFixed(2) + "</td><td class='right-text'>" + products[i].unit + "</td><td class='right-text'>&#x20B9; " + parseFloat(products[i].price).toFixed(2) + "</td><td class='dis right-text'>&#x20B9; " + parseFloat(currentTaxAmount).toFixed(2) + "</td><td class='right-text'>&#x20B9; " + parseFloat(currentTax).toFixed(2) + " (" + parseFloat(products[i].gst).toFixed(1) + "%) </td><td class='right-text'>&#x20B9; " + parseFloat(productSum).toFixed(2) + " </td></tr>";
    }

    html = html + "<tr style='text-align:center'><td></td><td></td><td><strong>Total</strong></td><td class='right-text'><strong>" + parseFloat(tqty).toFixed(2) + "</strong></td><td></td><td></td><td class='dis right-text'><strong>&#x20B9; " + parseFloat(tTaxAmount).toFixed(2) + "</strong></td><td></td><td class='right-text'><strong>&#x20B9; " + parseFloat(total).toFixed(2) + "</strong></td></tr>";
    html = html + "</table>";

    html = html + '<table><tr><td style="width:50%" rowspan="2">Invoice Amount In Words <br> <strong>' + price_in_words(Math.round(total)) + ' only</strong></td><td><strong>Amounts:</strong><br>Sub Total <span class="right">&#x20B9; ' + parseFloat(total).toFixed(2) + '</span><br>Round Off <span class="right">&#x20B9; ' + parseFloat(Math.round(total) - total).toFixed(2) + ' </span></td></tr><tr><td><strong>Total</strong><span class="right"><strong>&#x20B9; ' + parseFloat(Math.round(total)).toFixed(2) + '</strong></span></td></tr></table>';
    if (details.tax_type == "GST") {
        html = html + '<table class="center-text"><tr class="bold"><td rowspan="2">HSN</td><td rowspan="2">Taxable Amount</td><td colspan="2">CGST</td><td colspan="2">SGST</td><td rowspan="2">Total Tax Amount</td></tr><tr class="bold"><td>Rate</td><td>Amount</td><td>Rate</td><td>Amount</td></tr>';
    } else {
        html = html + '<table class="center-text"><tr class="bold"><td rowspan="2">HSN</td><td rowspan="2">Taxable Amount</td><td colspan="2">IGST</td><td rowspan="2">Total Tax Amount</td></tr><tr class="bold"><td>Rate</td><td>Amount</td></tr>';
    }

    html = html + getHSNWiseTaxDetails();
    html = html + '</table>';

    html = html + "<table><tr><td class='line-height-25'><p>Company's Bank Details</p><p><strong>Bank Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>" + details.bank_name + "</p><p><strong>Account No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>" + details.account_number + "</p><p><strong>Branch & IFSC &nbsp;:</strong>" + details.bank_address + " & " + details.ifsc + "</p></td><td class='vertical-base right-text'><p><strong>For " + details.firm_name + "</strong></p><br><p>Authorised Signatory</p></td></tr></table>";


    var table = "<table style='width:16%; font-size:10px;border-collapse: separate;border:0px;'><tr><td>Customer Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr><tr><td>Transporter Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr><tr><td>Backup Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr></table>";

    html = "<div style='display:inline-flex; width: 100%;'><h3 style='width:84%;padding-left:41%;'>Tax Invoice</h3>" + table + "</div>" + html;

    $("#html").html(html + '<p style="font-size:10px;">' + newDate.toLocaleDateString() + " - " + newDate.toLocaleTimeString() + '</p><p style="font-size:10px;text-align:center;"> Subject To Bijnor Jurisdiction</p><p style="font-size:10px;text-align:center;"> This is a computer generated Invoice.</p>');
    if (tdis <= 0) {

        $('.dis').css('display', 'none');
    }
    // generatePDF(html);
}


function price_in_words(price) {
    var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
        dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
        tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
        handle_tens = function (dgt, prevDgt) {
            return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
        },
        handle_utlc = function (dgt, nxtDgt, denom) {
            return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "")
        };

    var str = "",
        digitIdx = 0,
        digit = 0,
        nxtDigit = 0,
        words = [];
    if (price += "", isNaN(parseInt(price))) str = "";
    else if (parseInt(price) > 0 && price.length <= 10) {
        for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
            case 0:
                words.push(handle_utlc(digit, nxtDigit, ""));
                break;
            case 1:
                words.push(handle_tens(digit, price[digitIdx + 1]));
                break;
            case 2:
                words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
                break;
            case 3:
                words.push(handle_utlc(digit, nxtDigit, "Thousand"));
                break;
            case 4:
                words.push(handle_tens(digit, price[digitIdx + 1]));
                break;
            case 5:
                words.push(handle_utlc(digit, nxtDigit, "Lakh"));
                break;
            case 6:
                words.push(handle_tens(digit, price[digitIdx + 1]));
                break;
            case 7:
                words.push(handle_utlc(digit, nxtDigit, "Crore"));
                break;
            case 8:
                words.push(handle_tens(digit, price[digitIdx + 1]));
                break;
            case 9:
                words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "")
        }
        str = words.reverse().join("")
    } else str = "";
    return str

}


function generatePDF() {
    debugger;
    var temp = document.body.innerHTML;
    document.body.innerHTML = document.getElementById('html').innerHTML;
    window.print();
    document.body.innerHTML = temp;
    //setTimeout(function() { document.body.innerHTML = ''; }, 3000);
    // 
}


function getHSNWiseTaxDetails() {
    var html = "";
    var hsnDone = [];
    var totalTaxableAmount = 0.0;
    var totalTaxAmount = 0.0;
    for (var i = 0; i < products.length; i++) {
        if (!checkHsnDone(hsnDone, products[i].hsn, products[i].gst)) {
            hsnDone.push({
                "gst": products[i].gst,
                "hsn": products[i].hsn
            });
            var taxableAmount = getHSNTaxableAmount(products[i].hsn, products[i].gst);
            totalTaxableAmount = totalTaxableAmount + taxableAmount;
            var taxAmount = 0;
            if (details.tax_type == "GST") {
                taxAmount = (0.005 * taxableAmount * products[i].gst);
                totalTaxAmount = totalTaxAmount + taxAmount;
                html = html + "<tr><td>" + products[i].hsn + "</td><td>&#x20B9; " + parseFloat(taxableAmount).toFixed(2) + "</td><td>" + parseFloat(products[i].gst / 2).toFixed(1) + "%</td><td>&#x20B9; " + parseFloat(taxAmount).toFixed(2) + "</td><td>" + parseFloat(products[i].gst / 2).toFixed(1) + "%</td><td>&#x20B9; " + parseFloat(taxAmount).toFixed(2) + "</td><td>&#x20B9; " + parseFloat(taxAmount + taxAmount).toFixed(2) + "</td></tr>";

                
            } else {
                taxAmount = (0.01 * taxableAmount * products[i].gst);
                totalTaxAmount = totalTaxAmount + taxAmount;
                html = html + "<tr><td>" + products[i].hsn + "</td><td>&#x20B9; " + parseFloat(taxableAmount).toFixed(2) + "</td><td>" + parseFloat(products[i].gst).toFixed(1) + "%</td><td>&#x20B9; " + parseFloat(taxAmount).toFixed(2) + "</td><td>&#x20B9; " + parseFloat(taxAmount).toFixed(2) + "</td></tr>";

               
            }
        }
    }

    if(details.tax_type == "GST"){
        html = html + "<tr class='bold'><td>Total</td><td>&#x20B9; " + parseFloat(totalTaxableAmount).toFixed(2) + "</td><td></td><td>&#x20B9; " + parseFloat(totalTaxAmount).toFixed(2) + "</td><td></td><td>&#x20B9; " + parseFloat(totalTaxAmount).toFixed(2) + "</td><td>&#x20B9; " + parseFloat(totalTaxAmount + totalTaxAmount).toFixed(2) + "</td></tr>";
    }else{
        html = html + "<tr class='bold'><td>Total</td><td>&#x20B9; " + parseFloat(totalTaxableAmount).toFixed(2) + "</td><td></td><td>&#x20B9; " + parseFloat(totalTaxAmount).toFixed(2) + "</td><td>&#x20B9; " + parseFloat(totalTaxAmount).toFixed(2) + "</td></tr>";
    }

    return html;
}

function checkHsnDone(hsnArray, hsn, gst) {
    for (var i = 0; i < hsnArray.length; i++) {
        if (hsnArray[i].hsn == hsn && hsnArray[i].gst == gst) {
            return true;
        }
    }
    return false;
}

function getHSNTaxableAmount(hsn, gst) {
    var taxableAmount = 0.0;
    for (var i = 0; i < products.length; i++) {
        if (products[i].hsn == hsn && products[i].gst == gst) {
            taxableAmount = taxableAmount + (products[i].quantity * products[i].price);
        }
    }
    return taxableAmount;
}