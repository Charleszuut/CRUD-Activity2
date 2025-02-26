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
  <title>Edit Exercise</title>

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
  <div class="overlay"></div>

  <div class="container d-flex justify-content-center mt-5 content-container">
    <div class="col-md-6">
      <div class="card card-custom p-4">
        <div class="text-center mb-3">
          <h2 class="fw-bold icon-text">
            <span class="material-icons">edit</span> Edit Exercise
          </h2>
        </div>

        <form action="../handlers/update_fitness_handler.php" method="POST">
          <input name="ID" value="<?= $fitness['ExerciseID'] ?>" type="hidden" />

          <div class="mb-3">
            <label class="fw-bold icon-text">
              <span class="material-icons">fitness_center</span> Title
            </label>
            <input class="form-control" type="text" name="ExerciseName" value="<?= $fitness['ExerciseName'] ?>" required />
          </div>

          <div class="mb-3">
            <label class="fw-bold icon-text">
              <span class="material-icons">description</span> Description
            </label>
            <textarea class="form-control" name="description" required><?= $fitness['description'] ?></textarea>
          </div>

          <div class="mb-3">
            <label class="fw-bold icon-text">
              <span class="material-icons">repeat</span> Sets
            </label>
            <input type="number" class="form-control" name="sets" value="<?= $fitness['sets'] ?>" min="1" required />
          </div>

          <div class="mb-3">
            <label class="fw-bold icon-text">
              <span class="material-icons">refresh</span> Reps
            </label>
            <input type="number" class="form-control" name="reps" value="<?= $fitness['reps'] ?>" min="1" required />
          </div>

          <div class="mb-3">
            <label class="fw-bold icon-text">
              <span class="material-icons">check_circle</span> Status
            </label>
            <select class="form-control" name="status" required>
              <option value="0" <?= $fitness['status'] == 0 ? 'selected' : '' ?>>⏳ Ongoing</option>
              <option value="1" <?= $fitness['status'] == 1 ? 'selected' : '' ?>>✅ Done</option>
            </select>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-outline-light btn-custom px-4">
              <span class="material-icons">save</span> Save Exercise
            </button>
            <a href="../index.php" class="btn btn-secondary btn-custom px-4">
              <span class="material-icons">arrow_back</span> Back
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
