<?php
include 'database/database.php';

$result = $conn->query("SELECT * FROM users WHERE username = 'testuser'");
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo 'User ID: ' . $row['id'] . ', Role: ' . $row['role'];
    }
} else {
    echo 'No user found.';
}
$conn->close();
?>
