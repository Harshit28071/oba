<?php 
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
if(isset($_POST['CustName'])){
    $customer_name = $_POST['CustName'];
    $customer_mobile = $_POST['CustMobile'];
    $customer_state = $_POST['custstate'];
    $customer_city = $_POST['custcity'];
    $customer_add = $_POST['custAddress'];
    $customer_type = $_POST['custType'] ?? "";
    $distributor_id = isset($_POST['disName']) ? $_POST['disName']:"" ;
    
    $firm_gstin = $_POST['custgstin'];
    //Add Customer query
    $query = "INSERT IGNORE INTO customer (name,mobile_number,state_id,city,address,GSTIN,type,distributor_id) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("ssissssi",$customer_name,$customer_mobile,$customer_state,$customer_city,$customer_add,$firm_gstin,$customer_type,$distributor_id);
    $insert = $stmt->execute(); 
    $last_insert_id =$conn->insert_id;
    if($last_insert_id > 0){ 
        $response['status'] = 1; 
        $response['customerId'] = $last_insert_id ; 
        $response['message'] = 'Form data submitted successfully!'; 
    } else{
        $response['status'] = 0;  
        $response['message'] = 'Customer With this name already exist'; 
   } 

}
$stmt->close();
$conn->close();
echo json_encode($response);
?>
