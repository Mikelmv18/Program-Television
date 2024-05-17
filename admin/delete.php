<?php
include('../connection/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($conn, "DELETE FROM `content` WHERE 
	`id`='$id'");

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        // Redirect to home.php after successful deletion
        header("Location: ../HomePage/home.php");
        exit();
    }
} else {
    // Redirect to home.php if ID is not set
    header("Location: ../HomePage/home.php");
    exit();
}
?>
