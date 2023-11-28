var currentOrders = [];
var cities =[];
  function loadPendingOrders(){
  //Get All Pending Orders 
    $.ajax({
        url :"../../apis/select/salesman/get_orders.php",
        type : "POST",
        dataType : "json",
        success : function(data){
            currentOrders = data;
        localStorage.setItem('order_data_set',JSON.stringify(data)); 
        displayOrders(data);
        }
    })
}
function displayOrders(data){
        var html = '';
        var count =+ 1;
    $.each(data,function(key,value){
        var datetimeValue = value.order_date;
        html = html + ("<div class='info-box'>"+
        "<div class='info-box-content'>"+
           " <span class='info-box-number'>"+ count++ +".  " +value.customer_name +" ("+ value.city_name +")</span>"+
            "<span class='info-box-text'>Amount</span>"+
            "<span class='info-box-number'>₹ "+ value.order_amount +"</span>"+
        "</div>"+
        "<div class='info-box-content'>"+
        "<span class='info-box-text'>#  "+ value.order_id  +"</span>"+
       "<span class='info-box-text'>"+ new Date(datetimeValue).toLocaleDateString('en-US') + "</span>"+
       "<span class='info-box-text'><a data-id='"+ value.order_id +"'><i class='fa fa-eye' aria-hidden='true'></i></a>  "+
        "<a data-id='" + value.order_id +"'><i class='fas fa-edit'></i></a>  "+
      "<a data-id='"+ value.order_id +"'><i class='fa fa-trash' aria-hidden='true'></i></a></span>"+
       "</div>"+
       "</div>");
    });
    $("#load-orders").html(html); 
    
}
currentOrders = localStorage.getItem('order_data_set');
if(currentOrders){
    currentOrders = JSON.parse(currentOrders);
    displayOrders(currentOrders);
}else{
    loadPendingOrders();
}
//load City in SelectBox 
function loadCities(){
    //Get All Pending Orders 
      $.ajax({
          url :"../../apis/select/salesman/get_all_city.php",
          type : "POST",
          dataType : "json",
          success : function(data){
            cities = data;
            localStorage.setItem('city_data',JSON.stringify(data)); 
            displayCity(data);
          }
      })
  }
//Display city
function displayCity(data){
           var loadCityData = '';
           $.each(data,function(key,value){
            loadCityData = loadCityData +("<option value='"+ value.id +"' id='close-modal'>"+ value.cname+"</option>"
            );
           });
           $("#mySelectBox").html(loadCityData);
}
 cities = localStorage.getItem('city_data');
if(cities){
    cities =JSON.parse(cities)
    displayCity(cities);
    
}else{
    loadCities();
}
//City Filter
    var flilterOrders = [];
    $("#mySelectBox").change(function(){
    var selectedCity =  $(this).find(":selected").text();
   // $("#modal-city-select-box").modal("hide");
        for(i=0;i<currentOrders.length;i++){
            if(currentOrders[i].city_name == selectedCity){
                flilterOrders.push(currentOrders[i]);
               
            }
            
        }
        displayOrders(flilterOrders);
        
  });
  //
  