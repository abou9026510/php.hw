<?php
// Database connectie
$pdo = new PDO("mysql:host=localhost;dbname=statistieken", "gebruiker", "wachtwoord");

// Functie om random land te kiezen
function randomLand() {
    $landen = ['Nederland', 'België', 'Duitsland', 'Frankrijk', 'Verenigd Koninkrijk'];
    return $landen[array_rand($landen)];
}

// Functie om random browser te kiezen
function randomBrowser() {
    $browsers = ['Chrome', 'Firefox', 'Edge', 'Safari', 'Opera'];
    return $browsers[array_rand($browsers)];
}

// Functie om random provider te kiezen
function randomProvider() {
    $providers = ['KPN', 'Ziggo', 'T-Mobile', 'Tele2', 'Delta'];
    return $providers[array_rand($providers)];
}

// Testdata genereren
for ($i = 0; $i < 50; $i++) {
    $land = randomLand();
    $ip = "192.168." . rand(0, 255) . "." . rand(0, 255);
    $provider = randomProvider();
    $browser = randomBrowser();
    $datum_tijd = date('Y-m-d H:i:s', strtotime('-' . rand(0, 60) . ' days'));
    $referrer = 'https://voorbeeldsite.nl';

    $stmt = $pdo->prepare("INSERT INTO bezoekers (land, ip_adres, provider, browser, datum_tijd, referrer)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$land, $ip, $provider, $browser, $datum_tijd, $referrer]);
}

echo "50 bezoekers zijn toegevoegd!";
?>
