<?php $backgroundImage = "http://localhost/CRUD/Pictures/pic.jpg";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Add Exercise </title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>

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
    .text_col{
      color: white;
    }
      
  </style>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold text_col">Add Exercise</p>

      </div>
      <div class="row">
      <form action="../handlers/add_fitness_handler.php" method="POST">
        <div class="mb-3">
          <label class="fw-bold text_col">Exercise Name</label>
          <input type="text" class="form-control" name="ExerciseName" required>
        </div>

        <div class="mb-3">
          <label class="fw-bold text_col">Description</label>
          <textarea class="form-control" name="description" required></textarea>
        </div>

        <div class="mb-3">
          <label class="fw-bold text_col">Sets</label>
          <input type="number" class="form-control" name="sets" min="1" required>
        </div>

        <div class="mb-3">
          <label class="fw-bold text_col">Reps</label>
          <input type="number" class="form-control" name="reps" min="1" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary">➕ Add Exercise</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</body>

</html>
