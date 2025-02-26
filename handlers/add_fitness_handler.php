<?php
session_start();
include '../database/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['ExerciseName'], $_POST['description'], $_POST['sets'], $_POST['reps'])) {
        die("Error: Missing required fields.");
    }

    $user_id = $_SESSION['user_id'];
    $exerciseName = trim($_POST['ExerciseName']);
    $description = trim($_POST['description']);
    $sets = intval($_POST['sets']);
    $reps = intval($_POST['reps']);

    if (empty($exerciseName) || empty($description)) {
        die("Error: Please fill in all required fields.");
    }

    $stmt = $conn->prepare("INSERT INTO fitness (user_id, ExerciseName, description, sets, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $user_id, $exerciseName, $description, $sets, $reps);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=AddedSuccessfully");
        exit();
    } else {
        echo "Error adding exercise: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
