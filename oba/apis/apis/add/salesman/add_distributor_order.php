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

$stmt = $conn->prepare("INSERT INTO `orders`(`salesman_id`, `party_id`,  `amount`) VALUES (?,?,?)");
$stmt->bind_param("iid",$sid,$cid,$amount);
$stmt->execute();
$id = $stmt->insert_id;
for($i=0;$i<sizeof($item);$i++){
    $stmt = $conn->prepare("INSERT INTO `order_item_mapping`( `order_id`, `product_id`, `unit`, `quantity`, `price`) VALUES (?,?,?,?,?)");
$stmt->bind_param("iisdd",$id,$item[$i]["id"],$item[$i]["punit"],$item[$i]["quantity"],$item[$i]["itemPrice"]);
$stmt->execute();
}

$stmt = $conn->prepare("update orders set order_status = 'Completed',parent_order_id = ? where id in (".$orders.")");
$stmt->bind_param("i",$id);
$stmt->execute();



$stmt->close();
$conn->close();
echo json_encode($id);
?>