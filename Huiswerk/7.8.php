<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 8 - Fruitlijst</title>
</head>
<body>
    <h1>Fruitlijst Bewerken</h1>
    <form method="post" action="">
        <label for="fruit">Fruitsoort:</label>
        <input type="text" id="fruit" name="fruit">
        <button type="submit" name="action" value="toevoegen">Toevoegen</button>
        <button type="submit" name="action" value="sorteren">Sorteren</button>
        <button type="submit" name="action" value="schudden">Schudden</button>
    </form>

    <?php
    // Start sessie om de fruitlijst op te slaan
    session_start();

    // Initialiseer de fruitlijst als deze nog niet bestaat
    if (!isset($_SESSION['fruitlijst'])) {
        $_SESSION['fruitlijst'] = [];
    }

    // Verwerk formulieractie
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $actie = $_POST['action'];

        // Toevoegen van fruitsoort
        if ($actie === 'toevoegen') {
            $fruit = trim($_POST['fruit']);
            if (!empty($fruit)) {
                $_SESSION['fruitlijst'][] = $fruit;
            }
        }

        // Sorteren van de lijst
        if ($actie === 'sorteren') {
            sort($_SESSION['fruitlijst']);
        }

        // Schudden van de lijst
        if ($actie === 'schudden') {
            shuffle($_SESSION['fruitlijst']);
        }
    }

    // Weergeven van de fruitlijst
    echo "<h2>Inhoud van de array:</h2>";
    echo "<ul>";
    foreach ($_SESSION['fruitlijst'] as $fruit) {
        echo "<li>" . htmlspecialchars($fruit) . "</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>