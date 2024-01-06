<?php
$remove_cat_id = $_POST['removecatid'];
$remove_image =$_POST['removeofile'];
if(isset($_POST['removecatid']) || isset($_POST['removeofile'])){
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
$stmt = $conn->prepare("delete from `category` where id = ?");
$stmt->bind_param("i",$remove_cat_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id == 1){
 
    if(!empty($remove_image)){
    unlink("/new/oba/uploads/".$remove_image);
}
}
$stmt->close();
$conn->close();
}
echo json_encode($id);

?>