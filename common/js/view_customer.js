const urlparams = new URLSearchParams(window.location.search);
const id = urlparams.get('id');
var cust_id = id;
var obj = {cust_id : cust_id};
 var myJson = JSON.stringify(obj); 
 $("#loader-view-customer").show();

 $.ajax({
       url :"/new/oba/admin/apis/select/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
         $("#loader-view-customer").hide();

        $("#Cust-name-v").text(data[0].name);
        $("#Cust-Mobile-v").text(data[0].mobile_number);
        $("#state").text(data[0].state);
        $("#city").text(data[0].city);
        $("#cust-add-v").text(data[0].address);
        $("#c-gstin-v").text(data[0].GSTIN);
        $("#disop-v").text(data[0].type);
        $("#distributor").text(data[0].distributor);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
      function loadeditbtn(){
        $("#c").html("");
        var html ='';
        html = html +('<a href="edit_customer.php?id= '+ id +'" class="btn btn-warning">Edit</a>');
        $("#edit-customer-details").html(html);
      }
      loadeditbtn();