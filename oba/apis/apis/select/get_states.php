<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$states = [];
$stmt = $conn->prepare("SELECT `id`, `state` FROM `state`");
//$stmt->bind_param("is",$cid);
$stmt->execute();
$stmt->bind_result($id,$state);
while($stmt->fetch()) {
    array_push($states,[$id,$state]);
}
$stmt->close();



$conn->close();

echo json_encode($states);
?>