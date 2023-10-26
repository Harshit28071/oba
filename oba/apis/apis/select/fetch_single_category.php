<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$cat_id = $data['categoryeid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$category = [];
$stmt =$conn->prepare("SELECT id,name,image_url,parent_id FROM category WHERE id = ?");
$stmt->bind_param("i",$cat_id);
$stmt->bind_result($id,$name,$image_url,$parent_id);
$stmt->execute();
while($stmt->fetch()){
    array_push($category,['id' =>$id, 'cname' =>$name,'cimage' =>$image_url,'cparentid'=>$parent_id]);
}
$stmt->close();
$conn->close();
echo json_encode($category);

?>