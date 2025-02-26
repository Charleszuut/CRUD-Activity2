<?php 
session_start();
include '../database/database.php'; 

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id']; 
$backgroundImage = "http://localhost/CRUD/Pictures/gympic2.jpg";

// Use prepared statement to fetch exercises securely
$stmt = $conn->prepare("SELECT * FROM fitness WHERE user_id = ? ORDER BY ExerciseName ASC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Exercises</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Arial', sans-serif;
      background-image: url('<?php echo $backgroundImage; ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat; 
      background-attachment: fixed; 
      min-height: 100vh; 
    }
    .card-custom {
      background: rgba(255, 255, 255, 0.6);
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    .container {
      background: rgba(87, 87, 87, 0.7);
      padding: 20px;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="text-center mb-4">
      <h1 class="fw-bold text-primary">All Exercises</h1>
      <a href="../index.php" class="btn btn-outline-secondary btn-custom px-4">⬅ Back to Home</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card card-custom mb-3">
          <div class="card-body">
            <h4 class="card-title fw-bold text-dark">🔹 <?= htmlspecialchars($row['ExerciseName']); ?></h4>
            <p class="text-muted">Description: <?= htmlspecialchars($row['description']); ?></p>
            <p class="fw-bold text-info">Status: <?= $row['status'] == 0 ? "Ongoing" : "✅ Done"; ?></p>
            <p class="fw-bold">Sets: <span class="text-secondary"><?= (int) $row['sets']; ?></span></p>
            <p class="fw-bold">Reps: <span class="text-secondary"><?= (int) $row['reps']; ?></span></p>
            <p class="textcol">📅 Added on: <?= date("F j, Y, g:i A", strtotime($row['created_at'])); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center text-muted mt-4">
        <h5>🎉 No exercises found.</h5>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>

<?php 
$stmt->close(); // Close the prepared statement
$conn->close(); // Close database connection
?>
