const limit = 20;
let start = 0;
var orderStatus = 'New';
var loadMoreId  = 'New';
// Initally Function Call
load_data_ajax(limit,start,orderStatus,loadMoreId);
// Load Data
function load_data_ajax(limit,start,orderStatus,loadMoreId){
 
  $.ajax({
    url: "/new/oba/accountant/apis/select/my_orders.php",
    type: 'POST',
    data: {limit: limit, start : start,status : orderStatus },
    dataType: "json",
    success: function(result){
      
     if(result.checkResponse == 1){
          var html ='';
          $.each(result,function(key,value){
            html = html +("<tr>"+
                                 "<td>" + value.order_id +"</td>"+ 
                                 "<td>" + value.order_date +"</td>"+  
                                 "<td>" + value.customer_name  +"</td>"+ 
                                 "<td>" + value.order_amount +"</td>"+ 
                                 "<td>" + value.salesmanname +"</td>"+ 
                                "</tr>");
          });
          debugger;
          $("#load-"+ orderStatus +"-orders").html(html);
          }
          else{
            $("#btn-load-more-"+ loadMoreId +"").hide();
          }
    }

  });
}
//Load orders
function Orders(status){
  var orderStatus = status;
  load_data_ajax(limit,start,orderStatus,loadMoreId);
  }
// Load More Data Btn 
function loadMoreOrders(orderStatus,loadMoreId){
   
start = start + limit;
load_data_ajax(limit,start,orderStatus,loadMoreId);

}
