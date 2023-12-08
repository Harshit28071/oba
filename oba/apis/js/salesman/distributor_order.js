    
 function loadCustomer(){
   
    $.ajax({
       type : 'POST',
       url : '../../apis/select/common/get_distributors.php',
       success: function(data){
           var html = '<option selected style="text-align: center;" value="">SELECT DISTRIBUTOR </option>';
           $.each(data, function (index, value) {
               // APPEND OR INSERT DATA TO SELECT ELEMENT.
               html =   html + ('<option value="' + value.id + '">' + value.cname + '('+ value.cityname + ')' + '</option>');
           });
           $('#show-customer').html(html);
           if(localStorage.getItem('customer_id')){
            $('#show-customer').val(localStorage.getItem('customer_id'));
           
        }
          
          
       }
    });
 }
    $('#show-customer').change(function(){
        var customerid = $('#show-customer').val();
        var customerName = $('#show-customer option:selected').text();
        localStorage.setItem('distributor_id',customerid);
        localStorage.setItem('distributor_name',customerName);

    });
    $(document).ready(function(){
        
            loadCustomer();
        
    })

    function selectOrders(){
        if($("#show-customer").val()!= ''){
            localStorage.removeItem('order_data_set');
            localStorage.removeItem('selectedOrders');
            localStorage.removeItem('city_data');
            window.location.href = './select_orders.php';
        }else{
            alert('Please select a customer');
        }
        
    }