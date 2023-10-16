<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT user.id, user.username,user.mobile_number,user.email,roles.role FROM user LEFT JOIN roles ON user.role = roles.id");
$stmt->execute();
$stmt->bind_result($id,$username,$mobile_no,$email,$role);

while($stmt->fetch()){
    array_push($users,[$id,$username,$mobile_no,$email,$role]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>