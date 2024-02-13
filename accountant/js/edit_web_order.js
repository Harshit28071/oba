function getSelectedItems(){
    $.ajax({
      url : "/new/oba/common/apis/select/get_selected_products.php",
      type : "POST",
      data : {
        orderId : localStorage.getItem('order_id'),
        customerId : localStorage.getItem('customer_id')
      }, 
      dataType : "json",
      success : function(data){
        if(data.length > 0){
        selectedProducts = data;
        localStorage.setItem('selectedProducts',JSON.stringify(data));        
        showselectedProducts();
        displayTotalAmount();
        }else{
          alert('You can not edit this order.');
          history.back();
        }
      }
  });
  }

  getSelectedItems();
  if (localStorage.getItem('city')) {
debugger;
    $("#city-value option").filter(function() {
      //may want to use $.trim in here
      return $(this).text() == localStorage.getItem('city');
    }).prop('selected', true);

    loadCustomer();

}


function updateOrder(){
    if ($("#show-customer").val() == "") {
        alert('Please select a customer first');
        return;
    }else{ 
        var selectedProducts = localStorage.getItem('selectedProducts');
        if (selectedProducts) {
          selectedProducts = JSON.parse(selectedProducts);
      } else {
          alert('Please select at least one item');
          return;
      }
    if(selectedProducts.length > 0){
      $("#save-order").prop('disabled', true);
      var productData = {
        products : selectedProducts,
        totalAmount: getTotalAmount(),
        orderId: localStorage.getItem('order_id'),
        customerId: $("#show-customer").val()
      }
  
      $.ajax({
        type: 'POST',
        url: '/new/oba/common/apis/update/update_order.php',
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