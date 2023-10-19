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
    </script>