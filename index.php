<?php include 'database/database.php'; $backgroundImage = "Pictures/gympic.jpg";?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitness App</title>

  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
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
    }
    .text-center {
      color: white;
    }
    .textcol{
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
        <h1 class="fw-bold">Fitness Tracker App</h1>
      </div>
      <div class="text-center mb-4">
        <a href="views/add_fitness.php" class="btn btn-outline-primary btn-custom px-4">➕ Add Exercise</a>
        <a href="views/all_exercises.php" class="btn btn-outline-success btn-custom px-4">📋 See Exercises</a>
      </div>
      
      <?php $res = $conn->query("SELECT * FROM fitness"); ?>
      
      <?php if($res->num_rows > 0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
          <div class="card card-custom mb-3">
            <div class="card-body">
              <h4 class="card-title fw-bold textcol">🔹 <?= $row['ExerciseName']; ?></h4>
              <p class="textcol">Description: <?= $row['description']; ?></p>
              <p class="fw-bold textcol">Sets: <span class="text-secondary text-white"> <?= $row['sets']; ?> </span></p>
              <p class="fw-bold textcol">Reps: <span class="text-secondary text-white"> <?= $row['reps']; ?> </span></p>
              
              <p class="fw-bold textcol">
                Status: 
                <?php if ($row['status'] == 0): ?>
                  <span class="status-badge status-ongoing">⏳ Ongoing</span>
                <?php else: ?>
                  <span class="status-badge status-done">✅ Done</span>
                <?php endif; ?>
              </p>

              <p class="textcol">📅 Added on: <?= date("F j, Y, g:i A", strtotime($row['created_at'])); ?></p>

              <div class="d-flex gap-2">
                <a href="views/update_fitness.php?ExerciseID=<?=$row['ExerciseID'];?>" class="btn btn-warning btn-sm btn-custom">✏️ Edit</a>
                <a href="handlers/delete_fitness_handler.php?id=<?=$row['ExerciseID'];?>" class="btn btn-danger btn-sm btn-custom">🗑️ Delete</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="text-center text-white mt-4">
          <h5>🎉 No current exercises. Add one or enjoy your rest time!</h5>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
