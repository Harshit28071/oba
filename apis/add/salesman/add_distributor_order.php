<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$item =$data["products"];
$cid = $data["customerId"];
$amount = $data["totalAmount"];
$sid = $_SESSION["s_id"];
$orders = $data["selectedOrders"];
$products = "[";

for($i=0;$i<sizeof($item);$i++){

    if($i>0){
        $products = $products . ',';
    }
    $products = $products . '{"id":'.$item[$i]["id"].', "punit":"'.$item[$i]["punit"].'", "quantity":'.$item[$i]["quantity"].', "itemPrice":'.$item[$i]["itemPrice"].'}';
    
}
$products = $products . ']';
//$products = serialize($products);
$stmt = $conn->prepare("INSERT INTO `orders`(`salesman_id`, `party_id`,  `amount`,products) VALUES (?,?,?,?)");
$stmt->bind_param("iids",$sid,$cid,$amount,$products);
$stmt->execute();
$id = $stmt->insert_id;


$stmt = $conn->prepare("update orders set order_status = 'Completed',parent_order_id = ? where id in (".$orders.")");
$stmt->bind_param("i",$id);
$stmt->execute();



$stmt->close();
$conn->close();
echo json_encode($id);
?>