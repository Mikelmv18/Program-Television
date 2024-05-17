<?php
$server = 'localhost';
$db = 'Program Television';
$user = 'root';
$pword = 'heris!821';

$conn = new mysqli($server, $user, $pword, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

