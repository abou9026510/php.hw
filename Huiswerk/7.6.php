<?php
session_start();
// auteur: Abou
// functie: Oefening

// Controleer of de sessie-array voor cijfers al bestaat, anders maak deze aan
if (!isset($_SESSION['cijfers'])) {
    $_SESSION['cijfers'] = [];
}

// Verwerken van de invoer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cijfer = $_POST['cijfer'];

    // Controleer of het ingevoerde cijfer geldig is (tussen 1.0 en 10.0)
    if (is_numeric($cijfer) && $cijfer >= 1.0 && $cijfer <= 10.0) {
        $_SESSION['cijfers'][] = (float)$cijfer; // Voeg het cijfer toe aan de sessie-array
    } else {
        $error = "Voer een geldig cijfer in (tussen 1.0 en 10.0).";
    }
}

// Bereken het gemiddelde
$aantalCijfers = count($_SESSION['cijfers']);
$gemiddelde = $aantalCijfers > 0 ? array_sum($_SESSION['cijfers']) / $aantalCijfers : 0;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 6</title>
</head>
<body>
    <h1>Opdracht 6: Gemiddelde Berekening</h1>
    <form method="post" action="">
        <label for="cijfer">Cijfer:</label>
        <input type="text" id="cijfer" name="cijfer" required>
        <button type="submit">Toevoegen</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <h2>Resultaat</h2>
    <p>Aantal ingevoerde cijfers: <?php echo $aantalCijfers; ?></p>
    <p>Gemiddelde: <?php echo number_format($gemiddelde, 1); ?></p>
</body>
</html>