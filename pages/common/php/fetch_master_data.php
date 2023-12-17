<?php
$db = new Database();
$conn = $db->connect();
   
   $quary ="SELECT id,name FROM category";
   $stmt = $conn->prepare($quary);
   $stmt->execute();
   $stmt->bind_result($id,$name);
   $options = "";
   $options_edit ="";
   while($stmt->fetch()){
       $options .="<option value='$id'>$name</option>";
       $options_edit .="<option value='$id' selected>$name</option>";

     }
   $quary_unit ="SELECT id,name FROM units";
   $stmt = $conn->prepare($quary_unit);
   $stmt->execute();
   $stmt->bind_result($id,$name);
   $options_unit = "";
   $options_edit_unit ="";
   while($stmt->fetch()){
       $options_unit .="<option value='$id'>$name</option>";
       $options_edit_unit .="<option value='$id' selected>$name</option>";

     }
   $quary_firm ="SELECT id,name FROM firm";
   $stmt = $conn->prepare($quary_firm);
   $stmt->execute();
   $stmt->bind_result($id,$name);
   $options_firm = "";
   $options_edit_firm ="";
   while($stmt->fetch()){
       $options_firm .="<option value='$id'>$name</option>";
       $options_edit_firm .="<option value='$id' selected>$name</option>";

     }

     ?>