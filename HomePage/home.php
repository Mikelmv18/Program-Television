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

<div style='display: grid; grid-template-columns: 1fr 1fr 1fr; 
margin-left: 20px;'>

    <?php
   
    require('../connection/connect.php');
    
    $query = mysqli_query($conn, "SELECT * FROM `content`");
    
    while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <div style='width: 400px; margin-left:90px; 
        margin-top:40px; margin-bottom:35px; overflow: auto;'>
            <?php
            if ($row['URL_type'] == 'Image') {
                ?>
                <div style="width:400px">
                    <img src='<?php echo $row['URL']; ?>' 
                    style='width: 100%; border-radius:7px;'>
                </div>
            <?php
            } elseif ($row['URL_type'] == 'Video') {
                ?>
                <div style="width:400px">
                 <video style='width: 100%; border-radius:7px;' autoplay muted>
                    <source src='https://www.youtube.com/embed/CRlGDDprdOQ'>
                    
                 </video>
                </div>
            <?php
            }
            ?>

            <p style='display: inline-block;'>
            <?php echo $row['description']; ?></p>
            <br>
            <a href="../admin/edit.php?id=<?php echo $row['id']; ?>">
            Edit</a>
            <a href="../admin/delete.php?id=<?php echo $row['id']; ?>">
            Delete</a>
            <a href="../admin/admin_guida.php?id=<?php echo $row['id']; ?>">
            Add guida</a>

        
        </div>
    <?php
    }
?>

</div>
</body>
</html>
