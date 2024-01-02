<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
$products2 = [];
$pricing = [];
session_start();
$salesman = $_SESSION["s_id"];
$orders = $_POST["orders"];
$customerId = $_POST["customerId"];

$stmt =$conn->prepare("SELECT a.product_id,b.name,c.name as category,a.unit as punit,d.name as sunit,b.low_price as minPrice,
b.max_price as maxPrice, a.price as price,b.qty_step,SUM(a.quantity)
FROM `order_item_mapping` a 
left join product b on a.product_id = b.id
left join category c on b.category_id = c.id
left join units d on b.secondary_unit_id = d.id where a.order_id in (select id from orders where id in (".$orders.") and salesman_id = ? and invoice_id = 0) group by a.product_id,a.unit order by b.name");
$stmt->bind_param("i",$salesman);
$stmt->execute();
$stmt->bind_result($id,$name,$category,$punit,$sunit,$minPrice,$maxPrice,$itemPrice,$qty_step,$qty);

while($stmt->fetch()){
    array_push($products,[$id,$name,$category,$punit,$sunit,$itemPrice,$minPrice,$maxPrice,$qty_step,$qty]);
}

$stmt =$conn->prepare("SELECT product_id,price,unit FROM `invoice_item_mapping` 
WHERE invoice_id in (select id from invoice where party_id = ?) and 
id in (select max(id) from invoice_item_mapping group by product_id,invoice_id)");
$stmt->bind_param("i", $customerId);
$stmt->execute();
$stmt->bind_result($product_id,$price,$unit);

while($stmt->fetch()){
    array_push($pricing,[$product_id,$price,$unit]);
}

$stmt->close();
$conn->close();

for($i=0;$i<sizeof($products);$i++){
    
    $flag= 1;
    $customerPrice = getCustomerPrice($products[$i][0]);
    if($customerPrice == '-'){
        $flag = 0;
    }
array_push($products2,["id"=>$products[$i][0],"name"=>$products[$i][1],"category"=>$products[$i][2],
"punit"=>$products[$i][3],"sunit"=>$products[$i][4],"itemPrice"=>$products[$i][5],"minPrice"=>$products[$i][6],
"maxPrice"=>$products[$i][7],"customerPrice"=>$customerPrice,"quantity"=>$products[$i][9],"orderBefore"=>$flag,"qty_step"=>$products[$i][8]]);

}

function getCustomerPrice($id){
    global $pricing;
    for($i=0;$i<sizeof($pricing);$i++){
        if($id == $pricing[$i][0]){
            return $pricing[$i][1]." per ".$pricing[$i][2];
        }
    }
    return '-';
}
echo json_encode($products2);

?>