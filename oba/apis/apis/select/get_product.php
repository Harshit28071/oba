<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$product = [];
$stmt =$conn->prepare(" SELECT product.id,product.name,product.low_price,product.max_price,product.default_image_url,product.available,units.name FROM product LEFT JOIN units ON product.unit_id = units.id ORDER BY product.name ASC");
$stmt->execute();
$stmt->bind_result($id,$name,$low_price,$max_price,$default_image_url,$available,$unit_name );

while($stmt->fetch()){
    array_push($product,['id' =>$id, 'name' =>$name,'low_price' =>$low_price,'max_price' => $max_price,'default_image_url' => $default_image_url,'available' => $available,'unit_name' => $unit_name]);
}
$stmt->close();
$conn->close();
echo json_encode($product);

?>