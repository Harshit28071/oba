<?php
//session_start();
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$role = $data['Add-name'];
$stmt = $conn->prepare("INSERT INTO `suffix`(`name`)  VALUES (?)");
$stmt->bind_param("s",$role);
$stmt->execute();
$id = $stmt->insert_id;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Data Entered Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}
$stmt->close();

$conn->close();
echo json_encode($data);
?>