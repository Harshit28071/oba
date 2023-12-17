<?php 
// File upload folder 
$destination_path = $_SERVER['DOCUMENT_ROOT']."/new/oba/uploads/";
//$uploadDir = $_SERVER['DOCUMENT_ROOT']."/new/oba/uploads/"; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
if(isset($_POST['pname']) && isset($_POST['pcategory']) && isset($_POST['punit'])){ 
    // Get the submitted form data 
    $p_name = $_POST['pname']; 
    $p_category = $_POST['pcategory']; 
    $p_unit = $_POST['punit']; 
    $p_sec_unit= $_POST['secunit']; 
    $p_multiplier = $_POST['multiplier']; 
    $p_lowprice= $_POST['lowprice']; 
    $p_max_price = $_POST['maxprice']; 
    $p_mrp = $_POST['pmrp']; 
    $p_hsn_code = $_POST['phsncode']; 
    $p_gst_rate = $_POST['gstrate']; 
    $p_firm_id = $_POST['firmid']; 
    $p_gst_price = $_POST['gstprice']; 
    $p_gst_name = $_POST['GstName']; 
    $p_Qty_step = $_POST['Qty_step']; 


    $p_image = $_FILES["productimage"]["name"];
    //if secondary unit not selected then  
        if($p_sec_unit == 0){
            $p_sec_unit =$p_unit;
           // echo $p_sec_unit;
        }
     
    // Check whether submitted data is not empty 
    if(!empty($_POST["pname"])){ 
        // Validate category name 
       if((strlen($_POST["pname"])) <= 1){
        $errors['message'] ='Atleast Fill 2 charcters';
       echo json_encode($errors);
        die();
         }else{ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["productimage"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["productimage"]["name"]); 
                //$targetFilePath = $destination_path . $fileName;
                $targetFilePath = $destination_path . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["productimage"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
                } 
            } 
             
            if($uploadStatus == 1){ 
                // Include the database config file 
                include('../../../common/database.php');
                $db = new Database();
                $conn = $db->connect();
                 
                // Insert form data in the database 
                $sqlQ = "INSERT INTO product (name,unit_id,category_id,secondary_unit_id,multiplier,low_price,max_price,mrp,hsn_code,gst_rate,default_image_url,firm_id,gst_price,GST_name,qty_step) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("siiiddddidsidsi",$p_name,$p_unit,$p_category,$p_sec_unit,$p_multiplier,$p_lowprice,$p_max_price,$p_mrp,$p_hsn_code,$p_gst_rate,$uploadedFile,$p_firm_id,$p_gst_price,$p_gst_name,$p_Qty_step); 
                $insert = $stmt->execute(); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['message'] = 'Form data submitted successfully!'; 
                } 
            } 
        } 
    }else{ 
         $response['message'] = 'Please fill all the mandatory fields (category name and image).'; 
    } 
} 
 
// Return response 
echo json_encode($response);
?>