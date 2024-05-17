<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="../homestyling/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../HomePage/home.php">
                Home</a></li>
            <li><a href="../categories/programs.php">
                Program</a></li>
            <li>
        <a href="#">Kategorite ▾</a>
        
        <ul class="dropdown">
            
            <?php
           
            require_once('../connection/connect.php');
            $query = mysqli_query($conn, "SELECT DISTINCT 
            category.type FROM `category`,`content` 
            WHERE category.id = content.category_id ");
            
            while ($row = mysqli_fetch_assoc($query))
             {
                
                $category = $row['type'];
                ?>
                <li>
                    <a href="../admin/news_by_category.php?
                    category=<?php echo urlencode($category); ?>">
                        <?php echo $category; ?>
                    </a>
                 
                </li>
                <?php
            }
            ?>
        </ul>
        </li>
            <li><a href="#">Serialet</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="../categories/guida.php">Guida Tv</a></li>
            <li><a href="/Television/admin/admin.php">Admin</a></li>
            <li><a href="/Television/admin/categories.php">Kategorite</a></li>
            <a  href="/Television/registration/logout.php" class="logout-btn">
            <input type="button" value="Logout" name="logout"
            style="border-radius:10px; padding:4px;
            box-shadow:5px 5px 9px  #6d30e9; background-color:#6A5ACD;
             color: white; position:absolute; top:3px; right:1px;
             border:none;
            "></a>
        </ul>
        
    </nav>
