
    $(document).ready(function(){
    
//Fetch All Records
$(function () {
    $("#customertab").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      'processing': true,
	'serverSide': true,
	'serverMethod': 'post',
	'ajax': {
		  'url':'/new/oba/apis/select/admin/get_customer.php'
		 },
		 'columns': [
		         	{ data: 'name' },
		         	{ data: 'mobile_number'},
		         	{ data: 'type' },
		            { data: 'id',
                  render: function (data, type, row, meta){
                    
                    return type === 'display' ?
                    "<a href='./view_customer.php?id="+ data +"' class='View-product' data-productviewid='"+ data +"'><i class='fas fa-eye'></i></a> &nbsp; &nbsp; &nbsp;<a href='./edit_customer.php?id="+ data +"' class='edit-product' data-productviewid='"+ data +"'><i class='fas fa-edit'></i></a>&nbsp; &nbsp; &nbsp;<a href='#' class='remove-customer'  data-customerremoveid='"+ data +"'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a>"
                    :data;
                  }
                 
                }
		      	]
    });
    //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
});
// //Fetch All Records Close
//Fetch Single Record : Show Model

// fetch singlr record for remove product category
$(document).on("click",".remove-customer",function(){
  $('#modal-remove-custome').modal('show');
    var cust_r_id = $(this).data("customerremoveid");
    var obj = {cust_id: cust_r_id};
    var myJson = JSON.stringify(obj);
    $.ajax({
       url :"/new/oba/apis/select/admin/fetch_single_customer.php",
       type : "POST",
       data : myJson,
       dataType : "json",
       success : function(data){
        //console.log(data);
        $("#customer-remove-id").val(data[0].id);
       
        
       }
    });

   });
//
//Delete Role 
$('#remove-customer-form').on('submit',function(e){
        toastr.options = {
                          "positionClass": "toast-top-right",
                          "preventDuplicates": true
                         };
            e.preventDefault();
            $.ajax({
            type: 'POST',
            url: '/new/oba/apis/delete/admin/delete_customer.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                
                if(response == 1){
                  //  $('#edit-category-form')[0].reset();
                    $('#modal-remove-custome').modal('hide');
                    DataTable();
                    toastr.success('Customer Deleted Succesfully');
                    toastr .delay(1000)
                    toastr .fadeOut(1000);
                    
                }
                
            },
            error: function(error) {
            toastr.error('Something went wrong.');
            }
            })
        });
 
