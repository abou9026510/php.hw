<?php
// Maak verbinding met de database
$mysqli = new mysqli("localhost", "root", "", "polls_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

// Verkrijg de bestaande polls
$polls_result = $mysqli->query("SELECT * FROM polls");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polls</title>
</head>
<body>
    <h1>Beschikbare Polls</h1>

    <!-- Stemformulier -->
    <form method="POST" action="vote.php">
        <?php
        while ($poll = $polls_result->fetch_assoc()) {
            echo "<h2>" . htmlspecialchars($poll['question']) . "</h2>";

            $poll_id = $poll['id'];
            $answers_result = $mysqli->query("SELECT * FROM poll_answers WHERE poll_id = $poll_id");

            while ($answer = $answers_result->fetch_assoc()) {
                echo "<input type='radio' name='questions[$poll_id]' value='" . $answer['id'] . "'> " . htmlspecialchars($answer['answer_text']) . "<br>";
            }
        }
        ?>

        <br>
        <input type="submit" value="Stem op alle polls">
    </form>

    <hr>

    <!-- Formulier om een nieuwe poll aan te maken -->
    <h2>Nieuwe Poll Aanmaken</h2>
    <form method="POST" action="add_poll.php">
        <label>Vraag:</label><br>
        <input type="text" name="question" required><br><br>

        <label>Antwoorden (scheid met een komma):</label><br>
        <input type="text" name="answers" placeholder="Bijv: Ja, Nee, Misschien" required><br><br>

        <input type="submit" value="Poll Aanmaken">
    </form>

    <hr>

    <!-- Link naar resultatenpagina -->
    <h2>Resultaten bekijken</h2>
    <a href="results.php">Bekijk de poll-resultaten</a>

</body>
</html>