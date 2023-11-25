$(document).ready(function(){
    var userId =  $(".user-id").data("id");
    $.ajax({
        url :"../../apis/select/salesman/get_all_order.php",
        type : "POST",
        data : {user_id:userId},
        dataType : "json",
        success : function(data){
        
        $("#panding-count").html(data[0].count);
        $("#approve-count").html(data[0].approve_count);

        }
    })
    })