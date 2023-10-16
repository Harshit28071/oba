<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,role FROM roles");
$stmt->execute();
$stmt->bind_result($id,$role);

while($stmt->fetch()){
    array_push($users,[$id,$role]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>