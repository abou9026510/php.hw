<?php
session_start();
require 'config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: gastenboek.php");
    exit();
}

$bericht_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM berichten WHERE id = ?");
$stmt->execute([$bericht_id]);

header("Location: gastenboek.php");
exit();
