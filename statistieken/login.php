<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    // Simpele login (hardcoded demo)
    if ($gebruikersnaam == 'admin' && $wachtwoord == 'wachtwoord123') {
        $_SESSION['ingelogd'] = true;
        header('Location: beheer.php');
        exit;
    } else {
        $fout = "Onjuiste inloggegevens!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($fout)) echo "<p style='color:red;'>$fout</p>"; ?>
<form method="post">
    Gebruikersnaam: <input type="text" name="gebruikersnaam" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <input type="submit" value="Inloggen">
</form>
</body>
</html>
