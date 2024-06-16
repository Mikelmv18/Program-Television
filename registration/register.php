<?php

if(isset($_POST['sub'])){
    require('../connection/connect.php');

    $full_name = $_POST['full-name'];
    $username = $_POST['username'];
    $email = $_POST['em'];
    $password = $_POST['password'];

    // Check if password meets strength requirements
    $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    if (!preg_match($passwordPattern, $password)) {
        echo "Password should contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        $query = "SELECT * FROM user WHERE username=? AND password=?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows != 0) {
                require('../registration/registerform.php');
                echo "<p style='color:red; margin-left:10px;'>
                This user already exists</p>";
            } else {
                $insertQuery = "INSERT INTO user (full_name, username, email, password) VALUES (?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ssss", $full_name, $username, $email, $password);
                $insertStmt->execute();
                require("../registration/form.php");
            }
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
    $conn->close();
}
?>
