<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$category = [];
$stmt =$conn->prepare("SELECT a.id,a.name,IFNULL(b.name,'-') FROM category a left join category b on a.parent_id = b.id ORDER BY b.name,a.name ASC;");
$stmt->execute();
$stmt->bind_result($id,$name,$parent);

while($stmt->fetch()){
    array_push($category,['id' =>$id, 'name' =>$name,'parent' =>$parent ]);
}
$stmt->close();
$conn->close();
echo json_encode($category);

?>