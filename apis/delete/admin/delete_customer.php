<?php
$remove__id = $_POST['removecustid'];
if(isset($_POST['removecustid'])){
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
$stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
$stmt->bind_param("i",$remove__id);
$stmt->execute();
$rid = $stmt->affected_rows;
$stmt->close();

$conn->close();
}
echo json_encode($rid);

?>