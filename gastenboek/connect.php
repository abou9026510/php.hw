<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "gastenboek";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}
?>
