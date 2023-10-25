<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$category = [];
$stmt =$conn->prepare("SELECT id,name,image_url,parent_id FROM category ORDER BY id DESC;");
$stmt->execute();
$stmt->bind_result($id,$name,$image_url,$parent_id);

while($stmt->fetch()){
    array_push($category,['id' =>$id, 'name' =>$name,'image_url' => $image_url,'parent_id' =>$parent_id ]);
}
$stmt->close();
$conn->close();
echo json_encode($category);

?>