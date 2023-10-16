<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
//validate requires fields 
if(empty($_POST["username"])){
    $errors ='Username is require';
    echo json_encode($errors);
    die();
}
if(empty($_POST["password"])){
    $errors ='Password is require';
    echo json_encode($errors);
    die();
}
if(empty($_POST["role"])){
    $errors ='Role is require';
    echo json_encode($errors);
    die();
}
$username =$_POST["username"];
$pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
$phone =$_POST["mobile_number"];
$email= $_POST["email"];
$role =$_POST["role"];
$stmt = $conn->prepare("INSERT INTO `user`(username,password,mobile_number,email,role) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss",$username,$pwd,$phone,$email,$role);
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