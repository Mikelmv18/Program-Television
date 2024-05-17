<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>location.href = 
    '/Television/registration/form.php'</script>";
	exit();
}
require('../connection/connect.php');

if(isset($_GET['id'])){
	
	$id = $_GET['id'];

	$query = "SELECT * FROM content where id = '$id'";
	$result = mysqli_query($conn,$query);

	if(!$result){
		die("query failed".mysqli_error());
	}

	else{
		$row = mysqli_fetch_assoc($result);
	}
	
}
?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../connection/connect.php");

$query = "SELECT id, type FROM category";

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

require_once('../connection/connect.php');

if(isset($_POST['submit-news'])){
	
	$id_new = "";
    
	if(isset($_GET['id_new'])){
        $id_new = $_GET['id_new'];
    }
    $URL = trim(mysqli_real_escape_string($conn,$_POST['URL']));
    $description = trim(mysqli_real_escape_string($conn,$_POST['description']));
    $category = $_POST['category'];
	
    $query = "UPDATE `content` SET `URL`='$URL', `description`='$description', 
	`category_id`='$category'
	WHERE `id`='$id_new'";

    $result = mysqli_query($conn,$query);
	

    if(!$result){
        die("query failed".mysqli_error());
    }
    else{
		var_dump($_POST);
        header('location:../HomePage/home.php');
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
<link rel="stylesheet" href="../adminstyling/edit.css">
</head>
<body>
	
 <div class="edit-form">
	
		<form action="edit.php?id_new=<?php echo $id; ?>" 
		method="POST">

		<h2 style="display:flex;justify-content:center">Edit</h2>
		    
        <label style="margin-left:10px;font-size:14px;
		font-family:Arial;font-weight:bold;">URL</label><br>
		<input type="text" value="<?php echo $row['URL'] ?>" 
			name="URL" class="fields" id="link"><br><br>
		
        <label style="margin-left:10px;font-size:14px;
		font-family:Arial;font-weight:bold;">Description</label><br>
		<textarea rows="25" cols="35"
			name="description" class="fields"
			style="overflow:scroll"><?php echo $row['description'] ?>
			</textarea>
			<br>

	<select name="category" class="category-dropdown"style="width: 150px; border-radius: 10px; 
     margin-bottom: 20px; height: 30px">
        
        <?php
        
        if ($stmt) {
            while ($stmt->fetch()) {
                echo "<option value='$category_id'>$category</option>";
            }
        }
        ?>
    </select><br>
		

		<div>
			<input type="submit" name="submit-news" value="Update" 
			class="sub-btn">
		</div>
		</form>
	</div>
</body>
</html>