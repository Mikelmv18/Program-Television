<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['add']) && isset($_POST['category'])) { 
  
  require('../connection/connect.php');

  
    
    if(empty($_POST['category'])){
      require('../admin/categories.php');
      echo '<span style="position:absolute; top: 320px; right:44%; 
      color:red; background-color: #ffcccc; padding: 3px 7px; 
      border-radius: 5px; font-weight:bolder">
      Do not leave empty fields!</span>';

      
    }
    else{
    $category = trim(mysqli_real_escape_string
    ($conn, $_POST['category']));
   
    $insertQuery = "INSERT INTO category (type) VALUES (?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("s",$category);
    $insertStmt->execute();
    $insertStmt->close();
    $conn->close();

    header('location:../admin/categories.php');
    }
  }
 else {
  echo "Submit the form";
}
?>
