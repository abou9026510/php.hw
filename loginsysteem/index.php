<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Welkom</title>
</head>
<body>
    <h1>Welkom, <?php echo htmlspecialchars($username); ?>!</h1>
    <p><a href="logout.php">Uitloggen</a></p>
</body>
</html>
