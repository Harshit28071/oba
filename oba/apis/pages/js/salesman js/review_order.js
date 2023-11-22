var products = [];
var categories = [];
var parentCategories = [];
var childCategories = [];
var selectedProducts = [];

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
        showSelectedItems();
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
          showSelectedItems();
        }else{
          loadProducts();  
        }
  }

  function displayTotalAmount(){
    var total = 0;
    for(var i=0;i<selectedProducts.length;i++){
        total = total + parseFloat(selectedProducts[i].quantity*selectedProducts[i].itemPrice);
    }
    if(total > 0){
      $("#totalAmount").html('<strong>Total: ₹&nbsp;&nbsp;&nbsp;'+total+'</strong>');
    }else{
      $("#totalAmount").html('');
    }
    
  }
  
  function loadSelectedItems(){
    var data = localStorage.getItem('OrderData');
    if(data){
      data = JSON.parse(data);
      for(var i=0;i<data.length;i++){
        if(data[i].quantity > 0){
        selectedProducts.push(data[i]);
        }
      }

      selectedProducts.sort((a, b) => a.name.localeCompare(b.name));
      showSelectedItems();
      displayTotalAmount();
    }
      
  }

  function loadProductView(){
    // isme product ka view banana hai using currentProducts
     var html = '<div class="card" >'+
     '<div class="card-body custom-card-padding p-0" >';
       html = html + getCardViewHTML(currentProducts) + '</div></div>';
     $("#tab-view").html(html);
    
 } 

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
    '</tbody></table><div class="row"><div class="col-6"><button type="button" class="btn btn-default btn-block" onclick="saveItem('+d+')">Save</button></div>'+
    '<div class="col-6"><button type="button" class="btn btn-danger btn-block" onclick="deleteItem('+d+')">Delete</button></div></div>'+
    '<span class="info-box-text text-center top-4"><a class="badge badge-light font-14" data-toggle="collapse" href="#pricedetails'+data.id+'" aria-expanded="false" aria-controls="pricedetails'+data.id+'">'+
    'Click to view price details'+
  '</a>'+
  '<div class="collapse" id="pricedetails'+data.id+'">'+
  '<div class="card card-body">'+
  '<table class="table"><tbody class="price-table">'+
  '<tr><td>Max Price: </td><td>'+ data.maxPrice+'</td></tr>'+
  '<tr><td>Min Price: </td><td>'+ data.minPrice+'</td></tr>'+
  '<tr><td>Customer Last Price: </td><td>'+ data.customerPrice+'</td></tr>'+
  '</div>'+
'</div>'+
  '</span>';
  }
  
  function getItemBaselayout(data){
    var d= JSON.stringify(data);
    d=d.replace(/\"/g, '\'');
    return '<span class="info-box-text font-20">Rate:&nbsp;&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+data.itemPrice+' per '+data.punit+'</strong></span>'+
    '<span class="info-box-text font-20">Qty:&nbsp;&nbsp;&nbsp;&nbsp;<strong>'+data.quantity+' '+data.punit+'</strong></span>'+
    '<span class="info-box-text font-20">Total:&nbsp;<strong>₹&nbsp;&nbsp;&nbsp;'+parseFloat(data.quantity*data.itemPrice)+'</strong></span>'+
    '<div class="row"><div class="col-6"><button type="button" class="btn btn-default btn-block" onclick="editItem('+d+')">Edit</button></div>'+
    '<div class="col-6"><button type="button" class="btn btn-danger btn-block" onclick="deleteItem('+d+')">Delete</button></div></div>';
  }

  function showSelectedItems(){

    var html = '';
  for(var i=0;i<selectedProducts.length;i++){
  
  var temp = getItemBaselayout(selectedProducts[i]);
    
    html = html + '<div class="info-box"><span class="info-box-icon bg-info custom-product-name"><h6 class="item-name">'+(i+1)+'.</h6><h6 class="item-name">'+selectedProducts[i].name+' (in '+selectedProducts[i].punit+')</h6></span>'+
  '<div class="info-box-content" id="'+selectedProducts[i].id+'_content">'+temp+ '</div></div>';
  }
  
  $("#tab-view").html(html);
   }

   function editItem(d){
    $("#"+d.id+"_content").html(getItemTable(d));
   }

   function saveItem(d){
  
    for(var i=0;i<selectedProducts.length;i++){
        if(selectedProducts[i].id == d.id){
            $("#"+d.id+"_content").html(getItemBaselayout(selectedProducts[i]));
        }
    }
    
   }

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
    
    function deleteItem(d){
      setQty(d.id,0);
      selectedProducts = selectedProducts.filter(obj => obj.id != d.id);
    displayTotalAmount();
    showSelectedItems();
      }

      function updateTotalAmount(id,price,qty){
     
         var temp = selectedProducts;
         for(var i=0;i<temp.length;i++){
           if(temp[i].id == id){
            temp[i].itemPrice = price;
            temp[i].quantity = qty;
            break;
           }
       }
       selectedProducts = temp;
       displayTotalAmount();
       }

      function increasePrice(id){
        var t = parseFloat($("#"+id+"_price").val())+1;
        $("#"+id+"_price").val(t);
        updateJSON(id,"price");
        $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseInt($("#"+id+"_qty").val())*t);
        updateTotalAmount(id,t,parseInt($("#"+id+"_qty").val()));
      }
      
      function decreasePrice(id){
        if($("#"+id+"_price").val() >0 ){
          var t = parseFloat($("#"+id+"_price").val())-1;
          $("#"+id+"_price").val(t);
          updateJSON(id,"price");
          $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseInt($("#"+id+"_qty").val())*t);
          updateTotalAmount(id,t,parseInt($("#"+id+"_qty").val()))
        }
        
      }
      
      function increaseQty(id,step){
        var t = parseInt($("#"+id+"_qty").val())+parseInt(step);
        $("#"+id+"_qty").val(t);
        updateJSON(id,"qty");
        $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseFloat($("#"+id+"_price").val())*t);
        updateTotalAmount(id,parseFloat($("#"+id+"_price").val()),t);
      }
      function decreaseQty(id,step,d){
        if($("#"+id+"_qty").val() >step ){  
          var t = parseInt($("#"+id+"_qty").val())-parseInt(step);  
        $("#"+id+"_qty").val(t);
          updateJSON(id,"qty");
          $("#"+id+"_total").html('₹&nbsp;&nbsp;&nbsp;'+parseFloat($("#"+id+"_price").val())*t);
          updateTotalAmount(id,parseFloat($("#"+id+"_price").val()),t);
        }else{
          deleteItem(d);
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

      function setQty(id,value){
     
        $("#"+id+"_qty").val(value);
          updateJSON(id,"qty");
        
      }

var cat = localStorage.getItem('categories');
if(cat){
  categories = JSON.parse(cat);   
  afterCategoryLoad();
}else{
  loadCategories();
}

