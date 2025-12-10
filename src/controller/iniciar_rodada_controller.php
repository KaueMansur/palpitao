<?php

// require "../model/database.php";

require "../model/rodada.php";

if ($_POST["timeDaCasa"] != "") {
    if ($_POST["timeDeFora"] != "") {

        if ($_POST["timeDaCasa2"] != "") {
            if ($_POST["timeDeFora2"] != "") {
                // $db = new Database();

                $rodada = new Rodada($_POST['timeDaCasa'], $_POST['timeDeFora'], $_POST['timeDaCasa2'], $_POST['timeDeFora2']);
            }
        } else {
            $rodada = new Rodada($_POST['timeDaCasa'], $_POST['timeDeFora']);
        }
        $rodada->iniciarRodada();
    }
}

header("Refresh: 0; url= ../view/adm.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Aguarde...
</body>

</html>