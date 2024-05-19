<div class="slider-container">
    <div class="slides">
        
        
    <?php
    require('../HomePage/navbar.php');
    require_once('../connection/connect.php');
    $query = mysqli_query($conn, "SELECT URL, description FROM content");
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
                    echo '<img src="' . $row['URL'] . '" class="d-block w-100" alt="...">';
                    echo '<div class="carousel-caption d-none d-md-block">';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
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
<div class="program">
    <button class="prev-btn" onclick="changeSlide(-1)"><</button>
    <button class="next-btn" onclick="changeSlide(1)">></button>
</div>
