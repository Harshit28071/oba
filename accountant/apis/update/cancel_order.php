<?php
include("../../../common/check_token.php");
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant"){
    header("location:/new/oba/common/user_login.php");
    }
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";

header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
if(isset($_POST["id"])){
   
    $id = $_POST['id'];
    
    //Update query
    $SQL_UP ="UPDATE orders SET order_status = 'Cancel' WHERE id = ?";
    $stmt = $conn->prepare($SQL_UP);
    $stmt->bind_param("i",$id);
    $stmt->execute(); 
    $id = $stmt->affected_rows; 
    
   $stmt->close();

$conn->close();
echo json_encode($id);
}


?>