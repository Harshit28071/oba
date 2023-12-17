<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,name  FROM suffix ORDER BY name ASC;");
$stmt->execute();
$stmt->bind_result($id,$suffix);

while($stmt->fetch()){
    array_push($users,['id' =>$id, 'suffix' =>$suffix]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>