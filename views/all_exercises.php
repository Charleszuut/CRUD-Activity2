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

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>

  <style>
    body {
      background: url('<?php echo $backgroundImage; ?>') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Arial', sans-serif;
      min-height: 100vh;
      position: relative;
    }

    /* Dark overlay for better contrast */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1;
    }

    .content-container {
      position: relative;
      z-index: 2;
    }

    .card-custom {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      padding: 30px;
      backdrop-filter: blur(10px);
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
      color: white;
    }

    .text-white {
      color: white;
    }

    .icon-text {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-custom {
      display: flex;
      align-items: center;
      gap: 5px;
    }
  </style>
</head>

<body>
  <div class="overlay"></div> <!-- Dark overlay for better readability -->

  <div class="container mt-5 content-container">
    <div class="text-center mb-4">
      <h1 class="fw-bold text-white">
        <span class="material-icons">fitness_center</span> All Exercises
      </h1>
      <a href="../index.php" class="btn btn-outline-light btn-custom">
        <span class="material-icons">arrow_back</span> Back to Home
      </a>
    </div>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card card-custom">
          <div class="card-body">
            <h4 class="fw-bold icon-text">
              <span class="material-icons">directions_run</span> <?= htmlspecialchars($row['ExerciseName']); ?>
            </h4>
            <p class="icon-text">
              <span class="material-icons">description</span> <?= htmlspecialchars($row['description']); ?>
            </p>
            <p class="fw-bold icon-text">
              <span class="material-icons">check_circle</span> Status:
              <?= $row['status'] == 0 ? '<span class="text-warning">Ongoing ⏳</span>' : '<span class="text-success">✅ Done</span>'; ?>
            </p>
            <p class="fw-bold icon-text">
              <span class="material-icons">repeat</span> Sets: <span class="text-white"><?= (int) $row['sets']; ?></span>
            </p>
            <p class="fw-bold icon-text">
              <span class="material-icons">refresh</span> Reps: <span class="text-white"><?= (int) $row['reps']; ?></span>
            </p>
            <p class="icon-text">
              <span class="material-icons">event</span> Added on: <?= date("F j, Y, g:i A", strtotime($row['created_at'])); ?>
            </p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center text-white mt-4">
        <h5><span class="material-icons">celebration</span> No exercises found. Start tracking today! 💪</h5>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>

<?php 
$stmt->close(); 
$conn->close(); 
?>
