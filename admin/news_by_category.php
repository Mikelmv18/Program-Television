<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../registration/form.php');
    exit();
}

include('../connection/connect.php');

if (isset($_GET['category'])) {
    $selectedCategory = trim(mysqli_real_escape_string($conn, $_GET['category']));

    $query = "SELECT * FROM content, category WHERE 
    content.category_id = category.id AND 
    category.type = '$selectedCategory'";
    $result = mysqli_query($conn, $query);

    require('../HomePage/navbar.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Content by Category</title>
        <link rel="stylesheet" href="../homestyling/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
  <div class="main-content">
   <div class="grid-page">
     <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="grid">
                    <div style="width:100%; margin-bottom:10px;">
                        <img src='<?php echo $row['URL']; ?>' style='width: 100%; border-radius:7px;'>
                    </div>
                    <h1><?php echo $row['title']; ?></h1><br>
                    <p style="font-size:18px;"><?php echo $row['description']; ?></p>
                    
                </div>
                <?php
            }
            } else {
                echo '<div class="empty-search"><h1>No content found</h1></div>';
            }
            ?>
        </div>
    </div>
    <?php
    require('../HomePage/footer.php');
    ?>
    </body>
    </html>
    <?php
}
?>
