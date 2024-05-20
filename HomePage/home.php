<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../registration/form.php');
    exit();
}
?>

<?php
require('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Display</title>
    <link rel="stylesheet" href="../adminstyling/categories.css">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div style='display: grid; grid-template-columns: 1fr 1fr 1fr; margin-left: 20px;'>

    <?php
    require('../connection/connect.php');
    
    $query = mysqli_query($conn, "SELECT * FROM `content`");
    
    while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <div style='width: 400px; margin-left:90px; margin-top:40px; margin-bottom:35px; overflow: auto;'>
            <?php
            if ($row['URL_type'] == 'Image') {
                ?>
                <div style="width:400px">
                    <img src='<?php echo $row['URL']; ?>' style='width: 100%; border-radius:7px;'>
                </div>
            <?php
            } elseif ($row['URL_type'] == 'Video') {
                ?>
                <div style="width:400px">
                 <video style='width: 100%; border-radius:7px;' controls>
                    <source src='<?php echo $row['URL']; ?>' type='video/mp4'>
                    Your browser does not support the video tag.
                 </video>
                </div>
            <?php
            }
            ?>

            <p style='display: inline-block;'><?php echo $row['description']; ?></p>
            <br>
            <div class="admin-permission">
            <a href="../admin/edit.php?id=<?php echo $row['id']; ?>
            " class="edit">
            <i class="fas fa-edit"></i></a>
            <a href="../admin/delete.php?id=<?php echo $row['id']; 
            ?>" class="delete">
            <i class="fas fa-trash-alt"></i></a>
            <a href="../admin/admin_guida.php?id=<?php echo $row['id']; ?>"
            class="add-guida">Add guida</a>
        </div>
        </div>
    <?php
    }
    ?>
</div>
</body>
</html>
