<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Valideer de invoer
    if (empty($username) || empty($password)) {
        die('Gebruikersnaam en wachtwoord zijn verplicht.');
    }

    // Controleer of de gebruikersnaam al bestaat
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        die('Gebruikersnaam bestaat al.');
    }

    // Hash het wachtwoord
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Voeg de nieuwe gebruiker toe aan de database
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $hashedPassword]);

    echo 'Registratie succesvol! Je kunt nu inloggen.';
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
    <h1>Registreren</h1>
    <form method="POST" action="register.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registreren</button>
    </form>
    <p>Heb je al een account? <a href="login.php">Log hier in</a></p>
</body>
</html>
