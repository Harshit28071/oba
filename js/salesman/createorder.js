     $('#city-value').change(function(){
        loadCustomer();
    }); 
 function loadCustomer(){
    var cityId = $('#city-value').val();
    var cityName = $('#city-value').find(":selected").text();

    $.ajax({
       type : 'POST',
       url : '/new/oba/apis/select/salesman/get_city_customer.php',
       data : {id:cityId},
       success: function(data){
           var html = '<option selected style="text-align: center;" value="">SELECT CUSTOMER </option>';
           $.each(data, function (index, value) {
               // APPEND OR INSERT DATA TO SELECT ELEMENT.
               html =   html + ('<option value="' + value.id + '">' + value.cname + '('+ value.cityname + ')' + '</option>');
           });
           $('#show-customer').html(html);
           if(localStorage.getItem('customer_id')){
            $('#show-customer').val(localStorage.getItem('customer_id'));
           
        }
          // localStorage.setItem('customerList',data);
           localStorage.setItem('city_id',cityId);
           localStorage.setItem('city_name',cityName);
          
       }
    });
 }
    $('#show-customer').change(function(){
        var customerid = $('#show-customer').val();
        var customerName = $('#show-customer option:selected').text();
        localStorage.setItem('customer_id',customerid);
        localStorage.setItem('customer_name',customerName);

    });
    $(document).ready(function(){
        if(localStorage.getItem('city_id')){
            $('#city-value').val(localStorage.getItem('city_id'));
            loadCustomer();
        }
    });

    function selectOrderItems(){
        if($("#show-customer").val()!= ''){
            window.location.href = './select_order_items.php';
        }else{
            alert('Please select a customer');
        }
        
    }
