<?php
$remove__id = $_POST['firmremoveid'];
$remove_image_logo =$_POST['removelogoimgold'];
$remove_image_sign =$_POST['removesignimgold'];

if(isset($_POST['firmremoveid']) || isset($_POST['removelogoimgold']) || isset($_POST['removesignimgold'])){
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
$stmt = $conn->prepare("delete from `firm` where id = ?");
$stmt->bind_param("i",$remove__id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id == 1){
    unlink("../../pages/admin/uploads/".$remove_image_logo);
    unlink("../../pages/admin/uploads/".$remove_image_sign);

}
$stmt->close();
$conn->close();
}
echo json_encode($id);

?>