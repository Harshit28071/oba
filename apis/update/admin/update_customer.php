<?php
include("../../../common/check_token.php");
if(!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Admin"){
    header("location:/new/oba/common/user_login.php");
    }
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";

header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
if(isset($_POST["CustName"])){
   
    $customer_id = $_POST['Custid'];
    $customer_name_edit = $_POST['CustName'];
    $customer_mobile_edit = $_POST['CustMobile'];
    $customer_state_edit = $_POST['custstate'];
    $customer_city_edit = $_POST['custcity'];
    $customer_add_edit = $_POST['custAddress'];
    $customer_type_edit = $_POST['custType'];
    $distributor_id_edit = isset($_POST['disName']) ? $_POST['disName']:"" ;
    $firm_name_edit = $_POST['firmName'];
    $firm_gstin_edit = $_POST['custgstin'];
    //Update query
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
        $response['status'] = 0;  
        $response['message'] = 'something went wrong'; 
   } 
   $stmt->close();

$conn->close();
echo json_encode($response);
}


?>