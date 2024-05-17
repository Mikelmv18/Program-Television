<?php
 include('../connection/connect.php');
 
 if(isset($_GET['id'])){
	$id = $_GET['id'];
	$result = mysqli_query($conn,"delete from `category` where `id`='$id'");

	if(!$result){
		die("Query failed".mysqli_error());
	}
	else{
		header('location:../admin/categories.php');
    }
 }
    
?>