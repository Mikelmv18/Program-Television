<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../connection/connect.php');

$error = ''; // Initialize an empty error message

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM guida WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed: " . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if(isset($_POST['update'])){
	error_reporting(E_ALL);
ini_set('display_errors', 1);
    
	if(isset($_GET['id']) && isset($_POST['day']) && 
	isset($_POST['time'])){
        
		$guideId = $_GET['id'];
        
        // Retrieve the content_id associated with the guide
        $query = "SELECT content_id FROM guida WHERE id='$guideId'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $contentId = $row['content_id'];
        
        $day = trim(mysqli_real_escape_string($conn, $_POST['day']));
        $time = trim(mysqli_real_escape_string($conn, $_POST['time']));
	

        // Validate the time format (hh:mm)
    
		$query = "UPDATE `guida` SET `day`='$day', 
		`time`='$time'
		WHERE `id`='$guideId'";
		
		$result2 = mysqli_query($conn, $query);

		if($result2){
			header("location:../admin/admin_guida.php?id=$contentId");
			exit();
            
        }
    }
}
?>

<?php
$guideId = $_GET['id'];
$query = "SELECT day from `guida` WHERE `id`='$guideId'";
$result = mysqli_query($conn, $query);
$day = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Basic MySQLi Commands</title>
<link rel="stylesheet" href="../adminstyling/edit.css">
</head>
<body style="background-color:white">
    
<div class="edit-category">
    <form action="edit_guida.php?id=<?php echo $id; ?>" 
	method="POST">
       
	   <h2 style="display:flex; align-items:center; 
		justify-content:center; margin-top:350px;
		position:relative; right:40px">Edit</h2><br>
       
	   <label style="margin-right:6px">Day</label>
	   
	    <select name="day">
		
		<option value="<?php echo $day['day']?>"><?php echo 
		$day['day']?></option>
		
		<?php
		// Array of days
		$daysArray = array("Monday", "Tuesday", "Wednesday", 
		"Thursday", "Friday", "Saturday", "Sunday");

		// Generate options for days of the week
		foreach ($daysArray as $days) {
			if($days != $day['day']){
			echo "<option value='{$days}'>{$days}</option>";
			}
		}
		?>
		
		</select></br></br>

		<label style="margin-right:6px">Time</label>
		<input type="text" value="<?php echo $row['time'] ?>" 
		name="time" placeholder="hh:mm"></br></br>

		
		<input type="submit" class="update-category-btn" 
		name="update" value="Update"
		style="position:relative; top:10px">
    
	</form>
	
	
</div>
<?php
	if ($error) {
		echo "<p style='color: red;'>$error</p>";
	}
	?>
</body>
</html>
