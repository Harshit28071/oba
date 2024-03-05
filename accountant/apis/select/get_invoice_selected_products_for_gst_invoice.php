<?php
include($_SERVER['DOCUMENT_ROOT'] . '/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$products = [];
session_start();
if ($_SESSION["s_role"] == "Accountant") {
    $invoiceId = $_POST["id"];
    $firmId = $_POST["firm_id"];
    $stmt = $conn->prepare("SELECT p.*,b.gst_rate,b.GST_name,b.hsn_code,b.qty_step,b.gst_price,c.name as punit,d.name as sunit,e.name as category FROM invoice, JSON_TABLE(products, '$[*]' COLUMNS (id int(10) Path '$.id',  punit VARCHAR(50) Path '$.punit',quantity float(10) Path '$.quantity')) p 
left join product b on p.id = b.id
left join units c on b.unit_id = c.id
left join units d on b.secondary_unit_id = d.id
left join category e on b.category_id = e.id where invoice.invoice_number = ? and b.firm_id = ?");
    $stmt->bind_param("ss", $invoiceId,$firmId);
    $stmt->execute();
    $stmt->bind_result($id, $unit, $qty, $gst_rate, $name, $hsn, $qty_step, $gst_price, $punit, $sunit, $category);

    while ($stmt->fetch()) {
        $taxAmount = ($gst_price * $qty * $gst_rate * 0.01);
        array_push($products, ['id' => $id, 'name' => $name, 'unit' => $unit, 'quantity' => $qty, 'gst' => $gst_rate, 'hsn' => $hsn, 'qty_step' => $qty_step, 'itemPrice' => $gst_price, 'punit' => $punit, 'sunit' => $sunit, 'category' => $category,'taxAmount'=>$taxAmount]);
    }
    $stmt->close();
    $conn->close();
}
echo json_encode($products);
