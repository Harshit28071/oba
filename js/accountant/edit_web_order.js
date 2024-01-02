function getSelectedItems(){
    $.ajax({
      url : "/new/oba/apis/select/salesman/get_selected_products.php",
      type : "POST",
      data : {
        orderId : localStorage.getItem('order_id'),
        customerId : localStorage.getItem('customer_id')
      },
      dataType : "json",
      success : function(data){
        selectedProducts = data;
        localStorage.setItem('selectedProducts',JSON.stringify(data));        
        showselectedProducts();
        displayTotalAmount();
      }
  });
  }

  getSelectedItems();
  if (localStorage.getItem('city_id')) {
    $('#city-value').val(localStorage.getItem('city_id'));
    loadCustomer();

}


function updateOrder(){
    if ($("#show-customer").val() == "") {
        alert('Please select a customer first');
        return;
    }else{ 
        var selectedProducts = localStorage.getItem('selectedProducts');
    if(selectedProducts.length > 0){
  
      var productData = {
        products : selectedProducts,
        totalAmount: getTotalAmount(),
        orderId: localStorage.getItem('order_id'),
        customerId: $("#show-customer").val()
      }
  
      $.ajax({
        type: 'POST',
        url: '/new/oba/apis/update/salesman/update_order.php',
        data: JSON.stringify(productData),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(response){
          if(response > 0){
            $("#modal-success-alert").modal('show');
                        $("#main-heading").html("Order Updated Successfully");
                        $("#alert-message").html("order has been udpated successfully");
                        localStorage.clear();
                        dashboardRedirection();
          }
        },
        error: function(error) {
        alert('Order updation Failed');
        }
        })  
    }else{
      alert('Please add some items');
    }
}
  }