<?php
include "../database/database.php";

try {
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No Exercise ID provided.");
  }

  $id = intval($_GET['id']); 

  $stmt = $conn->prepare("DELETE FROM fitness WHERE ExerciseID = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: ../index.php?success=deleted");
    exit;
  } else {
    echo "Operation failed.";
  }

  $stmt->close();
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>