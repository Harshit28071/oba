var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];
var viewFunction;
var currentProducts = [];

function loadCategories(){
  $.ajax({
    url : "../../apis/select/salesman/get_all_category.php",
    type : "GET",
    dataType : "json",
    success : function(data){
      categories = data;
      fillCategories();    
      loadProducts();  
          
    }
});
}

function fillCategories(){

  for(var i=0;i<categories.length;i++){
    if(categories[i].parent == '-'){
      parentCategories.push(categories[i]);
    }else{
      childCategories.push(categories[i]);
    }
  }
}

function loadProducts(){
  $.ajax({
    url : "../../apis/select/salesman/get_all_product.php",
    type : "GET",
    dataType : "json",
    success : function(data){
      products = data;
      currentProducts = products;
      //loadTableView(data);
      viewFunction = loadBoxView;
      viewFunction();
      console.log(data);        
          
    }
});
}

function loadTableView(){
  var data = currentProducts;
  var html = '<div class="card" >'+
  '<div class="card-body p-0" >';
    html = html + getTableViewHTML(data) + '</div></div>';
  $("#tab-view").html(html);
} 

 function getTableViewHTML(data){
  var html = '<table class="table table-bordered table-striped">'+
  '<thead>'+
  '<tr>'+
  '<th style="width: 10px">#</th>'+
  '<th>Item</th>'+
  '<th>Price Range</th>'+
  '</tr>'+
  '</thead><tbody>';
  var tbody = '';
for(var i=0;i<data.length;i++){

 tbody = tbody + '<tr><td>'+(i+1)+'</td><td>'+data[i].name+'</td><td>'+data[i].low_price+' - ' +data[i].max_price+' per ' + data[i].unit+'</td></tr>';

}
html = html + tbody + '</tbody></table>';
return html;
 }

function filterData(){
  debugger;
  var input = $("#search").val();
if(input != ''){
  var data = products.filter(function(obj) {
    return (obj.name.toLowerCase().includes(input.toLowerCase()));
});
currentProducts= data;
}else{
  currentProducts= products;
}

viewFunction();
 
 }

function loadCollapseView(){
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
    '<div class="card-body" style="display: none;">';
     var parentEnd = '</div></div>';
     var parentExist = false;
        for(var j= 0 ;j<childs.length;j++){
          var temp = getCategoryProductsHTML(childs[j].name);
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
  debugger;
  $("#tab-view").html(html);
 }

 function getCategoryProductsHTML(category){
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
    '<div class="card-body" style="display: none;">';
    
    html =html + getTableViewHTML(productsData);

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
  $("#back").css("display", "none");
  var html = '<div class="row">';
  for(var i=0;i<parentCategories.length;i++){
      html = html + '<div class="col-lg-3 col-6">'+
      '<div class="small-box bg-success">'+
      '<div class="inner">'+
      '<h3 class="text-wrap">'+parentCategories[i].name+'</h3>'+
      '</div>'+
      '<div class="icon">'+
      '<i class="ion ion-bag"></i>'+
      '</div>'+
      '<a onclick="loadChildCategories(\''+parentCategories[i].name +'\')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>'+
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
 
  html = '<div class="row">';
  for(var i=0;i<childs.length;i++){
      html = html + '<div class="col-lg-3 col-6">'+
      '<div class="small-box bg-success">'+
      '<div class="inner">'+
      '<h3 class="text-wrap">'+childs[i].name+'</h3>'+
      '</div>'+
      '<div class="icon">'+
      '<i class="ion ion-bag"></i>'+
      '</div>'+
      '<a onclick="loadCategoryProducts(\''+childs[i].name +'\',\''+parent +'\')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>'+
      '</div>'+
      '</div>';
  }
html = html + "</div>";
$("#tab-view").html(html);
}else{
  currentProducts = products;
  currentProducts = getProducts(parent);
  loadTableView();
}


 }
    
 function loadCategoryProducts(child,parent){
  $("#back").css("display", "block");
  $(document).on("click", "#backbutton", function(){
    loadChildCategories(parent);
  });
  currentProducts = products;
  currentProducts = getProducts(child);
  loadTableView();
 }


loadCategories();
         
         
         
         
        