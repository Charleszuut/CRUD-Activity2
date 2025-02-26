<?php $backgroundImage = "http://localhost/CRUD/Pictures/pic.jpg";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Exercise</title>
  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
      position: relative;
    }
    
    /* Dark overlay for better text readability */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6); /* Dark transparency */
      z-index: 1;
    }

    .content-container {
      position: relative;
      z-index: 2;
    }

    .text_col {
      color: white;
    }

    .form-label {
      display: flex;
      align-items: center;
      gap: 5px;
      font-weight: bold;
      color: white;
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

  <div class="container d-flex justify-content-center align-items-center mt-5 content-container">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold text_col">
          <span class="material-icons">add_circle</span> Add Exercise
        </p>
      </div>

      <div class="row">
        <form action="../handlers/add_fitness_handler.php" method="POST">
          <div class="mb-3">
            <label class="form-label">
              <span class="material-icons">fitness_center</span> Exercise Name
            </label>
            <input type="text" class="form-control" name="ExerciseName" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <span class="material-icons">description</span> Description
            </label>
            <textarea class="form-control" name="description" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <span class="material-icons">repeat</span> Sets
            </label>
            <input type="number" class="form-control" name="sets" min="1" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <span class="material-icons">refresh</span> Reps
            </label>
            <input type="number" class="form-control" name="reps" min="1" required>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-custom">
              <span class="material-icons">add</span> Add Exercise
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
