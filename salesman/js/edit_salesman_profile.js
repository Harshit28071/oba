function loadSingleSalesman(){
    $.ajax({
        url: "/new/oba/common/apis/select/get_single_salesman.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
        $("#salesman-name").val(data[0].sname);
        $("#salesman-Mobile").val(data[0].smobile);
        $("#salesman-email").val(data[0].semail);
       // $("#salesman-lang").val(data[0].slang);
        }
    });
}
$("#edit-customer-form").on("submit",function(e){
    $("#loader-customer-edit").show();
    $.ajax({
            type: 'POST',
            url: '/new/oba/salesman/apis/update/edit_salesman_details.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
              $("#loader-customer-edit").hide();
                if(response.status == 1){
                   $('#edit-customer-form')[0].reset();
                   history.back("./view_customer_all_details.php");  
                }    
            }
           
            });
        e.preventDefault();
   });

   loadSingleSalesman();
