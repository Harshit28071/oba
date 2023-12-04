<?php
//session_start();
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
$salesman_id = $_SESSION['s_id'];
if(isset($_POST["CustName"])){
   
   // $customer_id = $_POST['Custid'];
    $salesman_name_edit = $_POST['CustName'];
    $salesman_mobile_edit = $_POST['CustMobile'];
    $salesman_state_edit = $_POST['custstate'];
    $salesman_city_edit = $_POST['custcity'];
    $salesman_add_edit = $_POST['custAddress'];
    $salesman_type_edit = $_POST['custType'];
    $distributor_id_edit = $_POST['disName'];
    $firm_name_edit = $_POST['FirmName'];
    $firm_gstin_edit = $_POST['custgstin'];
    //Update Quary
    $SQL_UP ="UPDATE customer SET name = ?,mobile_number = ?,state_id = ?,city = ?,address = ?,firm_name = ?,GSTIN = ?,type = ?,distributor_id = ? WHERE id = ?";
    $stmt = $conn->prepare($SQL_UP);
    $stmt->bind_param("ssisssssii",$salesman_name_edit,$salesman_mobile_edit,$salesman_state_edit,$salesman_city_edit,$salesman_add_edit,$firm_name_edit,$firm_gstin_edit,$salesman_type_edit,$distributor_id_edit,$salesman_id);
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
}


?>