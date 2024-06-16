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
    <link rel="stylesheet" href="../homestyling/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="main-content">
    <div class="grid-page">
        <?php
        require('../connection/connect.php');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $isSearch = isset($_POST["submit"]);
        $searchResults = [];

        if ($isSearch) {
            $str = $_POST["search"];
            $sth = $conn->prepare("SELECT * FROM `content` 
            WHERE title LIKE ? OR description LIKE ?");
            $searchStr = "%" . $str . "%";
            $sth->bind_param("ss", $searchStr, $searchStr);
            $sth->execute();
            $result = $sth->get_result();
            $searchResults = $result->fetch_all(MYSQLI_ASSOC);
        }

        if (!$isSearch) {
            $query = "SELECT * FROM `content`";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Error executing query: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        }
        ?>

        <!-- Search Form -->
        <form method="post" class="search-form">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" name="submit" style="padding:5px; cursor:pointer;">
            <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <!-- Display Results -->
        <?php
        if ($isSearch && empty($searchResults)) {
            echo '<div class="empty-search">
            <h1>Search not found</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/61/61088.png" style="width:70px; margin-left:20px;">
            </div>';
        } else {
            $count = 0;
            shuffle($searchResults);

            foreach ($searchResults as $row) {
                if ($count < 12) { // Limit to 12 contents
                    ?>
                <div class="grid">
                    <div style="width:100%; margin-bottom:10px;">
                        <img src='<?php echo $row['URL']; ?>' 
                        style='width: 100%; border-radius:7px;'>
                    </div>
                    
                    <h1><?php echo $row['title']; ?></h1><br>
                    <p style="font-size:18px;">
                    <?php echo $row['description']; ?></p>
                    
                    <?php
                    if ($_SESSION['username'] == 'mikel' && $_SESSION['password'] == 'mikelmikel') {
                    ?>
                    <div class="admin-permission" style="margin-top:10px;">
                        <a href="../admin/edit.php?id=<?php echo $row['id']; ?>" class="edit">
                        <i class="fas fa-edit"></i></a>
                        <a href="../admin/delete.php?id=<?php echo $row['id']; ?>" class="delete"><i class="fas fa-trash-alt"></i></a>
                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                $count++;
            } else {
                break; // Stop loop after 12 contents
            }
            }
        }
        ?>
    </div>
</div>

<?php
require('../HomePage/footer.php');
?>

</body>
</html>
