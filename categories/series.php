<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Slider</title>
<link rel="stylesheet" href="../adminstyling/series.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    require('../HomePage/navbar.php');
    ?>

<div class="slider-container">
    <?php
    require_once('../connection/connect.php');

    $query = mysqli_query($conn, "SELECT content.URL, content.title,
    content.description FROM content JOIN category ON content.category_id = category.id 
    WHERE category.type = 'TV Shows'");
    ?>

    <section id="homeBanner">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $firstItem = true;
                while ($row = mysqli_fetch_assoc($query)) {
                    $activeClass = $firstItem ? 'active' : '';
                    $firstItem = false;
                    echo '<div class="carousel-item ' . $activeClass . '">';
                    echo '<img src="' . $row['URL'] . '" class="d-block" alt="Image">';
                    echo '<div style="font-family:Arial Black;
                    font-size:34px" >'. $row['title'] . '</div>';
                    echo '<div class="description">' . $row['description'] . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
