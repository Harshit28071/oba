<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$customer = [];
$city_id = $_POST["cityId"];
$sdate = date("Y-m-01", strtotime(date("Y/m/d")));
$edate = date("Y-m-t", strtotime(date("Y/m/d")));
$stmt =$conn->prepare("SELECT a.id,a.name,IFNULL(SUM(b.amount),0) as amount FROM `customer` a left join (select * from orders where DATE(date) BETWEEN ? and ?) b on a.id = b.party_id WHERE a.city= ? group by a.name order by a.name");
$stmt->bind_param("ssi",$sdate,$edate,$city_id);
$stmt->bind_result($id,$name,$amount);
$stmt->execute();
while($stmt->fetch()){
    array_push($customer,['id' =>$id, 'customer_name' =>$name,'amount'=>$amount]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);

?>