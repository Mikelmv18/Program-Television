<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['sub'])){ 
  
  require('../connection/connect.php');

  if(isset($_POST['URL']) && isset($_POST['description']) && 
   isset($_POST['category_id'])) {
    
    $URL = trim(mysqli_real_escape_string($conn, $_POST['URL']));
    $description = trim(mysqli_real_escape_string($conn, $_POST['description']));
    $category_id = trim(mysqli_real_escape_string($conn, $_POST['category_id']));
    $URL_type = trim(mysqli_real_escape_string($conn, $_POST['URL-type']));
  
     
    if(empty($URL) || empty($description) || empty($category_id)) {
       
        echo "Fill all the required fields";
        exit();
    }

    $insertQuery = "INSERT INTO content (URL, description, category_id, 
    URL_type) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssis", $URL, $description, $category_id, 
    $URL_type);
    $insertStmt->execute();
    $insertStmt->close();
    

   
 
  }

    header('location:../HomePage/home.php');
  }
 else {
  echo "Submit the form";
}


?>
