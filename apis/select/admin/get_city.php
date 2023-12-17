<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
//$state_id = $data['roleid'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();

$city = [];
$stmt = $conn->prepare("SELECT city.id,city.name,state.state FROM city LEFT JOIN state ON city.state_id =state.id ORDER BY city.name ASC");
//$stmt->bind_param("is",$cid);
$stmt->execute();
$stmt->bind_result($city_id,$city_name,$state_name);
while($stmt->fetch()) {
    array_push($city ,['id' =>$city_id,'name' =>$city_name,'state' =>$state_name ]);
}
$stmt->close();



$conn->close();

echo json_encode($city);
?>