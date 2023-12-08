function editSalesmanProfile(){
    //localStorage.clear();
    window.location.href = "./edit_salesman_profile.php" ;
}
function loadSalesmanData(){
    $.ajax({
        url: "../../apis/select/common/get_single_salesman.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
          //  displaySingleCustomer(data);
            displaySalesmanData(data)
        }
    });
}

  //View All Details Of Customer
 function  displaySalesmanData(data){
    var html = '';
    $.each(data, function (key, value) {
    html = html +"<div class='info-box'>"+
      "<div class='info-box-content'>"+
      "<table class='table'>"+
     "<tbody class='customer-table'>"+
      "<tr><td><strong>Name</strong></td><td>"+ value.cname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ value.cmobile +"</td></tr>"+
     "<tr><td><strong>State</strong></td><td>"+ value.cstate +"</td></tr>"+
     "<tr><td><strong>City</strong></td><td>"+ value.ccity +"</td></tr>"+
     "<tr><td><strong>Address</strong></td><td>"+ value.caddress +"</td></tr>"+
     "<tr><td><strong>Firm</strong></td><td>"+ value.cfirm +"</td></tr>"+
     "<tr><td><strong>GSTIN</strong></td><td>"+ value.cGSTIN +"</td></tr>"+
     "<tr><td><strong>Type</strong></td><td>"+ value.ctype +"</td></tr>"+
     "<tr><td><strong>Distributor ID</strong></td><td>"+ value.distributor_name+"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "</div>"+
     "</div>";
    });
    $("#singleCustomerAllDetails").html(html);
  }
  loadSalesmanData();
  