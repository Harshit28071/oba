<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$firmId = $_POST["firmId"];
$category = [];
$stmt =$conn->prepare("SELECT a.id,a.name,IFNULL(b.name,'-') FROM category a left join category b on a.parent_id = b.id where a.id in (select distinct(category_id) from product where firm_id = ? or firm_id =0) ORDER BY b.name,a.name ASC");
$stmt->bind_param("i", $firmId);
$stmt->execute();
$stmt->bind_result($id,$name,$parent);
$parents = '';
while($stmt->fetch()){
    if($parents == ''){
        $parents = "'".$parent."'";
    }else{
        $parents = $parents.", '".$parent."'";
    }
    array_push($category,['id' =>$id, 'name' =>$name,'parent' =>$parent]);
}

$stmt =$conn->prepare("select id,name from category where name in (".$parents.") order by name ASC");
$stmt->execute();
$stmt->bind_result($id,$name,);
$parents = '';
while($stmt->fetch()){
 
    array_push($category,['id' =>$id, 'name' =>$name,'parent' =>'-']);
}

$stmt->close();
$conn->close();
echo json_encode($category);

?>