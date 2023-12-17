<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Controle-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$update_suffix =$data['editname'];
$suffix_id =$data['editid'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
$stmt = $conn->prepare("update `suffix` set `name` = ? where id = ?");
$stmt->bind_param("si",$update_suffix,$suffix_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Updated Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}

$stmt->close();

$conn->close();
echo json_encode($id);
//echo $id;
?>