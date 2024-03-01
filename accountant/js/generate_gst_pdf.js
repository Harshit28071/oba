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
        success: function(data) {
            if (data && data.length > 0) {
                details = data[0];
                getInvoiceProducts(invoiceId);
            }
        }
    });

}

function getInvoiceProducts(invoiceId) {
    $.ajax({
        type: 'POST',
        url: '/new/oba/accountant/apis/select/get_invoice_products.php',
        data: {
            id: invoiceId
        },
        dataType: "json",
        success: function(data) {
            products = data;
        
            createPdf(invoiceId);
        }
    });
}

function createPdf(invoiceId) {
    var newDate = new Date();
    //var datetime = "LastSync: " + newDate.today() + " @ " + newDate.timeNow();
    var add = details.address + ", " + details.city + ", " + details.state;
    var html = "<table><tr><td>Phone no.: " + 8800795218 + "</td><td>Invoice No. <br><b>" + invoiceId + "</b></td><td>Date <br><b>" + details.date + "</b></td></tr>";
    var tqty = 0;
    var tdis = 0;
    var total = 0;
    html = html + "<tr><td>Bill To</br><b>" + details.name + "</b></br>" + add + "</br>" + details.mobile + "</td></tr></table>";

    html = html + "<table><tr style='font-weight:bold;text-align:center'><td class='left-text'>#</td><td class='left-text'>Item Name</td><td class='right-text'>Quantity</td><td class='right-text'>Unit</td><td class='right-text'>Rate</td><td class='dis right-text'>Discount</td><td class='right-text'>Amount</td></tr>";
    for (var i = 0; i < products.length; i++) {
        tqty = tqty + products[i].quantity;
        tdis = tdis + products[i].discount;
        var productSum = (products[i].quantity * products[i].price) - products[i].discount;
        total = total + productSum;
        html = html + "<tr style='text-align:center'><td class='left-text'>" + (i + 1) + "</td><td class='left-text'>" + products[i].name + "</td><td class='right-text'>" + parseFloat(products[i].quantity).toFixed(2) + "</td><td class='right-text'>" + products[i].unit + "</td><td class='right-text'>&#x20B9; " + parseFloat(products[i].price).toFixed(2) + "</td><td class='dis right-text'>&#x20B9; " + parseFloat(products[i].discount).toFixed(2) + "</td><td class='right-text'>&#x20B9; " + parseFloat(productSum).toFixed(2) + "</td></tr>";
    }

    html = html + "<tr style='text-align:center'><td></td><td><b>Total</b></td><td class='right-text'><b>" + parseFloat(tqty).toFixed(2) + "</b></td><td></td><td></td><td class='dis right-text'><b>&#x20B9; " + parseFloat(tdis).toFixed(2) + "</b></td><td class='right-text'><b>&#x20B9; " + parseFloat(total).toFixed(2) + "</b></td></tr>";
    html = html + "</table>";

    html = html + '<table><tr><td style="width:50%" rowspan="2">Invoice Amount In Words <br> <b>' + price_in_words(Math.round(total)) + ' only</b></td><td><b>Amounts:</b><br>Sub Total <span class="right">&#x20B9; ' + parseFloat(total).toFixed(2) + '</span><br>Round Off <span class="right">&#x20B9; ' + parseFloat(Math.round(total) - total).toFixed(2) + ' </span></td></tr><tr><td><b>Total</b><span class="right"><b>&#x20B9; ' + parseFloat(Math.round(total)).toFixed(2) + '</b></span></td></tr><tr><td colspan="2"><b>Terms and conditions:</b><br>बिल पर जमा पैसा ही मनिया होगा। बिल पर जमा किया बिना कोई पैसे ना दे। </td></tr></table>'


    var table = "<table style='width:16%; font-size:10px;border-collapse: separate;border:0px;'><tr><td>Customer Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr><tr><td>Payment Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr><tr><td>Backup Copy</td><td>&nbsp;&nbsp;&nbsp;</td></tr></table>";

    html = "<div style='display:inline-flex; width: 100%;'><h2 style='width:84%;padding-left:80px;'>Rough Estimate</h2>" + table + "</div>" + html;

    $("#html").html(html+'<p style="font-size:10px;">'+newDate.toLocaleDateString() +" - "+ newDate.toLocaleTimeString()+'</p>');
    if (tdis <= 0) {

        $('.dis').css('display', 'none');
    }
   // generatePDF(html);
}


function price_in_words(price) {
    var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
        dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
        tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
        handle_tens = function(dgt, prevDgt) {
            return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
        },
        handle_utlc = function(dgt, nxtDgt, denom) {
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