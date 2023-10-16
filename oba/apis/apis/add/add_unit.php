<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("INSERT INTO `units`(`name`) VALUES (?)");
$stmt->bind_param("s",$_POST["unit_name"]);
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