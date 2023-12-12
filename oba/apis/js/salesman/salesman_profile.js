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
      "<tr><td><strong>Name</strong></td><td>"+ value.sname +"</td></tr>"+
     "<tr><td><strong>Number</strong></td><td>"+ value.smobile +"</td></tr>"+
     "<tr><td><strong>Email</strong></td><td>"+ value.semail +"</td></tr>"+
     "<tr><td><strong>Language</strong></td><td>"+ value.slang +"</td></tr>"+
     "</tbody>"+
      "</table>"+
      "</div>"+
     "</div>";
    });
    $("#singleCustomerAllDetails").html(html);
  }
  loadSalesmanData();
  