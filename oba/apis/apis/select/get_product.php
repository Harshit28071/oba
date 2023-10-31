<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$product = [];
$stmt =$conn->prepare("SELECT id,name,low_price,max_price,default_image_url FROM product ORDER BY id DESC;");
$stmt->execute();
$stmt->bind_result($id,$name,$low_price,$max_price,$default_image_url);

while($stmt->fetch()){
    array_push($product,['id' =>$id, 'name' =>$name,'low_price' =>$low_price,'max_price' => $max_price,'default_image_url' => $default_image_url]);
}
$stmt->close();
$conn->close();
echo json_encode($product);

?>