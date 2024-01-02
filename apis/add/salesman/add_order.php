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

$stmt = $conn->prepare("INSERT INTO `orders`(`salesman_id`, `party_id`,  `amount`) VALUES (?,?,?)");
$stmt->bind_param("iid",$sid,$cid,$amount);
$stmt->execute();
$id = $stmt->insert_id;
for($i=0;$i<sizeof($item);$i++){
    $unit = '';
    if(isset($item[$i]["unit"])){
        $unit = $item[$i]["unit"];
    }else{
        $unit = $item[$i]["punit"];
    }
    $stmt = $conn->prepare("INSERT INTO `order_item_mapping`( `order_id`, `product_id`, `unit`, `quantity`, `price`) VALUES (?,?,?,?,?)");
$stmt->bind_param("iisdd",$id,$item[$i]["id"],$unit,$item[$i]["quantity"],$item[$i]["itemPrice"]);
$stmt->execute();
}



$stmt->close();
$conn->close();
echo json_encode($id);
?>