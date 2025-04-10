<?php
session_start();
require 'config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: gastenboek.php");
    exit();
}

$bericht_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $berichttekst = $_POST['berichttekst'];

    $stmt = $pdo->prepare("UPDATE berichten SET berichttekst = ? WHERE id = ?");
    $stmt->execute([$berichttekst, $bericht_id]);

    header("Location: gastenboek.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM berichten WHERE id = ?");
$stmt->execute([$bericht_id]);
$bericht = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bericht Bewerken</title>
</head>
<body>
    <h2>Bericht Bewerken</h2>
    <form method="POST" action="edit.php?id=<?php echo $bericht_id; ?>">
        <label for="berichttekst">Bericht:</label>
        <textarea id="berichttekst" name="berichttekst" required><?php echo htmlspecialchars($bericht['berichttekst']); ?></textarea><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
