<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("INSERT INTO `state`( `state`) VALUES (?)");
$stmt->bind_param("s",$_GET["state"]);
$stmt->execute();
$id = $stmt->insert_id;
$stmt->close();

$conn->close();

echo $id;
?>