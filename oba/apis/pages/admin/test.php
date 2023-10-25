<script>
function jsonData(targetForm){
        var arr = $(targetForm).serializeArray();
        //console.log(arr);
        var obj = {};
        for(var a=0; a < arr.length; a++){
            obj[arr[a].name] = arr[a].value;
        }
        //console.log(obj);
        var json_str = JSON.stringify(obj);
       // console.log(json_str);
       return json_str;
    }
    $("#signin").on("click",function(e){
        e.preventDefault();
       var jsonobj_login = jsonData("#loginform");
       console.log(jsonobj_login);

    })
    // $("#fupForm").on('submit', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         type: 'POST',
    //         url: 'submit.php',
    //         data: new FormData(this),
    //         dataType: 'json',
    //         contentType: false,
    //         cache: false,
    //         processData:false,
    //         beforeSend: function(){
    //             $('.submitBtn').attr("disabled","disabled");
    //             $('#fupForm').css("opacity",".5");
    //         },
    //         success: function(response){
    //             $('.statusMsg').html('');
    //             if(response.status == 1){
    //                 $('#fupForm')[0].reset();
    //                 $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
    //             }else{
    //                 $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
    //             }
    //             $('#fupForm').css("opacity","");
    //             $(".submitBtn").removeAttr("disabled");
    //         }
    //     });
    // });
    </script>