<?php
// Auteur: Abou
// functie getallen optellen mbv for-loop (opdracht 4.4)

// 10,8,7,5 optellen 


// initialisatie 
$getal=[10,8,7,6,5];
// bepaal het aatal getallen in het array $getal
$aantal = count ($getal);
echo "Aantal getallen: $aantal <br>";

$som= 0;

for ($i=0; $i <$aantal; $i++) {
    echo "waarde van i: $i";
    echo " waarde van een getal: $getal[$i] <br>";
    $som= $som+$getal [$i];
    echo "subtotaal: $som<br>";
}







?>