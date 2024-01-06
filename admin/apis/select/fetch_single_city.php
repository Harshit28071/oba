<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$city_id = $data['Cityeid'];
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$city = [];
$stmt =$conn->prepare("SELECT id,name,state_id FROM city WHERE id = ?");
$stmt->bind_param("i",$city_id);
$stmt->bind_result($id,$cityname,$state_id);
$stmt->execute();
while($stmt->fetch()){
    array_push($city,['id' =>$id, 'name' =>$cityname,'state_id'=>$state_id]);
}
$stmt->close();
$conn->close();
echo json_encode($city);

?>