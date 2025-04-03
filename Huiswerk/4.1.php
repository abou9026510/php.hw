
<?php
//Auteur: Abou
//funnctie: Opdracht 
 
 
// vraag de tijd
$uur = 12;
echo $uur;
 
 
// Controleer het tijd
if ($uur >= 6 && $uur < 12) {
    // Ochtend
    echo "Het is morgen!<br>";
} elseif ($uur >= 12 && $uur < 18) {
    // Middag
    echo "Het is middag!<br>";;
} elseif ($uur >= 18 && $uur < 24) {
    // Avond
    echo "Het is avond!<br>";
} else {
    // Nacht
    echo "Het is nacht!<br>";
}
 
 
?>