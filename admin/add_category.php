<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['add'])) { 
  
  require('../connection/connect.php');

  if(isset($_POST['category'])) {
    
    
    $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
   
    $insertQuery = "INSERT INTO category (type) VALUES (?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("s",$category);
    $insertStmt->execute();
    $insertStmt->close();
    $conn->close();

    header('location:../admin/categories.php');
  }
} else {
  echo "Submit the form";
}
?>
