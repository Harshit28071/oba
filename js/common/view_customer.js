const urlparams = new URLSearchParams(window.location.search);
const id = urlparams.get('id');
var cust_id = id;
var obj = {cust_id : cust_id};
 var myJson = JSON.stringify(obj); 
 $("#loader-view-customer").show();

 $.ajax({
       url :"/new/oba/apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
         $("#loader-view-customer").hide();

        $("#Cust-name-v").val(data[0].name);
        $("#Cust-Mobile-v").val(data[0].mobile_number);
        $("#state").val(data[0].state);
        $("#city").val(data[0].city);
        $("#cust-add-v").val(data[0].address);
        $("#f-name-v").val(data[0].firm_name);
        $("#c-gstin-v").val(data[0].GSTIN);
        $("#disop-v").val(data[0].type);
        $("#distributor").val(data[0].distributor);
        //$("#Cust-name-v").val(data[0].name);

       }
      });
