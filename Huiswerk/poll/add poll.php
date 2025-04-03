<?php
// Maak verbinding met de database
$mysqli = new mysqli("localhost", "root", "", "polls_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question']) && isset($_POST['answers'])) {
    $question = trim($_POST['question']);
    $answers = explode(",", trim($_POST['answers']));

    if (!empty($question) && count($answers) > 0) {
        // Voeg de nieuwe poll toe
        $stmt = $mysqli->prepare("INSERT INTO polls (question) VALUES (?)");
        $stmt->bind_param("s", $question);
        $stmt->execute();
        $poll_id = $stmt->insert_id;
        $stmt->close();

        // Voeg de antwoorden toe aan de poll_answers tabel
        foreach ($answers as $answer) {
            $answer = trim($answer);
            if (!empty($answer)) {
                $stmt = $mysqli->prepare("INSERT INTO poll_answers (poll_id, answer_text) VALUES (?, ?)");
                $stmt->bind_param("is", $poll_id, $answer);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Redirect terug naar index.php
        header("Location: index.php");
        exit;
    }
}

// Als er iets fout is gegaan
echo "Er is een fout opgetreden. Probeer opnieuw.";
?>