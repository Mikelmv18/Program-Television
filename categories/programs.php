<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Slider</title>
<link rel="stylesheet" href="../adminstyling/programs.css">
</head>
<body>
<div class="slider-container">
    <div class="slides">
        
        <?php
         require('../HomePage/navbar.php');
         require_once('../connection/connect.php');
         $query = mysqli_query($conn, "SELECT URL,description from content");
         
         while ($row = mysqli_fetch_assoc($query))
         
          {
            echo '<div class="program">';
            echo '<div class="slide">';
            echo "<img src=\"" . $row['URL'] . "\">";
            echo '<div class="description">' . '<p>' . $row['description'] . '</p>' . '</div>';
            echo '</div>';
            echo '</div>';

         }
             
   ?>     
</div>
<div class="program">
    <button class="prev-btn" onclick="changeSlide(-1)"><</button>
    <button class="next-btn" onclick="changeSlide(1)">></button>
</div>

<script>

let slideIndex = 0;
let slide1Index = 0;

function showSlide(index) {
    
    const slides = document.querySelectorAll('.slides img');
    const slides1 = document.querySelectorAll('.description');
    
    if (index >= slides.length && index >= slides1.length) {
        slideIndex = 0;
        slide1Index = 0;
    } else if (index < 0) {
        slideIndex = slides.length - 1;
        slide1Index = slides1.length - 1;
    } else {
        slideIndex = index;
        slide1Index = index;
    }
    slides.forEach(slide => slide.style.display = 'none');
    slides[slideIndex].style.display = 'block';
    slides1.forEach(slide1 => slide1.style.display = 'none');
    slides1[slide1Index].style.display = 'inline-block';
    slides1[slide1Index].style.width = '100%';
}

function changeSlide(n) {
    showSlide(slideIndex + n);
    showSlide1(slideIndex1 + n);
}

showSlide(slideIndex);
showSlide(slide1Index);

</script>
</body>
</html>
