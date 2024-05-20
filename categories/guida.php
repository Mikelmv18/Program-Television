<?php
require('../connection/connect.php');

if (isset($_POST['day'])) {
    $day_of_week = $_POST['day']; 

    $query = "SELECT content.URL, content.description, guida.time 
    FROM content 
    INNER JOIN guida ON content.id = guida.content_id 
    WHERE guida.day = '$day_of_week'
    ORDER BY STR_TO_DATE(guida.time, '%h:%i %p') DESC"; 

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo '<div style="position:absolute; top:450px; 
            left:660px; display: flex; 
            align-items: center;">
            <h1>No programs available this day</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/61/61088.png" 
            style="width:70px; margin-left:20px;">
            </div>';
        }
    }
}
?>

<?php
function show_days($day){
    echo '<ul class="list">';
    echo '<li><form action="guida.php" method="POST">';
    echo '<input class="day" type="hidden" name="day" value="' . $day . '">';
    echo '<input type="submit" name="' . $day . '" value="' . $day . '">';
    echo '</form></li>';
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Slider</title>
<link rel="stylesheet" href="../adminstyling/guida.css">
</head>
<body>
    <div class="days">
        <?php
        require_once('../HomePage/navbar.php');
        
        $days_array = array("Monday", "Tuesday", "Wednesday", 
        "Thursday", "Friday", "Saturday", "Sunday");
        
        foreach($days_array as $day){
            show_days($day);
        }
        ?>
        
        <div style='display: grid; grid-template-columns: 1fr; 
        margin-left:700px; margin-top:-140px;'>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div style="margin-bottom:130px; width:400px;">
                    <div style="width:300px; position:relative; 
                    top:215px; left:40px;">
                        <img src='<?php echo $row['URL']; ?>' 
                        style='width: 400px; border-radius:7px;'>
                    </div>
                    
                    <div style="display: inline-block; position:relative; top:215px; 
                    left:50px; width:100%;">
                        <label>Time:</label><span>
                        <?php echo $row['time']; ?></span><br><br>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
    </div>
</body>
</html>
