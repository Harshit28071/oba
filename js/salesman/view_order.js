var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];

loadCustomerDetails();
loadOrderProducts();



function loadCustomerDetails(){
  var html ='<div class="info-box">'+
  '<div class="info-box-content">'+
  '<table class="table"><tbody class="customer-table">'+
  '<tr><td><strong>Order Id</strong></td><td>'+ localStorage.getItem('order_id')+'</td></tr>'+
    '<tr><td><strong>Customer</strong></td><td>'+ localStorage.getItem('customer_name')+'</td></tr>'+
    '<tr><td><strong>Date</strong></td><td>'+ localStorage.getItem('order_date')+'</td></tr>'+
    '<tr><td><strong>Total</strong></td><td id="totalAmount"></td></tr>'+
  '</tbody></table>'+
  '</div></div>';
  $("#customerDetails").html(html);
}




  function loadProducts(){
    $.ajax({
      url : "../../apis/select/salesman/get_order_products.php",
      type : "POST",
      data : {
        orderId : localStorage.getItem('order_id')
      },
      dataType : "json",
      success : function(data){
        products = data;
        localStorage.setItem('OrderDetails',JSON.stringify(data));        
        showSelectedItems();
      }
  });
  }

  function loadOrderProducts(){
        var temp = localStorage.getItem('OrderDetails') ;
        if(temp){
          products = JSON.parse(temp);
          showSelectedItems();
        }else{
          loadProducts();
        }
  }
function getTotalAmount(){
  var total = 0;
  for(var i=0;i<products.length;i++){
      total = total + products[i].quantity*products[i].price;
  }
  return parseFloat(total).toFixed(2);
}

  function displayTotalAmount(){
    var total = getTotalAmount();
    
    if(total > 0){
      $("#totalAmount").html('<strong>₹&nbsp;&nbsp;&nbsp;'+total+'</strong>');
    }else{
      $("#totalAmount").html('');
    }
    
  }
  
 

  function getItemBaselayout(data){
    var d= JSON.stringify(data);
    d=d.replace(/\"/g, '\'');
    return '<span class="info-box-text font-20">Rate:&nbsp;&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+data.price+' per '+data.unit+'</strong></span>'+
    '<span class="info-box-text font-20">Qty:&nbsp;&nbsp;&nbsp;&nbsp;<strong>'+data.quantity+' '+data.unit+'</strong></span>'+
    '<span class="info-box-text font-20">Total:&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+parseFloat(data.quantity*data.price)+'</strong></span>';
      
  }

  function showSelectedItems(){

    var html = '';
  for(var i=0;i<products.length;i++){
  
  var temp = getItemBaselayout(products[i]);
    
    html = html + '<div class="info-box"><span class="info-box-icon bg-info custom-product-name"><h6 class="item-name">'+(i+1)+'.</h6><h6 class="item-name">'+products[i].name+' (in '+products[i].unit+')</h6></span>'+
  '<div class="info-box-content">'+temp+ '</div></div>';
  }
  
  $("#tab-view").html(html);
  displayTotalAmount();
   }






