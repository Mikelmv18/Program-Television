<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session and check if user is logged in
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>location.href = '../registration/form.php'</script>";
    exit();
}

require('../connection/connect.php');

// Check if id is set in GET parameters and sanitize it
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Use intval to sanitize

    // Fetch the content by ID
    $query = "SELECT * FROM content WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            die("No content found with the given ID.");
        }
    }
}

// Fetch categories
$query = "SELECT id, type FROM category";
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($category_id, $category);
} else {
    die("Error preparing the query: " . $conn->error);
}
?>

<?php
// Handle the form submission for updating content
if (isset($_POST['submit-news'])) {
    $id_new = intval($_GET['id_new']);
    $URL = trim(mysqli_real_escape_string($conn, $_POST['URL']));
    $description = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['description'])));
    $category = intval($_POST['category']);
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));

    $query = "UPDATE `content` SET 
                `URL` = '$URL', 
                `title` = '$title',
                `description` = '$description', 
                `category_id` = '$category' WHERE `id` = '$id_new'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header('Location: ../HomePage/home.php');
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
    <link rel="stylesheet" href="../adminstyling/edit.css">
</head>
<body>
    <div class="edit-form">
        <form action="edit.php?id_new=<?php echo $id; ?>" method="POST">
            <h2 style="display:flex;justify-content:center">Edit</h2>
            
            <div class="URL-edit">
                <label>URL</label><br>
                <input type="text" value="<?php echo htmlspecialchars
                ($row['URL']); ?>" name="URL" class="fields" id="link">
                <br><br>
            </div>

            <div>
                <label style="margin-left:10px;">
                Title</label><br>
                <textarea name="title" rows="6" cols="20" 
                
                style="margin-left:10px">  <?php echo htmlspecialchars($row['title']); ?>
                </textarea>
            </div>
            
            <div class="descr-edit">
                <label>Description</label><br>
                <textarea rows="25" cols="35" name="description" 
                class="fields" style="overflow:scroll"><?php echo htmlspecialchars($row['description']); ?></textarea>
                <br>
            </div>
      
            <div class="category-edit">
                <label>Category</label><br>
                <select name="category" class="category-dropdown" style="width:150px; border-radius:10px; margin-bottom:20px; height:30px">
                    <?php
                    if ($stmt) {
                        while ($stmt->fetch()) {
                            $selected = $category_id == $row['category_id'] ? 'selected' : '';
                            echo "<option value='$category_id' $selected>$category</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <input type="submit" name="submit-news" value="Update" class="sub-btn">
            </div>
        </form>
    </div>
</body>
</html>
