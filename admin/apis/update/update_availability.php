<?php
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');

$id =$_POST['id'];
$available =$_POST['availability'];
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
$stmt = $conn->prepare("update `product` set `available` = ? where id = ?");
$stmt->bind_param("ii",$available,$id);
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
echo json_encode($data);
//echo $id;
?>