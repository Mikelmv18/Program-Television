<?php
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>location.href = 
    '../registration/form.php'</script>";
    exit();
}

include('../connection/connect.php');


if (isset($_GET['category'])) {
    
    $selectedCategory =trim(mysqli_real_escape_string($conn, 
    $_GET['category']));

    
    $query = "SELECT * FROM content, category
    WHERE content.category_id = category.id 
    AND category.type = '$selectedCategory'";

   
    $result = mysqli_query($conn, $query);

    require('../HomePage/navbar.php');
    ?>
    <div style='display: grid; grid-template-columns: 1fr 1fr 1fr; margin-left: 20px;'>
    <?php   
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            
            ?>
            <div style='width: 300px; margin-left:90px; margin-top:40px; 
            margin-bottom:35px'>
                <div>
                    <img src='<?php echo $row['URL']; ?>' 
                    style='width: 100%; border-radius:7px;'>
                </div>
                <div>
                    <p style='display: inline-block;'>
                        <?php echo $row['description']; ?>
                    </p>
                </div>
            </div>
<?php
        }
    } 
}
?>
</div>