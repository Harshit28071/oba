<?php
$uploadDir = '../../../pages/admin/uploads/'; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
if( isset($_POST['idedit']) && isset($_POST['pnameedit']) && isset($_POST['pcategoryedit']) && isset($_POST['punitedit'])){ 
    // Get the submitted form data 
    $edit_id =$_POST['idedit'];
    $edit_name = $_POST['pnameedit']; 
    $edit_category = $_POST['pcategoryedit']; 
    $edit_unit = $_POST['punitedit']; 
    $edit_sec_unit= $_POST['secunitedit']; 
    $edit_multiplier = $_POST['multiplieredit']; 
    $edit_lowprice= $_POST['lowpriceedit']; 
    $edit_max_price = $_POST['maxpriceedit']; 
    $edit_mrp = $_POST['pmrpedit']; 
    $edit_hsn_code = $_POST['phsncodeedit']; 
    $edit_gst_rate = $_POST['gstrateedit']; 
    $edit_firm_id = $_POST['firmidedit']; 
    $edit_gst_price = $_POST['gstpriceedit']; 
    $edit_image_new = $_FILES["productimagenew"]["name"];
    $product_old_image = $_POST["oldimageproduct"];
    if($edit_sec_unit == 0){
        $edit_sec_unit = $edit_unit;
    }
    if($edit_image_new != ""){
        $update_filename = $_FILES["productimagenew"]["name"];

        $uploadStatus = 1; 

        }else{

        $update_filename= $product_old_image ;
        $uploadStatus = 1; 

        }
        if($uploadStatus == 1){ 
            // Include the database config file 
            include('../../../common/database.php');
            $db = new Database();
            $conn = $db->connect();
             
            // update  form data in the database 
            $sqlQ = "UPDATE product  SET name = ?,unit_id  = ?,category_id  = ? ,secondary_unit_id = ?,multiplier = ?,low_price = ?,max_price = ?,mrp = ?,hsn_code = ?,gst_rate = ?, default_image_url = ?, firm_id = ?,gst_price = ? WHERE id  = ?"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("siiiddddidsidi",$edit_name,$edit_unit,$edit_category,$edit_sec_unit,$edit_multiplier,$edit_lowprice,$edit_max_price,$edit_mrp,$edit_hsn_code,$edit_gst_rate,$update_filename,$edit_firm_id,$edit_gst_price,$edit_id ); 
            $stmt->execute();
            $id = $stmt->affected_rows;
            
            if($id == 1){
                if(!empty($_FILES["productimagenew"]["name"])){ 
                           $uploadedFile = '';
                        // File path config 
                        $fileName = basename($_FILES["productimagenew"]["name"]); 
                        $targetFilePath = $uploadDir . $fileName; 
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                         
                        // Allow certain file formats to upload 
                        if(in_array($fileType, $allowTypes)){ 
                            // Upload file to the server 
                            if(move_uploaded_file($_FILES["productimagenew"]["tmp_name"], $targetFilePath)){ 
                                $uploadedFile = $fileName; 
                                unlink("../../pages/admin/uploads/".$product_old_image);
                            }else{ 
                                $uploadStatus = 0; 
                                $response['message'] = 'Sorry, there was an error uploading your file.'; 
                            } 
                        }else{ 
                            $uploadStatus = 0; 
                            $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
                        } 
                    }
            }
         }

// Return response 
$response['status'] = 1;
$response['message'] = 'Please fill all the mandatory fields'; 
echo json_encode($response);

}
?>