<?php
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>location.href = 
    '../registration/form.php'</script>";
    exit();
    
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../connection/connect.php");

$query = "SELECT * FROM category";

// Check if the query was successfully prepared
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($category_id, $category);
} else {
    // Handle the case where the query preparation fails
    die("Error preparing the query: " . $conn->error);
}
?>

<?php
require('../HomePage/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="../adminstyling/categories.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

   <div class="table-form">
    <form action="add_category.php" method="post">
        <input type="text" name="category" placeholder="Add category" 
        class="text">
        <input type="submit" name="add" value="Add" class="success">
    </form>
  </div>

   
    <div class="table">

        <table>
            <tr>
                <th>Category ID</th>
                <th>Category</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
            if ($stmt) {
                while ($stmt->fetch()) {
                    ?>
                    
                    <tr>
                        
                    <td><?php echo $category_id; ?></td>
                    <td><?php echo $category; ?></td>
                    <td>
                    <a href="../admin/edit_category.php?id=
                    <?php echo $category_id; ?>" class="edit">Edit</a>
                    </td>
                    <td>
                    <a href="../admin/delete_category.php?id=
                    <?php echo $category_id; ?>" class="delete">Delete</a>
                    </td>
                    
                </tr>
                <?php 
                }
            }
            ?>
        </table>
     </div>
</body>
</html>
