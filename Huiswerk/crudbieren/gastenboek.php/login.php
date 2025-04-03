<?php
    session_start();
    require 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['wachtwoord'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: index.php");
        } else {
            echo "Ongeldige login!";
        }
    }
    ?>
    <form method="post">
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Inloggen</button>
    </form>
