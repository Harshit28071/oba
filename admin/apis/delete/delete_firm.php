<?php
$remove__id = $_POST['firmremoveid'];
$remove_image_logo =$_POST['removelogoimgold'];
$remove_image_sign =$_POST['removesignimgold'];

if(isset($_POST['firmremoveid'])){
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
$stmt = $conn->prepare("delete from `firm` where id = ?");
$stmt->bind_param("i",$remove__id);
$stmt->execute();
$id = $stmt->affected_rows;
if($stmt){
    if(!empty($remove_image_logo) && !empty($remove_image_sign)){
    unlink("/new/oba/uploads/".$remove_image_logo);
    unlink("/new/oba/uploads/".$remove_image_sign);
    }
}
$stmt->close();
$conn->close();
}
echo json_encode($id);

?>