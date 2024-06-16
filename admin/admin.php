<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>location.href = '../registration/form.php'</script>";
    exit(); // Add an exit after redirecting
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../connection/connect.php");

$query = "SELECT id, type FROM category";

// Check if the query was successfully prepared
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $category);
} else {
    // Handle the case where the query preparation fails
    die("Error preparing the query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="../homestyling/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

<?php
require('../HomePage/navbar.php');
?>
<div class="admin-style">

    <div class="form">

    <form class="admin-form" action="adminprocess.php" method="POST">
        
        <h1>Welcome Admin!</h1>
          
        <input class="url-field" type="text" name="URL"
            placeholder="Image URL/Address" style="width:290px; 
            border-radius:4px" required>
        

         <div class="schedule"><br>
        
        </div> 
        
     <label>Title</label>
     <input type="text" name="title" style="width:500px; height:100px" required><br><br>

        <label>Description</label><br>
        <textarea rows="25" cols="55" name="description" 
        class="fields" style="margin-bottom:20px;overflow:scroll" required>
        </textarea><br>

        
        <select name="category_id" style="width: 150px; border-radius: 10px;
         margin-bottom: 20px; height: 30px">

            <?php

            if ($stmt) {
                while ($stmt->fetch()) {
                    echo "<option value='$id'>$category</option>";
                }
            }

            ?>
        </select><br>
        <input type="submit" name="sub" value='Submit'
                style="padding:4px;border-radius:6px; 
                border-color: rgb(204, 197, 197);">
    </form>
    </div>
</div>

</body>
</html>
