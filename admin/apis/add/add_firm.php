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
if(isset($_POST['firmname']) && isset($_POST['gstin']) && isset($_POST['address']) && isset($_POST['fssai']) && isset($_POST['mobile']) && isset($_POST['bankname']) && isset($_POST['accountnumber']) && isset($_POST['ifsc']) && isset($_POST['bankaddress']) && isset($_POST['state']) && isset($_POST['statecode'])){ 
    // Get the submitted form data 
    $firmname = $_POST['firmname']; 
    $gstin = $_POST['gstin']; 
    $address =$_POST['address'];
    $fssai =$_POST['fssai'];
    $mobile =$_POST['mobile'];
    $email =$_POST['email'];
    $bankname =$_POST['bankname'];
    $accountnumber =$_POST['accountnumber'];
    $ifsc =$_POST['ifsc'];
    $bankadd =$_POST['bankaddress'];
    $statename =$_POST['state'];
    $statecode =$_POST['statecode'];
    $logoimg =$_FILES["logoimage"]["name"];
    $signimg =$_FILES["signimg"]["name"];

    // Check whether submitted data is not empty 
    if(!empty($_POST["firmname"])){ 
        // Validate category name 
       if(($_POST["firmname"]) == ''){
        $errors ='Fill All The Required Fields';
       echo json_encode($errors);
        die();
         }else{ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["logoimage"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["logoimage"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["logoimage"]["tmp_name"], $targetFilePath)){ 
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
            //Upload Files For Signture
            $uploadedFileSign = ''; 
            if(!empty($_FILES["signimg"]["name"])){ 
                // File path config 
                $fileNameSign = basename($_FILES["signimg"]["name"]); 
                $targetFilePathSign = $uploadDir . $fileNameSign; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["signimg"]["tmp_name"], $targetFilePathSign)){ 
                        $uploadedFileSign = $fileNameSign; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
                } 
            } 
            //Upload Files For Signture close
             
            if($uploadStatus == 1){ 
                // Include the database config file 
                include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
                $db = new Database();
                $conn = $db->connect();
                 
                // Insert form data in the database 
                $sqlQ = "INSERT INTO firm (name,gstin,address,fssai,mobile,bank_name,account_number,ifsc,bank_address,logo,signature_image,email,state,state_code) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("ssssssssssssss", $firmname,$gstin,$address,$fssai,$mobile,$bankname,$accountnumber,$ifsc,$bankadd,$uploadedFile,$uploadedFileSign,$email,$statename,$statecode); 
                $insert = $stmt->execute(); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['message'] = 'Form data submitted successfully!'; 
                } 
            } 
        } 
    }else{ 
         $response['message'] = 'Please fill all the mandatory fields'; 
    } 
} 
 
// Return response 
echo json_encode($response);
?>