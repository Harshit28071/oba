<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,role FROM roles ORDER BY role ASC;");
$stmt->execute();
$stmt->bind_result($id,$role);

while($stmt->fetch()){
    array_push($users,['id' =>$id, 'role' =>$role]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>