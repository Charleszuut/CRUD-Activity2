<?php
include 'database/database.php';

$sql = "SHOW TABLES LIKE 'users'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "The 'users' table exists.<br>";

    $sql = "DESCRIBE users";
    $result = $conn->query($sql);

    if ($result) {
        echo "Structure of 'users' table:<br>";
        while ($row = $result->fetch_assoc()) {
            echo "Field: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
        }
    } else {
        echo "Error describing table: " . $conn->error;
    }
} else {
    echo "The 'users' table does not exist.";
}

$conn->close();
?>
