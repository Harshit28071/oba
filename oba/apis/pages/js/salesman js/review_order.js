var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];
var selectedProducts = [];

loadCustomerDetails();

function saveOrder(){
  if(selectedProducts.length > 0){

    var productData = {
      products : selectedProducts,
      customerId : localStorage.getItem('customer_id'),
      totalAmount: getTotalAmount()
    }

    $.ajax({
      type: 'POST',
      url: '../../apis/add/salesman/add_order.php',
      data: JSON.stringify(productData),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      success: function(response){
        if(response > 0){
          //alert('order has been created successfully');
          $("#modal-success-alert").modal('show');
          $("#main-heading").html("Order Created");
          $("#alert-message").html("order has been created successfully");
          localStorage.clear();
          deshboardRedirection();
          
        }
      },
      error: function(error){
      $("#modal-warning-alert").modal('show');
      $("#main-heading-warning").html("Order Failed");
      $("#alert-message-warning").html("Order creation Failed");
      }
      });
  }else{
   // alert('Please add some items');
   $("#modal-info-alert").modal('show');
      $("#main-heading-info").html("Add Items");
      $("#alert-message-info").html("Please add some items");
      }
  }

// Deshboard Redirection On Click Function
$("#done-btn").on("click",function deshboardRedirection(){
  window.location.href='./dashboard.php';
});
function getDate(){
  var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '/' + mm + '/' + yyyy;
return today;
}

function loadCustomerDetails(){
  var html ='<div class="info-box">'+
  '<div class="info-box-content">'+
  '<table class="table"><tbody class="customer-table">'+
    '<tr><td><strong>Customer</strong></td><td>'+ localStorage.getItem('customer_name')+'</td></tr>'+
    '<tr><td><strong>Date</strong></td><td>'+ getDate()+'</td></tr>'+
    '<tr><td><strong>Total</strong></td><td id="totalAmount"></td></tr>'+
  '</tbody></table>'+
  '</div></div>';
  $("#customerDetails").html(html);
}

function printMainCategoriesOptions(data){
var html = '<option selected style="text-align: center;">SELECT CATEGORY</option>';
  for(var i=0;i<data.length;i++){
html = html + '<option value="'+data[i].name+'">'+data[i].name+'</option>';
  }
$("#mainCategory").html(html);
}

function addNewItem(){
  var index = $("#items option:selected").val();
  if(index && index != 'SELECT ITEM'){

    var data = JSON.parse(localStorage.getItem('OrderData'));
	  data = data[index];
    data.quantity = data.qty_step;

    if($("#unit") && $("#unit option:selected").val()){
      data.punit = $("#unit option:selected").val();
    }
    selectedProducts.push(data);
	var html = '<div class="info-box"><span class="info-box-icon bg-info custom-product-name"><h6 class="item-name">'+(selectedProducts.length)+'.</h6><h6 class="item-name">'+data.name+' (in '+data.punit+')</h6></span>'+
  '<div class="info-box-content" id="'+data.id+'_content_'+(selectedProducts.length-1)+'">'+getItemTable(data,selectedProducts.length-1)+ '</div></div>';

	$("#tab-view").append(html);
    
  localStorage.setItem("selectedProducts",JSON.stringify(selectedProducts));
	displayTotalAmount();
	setQty(data.id,data.quantity,selectedProducts.length-1);
  $("#additemForm").trigger("reset")
  $('#modal-add-item').modal('hide');
 
  }else{
    //alert('Please select item');
    $("#modal-info-alert").modal('show');
      $("#main-heading-info").html("Add Items");
      $("#alert-message-info").html("Please add some items")

  }
  
}

function printItemOptions(){
  var data = JSON.parse(localStorage.getItem('OrderData'));
  var html = '<option selected style="text-align: center;" >SELECT ITEM</option>';
  var category = $("#mainCategory option:selected").val();
  if(category != '' && category != 'SELECT CATEGORY'){
    if($("#subCategory option:selected").val() && $("#subCategory option:selected").val()!='SELECT SUB CATEGORY'){
      category = $("#subCategory option:selected").val();
    } 
  }
    for(var i=0;i<data.length;i++){
      if(data[i].category == category)
  html = html + '<option value="'+i+'">'+data[i].name+'</option>';
    }
  $("#items").html(html);
  }

  $("#items").change(function(event){
      var index = $("#items option:selected").val();
      var data = JSON.parse(localStorage.getItem('OrderData'));
      data = data[index];
      if(data.punit == data.sunit){
        $("#units").html('');
      }else{
        $("#units").html('<div class="form-group">'+
        '<label for="exampleInputEmail1">Select Units</label>'+
        '<select class="custom-select" id="unit">'+
        '<option value="'+data.punit+'">'+data.punit+'</option>'+
        '<option value="'+data.sunit+'">'+data.sunit+'</option>'+
        '</select>'+
        '</div>');
      }
  });

$("#mainCategory").change(function(event){
  var html = '';
  var data = JSON.parse(localStorage.getItem('categories'));
  for(var i=0;i<data.length;i++){
    if(data[i].parent == $("#mainCategory option:selected").val()){
      html = html + '<option value="'+data[i].name+'">'+data[i].name+'</option>';
    }
  }
  if(html !=''){
$("#sub-category").html(' <div class="form-group">'+
'<label for="exampleInputEmail1">Select Sub Category</label>'+
'<select class="custom-select" id="subCategory" onchange="printItemOptions()"><option selected style="text-align: center;" >SELECT SUB CATEGORY</option>'+
html+
'</select>'+
'</div>');
$("#items").html('');
  }else{
    $("#sub-category").html('');
    printItemOptions();
  }
  
});



function loadCategories(){
    $.ajax({
      url : "../../apis/select/salesman/get_all_category.php",
      type : "GET",
      dataType : "json",
      success : function(data){
        categories = data;
        localStorage.setItem('categories',JSON.stringify(data));
        afterCategoryLoad(); 
        printMainCategoriesOptions(parentCategories);
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
      url : "../../apis/select/salesman/get_products_for_new_order.php",
      type : "POST",
      data : {
        customerId : localStorage.getItem('customer_id')
      },
      dataType : "json",
      success : function(data){
        products = data;
        //showSelectedItems();
        localStorage.setItem('OrderData',JSON.stringify(data));        
        loadSelectedItems();
      }
  });
  }

  function afterCategoryLoad(){
        fillCategories();  
        var temp = localStorage.getItem('OrderData') ;
        if(temp){
          products = JSON.parse(temp);
          loadSelectedItems();
        }else{
          loadProducts();  
        }
  }
function getTotalAmount(){
  var total = 0;
  for(var i=0;i<selectedProducts.length;i++){
      total = total + selectedProducts[i].quantity*selectedProducts[i].itemPrice;
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
  
  function loadSelectedItems(){
    var data = localStorage.getItem('selectedProducts');
    if(data){
      selectedProducts = JSON.parse(data);
      showSelectedItems();
      displayTotalAmount();
    }
      
  }



 function priceChange(id,i){
  var price = parseFloat($("#"+id+"_price_"+i).val());
  updateJSON(id,"price",price,i);
  $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_qty_"+i).val())*price).toFixed(2));
  displayTotalAmount();
}

function qtyChange(id,i){
  var t = parseFloat($("#"+id+"_qty_"+i).val());
  updateJSON(id,"qty",t,i);
  $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_price_"+i).val())*t).toFixed(2));
  displayTotalAmount();
}

 function getItemTable(data,i){
    var d= JSON.stringify(data);
    d=d.replace(/\"/g, '\'');
    return '<table class="table">'+
    '<tbody class="price-table">'+
      '<tr><td>Price</td>'+
      '<td>'+
      '<div class="input-group">'+
        '<div class="input-group-prepend">'+
          '<button class="btn btn-danger icon-button" onclick="increasePrice('+data.id+','+i+')">+</button>'+
        '</div>'+
        '<input type="number" class="form-control price-font" aria-label="Price" id="'+data.id+'_price_'+i+'" step=".01" min="0" value="'+data.itemPrice+'"  onchange onpropertychange onkeyuponpaste oninput="priceChange('+data.id+','+i+')">'+
        '<div class="input-group-append">'+
            '<button class="btn btn-danger icon-button" onclick="decreasePrice('+data.id+','+i+')">-</button>'+
        '</div>'+
      '</div>'+
      '</td>'+
      '</tr>'+
      '<tr><td>Qty</td>'+
      '<td>'+
      '<div class="input-group">'+
        '<div class="input-group-prepend">'+
          '<button class="btn btn-danger icon-button" onclick="increaseQty('+data.id+','+data.qty_step+','+i+')" >+</button>'+
        '</div>'+
        '<input type="number" class="form-control price-font"  aria-label="Quantity" id="'+data.id+'_qty_'+i+'" min="0" value="'+data.quantity+'"  onchange onpropertychange onkeyuponpaste oninput="qtyChange('+data.id+','+i+')">'+
        '<div class="input-group-append">'+
             '<button class="btn btn-danger icon-button" onclick="decreaseQty('+data.id+','+data.qty_step+','+d+','+i+')">-</button>'+
        '</div>'+
      '</div>'+
      '</td>'+
      '</tr>'+
      '<tr class="font-20"><td >Total:  </td><td><strong id="'+data.id+'_total_'+i+'">₹&nbsp;&nbsp;&nbsp;'+ data.quantity * data.itemPrice+'</strong></td></tr>'+
    '</tbody></table><div class="row"><div class="col-6"><button type="button" class="btn btn-default btn-block" onclick="saveItem('+d+','+i+')">Save</button></div>'+
    '<div class="col-6"><button type="button" class="btn btn-danger btn-block" onclick="deleteItem('+d+','+i+')">Delete</button></div></div>'+
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
  
  function getItemBaselayout(data,i){
    var d= JSON.stringify(data);
    d=d.replace(/\"/g, '\'');
    return '<span class="info-box-text font-20">Rate:&nbsp;&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+data.itemPrice+' per '+data.punit+'</strong></span>'+
    '<span class="info-box-text font-20">Qty:&nbsp;&nbsp;&nbsp;&nbsp;<strong>'+data.quantity+' '+data.punit+'</strong></span>'+
    '<span class="info-box-text font-20">Total:&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+parseFloat(data.quantity*data.itemPrice)+'</strong></span>'+
    '<div class="row"><div class="col-6"><button type="button" class="btn btn-default btn-block" onclick="editItem('+d+','+i+')">Edit</button></div>'+
    '<div class="col-6"><button type="button" class="btn btn-danger btn-block" onclick="deleteItem('+d+','+i+')">Delete</button></div></div>';
      
  }

  function showSelectedItems(){

    var html = '';
  for(var i=0;i<selectedProducts.length;i++){
  
  var temp = getItemBaselayout(selectedProducts[i],i);
    
    html = html + '<div class="info-box"><span class="info-box-icon bg-info custom-product-name"><h6 class="item-name">'+(i+1)+'.</h6><h6 class="item-name">'+selectedProducts[i].name+' (in '+selectedProducts[i].punit+')</h6></span>'+
  '<div class="info-box-content" id="'+selectedProducts[i].id+'_content_'+i+'">'+temp+ '</div></div>';
  }
  
  $("#tab-view").html(html);
   }

   function editItem(d,i){
    $("#"+d.id+"_content_"+i).html(getItemTable(d,i));
   }

   function saveItem(d,index){
debugger;
    for(var i=0;i<selectedProducts.length;i++){
        if(d.id == selectedProducts[i].id && index == i){
          $("#"+d.id+"_content_"+index).html(getItemBaselayout(selectedProducts[i],index));
          break;
        }
    }
   
    
    
   }

   
    function deleteItem(d,i){
      setQty(d.id,0,i);

    displayTotalAmount();
    showSelectedItems();
      }

      

      function increasePrice(id,i){
        //debugger;
        var t = parseFloat($("#"+id+"_price_"+i).val())+1;
        $("#"+id+"_price_"+i).val(t);
        updateJSON(id,"price",t,i);
        $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_qty_"+i).val())*t).toFixed(2));
        displayTotalAmount();
      }
      
      function decreasePrice(id,i){
        if($("#"+id+"_price_"+i).val() >0 ){
          var t = parseFloat($("#"+id+"_price_"+i).val())-1;
          $("#"+id+"_price_"+i).val(t);
          updateJSON(id,"price",t,i);
          $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_qty_"+i).val())*t).toFixed(2));
          displayTotalAmount();
        }
        
      }
      
      function increaseQty(id,step,i){
        var t = parseFloat($("#"+id+"_qty_"+i).val())+parseFloat(step);
        $("#"+id+"_qty_"+i).val(t);
        updateJSON(id,"qty",t,i);
        $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_price_"+i).val())*t).toFixed(2));
        displayTotalAmount();
      }
      function decreaseQty(id,step,d,i){
        if($("#"+id+"_qty_"+i).val() >step ){  
          var t = parseFloat($("#"+id+"_qty_"+i).val())-parseFloat(step);  
        $("#"+id+"_qty_"+i).val(t);
          updateJSON(id,"qty",t,i);
          $("#"+id+"_total_"+i).html('₹&nbsp;&nbsp;&nbsp;'+parseFloat(parseFloat($("#"+id+"_price_"+i).val())*t).toFixed(2));
          displayTotalAmount();
        }else{
          deleteItem(d,i);
        }
      }
      
      function updateJSON(id,type,value,index){
      
        var data = JSON.parse(localStorage.getItem('OrderData'));
        for(var i=0;i<data.length;i++){
          if(data[i].id == id){
            if(type == "price"){
              data[i].itemPrice = value;
            }
            if(type == "qty"){
              data[i].quantity = value;
            }
            
            break;
          }
        }
        localStorage.setItem('OrderData',JSON.stringify(data));


        data = JSON.parse(localStorage.getItem('selectedProducts'));
        for(var i=0;i<data.length;i++){
          if(data[i].id == id && i == index){
            if(type == "price"){
              data[i].itemPrice = value;
            }
            if(type == "qty"){
              data[i].quantity = value;
              if(data[i].quantity == 0){
                data.splice(i,1);
              }
            }
            
            break;
          }
        }
        localStorage.setItem('selectedProducts',JSON.stringify(data));
        selectedProducts = data;
        
      }

      function setQty(id,value,i){
              
          $("#"+id+"_qty_"+i).val(value);       
          updateJSON(id,"qty",value,i);
        
      }

var cat = localStorage.getItem('categories');
if(cat){
  categories = JSON.parse(cat);   
  afterCategoryLoad();
  printMainCategoriesOptions(parentCategories);
}else{
  loadCategories();
}



