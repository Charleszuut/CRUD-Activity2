<?php
include 'database/database.php';

$username = 'admin';
$password = password_hash('password', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Test user created successfully";
} else {
    echo "Error creating test user: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
