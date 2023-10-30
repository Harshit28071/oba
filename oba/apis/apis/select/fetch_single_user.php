<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$user_id = $data['userid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,username,password,mobile_number,email,role  FROM user WHERE id = ?");
$stmt->bind_param("i",$user_id);
$stmt->bind_result($id,$name,$password,$mobile_number,$email,$role);
$stmt->execute();
while($stmt->fetch()){
    array_push($users,['id' =>$id, 'username' =>$name,'password' =>$password,'mobile_number' =>$mobile_number,'email'=>$email,'role'=>$role]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>