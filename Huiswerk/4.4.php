<?php
// Auteur: Abou
// Functie: Oefening
 
// Lijst met producten en prijzen
$producten = [
    "Laptop" => 200,
    "Telefoon" => 120,
    "Koptelefoon" => 45,
    "Boek" => 30,
    "Televisie" => 180,
    "Muis" => 50
];
 
// Toon originele prijzen
echo "Originele prijzen:<br>";
foreach ($producten as $product => $prijs) {
    echo "$product: €" . number_format($prijs, 2, ',', '.') . "<br>";
}
 
echo "<br>Aangepaste prijzen:<br>";
foreach ($producten as $product => $prijs) {
    if ($prijs > 150) {
        // 19% verhoging voor prijzen boven €150
        $nieuwePrijs = $prijs * 1.19;
        $verhoging = 19;
    } elseif ($prijs < 55) {
        // 11% verhoging voor prijzen onder €55
        $nieuwePrijs = $prijs * 1.11;
        $verhoging = 11;
    } else {
        // Geen verandering voor prijzen tussen €55 en €150
        $nieuwePrijs = $prijs;
        $verhoging = 0;
    }
    // Toon nieuwe prijs en verhoging
    echo "Oude prijs van $product: €" . number_format($prijs, 2, ',', '.') . ". Na verhoging van $verhoging% is de prijs: €" . number_format($nieuwePrijs, 2, ',', '.') . "<br>";
}
?>