<?php
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset(
     $_POST['ExerciseName'],
     $_POST['description'], 
     $_POST['sets'], 
     $_POST['reps'])) {
        die("Error: Missing form data.");
    }

    $exerciseName = trim($_POST['ExerciseName']);
    $description = trim($_POST['description']);
    $sets = intval($_POST['sets']);
    $reps = intval($_POST['reps']);

    if (empty($exerciseName) || empty($description)) {
        die("Error: Exercise Name and Description cannot be empty.");
    }

    $stmt = $conn->prepare("INSERT INTO fitness (ExerciseName, description, sets, reps) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $exerciseName, $description, $sets, $reps);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=added");
        exit();
    } else {
        die("Error adding exercise.");
    }
    $stmt->close();
}
?>
