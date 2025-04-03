<?php
    session_start();
    require 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        echo "Registratie succesvol! <a href='login.php'>Login</a>";
    }
    ?>
    <form method="post">
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Registreren</button>
    </form>