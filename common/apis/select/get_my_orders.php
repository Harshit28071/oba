<?php 
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database2.php');
session_start();

   $user_id = $_SESSION['s_id'];
   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value
   $status = $_POST['status'];
   $searchArray = array();
 

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (orders.date LIKE :date OR
           customer.name LIKE :name OR city 
           LIKE :city OR orders.invoice_id LIKE :invoiceId) ";
      $searchArray = array(
           'name'=>"%$searchValue%",
           'date'=>"%$searchValue%",
           'city'=>"%$searchValue%",
           'invoiceId'=>"%$searchValue%"
           
      );
   }

   // Total number of records without filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM orders where salesman_id =  '".$user_id."' and order_status = '".$status."'");

   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];



   // Total number of records with filtering
   $stmt = $conn->prepare("SELECT COUNT(orders.id) AS allcount FROM orders 
   LEFT JOIN customer ON orders.party_id = customer.id 
   left join city on customer.city = city.id 
   WHERE (orders.order_status = '".$status."' and orders.salesman_id = '".$user_id."') ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

    // Fetch records
   $stmt = $conn->prepare("SELECT orders.id,orders.date,orders.order_status,orders.amount, customer.name,
   customer.id as customer_id,city.name as city,city.id as city_id,orders.invoice_id from orders 
   LEFT JOIN customer ON orders.party_id = customer.id
   left join city on customer.city = city.id 
   WHERE (orders.order_status = '".$status."' and orders.salesman_id = '".$user_id."') ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");


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
         "date"=>$row['date'],
         "order_status"=>$row['order_status'],
         "amount"=>$row['amount'],
         "name"=>$row['name'],
         "customer_id"=>$row['customer_id'],
         "city"=>$row['city'],
         "city_id"=>$row['city_id'],
         "invoice_id"=>$row['invoice_id']        
         
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



