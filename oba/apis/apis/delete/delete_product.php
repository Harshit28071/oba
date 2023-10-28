<?php
$remove_p_id = $_POST['idremove'];
$remove_image_product =$_POST['removeimage'];
if(isset($_POST['idremove']) || isset($_POST['idremove'])){
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
$stmt = $conn->prepare("delete from `product` where id = ?");
$stmt->bind_param("i",$remove_p_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id == 1){
    unlink("../../pages/admin/uploads/".$remove_image_product);
}
$stmt->close();
$conn->close();
}
echo json_encode($id);

?>