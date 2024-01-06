<?php
include("../../../common/check_token.php");
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:/new/oba/common/user_login.php");
    }
$remove__id = $_POST['removecustid'];
if(isset($_POST['removecustid'])){
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";

$stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
$stmt->bind_param("i",$remove__id);
$stmt->execute();
$rid = $stmt->affected_rows;
$stmt->close();

$conn->close();
}
echo json_encode($rid);

?>