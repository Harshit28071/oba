<?php 
// File upload folder 
$uploadDir = '../../../pages/admin/uploads/'; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
if(isset($_POST['editidcat']) && isset($_POST['editcatname'])){ 
    // Get the submitted form data 
        $cat_update_id =$_POST['editidcat'];
        $cat_name = $_POST['editcatname']; 
        $category_image_new = $_FILES["editcatfile"]["name"];
        $category_image_old = $_POST['editoldcatfile'];
        $cat_parent_id_edit =$_POST['parentcatedit'];
        if($category_image_new != ""){
        $update_filename = $_FILES["editcatfile"]["name"];

        $uploadStatus = 1; 

        }else{

        $update_filename= $category_image_old ;
        $uploadStatus = 1; 

        }
       if($uploadStatus == 1){ 
                // Include the database config file 
                include('../../../common/database.php');
                $db = new Database();
                $conn = $db->connect();
                 
                // update  form data in the database 
                $sqlQ = "UPDATE category  SET name = ?,image_url = ?,parent_id = ? WHERE id  = ?"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("ssii",$cat_name ,$update_filename,$cat_parent_id_edit,$cat_update_id); 
                $stmt->execute();
                $id = $stmt->affected_rows;
                
                if($id == 1){
                    if(!empty($_FILES["editcatfile"]["name"])){ 
                               $uploadedFile = '';
                            // File path config 
                            $fileName = basename($_FILES["editcatfile"]["name"]); 
                            $targetFilePath = $uploadDir . $fileName; 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                             
                            // Allow certain file formats to upload 
                            if(in_array($fileType, $allowTypes)){ 
                                // Upload file to the server 
                                if(move_uploaded_file($_FILES["editcatfile"]["tmp_name"], $targetFilePath)){ 
                                    $uploadedFile = $fileName; 
                                    if(!empty($category_image_old)){  
                                    unlink("../../pages/admin/uploads/".$category_image_old);
                                }
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
$response['message'] = 'Please fill all the mandatory fields (category name and image).'; 
echo json_encode($response);
}
?>