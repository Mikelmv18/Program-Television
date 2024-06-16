<?php

session_start();

if(isset($_SESSION['username'])){
  header('Location: ../HomePage/home.php');
}


$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);


require('../connection/connect.php');

$query = "SELECT * FROM user WHERE username=? and password=?";
$stmt = $conn->prepare($query);

if($stmt){

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows != 0) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header('Location: ../HomePage/home.php');
}

else{
    
    echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Webleb</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
                integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"/>
            <link href="/Television/registrationStyling/log.css" rel="stylesheet">
        </head>
        
        <body style="display:flex; align-items:center; justify-content:center;">
        <div class="login-page">
        <div class="form">
            <form class="login-form" action="/Television/registration/login.php" method="POST">
            <h2><i class="fas fa-user-alt" style="margin-right: 5px;"></i>Login</h2>
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="send2">login</button>
            <p class="message">Not registered? <a href="registerform.php">Create an account</a></p>
            <p class="warning" style="color:red;">Incorrect username or password.</p>
            </form>
            
        </div>
        </div>';
        exit();
        
    }
 
    
}



$conn->close();


?>