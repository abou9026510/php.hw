<?php
    session_start();
    require 'config.php';
    
    if (!isset($_SESSION['user_id'])) {
        die("U moet ingelogd zijn.");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bericht = $_POST['bericht'];
        $stmt = $pdo->prepare("INSERT INTO berichten (gebruikers_id, berichttekst) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $bericht]);
        header("Location: index.php");
    }
    ?>