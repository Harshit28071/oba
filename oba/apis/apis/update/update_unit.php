<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$unit_update =$_POST["unit_name"];
$unit_id =$_POST["id"];
$stmt = $conn->prepare("update `units` set `name` = ? where id = ?");
$stmt->bind_param("si",$unit_update,$unit_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'Updated Unit Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}
echo json_encode($data);
$stmt->close();

$conn->close();

echo $id;
?>