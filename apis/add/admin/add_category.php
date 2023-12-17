<?php 
// File upload folder 
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/new/oba/uploads/";
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
if(isset($_POST['c_name'])){ 
    // Get the submitted form data 
    $name = $_POST['c_name']; 
    $parent_category = $_POST['parent_cat']; 
     
    // Check whether submitted data is not empty 
    if(!empty($_POST["c_name"])){ 
        // Validate category name 
       if(strlen($name) <= 1){
        $response['message'] ='Atleast Fill 2 charcters';
       echo json_encode($response);
        die();
         }else{ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["file"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["file"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
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
                $sqlQ = "INSERT INTO category (name,image_url,parent_id) VALUES (?,?,?)"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("ssi", $name,$uploadedFile,$parent_category); 
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