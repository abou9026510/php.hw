<?php
// Maak verbinding met de database
$mysqli = new mysqli("localhost", "root", "", "polls_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Verkrijg de bestaande polls
$polls_result = $mysqli->query("SELECT * FROM polls");

$polls = [];
while ($poll = $polls_result->fetch_assoc()) {
    $polls[] = $poll;
}

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['questions'])) {
    // Verkrijg de antwoorden uit het formulier
    foreach ($_POST['questions'] as $poll_id => $answer_id) {
        if (!empty($answer_id)) {
            // Sla de stem op in de poll_votes tabel
            $stmt = $mysqli->prepare("INSERT INTO poll_votes (poll_answer_id) VALUES (?)");
            $stmt->bind_param("i", $answer_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Redirect naar de resultatenpagina na indienen
    echo "<h2>Bedankt voor je deelname!</h2>";
    echo "<a href='results.php'>Bekijk de resultaten</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak een Poll aan</title>
    <style>
        .poll-container {
            display: none; /* Vragen zijn standaard verborgen */
        }
        .poll-link {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
    <script>
        function showPoll(pollId) {
            // Verberg eerst alle polls
            let polls = document.querySelectorAll('.poll-container');
            polls.forEach(function(poll) {
                poll.style.display = 'none';
            });

            // Toon de geselecteerde poll
            let selectedPoll = document.getElementById('poll-' + pollId);
            selectedPoll.style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Stem op de Polls</h1>

    <div>
        <!-- Menu met links naar elke vraag -->
        <h3>Kies een vraag om te beantwoorden:</h3>
        <ul>
            <?php foreach ($polls as $poll) { ?>
                <li><a class="poll-link" onclick="showPoll(<?php echo $poll['id']; ?>)">Vraag: <?php echo $poll['question']; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <form method="POST" action="create_poll.php">
        <?php
        // Toon de bestaande polls en hun antwoorden
        foreach ($polls as $poll) {
            echo "<div id='poll-" . $poll['id'] . "' class='poll-container'>";
            echo "<h3>" . $poll['question'] . "</h3>";

            // Verkrijg de antwoorden voor deze poll
            $poll_id = $poll['id'];
            $answers_result = $mysqli->query("SELECT * FROM poll_answers WHERE poll_id = $poll_id");

            // Controleer of er antwoorden zijn voor deze poll
            if ($answers_result->num_rows > 0) {
                // Toon de antwoorden als een dropdown menu (select)
                echo "<select name='questions[$poll_id]'>";
                echo "<option value=''>Kies een antwoord</option>";  // Optie voor geen keuze
                while ($answer = $answers_result->fetch_assoc()) {
                    echo "<option value='" . $answer['id'] . "'>" . $answer['answer_text'] . "</option>";
                }
                echo "</select><br>";
            } else {
                echo "<p>Geen antwoorden voor deze poll.</p>";
            }
            echo "</div>";
        }
        ?>

        <br>
        <!-- 1 Vaste Submit knop -->
        <input type="submit" value="Stem op alle polls">
    </form>

</body>
</html>