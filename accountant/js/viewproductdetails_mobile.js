  var product = [];
  const urlparams = new URLSearchParams(window.location.search);
  const id = urlparams.get('id');
 // console.log(id);
  var p_id = id;
  var obj = {p_id : p_id};
  var myJson = JSON.stringify(obj);
 // console.log(myJson);
  $.ajax({
     url :"/new/oba/admin/apis/select/fetch_single_product.php",
     type : "POST",
     data : myJson,
     dataType : "json",
     success : function(data){ 
         
         product = data;
          viewProductDetails(product);
         
     }
     
  });

  function viewProductDetails(product){
    var html = '';
    $.each(product, function (key, value) {
        html = html + "<div class='card card-widget widget-user-2'>"+
        "<div class='widget-user-header bg-warning'>"+
        "<div class='widget-user-image'>"+
        "<img class='img-circle elevation-2' src='/new/oba/uploads/"+ value.default_image_url+"' alt='User Avatar'>"+
        "</div>"+
        "<h3 class='widget-user-username'>" +  value.name + "</h3>"+
        "<h5 class='widget-user-desc'>MRP:  " + value.mrp +"  ₹</h5>"+
        "<h5><span class='float-right badge bg-primary' onclick='editproduct("+ value.id +")'>Edit</span></h5>"+

        "</div>"+
        "<div class='card-footer p-0'>"+
        "<ul class='nav flex-column'>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'>Category</span> <span class='float-right'>"+ value.categoryname +"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        " <span class='text-dark font-weight-bold'> Price Range </span><span class='float-right '>"+"₹\xa0"+value.low_price+ "\xa0- "+ "\xa0₹\xa0" + value.max_price +" \xa0" +"per\xa0 "+value.unitname+"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'>Hsn Code </span> <span class='float-right'>"+ value.hsn_code+"</span>"+
        "</a>"+
        "</li>"+
        " <li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'> Gst Rate </span>	 <span class='float-right'>"+ value.gst_rate +"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'> Firm </span><span class='float-right'>"+ value.firmname +"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'>Gst Price </span><span class='float-right'>"+ value.gst_price +"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'>Gst Name </span><span class='float-right'>"+ value.GST_name +"</span>"+
        "</a>"+
        "</li>"+
        "<li class='nav-item'>"+
        "<a href='#' class='nav-link'>"+
        "<span class='text-dark font-weight-bold'>Qty_step </span> <span class='float-right'>"+ value.qty_step +"</span>"+
        "</a>"+
        "</li>"+
        "</ul>"+
        "</div>"+
        "</div>";
        
    });
    $("#product").html(html);
    
  }
  function editproduct(id){
    
    window.location.href = '/new/oba/accountant/pages/mobile/edit_product.php?id='+ id +'';
  
   }
  
  
