<?php
//Auteur: Abou Functie: Oefening
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fietsenmaker";

try {
    // Maak een nieuwe PDO-verbinding
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Optionele foutmodus

    // Bereid de SQL-query voor
    $query = $conn->prepare("SELECT * FROM fietsen");
    $query->execute();

    // Optioneel: Resultaten ophalen
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo $data["merk"] . " " . $data["type"] . " " . $data["prijs"] . "<br>";
    }
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>