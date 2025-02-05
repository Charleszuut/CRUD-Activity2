<?php
include '../database/database.php'; 
$backgroundImage = "http://localhost/CRUD/Pictures/gympic3.jpg";

try {
  if (!isset($_GET['ExerciseID']) || empty($_GET['ExerciseID'])) {
    die("Error: No Exercise ID provided.");
  }
  $ExerciseID = intval($_GET['ExerciseID']);

  $stmt = $conn->prepare("SELECT * FROM fitness WHERE ExerciseID = ?");
  $stmt->bind_param("i", $ExerciseID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $fitness = $result->fetch_assoc();
  } else {
    die("Exercise not found");
  }
  $stmt->close();
} catch (\Exception $e) {
  echo "Error: " . $e;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Fitness</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
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
    .text_col { color: white; }
    .card_custom {
      background: rgba(94, 94, 94, 0.8);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .btn-custom { border-radius: 20px; padding: 5px; color: white; }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card card_custom p-4">
        <div class="text-center mb-3">
          <h2 class="fw-bold text_col">Edit Exercise</h2>
        </div>

        <form class="form" action="../handlers/update_fitness_handler.php" method="POST">
          <input name="ID" value="<?= $fitness['ExerciseID'] ?>" type="hidden" />
          <div class="mb-3">
            <label class="fw-bold text_col">Title</label>
            <input class="form-control" type="text" name="ExerciseName" value="<?= $fitness['ExerciseName'] ?>" required />
          </div>
          <div class="mb-3">
            <label class="fw-bold text_col">Description</label>
            <textarea class="form-control" name="description" required><?= $fitness['description'] ?></textarea>
          </div>
          <div class="mb-3">
            <label class="fw-bold text_col">Sets</label>
            <input type="number" class="form-control" name="sets" value="<?= $fitness['sets'] ?>" min="1" required />
          </div>
          <div class="mb-3">
            <label class="fw-bold text_col">Reps</label>
            <input type="number" class="form-control" name="reps" value="<?= $fitness['reps'] ?>" min="1" required />
          </div>

          <div class="mb-3">
            <label class="fw-bold text_col">Status</label>
            <select class="form-control" name="status" required>
              <option value="0" <?= $fitness['status'] == 0 ? 'selected' : '' ?>>⏳ Ongoing</option>
              <option value="1" <?= $fitness['status'] == 1 ? 'selected' : '' ?>>✅ Done</option>
            </select>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-outline-primary btn-custom px-4">💾 Save Exercise</button>
            <a href="../index.php" class="btn btn-secondary btn-custom px-4">⬅ Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
