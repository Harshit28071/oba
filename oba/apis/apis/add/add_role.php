<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("INSERT INTO `roles`(`role`) VALUES (?)");
$stmt->bind_param("s",$_POST["role"]);
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