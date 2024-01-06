var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];
var viewFunction = loadBoxView;
var currentProducts = [];
var currentCategory = '';

if(localStorage.getItem('view')){
  var func = localStorage.getItem('view');
  viewFunction = eval('(' + func + ')');
  debugger;
  viewFunction();
}

function switchView(view){
  currentProducts = JSON.parse(localStorage.getItem('products'));
  $("#search").val(''); 
  switch(view){
    case 1:      
      viewFunction = loadTableView;
      
      break;
      case 2:       
        viewFunction = loadCollapseView;
        break;
        case 3:
          viewFunction = loadBoxView;
          break;
          default: viewFunction = loadBoxView;

  }
  localStorage.setItem('view',viewFunction.toString());
  viewFunction();
}

function loadCategories(){
  $.ajax({
    url : "/new/oba/salesman/apis/select/get_all_category.php",
    type : "GET",
    dataType : "json",
    success : function(data){
      categories = data;
      localStorage.setItem('categories',JSON.stringify(data));
      afterCategoryLoad(); 
          
    }
});
}

function afterCategoryLoad(){
  fillCategories();  
      var temp = localStorage.getItem('products') ;
      if(temp){
        products = JSON.parse(temp);
        currentProducts = products;
        viewFunction();
      }else{
        loadProducts();  
      }
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
    url : "/new/oba/accountant/apis/select/get_all_product.php",
    type : "GET",
    dataType : "json",
    success : function(data){
      products = data;
      localStorage.setItem('products',JSON.stringify(data));
      currentProducts = products;
      viewFunction();        
          
    }
});
}

function loadTableView(){
  $("#searchForm").css("display", "block");
    var html = '<div class="card" >'+
  '<div class="card-body p-0" >';
  //debugger;
    html = html + getTableViewHTML(currentProducts) + '</div></div>';
  $("#tab-view").html(html);
} 

 function getTableViewHTML(data){
  var html = "<div class='container'>";
  var cardbody = '';
for(var i=0;i<data.length;i++){

  cardbody = cardbody + " <div class='info-box'>"+
     
  " <div class='info-box-content'>"+
  " <span class='info-box-number'>" +(i+1) + '. '  +  data[i].name+ "</span>"+
   "<span class='info-box-text'>MRP :₹ "+ data[i].mrp +"</span>"+    
   "</div>"+
   " <div class='info-box-content'>"+
   "<span class='info-box-number'>Price Range</span>"+
   "<span class='info-box-text text-wrap'>"+"₹ "+data[i].low_price+' - '+ "₹ " +data[i].max_price+' per '+data[i].unit +"</span>"+
   "<span class='info-box-text'><a onclick='viewproduct("+ data[i].id +")'><i class='far fa-eye'></i></a> "+ '\xa0\xa0'+
   "<a onclick='editproduct("+ data[i].id +")'> <i class='far fa-edit'></i></a>   "+ '\xa0\xa0' +
   "<a  onclick='removeproduct()'> <i class='fa fa-trash'  aria-hidden='true'></i></a></span>"+
        
  " </div>"+
  " <span class='info-box-icon bg-info'><img src='/new/oba/uploads/" + data[i].default_image_url + "'></span> "+
 "</div>";

}
html = html + cardbody +"</div>";
return html;
 }

 $("#searchForm").submit(function(event){

  event.preventDefault();

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
  if(viewFunction == loadBoxView){
    currentProducts = JSON.parse(localStorage.getItem('products'));
    currentProducts = getProducts(currentCategory);
  }else{
    currentProducts= products;
  }
  
}
if(viewFunction == loadBoxView){
  loadTableView();
}else{
viewFunction();
}
});

function loadCollapseView(){
  $("#searchForm").css("display", "block");
  var html = '';
//debugger;
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
 // debugger;
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
  $("#searchForm").css("display", "none");
  $("#back").css("display", "none");
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
  /*$(document).on("click", "#backbutton", function(){
    loadBoxView();
  });*/
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


 var cat = localStorage.getItem('categories');
 if(cat){
   categories = JSON.parse(cat);   
   afterCategoryLoad();
 }else{
   loadCategories();
 }

 //Fetch Single Record For Remove Product
function removeproduct(){
  $('#modal-product-remove').modal('show');
  var p_id = $(this).data("productviewid");
  var obj = { p_id: p_id };
  var myJson = JSON.stringify(obj);
  $.ajax({
    url: "/new/oba/admin/apis/select/fetch_single_product.php",
    type: "POST",
    data: myJson,
    dataType: "json",
    success: function (data) {
      //console.log(data);
      $("#removeid").val(data[0].id);
      $("#hidden-p-img-remove").val(data[0].default_image_url);

    }
  });

};
//Delete Product 
$('#remove-product-form').on('submit', function (e) {
  $("#loader-remove-product").show();
  toastr.options = {
    "positionClass": "toast-top-right",
    "preventDuplicates": true
  };
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: '/new/oba/admin/apis/delete/delete_product.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      $("#loader-remove-product").hide();
      $('#remove-product-form')[0].reset();
      $('#modal-product-remove').modal('hide');
      if (response > 0) {

        toastr.success('Product Deleted Succesfully');


      } else {
        toastr.danger('Product Deleted Failed');
      }
      toastr.delay(1000)
      toastr.fadeOut(1000);
    },
    error: function (error) {
      $('#modal-product-remove').modal('hide');
      toastr.error('Can not delete this item');
      //toastr .delay(1000)
      toastr.fadeOut(1000);
      location.reload();

    }
  })
  //Delete Product

});
 function viewproduct(id){
  
  window.location.href = '/new/oba/accountant/pages/mobile/view_product_details.php?id='+ id +'';

 }
 function editproduct(id){
  
  window.location.href = '/new/oba/accountant/pages/mobile/edit_product.php?id='+ id +'';

 }         
         
         
         
        