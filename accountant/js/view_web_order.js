var selectedProducts = [];
loadCustomerDetails()
loadProducts();


function loadCustomerDetails(){
    var html =
    '<table class="table table-bordered table-sm"><tbody>'+
    '<tr><td><strong>Order Id</strong></td><td>'+ localStorage.getItem('order_id')+'</td></tr>'+
      '<tr><td><strong>Customer</strong></td><td>'+ localStorage.getItem('customerName')+' - '+localStorage.getItem('city')+'</td></tr>'+
      '<tr><td><strong>Date</strong></td><td>'+ localStorage.getItem('date')+'</td></tr>'+
    '</tbody></table>';
    $("#customerDetails").html(html);
  } 

  function loadProducts(){
    $.ajax({
      url : "/new/oba/accountant/apis/select/get_order_products.php",
      type : "POST",
      data : {
        orderId : localStorage.getItem('order_id')
      },
      dataType : "json",
      success : function(data){
        selectedProducts = data;
        localStorage.setItem('selectedProducts',JSON.stringify(data));        
        showselectedProducts();
      }
  });
  }


//Modal Functions end


function showselectedProducts() {

    var data = localStorage.getItem('selectedProducts');
    var html = '';
    var i = 0;
    if (data) {
        data = JSON.parse(data);
        var total = 0;
        for (i = 0; i < data.length; i++) {
            
            console.log(data[i]);
            html = html + '<tr>' +
                '<td>' + (i + 1) + '.</td>' +
                '<td>' + data[i].name + '</td>' +
                '<td>' + data[i].quantity+ '</td>' +
                '<td>' + data[i].unit + '</td>' +
                '<td>' + data[i].price + '</td>' +
                '<td>' + data[i].discount + '</td>' +
                '<td>' + parseFloat((data[i].price * data[i].quantity) -  data[i].discount).toFixed(2) + '</td>' +
            '</tr>';
            total = parseFloat(parseFloat(total) + parseFloat((data[i].price * data[i].quantity)-data[i].discount)).toFixed(2);
        }

    }
    html = html + '<tr><td></td><td></td><td></td><td></td><td></td><td><strong>Total</strong></td><td id="totalAmount">&#8377;&nbsp;' + total + '</td></tr>';
    $("#orderItems").html(html);
    
}





