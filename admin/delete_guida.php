<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require('../connection/connect.php');

if (!isset($_SESSION['username'])) {
    header('Location: ../registration/form.php');
    exit();
}

if(isset($_GET['id'])){
    
	$guideId = $_GET['id'];
    
    // Retrieve the content_id associated with the guide
    $query = "SELECT content_id FROM guida WHERE id='$guideId'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        $contentId = $row['content_id'];
        
        // Delete the guide
        $deleteQuery = "DELETE FROM guida WHERE id='$guideId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        
        if (!$deleteResult) {
            die("Delete query failed: " . mysqli_error($conn));
        } else {
            // Redirect back to admin_guida.php with content_id
            header("location:../admin/admin_guida.php?id=$contentId");
            exit();
        }
    }
} else {
    echo "Guide ID not provided.";
}
?>
