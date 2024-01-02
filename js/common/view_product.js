
    //Script For Multipler Eanble Disable
function checkInput(){
  var secondunit = document.getElementById("secondaryunit");
  var multi = document.getElementById("multiplier");

  if (secondunit.value.trim() === "") {
    multi.disabled = true;
  } else {
    multi.disabled = false; 
  }
}

    $(document).ready(function(){
      $("#loader-view-product").show();
    const urlparams = new URLSearchParams(window.location.search);
    const id = urlparams.get('id');
   // console.log(id);
    var p_id = id;
    var obj = {p_id : p_id};
    var myJson = JSON.stringify(obj);
   // console.log(myJson);
    $.ajax({
       url :"/new/oba/apis/select/admin/fetch_single_product.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
      $("#loader-view-product").hide();

        $("#vname").text(data[0].name);
        $("#vcat").text(data[0].category_id);
        $("#vunit").text(data[0].unit_id);
        $("#viewsecondaryunit").text(data[0].secondary_unit_id);
        $("#multiplierview").text(data[0].multiplier);
        $("#lowpview").text(data[0].low_price);
        $("#maxpview").text(data[0].max_price);
        $("#mrpview").text(data[0].mrp);
        $("#hsnview").text(data[0].hsn_code);
        $("#gstrateview").text(data[0].gst_rate);
        $("#firmidview").text(data[0].firm_id);
        $("#gstpriceview").text(data[0].gst_price);
        $("#gstnameview").text(data[0].GST_name);
        $("#Qty-step-view").text(data[0].qty_step);
        $("#hidden-p-img").text(data[0].default_image_url);
        var pimg ="/new/oba/uploads/"+data[0].default_image_url;
        $('#view-p-main-img').attr("src",pimg);
        
       }
    });
    function loadeditbtn(){
      $("#c").html("");
      var html ='';
      html = html +('<a href="edit_product.php?id= '+ id +'" class="btn btn-warning">Edit</a>');
      $("#edit-product-details").html(html);
    }
    loadeditbtn();
  });