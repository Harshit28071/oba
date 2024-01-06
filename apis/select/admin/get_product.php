<?php
include('../../../common/database2.php');


/*$product = [];
$stmt =$conn->prepare("SELECT product.id,product.name,product.low_price,product.max_price,product.default_image_url,product.available,
units.name as unit,category.name as category FROM product right JOIN units ON product.unit_id = units.id right join category on product.category_id = category.id ORDER BY product.name ASC");
$stmt->execute();
$stmt->bind_result($id,$name,$low_price,$max_price,$default_image_url,$available,$unit_name );

while($stmt->fetch()){
    array_push($product,['id' =>$id, 'name' =>$name,'low_price' =>$low_price,'max_price' => $max_price,'default_image_url' => $default_image_url,'available' => $available,'unit_name' => $unit_name]);
}
$stmt->close();
$conn->close();
echo json_encode($product);*/


   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value

   $searchArray = array();

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (product.name LIKE :name OR
           category.name LIKE :category) ";
      $searchArray = array(
           'name'=>"%$searchValue%",
           'category'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM product ");
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $conn->prepare("SELECT COUNT(product.id) AS allcount FROM product left JOIN category on product.category_id = category.id WHERE 1 ".$searchQuery);
   
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $conn->prepare("SELECT product.id,product.name,product.low_price,product.max_price,product.default_image_url,product.available,
units.name as unit,category.name as category FROM product left JOIN units ON product.unit_id = units.id left join category on product.category_id = category.id
WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");


   // Bind values
   foreach ($searchArray as $key=>$search) {
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
   }

   $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
   $stmt->execute();
   $empRecords = $stmt->fetchAll();

   $data = array();

   foreach ($empRecords as $row) {
      $data[] = array(
         "id"=>$row['id'],
         "name"=>$row['name'],
         "low_price"=>$row['low_price'],
         "max_price"=>$row['max_price'],
         "default_image_url"=>$row['default_image_url'],
         "available"=>$row['available'],
         "unit"=>$row['unit'],
         "category"=>$row['category']
         
         
      );
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);

?>