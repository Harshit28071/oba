<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
$data = json_decode(file_get_contents("php://input"),true);
$unit = $data['Addunit'];
$stmt = $conn->prepare("INSERT INTO `units`(`name`) VALUES (?)");
$stmt->bind_param("s",$unit);
$stmt->execute();
$id = $stmt->insert_id;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Unit Entered Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}

$stmt->close();

$conn->close();
echo json_encode($data);
?>