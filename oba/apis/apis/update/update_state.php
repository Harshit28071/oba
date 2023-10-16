<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("update `state` set `state` = ? where id = ?");
$stmt->bind_param("si",$_GET["state"],$_GET["id"]);
$stmt->execute();
$id = $stmt->affected_rows;
$stmt->close();

$conn->close();

echo $id;
?>