<?php
session_start();
if (!isset($_SESSION['ingelogd'])) {
    header('Location: login.php');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=statistieken', 'root', '');

// Filters ophalen
$geselecteerde_maand = $_GET['maand'] ?? '';
$geselecteerd_land = $_GET['land'] ?? '';

// Dynamische query bouwen
$query = "SELECT * FROM bezoekers WHERE 1=1";
$params = [];

if ($geselecteerde_maand) {
    $query .= " AND MONTH(datum_tijd) = ?";
    $params[] = $geselecteerde_maand;
}
if ($geselecteerd_land) {
    $query .= " AND land = ?";
    $params[] = $geselecteerdAland;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$resultaten = $stmt->fetchAll();

$landen = ['Nederland', 'België', 'Duitsland', 'Frankrijk', 'Spanje'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheerderspagina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welkom, beheerder!</h1>
    <p><a href="logout.php">Uitloggen</a></p>

    <h2>Filter bezoekersgegevens</h2>
    <form method="get">
        Maand: 
        <select name="maand">
            <option value="">--Alles--</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= ($i == $geselecteerde_maand) ? 'selected' : '' ?>>
                    <?= date('F', mktime(0, 0, 0, $i, 10)) ?>
                </option>
            <?php endfor; ?>
        </select>

        Land:
        <select name="land">
            <option value="">--Alles--</option>
            <?php foreach ($landen as $land): ?>
                <option value="<?= $land ?>" <?= ($land == $geselecteerd_land) ? 'selected' : '' ?>>
                    <?= $land ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Filter">
    </form>

    <h2>Resultaten</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Land</th>
            <th>IP-adres</th>
            <th>Provider</th>
            <th>Browser</th>
            <th>Datum/tijd</th>
            <th>Referrer</th>
        </tr>
        <?php if (count($resultaten) > 0): ?>
            <?php foreach ($resultaten as $rij): ?>
                <tr>
                    <td><?= htmlspecialchars($rij['land']) ?></td>
                    <td><?= htmlspecialchars($rij['ip_adres']) ?></td>
                    <td><?= htmlspecialchars($rij['provider']) ?></td>
                    <td><?= htmlspecialchars($rij['browser']) ?></td>
                    <td><?= htmlspecialchars($rij['datum_tijd']) ?></td>
                    <td><?= htmlspecialchars($rij['referrer']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Geen resultaten gevonden.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
