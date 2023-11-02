<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$product_id = $data['p_id'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$product_s = [];
$stmt =$conn->prepare("SELECT id,name,unit_id,category_id,secondary_unit_id,multiplier,low_price,max_price,mrp,hsn_code,gst_rate,default_image_url,firm_id,gst_price,available FROM product  WHERE id = ?");
$stmt->bind_param("i",$product_id);
$stmt->bind_result($id,$p_name,$p_unit,$p_category,$p_sec_unit,$p_multiplier,$p_lowprice,$p_max_price,$p_mrp,$p_hsn_code,$p_gst_rate,$uploadedFile,$p_firm_id,$p_gst_price,$status);
$stmt->execute();
while($stmt->fetch()){
    array_push($product_s,['id' =>$id, 'name' =>$p_name,'unit_id' => $p_unit,'category_id' =>$p_category,'secondary_unit_id' => $p_sec_unit,'multiplier' =>$p_multiplier,'low_price' =>$p_lowprice,'max_price'=>$p_max_price,'mrp'=>$p_mrp,'hsn_code'=>$p_hsn_code,'gst_rate'=>$p_gst_rate,'default_image_url'=>$uploadedFile,'firm_id'=>$p_firm_id,'gst_price'=>$p_gst_price,'available'=>$status]);
}
$stmt->close();
$conn->close();
echo json_encode($product_s);

?>