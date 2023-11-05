<? 
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
if(isset($_POST['CustName'])){
    $customer_name = $_POST['CustName'];
    $customer_mobile = $_POST['CustMobile'];
    $customer_state = $_POST['custstate'];
    $customer_city = $_POST['custcity'];
    $customer_add = $_POST['custAddress'];
    $customer_type = $_POST['custType'];
    $distributor_id = $_POST['disName'];
    $firm_name = $_POST['firmName'];
    $firm_gstin = $_POST['custgstin'];
    //Add Customer Quary
    $Quary = "INSERT INTO customer (name,mobile_number,state_id,city,address,firm_name,GSTIN,type,distributor_id) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($Quary); 
    $stmt->bind_param("ssisssssi",$customer_name,$customer_mobile,$customer_state,$customer_city,$customer_add,$firm_name,$firm_gstin,$customer_type,$distributor_id);
    $insert = $stmt->execute(); 
    if($insert){ 
        $response['status'] = 1; 
        $response['message'] = 'Form data submitted successfully!'; 
    } else{ 
        $response['message'] = 'Something went wrong'; 
   } 

}
$stmt->close();
$conn->close();
echo json_encode($response);
?>
