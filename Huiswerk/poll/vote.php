<?php
// Maak verbinding met de database
$mysqli = new mysqli("localhost", "root", "", "polls_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

// Controleer of het formulier is ingediend en er antwoorden zijn
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['questions'])) {
    foreach ($_POST['questions'] as $poll_id => $answer_id) {
        if (!empty($answer_id)) {
            // Sla de stem op in de poll_votes tabel
            $stmt = $mysqli->prepare("INSERT INTO poll_votes (poll_answer_id) VALUES (?)");
            $stmt->bind_param("i", $answer_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Doorsturen naar de resultatenpagina
    header("Location: results.php");
    exit;
} else {
    echo "Je hebt geen antwoorden geselecteerd!";
}
?>