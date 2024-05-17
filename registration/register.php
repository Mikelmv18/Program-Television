<?php

if(isset($_POST['sub'])){
  
  require('../connection/connect.php');
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  

  $query = "SELECT * FROM user WHERE username=? and password=?";
  $stmt = $conn->prepare($query);

  if ($stmt) {

  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows != 0) {
    require('../registration/registerform.php');
    echo "<p style= 'color:red; margin-left:10px;'>
    This user already exists</p>";

  } else {
    
   
    $insertQuery = "INSERT INTO user (username, password) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ss", $username, $password);
    $insertStmt->execute();
    require("../registration/form.php");
   
  }
  } else {
  echo "Error preparing statement: " . $conn->error;
  }

  $conn->close();

}





?>

