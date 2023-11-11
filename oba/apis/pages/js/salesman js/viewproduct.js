$(document).ready(function(){
    //Data Table Script
    $(function () {
       $("#example1").DataTable({
         "responsive": true, 
         "lengthChange": false, 
         "autoWidth": false,
         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
         'processing': true,
        'serverSide': true,
       'serverMethod': 'post',
       'ajax': {
             'url':'../../apis/select/salesman_get_all_product.php'
            },
            'columns': [
                        {data:'name'},
                        { data: 'category'},
                        { data: 'max_price' },
                        { data: 'gstrate' },
                        { data: 'default_image_url', 
                         render: function (data, type, row, meta){
                         return type === 'display' ?
                         "<img src='http://localhost/oba/oba/oba/apis/pages/admin/uploads/"+ data +"' width='30px' height='30px'>"
                         : data;
                     }
                   }  
                     ]
       });
       //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
       //Diffent views
       $("#tab-view").show();
       $("#collalaps-view").hide();
       $("#third-view").hide(); 
       //Tabular view
       $('#tab-view-btn').click(function(){
        $("#tab-view").show();
        $("#collalaps-view").hide();
        $("#third-view").hide();

       });
       //list View
       $('#li-view').click(function(){
        $("#tab-view").hide();
        $("#third-view").hide();
        $("#collalaps-view").show();
       
       })
       //third view
       $('#third-view-btn').click(function(){
        $("#tab-view").hide();
        $("#collalaps-view").hide();
        $("#third-view").show();
       })
     });   

     //List View 
     function loadcate(){
     $("#collalaps-view").html("");
    $.ajax({
        url : "../../apis/select/salesman_get_all_category.php",
        type : "GET",
        dataType : "json",
        success : function(data){
            var html ='';
            console.log(data);
            $.each(data,function(key,value){
                html = html + (
                "<div class='col-md-3'>"+
                "<div class='card card-primary collapsed-card' id='collalaps-view'>"+
                "<div class='card-header'>"+
                "<h3 class='card-title'>" + value.name  +"</h3>"+
                "<div class='card-tools'>"+
                "<button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-plus'></i>"+
               " </button>"+
               "</div>"+
               "</div>"+
                "<div class='card-body'>"+
                "The body of the card"+
               "</div>"+
               " </div>"+
               "</div>"
                    )
            })
            $("#collalaps-view").html(html);  
        }
    });
}
loadcate();
         });
         
         
         
        