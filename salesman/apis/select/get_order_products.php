<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
session_start();
$salesman = $_SESSION["s_id"];
$orderId = $_POST["orderId"];
$stmt =$conn->prepare("SELECT p.*,b.name FROM orders, JSON_TABLE(products, '$[*]' COLUMNS (id int(10) Path '$.id',  punit VARCHAR(50) Path '$.punit',quantity float(10) Path '$.quantity',itemPrice float(11) PATH '$.itemPrice')) p left join product b on p.id = b.id where orders.id = ? and orders.salesman_id = ?");
$stmt->bind_param("ii",$orderId,$salesman);
$stmt->execute();
$stmt->bind_result($id,$unit,$qty,$price,$name);

while($stmt->fetch()){
    array_push($products,['id' =>$id, 'name' =>$name,'price' => $price,'unit' =>$unit,'quantity' =>$qty ]);
}
$stmt->close();
$conn->close();
echo json_encode($products);

?>