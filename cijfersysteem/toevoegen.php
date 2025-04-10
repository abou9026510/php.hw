<form method="POST" action="">
    <input type="text" name="leerling" placeholder="Leerling" required>
    <input type="number" step="0.1" name="cijfer" placeholder="Cijfer" required>
    <input type="text" name="vak" placeholder="Vak" required>
    <input type="text" name="docent" placeholder="Docent" required>
    <input type="submit" name="submit" value="Toevoegen">
</form>

<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $leerling = $conn->real_escape_string($_POST['leerling']);
    $cijfer = $_POST['cijfer'];
    $vak = $conn->real_escape_string($_POST['vak']);
    $docent = $conn->real_escape_string($_POST['docent']);

    $sql = "INSERT INTO cijfers (leerling, cijfer, vak, docent) VALUES ('$leerling', '$cijfer', '$vak', '$docent')";
    if ($conn->query($sql)) {
        echo "Cijfer toegevoegd!";
    } else {
        echo "Fout: " . $conn->error;
    }
}
?>
