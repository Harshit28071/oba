<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,name FROM units");
$stmt->execute();
$stmt->bind_result($id,$name);

while($stmt->fetch()){
    array_push($users,[$id,$name]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>