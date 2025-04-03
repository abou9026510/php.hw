<?php
// Auteur: Abou
// Functie: Opdracht
 
// Twee variabelen definiëren
$waarde1 = 30;
$waarde2 = 50;
 
// Bepalen welke de grootste is
if ($waarde1 > $waarde2) {
    $grootste = $waarde1;
    $kleinste = $waarde2;
} else {
    $grootste = $waarde2;
    $kleinste = $waarde1;
}
 
// De grootste waarde verdubbelen en optellen bij de kleinste
$resultaat = ($grootste * 2) + $kleinste;
 
// Resultaat weergeven
echo "De grootste waarde is: $grootste<br>";
echo "De kleinste waarde is: $kleinste<br>";
echo "Het resultaat is: $resultaat<br>";
?>