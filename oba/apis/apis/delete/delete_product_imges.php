<?php 
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
$remove_image_id = $_POST['imageid'];
$remove_image_name = $_POST['imgname'];
$stmt = $conn->prepare("delete from `hd_images` where id = ?");
$stmt->bind_param("i",$remove_image_id);
$stmt->execute();
$id = $stmt->affected_rows;
if($id == 1)
{
    if(!empty($remove_image_name))
    {
    unlink("../../pages/admin/uploads/".$remove_image_name);
    }else{
        $id = 1; 
    }

}
$stmt->close();
$conn->close();
echo json_encode($id);
?>