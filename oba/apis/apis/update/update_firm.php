<?php 
// File upload folder 
$uploadDir = '../../pages/admin/uploads/'; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
if(isset($_POST['firmeditid']) ||isset($_POST['firmnameedit']) || isset($_POST['gstinedit']) || isset($_POST['addressedit']) || isset($_POST['fssaiedit']) || isset($_POST['mobileedit'])|| isset($_POST['emailedit'])|| isset($_POST['banknameedit'])|| isset($_POST['accountnumberedit'])||isset($_POST['ifscedit'])|| isset($_POST['bankaddressedit'])|| isset($_POST['stateedit'])|| isset($_POST['statecodeedit'])||isset($_FILES["logoimageedit"]["name"])||isset($_FILES["signimgedit"]["name"]) || isset($_POST['logoimgold']) || isset($_POST['signimgold']) ){ 
    // Get the submitted form data 
    $firm_edit_id =$_POST['firmeditid'];
    $firmname_edit = $_POST['firmnameedit']; 
    $gstin_edit = $_POST['gstinedit']; 
    $address_edit =$_POST['addressedit'];
    $fssai_edit =$_POST['fssaiedit'];
    $mobile_edit =$_POST['mobileedit'];
    $email_edit =$_POST['emailedit'];
    $bankname_edit =$_POST['banknameedit'];
    $accountnumber_edit =$_POST['accountnumberedit'];
    $ifsc_edit =$_POST['ifscedit'];
    $bankadd_edit =$_POST['bankaddressedit'];
    $statename_edit =$_POST['stateedit'];
    $statecode_edit =$_POST['statecodeedit'];
    $logoimg_edit =$_FILES["logoimageedit"]["name"];
    $signimg_edit =$_FILES["signimgedit"]["name"];
    $logo_old_img = $_POST['logoimgold'];
    $sign_old_img = $_POST['signimgold'];
    $uploadStatus = 1;
    if($logoimg_edit != ""){
        $update_filename_logo = $_FILES["logoimageedit"]["name"];

        $uploadStatus = 1; 

        }else{

        $update_filename_logo= $logo_old_img ;
        $uploadStatus = 1; 

        }
        if($signimg_edit != ""){
            $update_filename_sign = $_FILES["signimgedit"]["name"];
    
            $uploadStatus = 1; 
    
            }else{
    
            $update_filename_sign= $sign_old_img;
            $uploadStatus = 1; 
    
            }
    // Check whether submitted data is not empty 
    if(!empty($_POST["firmnameedit"])){ 
        // Validate category name 
       if(($_POST["firmnameedit"]) == ''){
        $errors ='Fill All The Required Fields';
       echo json_encode($errors);
        die();
         }else{ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["logoimageedit"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["logoimageedit"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["logoimageedit"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                        unlink("../../pages/admin/uploads/".$logo_old_img);
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
            if(!empty($_FILES["signimgedit"]["name"])){ 
                // File path config 
                $fileNameSign = basename($_FILES["signimgedit"]["name"]); 
                $targetFilePathSign = $uploadDir . $fileNameSign; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["signimgedit"]["tmp_name"], $targetFilePathSign)){ 
                        $uploadedFileSign = $fileNameSign; 
                        unlink("../../pages/admin/uploads/".$sign_old_img);

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
                include('../../common/database.php');
                $db = new Database();
                $conn = $db->connect();
                 
                // Insert form data in the database 
                $sqlQ = "UPDATE  firm SET name = ? , gstin =? ,address = ?,fssai = ?,mobile = ?,bank_name = ?,account_number = ? ,ifsc = ?,bank_address = ?,logo = ?,signature_image = ?,email = ?,state = ?,state_code = ? WHERE id = ?"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("ssssssssssssssi", $firmname_edit,$gstin_edit,$address_edit,$fssai_edit,$mobile_edit,$bankname_edit,$accountnumber_edit,$ifsc_edit,$bankadd_edit,$update_filename_logo,$update_filename_sign,$email_edit,$statename_edit,$statecode_edit,$firm_edit_id); 
                $insert = $stmt->execute(); 
                $id = $stmt->affected_rows;
                if($id){ 
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