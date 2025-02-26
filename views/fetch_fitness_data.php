<?php
$host = 'localhost';
$dbname = 'fitness_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM fitness WHERE user_id = :user_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();


    $fitnessData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Fitness Tracking App";
    if (count($fitnessData) > 0) {
        echo "<ul>";
        foreach ($fitnessData as $row) {
            echo "<li><strong>" . htmlspecialchars($row['ExerciseName']) . "</strong><br>" . htmlspecialchars($row['description']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No fitness data available.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
