<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$role_update =$_POST["role"];
$role_id =$_POST["id"];
$stmt = $conn->prepare("update `roles` set `role` = ? where id = ?");
$stmt->bind_param("si",$role_update,$role_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Updated Role Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}
echo json_encode($data);
$stmt->close();

$conn->close();

echo $id;
?>