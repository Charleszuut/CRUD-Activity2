<?php
session_start();
include '../database/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM fitness WHERE ExerciseID = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: ../index.php?success=deleted");
        exit();
    } else {
        die("Error deleting exercise.");
    }

    $stmt->close();
} else {
    die("Error: No ID provided.");
}

$conn->close();
?>
