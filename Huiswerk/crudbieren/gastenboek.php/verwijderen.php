<?php
    session_start();
    require 'config.php';
    
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        die("Geen rechten!");
    }
    
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("DELETE FROM berichten WHERE id = ?");
        $stmt->execute([$_GET['id']]);
    }
    header("Location: index.php");
    ?>