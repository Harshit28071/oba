<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
$stmt =$conn->prepare("SELECT a.id,a.name,a.low_price,a.max_price,b.name as unit,c.name as category,d.name as p_category from product a left join units b on a.unit_id = b.id left join category c on a.category_id = c.id left join category d on c.parent_id = d.id where a.available = 1 order by a.name");
$stmt->execute();
$stmt->bind_result($id,$name,$low_price,$max_price,$unit,$category,$p_category);

while($stmt->fetch()){
    array_push($products,['id' =>$id, 'name' =>$name,'low_price' => $low_price,'max_price' =>$max_price,'unit' =>$unit,'category' =>$category,'p_category' =>$p_category ]);
}
$stmt->close();
$conn->close();
echo json_encode($products);

?>