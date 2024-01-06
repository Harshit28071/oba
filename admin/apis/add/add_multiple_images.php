<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/new/oba/uploads/";
$allowTypes = array('jpg', 'png', 'jpeg'); 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
$valid = 1; 
if(isset($_POST["productidimgem"]) || isset($_POST["files"])){
    $product_id = $_POST["productidimgem"];
    $filesArr = $_FILES["files"]; 
    // echo"<pre>";
    // print_r($filesArr);
    // echo"</pre>";
    // die;
    if($valid == 1){ 
        $uploadStatus = 1; 
        $fileNames = array_filter($filesArr['name']); 
        $uploadedFile = '';
        if(!empty($fileNames)){  
            foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    }else{  
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    }  
                }else{  
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only  JPG, JPEG, & PNG files are allowed to upload.'; 
                }  
            }  
            if($uploadStatus == 1){
                     include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
                     $db = new Database();
                     $conn = $db->connect();
                foreach($filesArr['name'] as $key=>$val){  
                    $fileName = basename($filesArr['name'][$key]);  
                    $targetFilePath = $uploadDir . $fileName; 
                    
                    $insert ="INSERT INTO hd_images(product_id,image_url)values(?,?)";
                    $stmt = $conn->prepare($insert); 
                    $stmt->bind_param("is", $product_id,$fileName); 
                    $result = $stmt->execute(); 
                }
                if($result){ 
                    $response['status'] = 1; 
                    $response['message'] = 'Form data submitted successfully!'; 
                }
            }
        } 
    }
}else{
    $response['message'] = 'Please fill all the mandatory fields';
}
echo json_encode($response);
?>