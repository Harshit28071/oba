<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$product_id = $data['p_id'];
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$product_s = [];
$stmt =$conn->prepare("SELECT a.id,a.name,a.unit_id,a.category_id,a.secondary_unit_id,a.multiplier,a.low_price,a.max_price,a.mrp,a.hsn_code,a.gst_rate,a.default_image_url,a.firm_id,a.gst_price,a.available,a.GST_name,a.qty_step,b.name as unit,c.name as sunit,d.name as category,e.name as p_category,f.name as firmname  FROM product a left join units b on a.unit_id = b.id left join units c on  a.secondary_unit_id = c.id left join category d on a.category_id = d.id left join category e on d.parent_id = e.id left join firm f on a.firm_id = f.id WHERE a.id = ?");
$stmt->bind_param("i",$product_id);
$stmt->bind_result($id,$p_name,$p_unit,$p_category,$p_sec_unit,$p_multiplier,$p_lowprice,$p_max_price,$p_mrp,$p_hsn_code,$p_gst_rate,$uploadedFile,$p_firm_id,$p_gst_price,$status,$GST_name,$qty_step,$unit_name,$sunit_name,$category_name,$parenet_category_name,$firm_name);
$stmt->execute();
while($stmt->fetch()){
    array_push($product_s,['id' =>$id, 'name' =>$p_name,'unit_id' => $p_unit,'category_id' =>$p_category,'secondary_unit_id' => $p_sec_unit,'multiplier' =>$p_multiplier,'low_price' =>$p_lowprice,'max_price'=>$p_max_price,'mrp'=>$p_mrp,'hsn_code'=>$p_hsn_code,'gst_rate'=>$p_gst_rate,'default_image_url'=>$uploadedFile,'firm_id'=>$p_firm_id,'gst_price'=>$p_gst_price,'available'=>$status,'GST_name' =>$GST_name,'qty_step' =>$qty_step,'unitname' =>$unit_name,'sunit'=>$sunit_name,'categoryname' => $category_name ,'parentcategoryname' => $parenet_category_name ,'firmname'=>$firm_name ]);
}
$stmt->close();
$conn->close();
echo json_encode($product_s);

?>


