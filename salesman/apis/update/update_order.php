<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');

$data = json_decode(file_get_contents("php://input"),true);
$item =$data["products"];
$oid = $data["orderId"];
$amount = $data["totalAmount"];
$sid = $_SESSION["s_id"];
$customerId = $data["customerId"];
$products = "[";

for($i=0;$i<sizeof($item);$i++){
    $unit = '';
    if(isset($item[$i]["unit"])){
        $unit = $item[$i]["unit"];
    }else{
        $unit = $item[$i]["punit"];
    }


    if($i>0){
        $products = $products . ',';
    }
    $products = $products . '{"id":'.$item[$i]["id"].', "punit":"'.$item[$i]["punit"].'", "quantity":'.$item[$i]["quantity"].', "itemPrice":'.$item[$i]["itemPrice"].'}';
    
}
$products = $products . ']';



if(sizeof($item) > 0){
    
$stmt = $conn->prepare("update `orders` set amount = ?,party_id = ?,products = ? where id = ? and salesman_id = ? and invoice_id = 0");
$stmt->bind_param("disii",$amount,$customerId,$products,$oid,$sid);
$stmt->execute();

$stmt->close();
$conn->close();
echo json_encode($oid);
}else{
    echo json_encode(0);
}


?>