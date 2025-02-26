<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $role = 'user';

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) { 
        echo "User registered successfully"; 
    } else {
        echo "Error registering user: " . $stmt->error; 
    }

    $stmt->close();
}
$conn->close();
?>
