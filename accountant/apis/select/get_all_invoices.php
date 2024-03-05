<?php 
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database2.php');
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
    header("location:/new/oba/common/user_login.php");
}

   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value
   $city = $_POST['city'];
   $customer = $_POST['customer'];
   $status = $_POST['status'];
   $min = $_POST['min'];
   $max = $_POST['max'];

  

   $searchArray = array();
   $query = '';

   if($customer != ''){
      $query = " invoice.party_id =".$customer;
   }else{
      if($city != '')
      $query = " invoice.party_id in (select id from customer where city =".$city.") ";
   }

   if($status != 'All'){
      if($query == ''){
         $query = " invoice.status ='".$status."'";
      }else{
         $query = $query." and invoice.status ='".$status."'";
      }
   }

   if($min != ''){
      if($query == ''){
         $query = " invoice.date >='".$min."'";
      }else{
         $query = $query." and invoice.date >='".$min."'";
      }
   }

   if($max != ''){
     //$max = date('Y-m-d', strtotime($max. ' + 1 days'));   
      if($query == ''){
         $query = " invoice.date <='".$max."'";
      }else{
         $query = $query." and invoice.date <='".$max."'";
      }
   }

   

   if($query == ''){
      $query = "1";
   }
 
   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (invoice.date LIKE :date OR
           customer.name LIKE :name OR city 
           LIKE :city OR invoice.invoice_number LIKE :invoiceId OR invoice.status LIKE :status) ";
      $searchArray = array(
           'name'=>"%$searchValue%",
           'date'=>"%$searchValue%",
           'city'=>"%$searchValue%",
           'invoiceId'=>"%$searchValue%",
           'status'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM invoice where ".$query);
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $conn->prepare("SELECT COUNT(invoice.id) AS allcount FROM invoice 
   LEFT JOIN customer ON invoice.party_id = customer.id 
   left join city on customer.city = city.id 
   WHERE ".$query." ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $conn->prepare("SELECT invoice.id,invoice.date,invoice.status,invoice.amount, customer.name,
   customer.id as customer_id,city.name as city,city.id as city_id,invoice.invoice_number,agarwal_invoices.invoice_number as agarwal,harihar_invoices.invoice_number as harihar from invoice 
   LEFT JOIN customer ON invoice.party_id = customer.id 
   left join city on customer.city = city.id 
   left join agarwal_invoices on invoice.invoice_number = agarwal_invoices.invoice_id
   left join harihar_invoices on invoice.invoice_number = harihar_invoices.invoice_id
   WHERE ".$query." ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
         "status"=>$row['status'],
         "amount"=>$row['amount'],
         "name"=>$row['name'],  
         "customer_id"=>$row['customer_id'],
         "city"=>$row['city'],
         "city_id"=>$row['city_id'],
         "invoice_number"=>$row['invoice_number'],
         "harihar"=>$row['harihar'],
         "agarwal"=>$row['agarwal']    
         
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