<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "cijfers";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}
?>
