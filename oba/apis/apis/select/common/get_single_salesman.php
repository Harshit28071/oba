<?php
session_start();
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
//$c_id = $_POST['id'];
$salesman_id = $_SESSION['s_id'];
$salesman = [];
$stmt =$conn->prepare("SELECT id,username,mobile_number,email,lang FROM user WHERE id = ? ");
$stmt->bind_param("i",$salesman_id);
$stmt->execute();
$stmt->bind_result($salesman_id,$salesman_name,$salesman_mobile_number,$salesman_email,$salesman_lang);
while($stmt->fetch()){
    array_push($salesman,['id' =>$salesman_id, 'sname' =>$salesman_name,'smobile' => $salesman_mobile_number,'semail' =>$salesman_email,'slang' =>$salesman_lang]);
}
$stmt->close();
$conn->close();
echo json_encode($salesman);

?>