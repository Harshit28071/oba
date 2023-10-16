<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("delete from `units` where id = ?");
$stmt->bind_param("i",$_POST["id"]);
$stmt->execute();
$id = $stmt->affected_rows;
$stmt->close();

$conn->close();

echo $id;
?>