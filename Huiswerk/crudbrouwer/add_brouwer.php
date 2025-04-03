<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $land = $_POST['land'];
    $sql = "INSERT INTO brouwer (naam, land) VALUES ('$naam', '$land')";
    $conn->query($sql);
}

header("Location: index.php");
?>
