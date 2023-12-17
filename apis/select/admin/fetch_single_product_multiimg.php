<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$product_id = $data['p_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
?>