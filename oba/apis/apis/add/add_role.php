<?php
//require_once("../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Controle-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$role = $data['Addrole'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("INSERT INTO `roles`(`role`) VALUES (?)");
$stmt->bind_param("s",$role);
$stmt->execute();
$id = $stmt->insert_id;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Role Entered Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}
$stmt->close();

$conn->close();
echo json_encode($data);
?>