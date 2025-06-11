<?php
// Verbinden met database
$pdo = new PDO('mysql:host=localhost;dbname=statistieken', 'gebruikersnaam', 'wachtwoord');

// Gegevens verzamelen
$ipadres = gethostbyname(gethostname()); // of $_SERVER['REMOTE_ADDR'] in echte situatie
$landen = ['Nederland', 'België', 'Duitsland', 'Frankrijk', 'Spanje']; // verzonnen landen
$land = $landen[array_rand($landen)];

$providers = ['KPN', 'Telenet', 'Proximus', 'Vodafone', 'Orange']; // verzonnen providers
$provider = $providers[array_rand($providers)];

$browser = $_SERVER['HTTP_USER_AGENT'];
$datum_tijd = date('Y-m-d H:i:s');
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';

// Gegevens invoegen in database
$stmt = $pdo->prepare("INSERT INTO bezoekers (land, ip_adres, provider, browser, datum_tijd, referrer)
                       VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$land, $ipadres, $provider, $browser, $datum_tijd, $referrer]);

echo "Bezoek geregistreerd!";
?>
