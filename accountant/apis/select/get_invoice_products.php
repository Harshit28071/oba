<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
session_start();
if($_SESSION["s_role"] == "Accountant"){
$invoiceId = $_POST["id"];
$stmt =$conn->prepare("SELECT p.*,b.name FROM invoice, JSON_TABLE(products, '$[*]' COLUMNS (id int(10) Path '$.id',  punit VARCHAR(50) Path '$.punit',quantity float(10) Path '$.quantity',itemPrice float(11) PATH '$.itemPrice',discount float(11) PATH '$.discount')) p left join product b on p.id = b.id where invoice.invoice_number = ?");
$stmt->bind_param("s",$invoiceId);
$stmt->execute();
$stmt->bind_result($id,$unit,$qty,$price,$discount,$name);

while($stmt->fetch()){
    array_push($products,['id' =>$id, 'name' =>$name,'price' => $price,'unit' =>$unit,'quantity' =>$qty,'discount'=>$discount ]);
}
$stmt->close();
$conn->close();
}
echo json_encode($products);

?>