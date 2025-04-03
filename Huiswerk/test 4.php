<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cijfer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleren of de verbinding werkt
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// SQL-query om gegevens op te halen
$sql = "SELECT id, leerling, cijfer FROM cijfer";
$result = $conn->query($sql);

// Gegevens weergeven in een tabel
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Leerling</th>
                <th>Cijfer</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["leerling"] . "</td>
                <td>" . $row["cijfer"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Geen resultaten gevonden.";
}

$conn->close();
?>