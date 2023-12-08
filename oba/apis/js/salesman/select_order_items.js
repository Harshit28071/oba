var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];
var viewFunction = loadBoxView;
var currentProducts = [];
var selectItemAmount = [];
var currentCategory = '';

function loadCart(){
  var data = localStorage.getItem('OrderData');
  var selectedProducts = [];
  if(data){
    data = JSON.parse(data);
    for(var i=0;i<data.length;i++){
      if(data[i].quantity > 0){
        selectedProducts.push(data[i]);
      }
    }
    localStorage.setItem("selectedProducts",JSON.stringify(selectedProducts));
  }
  window.location.href='./review_order.php';
}
//done
function loadSelectedItems(){
  var data = localStorage.getItem('OrderData');
  if(data){
    data = JSON.parse(data);
    for(var i=0;i<data.length;i++){
      if(data[i].quantity > 0){
        selectItemAmount.push({
          id:data[i].id,
          amount:data[i].quantity*data[i].itemPrice
        });
      }
    }
    displayTotalAmount();
  }
    
}

//done
function loadCategories(){
  $.ajax({
    url : "../../apis/select/salesman/get_all_category.php",
    type : "GET",
    dataType : "json",
    success : function(data){
      categories = data;
      localStorage.setItem('categories',JSON.stringify(data));
      afterCategoryLoad(); 
    }
});
}

//done
function afterCategoryLoad(){
  fillCategories();  
      var temp = localStorage.getItem('OrderData') ;
      if(temp){
        products = JSON.parse(temp);
        currentProducts = products;
        viewFunction();
        loadSelectedItems();
      }else{
        loadProducts();  
      }
}

//done
function fillCategories(){

  for(var i=0;i<categories.length;i++){
    if(categories[i].parent == '-'){
      parentCategories.push(categories[i]);
    }else{
      childCategories.push(categories[i]);
    }
  }
}

//done
function loadProducts(){
  $.ajax({
    url : "../../apis/select/salesman/get_products_for_new_order.php",
    type : "POST",
    data : {
      customerId : localStorage.getItem('customer_id')
    },
    dataType : "json",
    success : function(data){
      products = data;
      currentProducts = products;
      viewFunction();
      localStorage.setItem('OrderData',JSON.stringify(data));        
      loadSelectedItems();
    }
});
}
//done
function loadProductView(){
   // isme product ka view banana hai using currentProducts
    var html = '';
      html = html + getCardViewHTML(currentProducts);
    $("#tab-view").html(html);
   
} 

function priceChange(id){
  var t = parseFloat($("#"+id+"_price").val());
  updateJSON(id,"price");
  $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseInt($("#"+id+"_qty").val())*t);
  updateTotalAmount(id,parseInt($("#"+id+"_qty").val())*t);
}

function qtyChange(id){
  var t = parseInt($("#"+id+"_qty").val());
  updateJSON(id,"qty");
  $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseFloat($("#"+id+"_price").val())*t);
  updateTotalAmount(id,parseFloat($("#"+id+"_price").val())*t);
}
//done
function getItemTable(data){
  var d= JSON.stringify(data);
  d=d.replace(/\"/g, '\'');
  return '<table class="table">'+
  '<tbody class="price-table">'+
    '<tr><td>Price</td>'+
    '<td>'+
    '<div class="input-group">'+
      '<div class="input-group-prepend">'+
        '<button class="btn btn-danger icon-button" onclick="increasePrice('+data.id+')">+</button>'+
      '</div>'+
      '<input type="number" class="form-control price-font" aria-label="Price" id="'+data.id+'_price" step=".01" min="0" value="'+data.itemPrice+'"  onchange onpropertychange onkeyuponpaste oninput="priceChange('+data.id+')">'+
      '<div class="input-group-append">'+
          '<button class="btn btn-danger icon-button" onclick="decreasePrice('+data.id+')">-</button>'+
      '</div>'+
    '</div>'+
    '</td>'+
    '</tr>'+
    '<tr><td>Qty</td>'+
    '<td>'+
    '<div class="input-group">'+
      '<div class="input-group-prepend">'+
        '<button class="btn btn-danger icon-button" onclick="increaseQty('+data.id+','+data.qty_step+')" >+</button>'+
      '</div>'+
      '<input type="number" class="form-control price-font"  aria-label="Quantity" id="'+data.id+'_qty" min="0" value="'+data.quantity+'"  onchange onpropertychange onkeyuponpaste oninput="qtyChange('+data.id+')">'+
      '<div class="input-group-append">'+
          '<button class="btn btn-danger icon-button" onclick="decreaseQty('+data.id+','+data.qty_step+','+d+')">-</button>'+
      '</div>'+
    '</div>'+
    '</td>'+
    '</tr>'+
    '<tr class="font-20"><td >Total:  </td><td><strong id="'+data.id+'_total">₹&nbsp;&nbsp;&nbsp;'+ data.quantity * data.itemPrice+'</strong></td></tr>'+
  '</tbody></table><button type="button" class="btn btn-danger btn-block" onclick="deleteItem('+d+')">Delete</button>'+
  '<span class="info-box-text text-center top-4"><a class="badge badge-light font-14" data-toggle="collapse" href="#pricedetails'+data.id+'" aria-expanded="false" aria-controls="pricedetails'+data.id+'">'+
    'Click to view price details'+
  '</a>'+
  '<div class="collapse" id="pricedetails'+data.id+'">'+
  '<div class="card card-body">'+
  '<table class="table"><tbody class="price-table">'+
  '<tr><td>Max Price: </td><td>'+ data.maxPrice+'</td></tr>'+
  '<tr><td>Min Price: </td><td>'+ data.minPrice+'</td></tr>'+
  '<tr><td>Customer Last Price: </td><td>'+ data.customerPrice+'</td></tr></table>'+
  '</div>'+
'</div>'+
  '</span>'
}

//done
function getItemBaselayout(data){
  var d= JSON.stringify(data);
  d=d.replace(/\"/g, '\'');
  var temp = '<div class="ribbon-wrapper">'+
  '<div class="ribbon bg-info">'+
    'Ordered'+
  '</div>'+
  '</div>';
  if(data.orderBefore == 0){
    temp = '';
  }
  return '<span class="info-box-text font-20">Rate: <strong>₹&nbsp;&nbsp;&nbsp;'+data.itemPrice+' per '+data.punit+'</strong></span>'+
  '<button type="button" class="btn btn-danger btn-block" onclick="addItem('+d+')">ADD</button>'+
  temp+
  '<span class="info-box-text text-center top-4"><a class="badge badge-light font-14" data-toggle="collapse" href="#pricedetails'+data.id+'" aria-expanded="false" aria-controls="pricedetails'+data.id+'">'+
  'Click to view price details'+
'</a>'+
'<div class="collapse" id="pricedetails'+data.id+'">'+
'<div class="card card-body">'+
'<table class="table"><tbody class="price-table">'+
'<tr><td>Max Price: </td><td>'+ data.maxPrice+'</td></tr>'+
'<tr><td>Min Price: </td><td>'+ data.minPrice+'</td></tr>'+
'<tr><td>Customer Last Price: </td><td>'+ data.customerPrice+'</td></tr></table>'+
'</div>'+
'</div>'+
'</span>';
}

//done
function displayTotalAmount(){
  var total = 0;
  for(var i=0;i<selectItemAmount.length;i++){
      total = total + parseFloat(selectItemAmount[i].amount);
  }
  if(total > 0){
    $("#totalAmount").html('<strong>Total: ₹&nbsp;&nbsp;&nbsp;'+total+'</strong>');
  }else{
    $("#totalAmount").html('');
  }
  
}

function updateTotalAmount(id,price){
 // debugger;
  for(var i=0;i<selectItemAmount.length;i++){
    if(selectItemAmount[i].id == id){
      selectItemAmount[i].amount = price;
      break;
    }
}
displayTotalAmount();
}

function deleteTotalAmount(id){
  selectItemAmount = selectItemAmount.filter(obj => obj.id != id);
  displayTotalAmount();
}
//done
function addItem(d){

$("#"+d.id+"_content").html(getItemTable(d));
setQty(d.id,d.qty_step);
$("#"+d.id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+d.qty_step*d.itemPrice);
selectItemAmount.push({
  id:d.id,
  amount:d.qty_step*d.itemPrice
});
displayTotalAmount();
}
//done
function deleteItem(d){
  setQty(d.id,0);
  $("#"+d.id+"_content").html(getItemBaselayout(d)); 
  $("#"+d.id+"_total").html('₹&nbsp;&nbsp;&nbsp;0');
  deleteTotalAmount(d.id);
  }

function increasePrice(id){
  var t = parseFloat($("#"+id+"_price").val())+1;
  $("#"+id+"_price").val(t);
  updateJSON(id,"price");
  $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseInt($("#"+id+"_qty").val())*t);
  updateTotalAmount(id,parseInt($("#"+id+"_qty").val())*t);
}

function decreasePrice(id){
  if($("#"+id+"_price").val() >0 ){
    var t = parseFloat($("#"+id+"_price").val())-1;
    $("#"+id+"_price").val(t);
    updateJSON(id,"price");
    $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseInt($("#"+id+"_qty").val())*t);
    updateTotalAmount(id,parseInt($("#"+id+"_qty").val())*t)
  }
  
}

function increaseQty(id,step){
  var t = parseInt($("#"+id+"_qty").val())+parseInt(step);
  $("#"+id+"_qty").val(t);
  updateJSON(id,"qty");
  $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseFloat($("#"+id+"_price").val())*t);
  updateTotalAmount(id,parseFloat($("#"+id+"_price").val())*t);
}
function decreaseQty(id,step,d){
  if($("#"+id+"_qty").val() >step ){  
    var t = parseInt($("#"+id+"_qty").val())-parseInt(step);  
  $("#"+id+"_qty").val(t);
    updateJSON(id,"qty");
    $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseFloat($("#"+id+"_price").val())*t);
    updateTotalAmount(id,parseFloat($("#"+id+"_price").val())*t);
  }else{
    deleteItem(d);
    //deleteTotalAmount(id);
  }
}

function updateJSON(id,type){

  var data = JSON.parse(localStorage.getItem('OrderData'));
  for(var i=0;i<data.length;i++){
    if(data[i].id == id){
      if(type == "price"){
        data[i].itemPrice = parseFloat($("#"+id+"_price").val());
      }
      if(type == "qty"){
        data[i].quantity = parseInt($("#"+id+"_qty").val());
      }
      
      break;
    }
  }
  localStorage.setItem('OrderData',JSON.stringify(data));
}


//done
function getCardViewHTML(data){

  var html = '';
for(var i=0;i<data.length;i++){

  var temp = '';
  if(data[i].quantity == 0){
temp = getItemBaselayout(data[i]);
  }else{
temp = getItemTable(data[i]);
  }
  html = html + '<div class="info-box"><span class="info-box-icon bg-info custom-product-name"><h6 class="item-name">'+data[i].name+' (in '+data[i].punit+')</h6></span>'+
'<div class="info-box-content" id="'+data[i].id+'_content">'+temp+ '</div></div>';
}

return html;
 }




function setQty(id,value){
     
  $("#"+id+"_qty").val(value);
    updateJSON(id,"qty");
  
}

function getUnitDropDown(punit,sunit){

var html = '<select class="custom-select rounded-0" id="exampleSelectRounded0">';
if(punit!=''){
  html = html + '<option value="'+punit+'">'+punit+'</option>';
}
if(sunit !='' && sunit != punit){
  html = html + '<option value="'+sunit+'">'+sunit+'</option>';
}
html = html + '</select>';

return html;
}


$("#searchButton").click(function(e){

  e.preventDefault();
   //debugger;
  var input = $("#search").val();
if(input != ''){
  var data = products.filter(function(obj) {
    if(viewFunction == loadBoxView){
      return (obj.name.toLowerCase().includes(input.toLowerCase()) && currentCategory == obj.category);
    }else{
      return (obj.name.toLowerCase().includes(input.toLowerCase()));
    }
   
});
currentProducts= data;
}else{
  currentProducts= products;
}
if(viewFunction == loadBoxView){
loadProductView();
}else{
  viewFunction();
}
});

function loadCollapseView(){
  viewFunction = loadCollapseView;
  $("#searchForm").css("display", "block");
  var html = '';
debugger;
  for(var i=0;i<parentCategories.length;i++){
      var childs = getChilds(parentCategories[i].name);
      if(childs.length > 0){
        var parentStart = '<div class="card card-primary collapsed-card">'+
    '<div class="card-header">'+
    '<h3 class="card-title">'+ parentCategories[i].name +'</h3>'+
    '<div class="card-tools">'+
    '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>'+
    '</button>'+
    '</div>'+
    '</div>'+          
    '<div class="card-body custom-card-padding" style="display: none;">';
     var parentEnd = '</div></div>';
     var parentExist = false;
        for(var j= 0 ;j<childs.length;j++){
          var temp = getCategoryProductsHTML(childs[j].name);
          temp = temp.replace(/card-primary/g, 'card-warning');
          if(temp == ''){

          }else{
              if(!parentExist){
                parentExist = true;
                html = html + parentStart +temp;
              }else{
                html = html +temp;
              }
            
          }
        }
        if(parentExist){
          html = html + parentEnd;
        }
      
      }else{
       html = html + getCategoryProductsHTML(parentCategories[i].name);
      }
  }
 // debugger;
  $("#tab-view").html(html);
 }

 //done
 function getCategoryProductsHTML(category){ // is function mein product view return karna hai
  var productsData = getProducts(category); 
  var html = '';
  if(productsData.length > 0){
    html = html +'<div class="card card-primary collapsed-card">'+
    '<div class="card-header">'+
    '<h3 class="card-title">'+ category +'</h3>'+
    '<div class="card-tools">'+
    '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>'+
    '</button>'+
    '</div>'+
    '</div>'+          
    '<div class="card-body custom-card-padding" style="display: none;">';
    
    html =html + getCardViewHTML(productsData);

    html = html +'</div></div>';
  }
  return html;
 }

 function getProducts(category){
  var data = currentProducts.filter(function(obj) {
    return obj.category == category;
});
return data;
 }

 function getChilds(parent){
  var data = childCategories.filter(function(obj) {
    return obj.parent == parent;
});
return data;
 }

 function loadBoxView(){
  viewFunction = loadBoxView;
  $("#back").css("display", "none");
  $("#searchForm").css("display", "none");
  var html = '<div class="row">';
  for(var i=0;i<parentCategories.length;i++){
      html = html + '<div class="col-lg-3 col-6">'+
      '<div class="small-box bg-info" onclick="loadChildCategories(\''+parentCategories[i].name +'\')">'+
      '<div class="inner">'+
      '<h3 class="text-wrap">'+parentCategories[i].name+'</h3>'+
      '</div>'+
      '<div class="icon">'+
      '<i class="ion ion-bag"></i>'+
      '</div>'+
      '</div>'+
      '</div>';
  }
html = html + "</div>";
  $("#tab-view").html(html);
 }

 function loadChildCategories(parent){
  var childs = getChilds(parent);
  var html = '';
  $("#back").css("display", "block");
  $(document).on("click", "#backbutton", function(){
    loadBoxView();
  });
  if(childs.length > 0){
    $("#searchForm").css("display", "none");
  html = '<div class="row">';
  for(var i=0;i<childs.length;i++){
      html = html + '<div class="col-lg-3 col-6">'+
      '<div class="small-box bg-info" onclick="loadCategoryProducts(\''+childs[i].name +'\',\''+parent +'\')">'+
      '<div class="inner">'+
      '<h3 class="text-wrap">'+childs[i].name+'</h3>'+
      '</div>'+
      '<div class="icon">'+
      '<i class="ion ion-bag"></i>'+
      '</div>'+
      
      '</div>'+
      '</div>';
  }
html = html + "</div>";
$("#tab-view").html(html);
}else{
  currentCategory = parent;
  $("#searchForm").css("display", "block");
  currentProducts = products;
  currentProducts = getProducts(parent);
  loadProductView();
}


 }
    
 function loadCategoryProducts(child,parent){
  $("#back").css("display", "block");
  $(document).on("click", "#backbutton", function(){
    loadChildCategories(parent);
  });
  currentCategory = child;
  currentProducts = products;
  currentProducts = getProducts(child);
  loadProductView();
 }

var cat = localStorage.getItem('categories');
if(cat){
  categories = JSON.parse(cat);   
  afterCategoryLoad();
}else{
  loadCategories();
}


         
         
         
         
        