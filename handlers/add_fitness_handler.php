<?php
session_start();
include '../database/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ensure all required form fields are set
    if (!isset($_POST['ExerciseName'], $_POST['description'], $_POST['sets'], $_POST['reps'])) {
        die("Error: Missing form data.");
    }

    $user_id = $_SESSION['user_id']; // Get logged-in user ID
    $exerciseName = trim($_POST['ExerciseName']);
    $description = trim($_POST['description']);
    $sets = intval($_POST['sets']);
    $reps = intval($_POST['reps']);

    // Validate inputs
    if (empty($exerciseName) || empty($description)) {
        die("Error: Exercise Name and Description cannot be empty.");
    }

    // Insert into the database with user_id
    $stmt = $conn->prepare("INSERT INTO fitness (user_id, ExerciseName, description, sets, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issii", $user_id, $exerciseName, $description, $sets, $reps);

    if ($stmt->execute()) {
        header("Location: ../views/all_exercises.php?success=added");
        exit();
    } else {
        die("Error adding exercise: " . $stmt->error);
    }

    $stmt->close();
}
$conn->close();
?>
