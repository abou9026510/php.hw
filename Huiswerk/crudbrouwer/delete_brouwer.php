<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $checkSql = "SELECT * FROM bier WHERE brouwer_id = $id";
    $result = $conn->query($checkSql);
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Deze brouwer kan niet worden verwijderd omdat hij in gebruik is.');</script>";
    } else {
        $sql = "DELETE FROM brouwer WHERE id=$id";
        $conn->query($sql);
    }
}

header("Location: index.php");
?>
