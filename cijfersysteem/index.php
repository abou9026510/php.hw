<form method="GET" action="">
    <input type="text" name="zoek" placeholder="Zoek op leerling...">
    <input type="submit" value="Zoek">
</form>

<?php
include 'connect.php';

$zoek = isset($_GET['zoek']) ? $conn->real_escape_string($_GET['zoek']) : '';

$sql = "SELECT * FROM cijfers WHERE leerling LIKE '%$zoek%' ORDER BY leerling ASC";
$result = $conn->query($sql);
?>

<table border="1" id="cijferTabel">
    <thead>
        <tr>
            <th onclick="sortTable(0)">Leerling</th>
            <th>Cijfer</th>
            <th>Vak</th>
            <th>Docent</th>
            <th>Actie</th>
        </tr>
    </thead> 
    
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['leerling']) ?></td>
                <td><?= $row['cijfer'] ?></td>
                <td><?= htmlspecialchars($row['vak']) ?></td>
                <td><?= htmlspecialchars($row['docent']) ?></td>
                <td>
                    <a href="verwijder.php?id=<?= $row['id'] ?>" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?');">Verwijder</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </table>
        
        <script>
function sortTable(n) {
    var table = document.getElementById("cijferTabel");
    var switching = true;
    var dir = "asc";
    var switchcount = 0;
  
    while (switching) {
        switching = false;
        var rows = table.rows;
    
        for (var i = 1; i < (rows.length - 1); i++) {
            var shouldSwitch = false;
            var x = rows[i].getElementsByTagName("TD")[n];
            var y = rows[i + 1].getElementsByTagName("TD")[n];
    
            if ((dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                (dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {
                shouldSwitch = true;
                break;
            }
        }
    
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
        }
    }
}
</script>

    </tbody>


