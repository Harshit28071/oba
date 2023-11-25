$(document).ready(function(){
    $.ajax({
        url :"../../apis/select/salesman/total_order_count.php",
        type : "POST",
        dataType : "json",
        success : function(data){
        
        $("#panding-count").html(data[0].count);
        $("#approve-count").html(data[0].approve_count);

        }
    })
    })