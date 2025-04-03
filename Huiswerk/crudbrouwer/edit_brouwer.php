<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $land = $_POST['land'];
    $sql = "UPDATE brouwer SET naam='$naam', land='$land' WHERE id=$id";
    $conn->query($sql);
}

header("Location: index.php");
?>
