<?php
include 'connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM cijfers WHERE id = $id";
    $conn->query($sql);
}

header("Location: index.php");
exit;
