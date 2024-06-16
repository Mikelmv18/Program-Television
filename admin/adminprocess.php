<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['sub'])){ 
  
  require('../connection/connect.php');

  if(isset($_POST['URL']) && isset($_POST['description']) && 
   isset($_POST['category_id']) && isset($_POST['title'])) {
    
    $URL = trim(mysqli_real_escape_string($conn, $_POST['URL']));
    $URL = htmlspecialchars($URL);
    
    $title = trim(mysqli_real_escape_string($conn, 
    $_POST['title']));
    $title = htmlspecialchars($title);

    $description = trim(mysqli_real_escape_string($conn, 
    $_POST['description']));
    $description = htmlspecialchars($description);
    
    $category_id = trim(mysqli_real_escape_string($conn, 
    $_POST['category_id']));
    $category_id = htmlspecialchars($category_id);
    

    
    $insertQuery = "INSERT INTO content (URL, title,
    description,category_id) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssis", $URL, $title, $description,
    $category_id);
    $insertStmt->execute();
    $insertStmt->close();
    
  }
  
}

    header('location:../HomePage/home.php');
  



?>
