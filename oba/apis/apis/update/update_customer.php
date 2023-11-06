<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
if(isset($_POST["CustNameEdit"])){
   
    $customer_id = $_POST['Custid'];
    $customer_name_edit = $_POST['CustNameEdit'];
    $customer_mobile_edit = $_POST['CustMobileEdit'];
    $customer_state_edit = $_POST['custstateEdit'];
    $customer_city_edit = $_POST['custcityEdit'];
    $customer_add_edit = $_POST['custAddressEdit'];
    $customer_type_edit = $_POST['custTypeEdit'] ?? "";
    $distributor_id_edit = isset($_POST['disNameEdit']) ? $_POST['disNameEdit']:"" ;
    $firm_name_edit = $_POST['firmNameEdit'];
    $firm_gstin_edit = $_POST['custgstinEdit'];
    //Update Quary
    $SQL_UP ="UPDATE customer SET name = ?,mobile_number = ?,state_id = ?,city = ?,address = ?,firm_name = ?,GSTIN = ?,type = ?,distributor_id = ? WHERE id = ?";
    $stmt = $conn->prepare($SQL_UP);
    $stmt->bind_param("ssisssssii",$customer_name_edit,$customer_mobile_edit,$customer_state_edit,$customer_city_edit,$customer_add_edit,$firm_name_edit,$firm_gstin_edit,$customer_type_edit,$distributor_id_edit,$customer_id);
    $updated = $stmt->execute(); 
    $id = $stmt->affected_rows; 
    if($id){ 
        $response['status'] = 1; 
        $response['message'] = 'Form data Updated successfully!'; 
    } 
    else{ 
        $response['message'] = 'something went wrong'; 
   } 
}
$stmt->close();

$conn->close();
echo json_encode($response);
?>