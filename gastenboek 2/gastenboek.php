<?php
session_start();
require 'config.php';

if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $berichttekst = $_POST['berichttekst'];
    $gebruiker_id = $_SESSION['gebruiker_id'];

    $stmt = $pdo->prepare("INSERT INTO berichten (gebruiker_id, berichttekst) VALUES (?, ?)");
    $stmt->execute([$gebruiker_id, $berichttekst]);

    header("Location: gastenboek.php");
    exit();
}

$stmt = $pdo->query("SELECT berichten.*, gebruikers.gebruikersnaam FROM berichten JOIN gebruikers ON berichten.gebruiker_id = gebruikers.id ORDER BY berichten.aanmaakdatum DESC");
$berichten = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gastenboek</title>
</head>
<body>
    <h2>Gastenboek</h2>
    <form method="POST" action="gastenboek.php">
        <label for="berichttekst">Bericht:</label>
        <textarea id="berichttekst" name="berichttekst" required></textarea><br>
        <button type="submit">Bericht Toevoegen</button>
    </form>
    <h3>Berichten:</h3>
    <?php foreach ($berichten as $bericht): ?>
        <div>
            <p><strong><?php echo htmlspecialchars($bericht['gebruikersnaam']); ?></strong> (<?php echo $bericht['aanmaakdatum']; ?>)</p>
            <p><?php echo nl2br(htmlspecialchars($bericht['berichttekst'])); ?></p>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <a href="edit.php?id=<?php echo $bericht['id']; ?>">Bewerken</a>
                <a href="delete.php?id=<?php echo $bericht['id']; ?>">Verwijderen</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
