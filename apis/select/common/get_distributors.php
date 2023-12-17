<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$customer = [];
$stmt =$conn->prepare("SELECT customer.id,customer.name,city.name FROM customer LEFT JOIN city ON customer.city = city.id WHERE type = 'Distributor' ");
$stmt->bind_result($id,$name,$cityName,);
$stmt->execute();
while($stmt->fetch()){
    array_push($customer,['id' =>$id, 'cname' =>$name,'cityname' =>$cityName]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);

?>