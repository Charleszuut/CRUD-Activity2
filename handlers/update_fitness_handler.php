<?php
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = intval($_POST["ID"]);
    $ExerciseName = $_POST["ExerciseName"];
    $description = $_POST["description"];
    $sets = intval($_POST["sets"]);
    $reps = intval($_POST["reps"]);
    $status = intval($_POST["status"]);  // ✅ Get status from form

    $query = "UPDATE fitness SET ExerciseName=?, description=?, sets=?, reps=?, status=? WHERE ExerciseID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssiiii", $ExerciseName, $description, $sets, $reps, $status, $ID);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=UpdatedSuccessfully");
        exit();
    } else {
        echo "Error updating exercise: " . $conn->error;
    }
    $stmt->close();
}
?>
