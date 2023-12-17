<?php

include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
    $response = [];
    $salesman_id = $_SESSION['s_id'];
    $salesman_name_edit = $_POST['SalesmanName'];
    $salesman_mobile_edit = $_POST['SalesmanMobile'];
    $salesman_email_edit = $_POST['SalesmanEmail'];
    //Update Quary
    $SQL_UP ="UPDATE user SET username = ?,mobile_number = ?,email = ? WHERE id = ?";
    $stmt = $conn->prepare($SQL_UP);
    $stmt->bind_param("sssi",$salesman_name_edit,$salesman_mobile_edit,$salesman_email_edit,$salesman_id);
    $updated = $stmt->execute(); 
    $id = $stmt->affected_rows; 
    if($id){ 
        $response['status'] = 1; 
        $response['message'] = 'Form data Updated successfully!'; 
    } 
    else{
        $response['status'] = 0;  
        $response['message'] = 'something went wrong'; 
   } 
$stmt->close();
$conn->close();
echo json_encode($response);

?>