<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
//validate requires fields 
// if(empty($_POST["username"])){
//     $data =['message' => 'Field is require'];
//     echo json_encode($data);
//     die();
// }
// if(empty($_POST["password"])){
//     $data =['message' => 'Field is require'];
//     echo json_encode($data);
//     die();
// }
// if(empty($_POST["role"])){
//     $data =['message' => 'Field is require'];
//     echo json_encode($data);
//     die();
// }
$username =$data["username"];
$pwd = password_hash($data["password"], PASSWORD_DEFAULT);
$phone =$data["mobile_number"];
$email= $data["email"];
$role =$data["role"];
$language =$data["Language"];
$stmt = $conn->prepare("INSERT INTO `user`(username,password,mobile_number,email,role,lang) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$username,$pwd,$phone,$email,$role,$language);
$stmt->execute();
$id = $stmt->insert_id;
if($id)
{
   $data = ['id' => $id, 'status'=> 201, 'message'=>'User Register Successfully'];  
}else{
    $data = ['status'=> 500, 'message'=>'Something went wrong'];
}
echo json_encode($data);


$stmt->close();
$conn->close();
?>