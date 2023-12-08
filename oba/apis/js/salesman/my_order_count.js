$(document).ready(function(){
    $.ajax({
        url :"../../apis/select/salesman/total_order_count.php",
        type : "POST",
        dataType : "json",
        success : function(data){
        
        $("#new-count").html(data[0].new_count);
        $("#pending-count").html(data[0].pending_count);
        $("#approved-count").html(data[0].completed_count);
        $("#cancel-count").html(data[0].cancel_count);

        }
    })
    });
    function orders(status){
        localStorage.clear();
        window.location.href='../salesman/orders.php?status='+status;
    }
        

 
   