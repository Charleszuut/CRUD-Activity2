<?php
session_start();
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error registering user: " . $stmt->error;
        header("Location: ../register.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
