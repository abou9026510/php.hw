<?php
// Auteur: Abou
// Functie: Opdracht 
 
// Vraag de tijd
$uur = 12;
echo $uur . "<br>";
 
// Controleer de tijd met switch
switch (true) {
    case ($uur >= 6 && $uur < 12):
        // Ochtend
        echo "Het is morgen!<br>";
        break;
    case ($uur >= 12 && $uur < 18):
        // Middag
        echo "Het is middag!<br>";
        break;
    case ($uur >= 18 && $uur < 24):
        // Avond
        echo "Het is avond!<br>";
        break;
    default:
        // Nacht
        echo "Het is nacht!<br>";
        break;
}
?>