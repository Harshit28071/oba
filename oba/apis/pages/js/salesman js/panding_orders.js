$(document).ready(function(){
    $.ajax({
        url :"../../apis/select/salesman/get_orders.php",
        type : "POST",
        dataType : "json",
        success : function(data){
        var html = '';
        console.log(data);
        var count =+ 1;
        $.each(data,function(key,value){
            var datetimeValue = value.order_date;
            html = html + ("<div class='info-box'>"+
            "<div class='info-box-content'>"+
               " <span class='info-box-text'><b>"+ count++ +"<b>.</b>  " +value.customer_name +"</b></span>"+
                "<span class='info-box-text'><b>Amount</b></span>"+
                "<span class='info-box-text'><b>₹ "+ value.order_amount +"</b></span>"+
            "</div>"+
            "<div class='info-box-content'>"+
            "<span class='info-box-text'><b class='float-right'>#ID  "+ value.order_id  +"</b></span>"+
           "<span class='info-box-number'><b class='float-right'>"+ new Date(datetimeValue).toLocaleDateString('en-US') + "</b></span>"+
           "<span class='info-box-text'><b class='float-right'><a data-id='"+ value.order_id +"'><i class='fa fa-eye' aria-hidden='true'></i></a>  "+
            "<a data-id='" + value.order_id +"'><i class='fas fa-edit'></i></a>  "+
          "<a data-id='"+ value.order_id +"'><i class='fa fa-trash' aria-hidden='true'></i></a></b></span>"+
           "</div>"+
           "</div>");
        });
        $("#load-orders").html(html); 
        }
    })
    });