<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$category = [];
$stmt =$conn->prepare("SELECT a.id,a.name,a.image_url,IFNULL(b.name,'-') FROM category a left join category b on a.parent_id = b.id ORDER BY a.name ASC;");
$stmt->execute();
$stmt->bind_result($id,$name,$image_url,$parent_id);

while($stmt->fetch()){
    array_push($category,['id' =>$id, 'name' =>$name,'image_url' => $image_url,'parent_id' =>$parent_id ]);
}
$stmt->close();
$conn->close();
echo json_encode($category);

?>