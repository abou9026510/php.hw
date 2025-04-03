<?php
// Maak verbinding met de database
$mysqli = new mysqli("localhost", "root", "", "polls_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Verkrijg de bestaande polls
$polls_result = $mysqli->query("SELECT * FROM polls");

echo "<h1>Resultaten van de Polls</h1>";

// Loop door alle polls en toon de resultaten
while ($poll = $polls_result->fetch_assoc()) {
    echo "<h2>" . $poll['question'] . "</h2>";

    // Verkrijg de antwoorden en het aantal stemmen per antwoord
    $poll_id = $poll['id'];
    $answers_result = $mysqli->query("SELECT * FROM poll_answers WHERE poll_id = $poll_id");

    while ($answer = $answers_result->fetch_assoc()) {
        $answer_id = $answer['id'];

        // Tel het aantal stemmen voor elk antwoord
        $votes_result = $mysqli->query("SELECT COUNT(*) AS vote_count FROM poll_votes WHERE poll_answer_id = $answer_id");
        $votes = $votes_result->fetch_assoc();

        echo "<p>" . $answer['answer_text'] . ": " . $votes['vote_count'] . " stemmen</p>";
    }
}
?>