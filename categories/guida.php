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

   
}
?>

<?php
function show_days($day){
    echo '<ul class="list">';
    echo '<li><form action="guida.php" method="POST">';
    echo '<input type="hidden" name="day" value="' . $day . '">';
    echo '<input type="submit" name="' . $day . '" value="' . 
    $day . '">';
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
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
      <div style="margin-bottom:130px; width:400px">
        <div style="width:300px; position:relative; top:215px;
         left:100px;">
            <img src='<?php echo $row['URL'];?>' 
            style='width: 100%; border-radius:7px;'>
        </div>
       
       <div style="display: inline-block; position:relative;
        top:215px; left:100px; width:300px;">
       <label >Time:</label><span style="margin-right:4px"><?php echo $row['time']?>
       </span><br><br>
       <p style=><?php echo
        $row['description']?></p>
       </div>
       
      
    </div>
       
        <?php
       
    }
?>
    </div>
</body>
</html>
