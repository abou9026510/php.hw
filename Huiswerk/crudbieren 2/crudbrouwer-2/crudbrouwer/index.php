<?php
include 'config.php';

$brouwers = $conn->query("SELECT * FROM brouwer");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Brouwers</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Brouwer Toevoegen</h2>
    <form action="add_brouwer.php" method="POST">
        Naam: <input type="text" name="naam" required>
        Land: <input type="text" name="land" required>
        <button type="submit">Toevoegen</button>
    </form>

    <h2>Brouwer Lijst</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Land</th>
            <th>Acties</th>
        </tr>
        <?php while ($row = $brouwers->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['naam'] ?></td>
                <td><?= $row['land'] ?></td>
                <td>

}


                    <form action="edit_brouwer.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="naam" value="<?= $row['naam'] ?>" required>
                        <input type="text" name="land" value="<?= $row['land'] ?>" required>
                        <button type="submit">Bewerken</button>
                    </form>
                    <form action="delete_brouwer.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" onclick="return confirm('Weet je zeker dat je deze brouwer wilt verwijderen?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
