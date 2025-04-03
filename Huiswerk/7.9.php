<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opdracht 9 - Formulier Verwerken</title>
</head>
<body>
    <form method="post" action="">
        <label for="text">Tekst:</label>
        <input type="text" id="text" name="text" value="<?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?>">
        <br><br>

        <input type="radio" id="uppercase" name="option" value="uppercase" <?php echo (isset($_POST['option']) && $_POST['option'] == 'uppercase') ? 'checked' : ''; ?>>
        <label for="uppercase">In hoofdletters</label>
        <br>

        <input type="radio" id="lowercase" name="option" value="lowercase" <?php echo (isset($_POST['option']) && $_POST['option'] == 'lowercase') ? 'checked' : ''; ?>>
        <label for="lowercase">In kleine letters</label>
        <br>

        <input type="radio" id="sentence" name="option" value="sentence" <?php echo (isset($_POST['option']) && $_POST['option'] == 'sentence') ? 'checked' : ''; ?>>
        <label for="sentence">Eerste letter van zin hoofdletter</label>
        <br>

        <input type="radio" id="capitalize" name="option" value="capitalize" <?php echo (isset($_POST['option']) && $_POST['option'] == 'capitalize') ? 'checked' : ''; ?>>
        <label for="capitalize">Eerste letter van ieder woord hoofdletter</label>
        <br><br>

        <button type="submit">Weergeven</button>
    </form>

    <br><br>
    <div>
        <strong>Resultaat:</strong><br>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $_POST['text'];
            $option = $_POST['option'] ?? '';

            if (!empty($text)) {
                switch ($option) {
                    case 'uppercase':
                        echo strtoupper($text);
                        break;
                    case 'lowercase':
                        echo strtolower($text);
                        break;
                    case 'sentence':
                        echo ucfirst(strtolower($text));
                        break;
                    case 'capitalize':
                        echo ucwords(strtolower($text));
                        break;
                    default:
                        echo "Selecteer een optie.";
                        break;
                }
            } else {
                echo "Voer een tekst in.";
            }
        }
        ?>
    </div>
</body>
</html>