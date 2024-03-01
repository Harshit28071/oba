<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
$products2 = [];
$pricing = [];
$firmId = $_POST["firmId"];

$stmt =$conn->prepare("SELECT a.id,b.name as category,c.name as punit,d.name as sunit,a.qty_step,a.hsn_code,a.gst_rate,a.gst_price,a.gst_name
FROM `product` a 
left join category b on a.category_id = b.id
left join units c on a.unit_id = c.id
left join units d on a.secondary_unit_id = d.id where a.available = 1 and (a.firm_id = ? or a.firm_id = 0) and a.gst_name != '' ");
$stmt->bind_param("i", $firmId);
$stmt->execute();
$stmt->bind_result($id,$category,$punit,$sunit,$qty_step,$hsn,$gst,$itemPrice,$name);

while($stmt->fetch()){    
    array_push($products,["id"=>$id,"name"=>$name,"category"=>$category,
"punit"=>$punit,"sunit"=>$sunit,"itemPrice"=>$itemPrice,"quantity"=>0,"qty_step"=>$qty_step,"hsn"=>$hsn,"gst"=>$gst,"taxAmount"=>0]);
}


echo json_encode($products);

?>