<?php 
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../admin/pages/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$item =$data["products"];
$cid = $data["customerId"];
$amount = $data["totalAmount"];
$sid = $_SESSION["s_id"];
$products = "[";

for($i=0;$i<sizeof($item);$i++){

    if($i>0){
        $products = $products . ',';
    }
    $products = $products . '{"id":'.$item[$i]["id"].', "punit":"'.$item[$i]["punit"].'", "quantity":'.$item[$i]["quantity"].', "itemPrice":'.$item[$i]["itemPrice"].', "discount":'.$item[$i]["discount"].'}';
    
}
$products = $products . ']';



$stmt = $conn->prepare("INSERT INTO `orders`(`salesman_id`, `party_id`,  `amount`,products) VALUES (?,?,?,?)");
$stmt->bind_param("iids",$sid,$cid,$amount,$products);
$stmt->execute();
$id = $stmt->insert_id;

$stmt->close();
$conn->close();
echo json_encode($id);
?>