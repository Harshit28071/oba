<?php 
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database2.php');
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
   $searchQuery = " AND (name LIKE :name) ";
   $searchArray = array(
        'name'=>"%$searchValue%",
        //'category'=>"%$searchValue%"
   );
}
// Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM customer ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

// Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(id) AS allcount FROM customer  WHERE 1 ".$searchQuery);

$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$stmt = $conn->prepare("SELECT id ,name,mobile_number,state_id,city,address,GSTIN,type,distributor_id FROM customer WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
       "mobile_number"=>$row['mobile_number'],
       "state_id"=>$row['state_id'],
       "city"=>$row['city'],
       "address"=>$row['address'],
       "GSTIN"=>$row['GSTIN'],
       "type"=>$row['type'],
       "distributor_id"=>$row['distributor_id']

       
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