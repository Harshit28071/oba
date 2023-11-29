<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
session_start();
$salesman = $_SESSION["s_id"];
$orderId = $_POST["orderId"];
$stmt =$conn->prepare("select a.product_id,b.name,a.price,a.unit,a.quantity from order_item_mapping a left join product b on a.product_id = b.id where a.order_id in (select id from orders where id = ? and salesman_id = ?) order by b.name");
$stmt->bind_param("ii",$orderId,$salesman);
$stmt->execute();
$stmt->bind_result($id,$name,$price,$unit,$qty);

while($stmt->fetch()){
    array_push($products,['id' =>$id, 'name' =>$name,'price' => $price,'unit' =>$unit,'quantity' =>$qty ]);
}
$stmt->close();
$conn->close();
echo json_encode($products);

?>