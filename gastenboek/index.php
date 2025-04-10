<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $conn->real_escape_string($_POST['naam']);
    $bericht = $conn->real_escape_string($_POST['bericht']);

    if (!empty($naam) && !empty($bericht)) {
        $sql = "INSERT INTO berichten (naam, bericht) VALUES ('$naam', '$bericht')";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gastenboek</title>
</head>
<body>
    <h1>Laat een bericht achter</h1>
    <form method="POST" action="">
        Naam:<br>
        <input type="text" name="naam" required><br><br>
        Bericht:<br>
        <textarea name="bericht" rows="5" cols="30" required></textarea><br><br>
        <input type="submit" value="Verstuur">
    </form>

    <h2>Berichten</h2>
    <?php
    $result = $conn->query("SELECT * FROM berichten ORDER BY datum DESC");

    while ($row = $result->fetch_assoc()) {
        echo "<hr>";
        echo "<strong>" . htmlspecialchars($row['naam']) . "</strong> op " . $row['datum'] . "<br>";
        echo nl2br(htmlspecialchars($row['bericht']));
        echo "<br>";
    }
    ?>
</body>
</html>
