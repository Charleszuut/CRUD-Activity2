<?php
session_start();
include '../database/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ID = intval($_POST["ID"]);
    $ExerciseName = trim($_POST["ExerciseName"]);
    $description = trim($_POST["description"]);
    $sets = intval($_POST["sets"]);
    $reps = intval($_POST["reps"]);
    $status = isset($_POST["status"]) ? intval($_POST["status"]) : 0; // Default to 0 if not set

    // ✅ Ensure all fields are filled
    if (empty($ExerciseName) || empty($description) || $sets < 1 || $reps < 1) {
        die("Error: Please fill in all required fields correctly.");
    }

    $query = "UPDATE fitness SET ExerciseName=?, description=?, sets=?, reps=?, status=? WHERE ExerciseID=? AND user_id=?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssiiiii", $ExerciseName, $description, $sets, $reps, $status, $ID, $_SESSION['user_id']);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=UpdatedSuccessfully");
        exit();
    } else {
        echo "Error updating exercise: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
