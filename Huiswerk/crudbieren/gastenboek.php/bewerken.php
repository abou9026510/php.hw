<?php
    session_start();
    require 'config.php';
    
    if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        die("Geen rechten!");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $pdo->prepare("UPDATE berichten SET berichttekst = ? WHERE id = ?");
        $stmt->execute([$_POST['bericht'], $_POST['id']]);
        header("Location: index.php");
    }
    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <textarea name="bericht" required></textarea>
        <button type="submit">Opslaan</button>
    </form>
