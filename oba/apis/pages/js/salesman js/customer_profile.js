var currentCustomer = [];
function loadSingleCustomer(){
    const urlparams = new URLSearchParams(window.location.search);
    //var obj = {id : urlparams.get('id')};
    $.ajax({
        url: "../../apis/select/common/get_single_customer.php",
        type: "POST",
        data: {id : urlparams.get('id')},
        dataType: "json",
        success: function (data) {
           // console.log(data);
           currentCustomer = data;
           localStorage.setItem('customer_details', JSON.stringify(data));
            displaySingleCustomer(data);
        }
    })
}

function displaySingleCustomer(data){
    var html = '';
    var count = + 1;
    $.each(data, function (key, value) {
      html = html +"<div class='info-box'>"+
      "<div class='info-box-content'>"+
      "<table class='table'>"+
     "<tbody class='customer-table'>"+
      "<tr><td><strong>Name</strong></td><td>"+ value.cname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ value.cmobile +"</td></tr>"+
     "<tr><td><strong>City</strong></td><td>"+ value.ccity +"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "<div class='info-box-content align-items-end'>" +
      "<span class='info-box-text'><i class='fas fa-eye' data-id='"+ value.cid +"' onclick='viewPopUp()'></i></span>" +
      "</div>"+
      "</div>"+
     "</div>";
    });
    $("#singleCustomerDetails").html(html);
}
loadSingleCustomer();

currentCustomer = localStorage.getItem('customer_details');
currentCustomer = JSON.parse(currentCustomer);
console.log(currentCustomer);
function viewPopUp(){
    $("#modal-view-details").modal('show');
    for (i = 0; i < currentCustomer.length; i++) {
    var html = '';
    html = html +"<div class='info-box'>"+
      "<div class='info-box-content'>"+
      "<table class='table'>"+
     "<tbody class='customer-table'>"+
      "<tr><td><strong>Name</strong></td><td>"+ currentCustomer[i].cname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ currentCustomer[i].cmobile +"</td></tr>"+
     "<tr><td><strong>City</strong></td><td>"+ currentCustomer[i].ccity +"</td></tr>"+
     "<tr><td><strong>Address</strong></td><td>"+ currentCustomer[i].caddress +"</td></tr>"+
     "<tr><td><strong>Firm</strong></td><td>"+ currentCustomer[i].cfirm +"</td></tr>"+
     "<tr><td><strong>GSTIN</strong></td><td>"+ currentCustomer[i].cGSTIN +"</td></tr>"+
     "<tr><td><strong>Type</strong></td><td>"+ currentCustomer[i].ctype +"</td></tr>"+
     "<tr><td><strong>Distributor ID</strong></td><td>"+ currentCustomer[i].cdistributor_id +"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "</div>"+
     "</div>";
    }
     $("#pop-body").html(html);
}