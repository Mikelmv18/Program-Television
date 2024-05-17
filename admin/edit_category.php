<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../connection/connect.php');

if(isset($_GET['id'])){
	
	$id=$_GET['id'];

	$query = "SELECT * FROM category where id = '$id'";
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
  if(isset($_POST['update'])){

	if(isset($_GET['id_new'])){
		$idnew = $_GET['id_new'];
	}
	
	$type = trim(mysqli_real_escape_string($conn,($_POST['type'])));


	$query = "UPDATE `category` set `type`='$type'
	WHERE `id`='$idnew' ";

	$result = mysqli_query($conn,$query);

	if($result){
		header('location:../admin/categories.php');
	}

	
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
<link rel="stylesheet" href="../adminstyling/edit.css">
</head>
<body style="background-color:white">
    
	<div class="edit-category">
	
	<form action="edit_category.php?id_new=<?php echo $id; ?>"
     method="POST">
		
		<h2 style="display:flex; align-items:center; 
		justify-content:center; margin-top:350px;
		">Edit</h2>
        
		<label style="margin-right:6px">Category</label><input type="text" 
		value="<?php echo $row['type'] ?>" name="type"><br>
		
        <input type="submit" class="update-category-btn" name="update" 
		value="Update">
		
	</form>
  </div>

</body>
</html>