<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT user.id, user.username,user.mobile_number,user.email,roles.role,user.lang FROM user LEFT JOIN roles ON user.role = roles.id ORDER BY username ASC");
$stmt->execute();
$stmt->bind_result($id,$username,$mobile_no,$email,$role,$language);

while($stmt->fetch()){
    array_push($users,['id' =>$id,'username' => $username,'mobile' => $mobile_no,'email' =>$email,'role' => $role,'language' => $language ]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>