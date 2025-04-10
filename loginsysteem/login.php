<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Valideer de invoer
    if (empty($username) || empty($password)) {
        die('Gebruikersnaam en wachtwoord zijn verplicht.');
    }

    // Controleer of de gebruikersnaam bestaat
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Initialiseer de sessie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        die('Ongeldige gebruikersnaam of wachtwoord.');
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
</head>
<body>
    <h1>Inloggen</h1>
    <form method="POST" action="login.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Inloggen</button>
    </form>
    <p>Heb je nog geen account? <a href="register.php">Registreer hier</a></p>
</body>
</html>
