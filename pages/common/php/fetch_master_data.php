<?php
$db = new Database();
$conn = $db->connect();

function loadCategory()
{
  global $conn;
  $id = "";
  $name = "";
  $query = "SELECT id,name FROM category";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->bind_result($id, $name);
  $options = "";
  $options_edit = "";
  while ($stmt->fetch()) {
    $options .= "<option value='$id'>$name</option>";
    $options_edit .= "<option value='$id' selected>$name</option>";
  }
  return $options_edit;
}
function loadUnits()
{
  global $conn;
  $id = "";
  $name = "";

  $query_unit = "SELECT id,name FROM units";
  $stmt = $conn->prepare($query_unit);
  $stmt->execute();
  $stmt->bind_result($id, $name);
  $options_unit = "";
  $options_edit_unit = "";
  while ($stmt->fetch()) {
    $options_unit .= "<option value='$id'>$name</option>";
    $options_edit_unit .= "<option value='$id' selected>$name</option>";
  }
  return $options_edit_unit;
}

function loadFirms()
{
  global $conn;
  $id = "";
  $name = "";

  $query_firm = "SELECT id,name FROM firm";
  $stmt = $conn->prepare($query_firm);
  $stmt->execute();
  $stmt->bind_result($id, $name);
  $options_firm = "";
  $options_edit_firm = "";
  while ($stmt->fetch()) {
    $options_firm .= "<option value='$id'>$name</option>";
    $options_edit_firm .= "<option value='$id' selected>$name</option>";
  }
  return $options_edit_firm;
}

function loadState(){
  global $conn;
  $id = "";
  $state = "";

  $query ="SELECT id,state FROM state";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->bind_result($id,$state);
  $options = "";
  $selected = "";
  while($stmt->fetch()){
      $selected = ($state === 'UP') ? 'selected': '' ;
      $options .="<option value='$id' $selected>$state</option>";
      }

      return $options;
}

function loadCity(){
  global $conn;
  $id = "";
  $cityname = "";

  $querycity ="SELECT id,name FROM city";
    $stmt = $conn->prepare($querycity);
    $stmt->execute();
    $stmt->bind_result($id,$cityname);
    $options_city = '<option selected style="text-align: center;" value="">Select City</option>';
    
    while($stmt->fetch()){
      
        $options_city .="<option value='$id' >$cityname</option>";
    
      }
      return $options_city;
}
