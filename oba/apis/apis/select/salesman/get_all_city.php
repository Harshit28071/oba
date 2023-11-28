<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$city = [];
$stmt =$conn->prepare("SELECT id ,name,state_id FROM city");
$stmt->bind_result($id,$name,$state_id);
$stmt->execute();
while($stmt->fetch()){
    array_push($city,['id' =>$id, 'cname' =>$name,'state_id' =>$state_id]);
}
$stmt->close();
$conn->close();
echo json_encode($city);

?>