<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 7 - Looptijd Berekening</title>
</head>
<body>
    <h1>Opdracht 7: Looptijd Berekening</h1>
    <form method="post" action="">
        <label for="startkapitaal">Startkapitaal (€):</label>
        <input type="number" id="startkapitaal" name="startkapitaal" value="100000" required><br><br>

        <label for="rentepercentage">Rentepercentage (%):</label>
        <input type="number" id="rentepercentage" name="rentepercentage" value="4" step="0.01" required><br><br>

        <label for="opname">Jaarlijkse opname (€):</label>
        <input type="number" id="opname" name="opname" value="5000" required><br><br>

        <button type="submit">Bereken de looptijd</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ophalen van ingevoerde waarden
        $startkapitaal = (float)$_POST['startkapitaal'];
        $rentepercentage = (float)$_POST['rentepercentage'];
        $opname = (float)$_POST['opname'];

        // Variabelen voor berekening
        $huidigKapitaal = $startkapitaal;
        $jaar = 0;

        // Bereken de looptijd
        while ($huidigKapitaal > 0) {
            $rente = $huidigKapitaal * ($rentepercentage / 100);
            $huidigKapitaal += $rente; // Voeg rente toe
            $huidigKapitaal -= $opname; // Trek jaarlijkse opname af
            $jaar++;

            // Voorkom oneindige loop
            if ($jaar > 100) {
                echo "<p>Geert kan zijn hele leven lang (€{$opname} per jaar) opnemen.</p>";
                return;
            }
        }

        // Output resultaat
        echo "<p>U kunt {$jaar} jaar lang €{$opname} opnemen.</p>";
    }
    ?>
</body>
</html>
