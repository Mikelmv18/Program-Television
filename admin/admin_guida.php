<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>location.href = '../registration/form.php'
    </script>";
    exit();
}

require('../HomePage/navbar.php');

require('../connection/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['submit'])) {

 if (isset($_POST['days']) && isset(($_POST['times'])) && 
     isset($_GET['id'])) {
        
        $selected_days = $_POST['days'];
        $selected_times = $_POST['times'];
        $id = $_GET['id'];

        $times = array();

        for ($i = 0; $i < count($selected_times); $i++){
            if(!empty($selected_times[$i])){
                array_push($times,$selected_times[$i]);
            }
        }
       
        
      for ($i = 0; $i < count($times); $i++) {
            $time = trim($times[$i]);
            $contentId = $id;
            $day = $selected_days[$i];
          
           if (!empty($day) && !empty($time)) {
                $insertQuery = "INSERT INTO guida (day, time, 
                content_id) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ssi", $day, $time, 
                $contentId);
                $insertStmt->execute();
                $insertStmt->close();
            }
        }
    } 
    else {

        echo '<div class="error-message">
            Do not leave empty fields.
            </div>';
    }
    
}

?>

<?php

$query = "SELECT id,day,time FROM guida WHERE content_id='$id'";

// Check if the query was successfully prepared
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($guide_id,$day,$time);
} else {
    // Handle the case where the query preparation fails
    die("Error preparing the query: " . $conn->error);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Basic MySQLi Commands</title>
    <link rel="stylesheet" href="../adminstyling/guida.css">
</head>
<body>

<form action="admin_guida.php?id=<?php echo $id?>" method="POST">
    <h2>
        Add guides
    </h2>
    <?php
    $daysArray = array("Monday", "Tuesday", "Wednesday", "Thursday", 
    "Friday", "Saturday", "Sunday");
         
     foreach ($daysArray as $day) {
        build_guida_form($day);
    }

    ?>
    <input class="sub-btn" type="submit" name="submit" 
    value="Add guide">
   
</form>
<input type="button" value="Back" onclick="redirectToHomePage()"
style="position:fixed; top:0; left:0">

    <!-- Include jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">

    </script>
    <script>
        function redirectToHomePage() {
            window.location.href = "../HomePage/home.php";
        }
    </script>

<?php
function build_guida_form($day){
    echo '<div class="guida-form">';
    echo '<label>' . $day . '</label>';
    echo '<input type="checkbox" name="days[]" value="' . $day . '">';
    echo '<input type="text" name="times[]" placeholder="hh:mm">'; 
    echo '</div>';
}
?>

<div class="table">

    <table>
        
        <tr>
            <th>Day</th>
            <th>Time</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php
        
        if ($stmt) {
            
            while ($stmt->fetch()) {
                ?>
                
                <tr>
                    
                <td><?php echo $day; ?></td>
                <td><?php echo $time; ?></td>
               
              
                
                <td><a href="../admin/edit_guida.php?id=
                <?php echo $guide_id; ?>"class="edit">Edit</a> </td>
                
                <td><a href="../admin/delete_guida.php?id=
                <?php echo $guide_id; ?>" class="delete"> Delete</a>
                
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
