<?php 
session_start();
include 'database/database.php'; 
$backgroundImage = "Pictures/gympic.jpg";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitness App</title>

  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    body {
      background-image: url('<?php echo $backgroundImage; ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat; 
      background-attachment: fixed; 
      font-family: 'Arial', sans-serif;
      min-height: 100vh; 
    }
    .card-custom {
      background: rgba(94, 94, 94, 0.8);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .btn-custom {
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .textcol {
      color: white;
    }
    .status-badge {
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 5px;
      display: inline-block;
    }
    .status-ongoing {
      background-color: orange;
      color: black;
    }
    .status-done {
      background-color: green;
      color: white;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-md-8">
      <div class="text-center mb-4">
      <h1 class="fw-bold text-white">Fitness Tracker</h1>
        <form action="logout.php" method="post" class="mt-3">
          <button type="submit" class="btn btn-danger btn-sm btn-custom">
            <span class="material-icons">logout</span> Logout
          </button>
        </form>
      </div>

      <div class="text-center mb-4">
        <a href="views/add_fitness.php" class="btn btn-outline-primary btn-custom px-4">
          <span class="material-icons">add</span> Add Exercise
        </a>
        <a href="views/all_exercises.php" class="btn btn-outline-success btn-custom px-4">
          <span class="material-icons">list</span> View Exercises
        </a>
      </div>
      
      <?php 
      $stmt = $conn->prepare("SELECT * FROM fitness WHERE user_id = ? ORDER BY created_at DESC");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $res = $stmt->get_result();
      ?>

      <?php if ($res->num_rows > 0): ?>
        <?php while ($row = $res->fetch_assoc()): ?>
          <div class="card card-custom mb-3">
            <div class="card-body">
              <h4 class="card-title fw-bold textcol">
                <span class="material-icons">fitness_center</span> 
                <?= htmlspecialchars($row['ExerciseName']); ?>
              </h4>
              <p class="textcol"><strong>Description:</strong> <?= htmlspecialchars($row['description']); ?></p>
              <p class="fw-bold textcol"><strong>Sets:</strong> <?= (int) $row['sets']; ?></p>
              <p class="fw-bold textcol"><strong>Reps:</strong> <?= (int) $row['reps']; ?></p>
              
              <p class="fw-bold textcol">
                <strong>Status:</strong> 
                <?php if ($row['status'] == 0): ?>
                  <span class="status-badge status-ongoing">
                    <span class="material-icons">hourglass_empty</span> Ongoing
                  </span>
                <?php else: ?>
                  <span class="status-badge status-done">
                    <span class="material-icons">check_circle</span> Done
                  </span>
                <?php endif; ?>
              </p>

              <p class="textcol"><strong>📅 Added on:</strong> <?= date("F j, Y, g:i A", strtotime($row['created_at'])); ?></p>

              <div class="d-flex gap-2">
                <a href="views/update_fitness.php?ExerciseID=<?= $row['ExerciseID']; ?>" class="btn btn-warning btn-sm btn-custom">
                  <span class="material-icons">edit</span> Edit
                </a>
                <a href="handlers/delete_fitness_handler.php?id=<?= $row['ExerciseID']; ?>" 
                   class="btn btn-danger btn-sm btn-custom" 
                   onclick="return confirm('Are you sure you want to delete this exercise?');">
                  <span class="material-icons">delete</span> Delete
                </a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="text-center text-white mt-4">
          <h5>🎉 No current exercises. Add one or enjoy your rest time!</h5>
        </div>
      <?php endif; ?>

      <?php $stmt->close(); ?>
    </div>
  </div>
</body>
</html>
